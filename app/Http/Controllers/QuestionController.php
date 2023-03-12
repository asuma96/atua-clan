<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Transformers\Question\QuestionTransformer;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JsonException;
use League\Fractal;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\DataArraySerializer;
use Throwable;

class QuestionController extends \App\Http\Controllers\Controller
{
    /** @var \League\Fractal\Manager */
    protected Fractal\Manager $fractalManager;

    /**
     */
    public function index()
    {
        return $this->response();
    }

    /**
     * @param  QuestionRequest  $request
     * @return JsonResponse|object
     *
     * @throws JsonException|Throwable
     */
    public function create(QuestionRequest $request)
    {
        // Create new model
        $question = new Question();

        // Prepare model from request and save data.
        $isCreated = $this->prepareQuestionAndSave($question, $request);

        // If model not created, send error response to client.
        if (! $isCreated) {
            return $this->error('Во время создания что-то пошло не так, попробуйте еще раз.');
        }

        // Prepare model to response.
        $preparedPost = $this->prepareQuestionToResponse($question);

        return $this->response($preparedPost);
    }

    /**
     * @param Question $question
     * @param FormRequest $request
     * @return bool
     */
    protected function prepareQuestionAndSave(Question $question, FormRequest $request): bool
    {
        // Get only validated from form request data
        $validatedRequestData = $request->validated();

        // Store image from request
        $newImagePathFromRequest = $this->storeImage($request->file('image'), with($question)->getTable());

        // Override image in data if request image successfully upload.
        if ($newImagePathFromRequest) {
            $validatedRequestData = array_merge($validatedRequestData, [
                'image' => $newImagePathFromRequest,
            ]);
        }

        // Fill model from validated request data
        $post->fill($validatedRequestData);

        try {
            DB::transaction(function () use (&$post, $request) {
                if (! $post->save()) {
                    throw new Exception('Post not saved. Rollback transaction.');
                }

                // Attach text-editor files to this model
                if ($request->has('textEditorAttachments')) {
                    MediaFile::query()
                        ->where('mediafileable_type', Post::class)
                        ->whereIn('id', $request->get('textEditorAttachments'))
                        ->update([
                            'mediafileable_id' => $post->id,
                        ]);
                }

                // Check has brand_ids in request, and save to relation.
                $brandIds = $request->get('brand_ids', []);
                $brandIdsFiltered = array_filter(! is_array($brandIds) ? [$brandIds] : $brandIds);

                // Attach Brands to Post, if existed in request
                $post->brands()->sync($brandIdsFiltered);

                $categoryIds = $request->get('category_ids', []);
                $categoryIdsFiltered = array_filter(! is_array($categoryIds) ? [$categoryIds] : $categoryIds);

                // Attach Categories to Post, if existed in request
                $post->categories()->sync($categoryIdsFiltered);
            }, 5);
        } catch (Exception $e) {
            // If model not updated, remove image from server, before sent and upload from request.
            if ($newImagePathFromRequest) {
                $this->dropImage($newImagePathFromRequest);
            }

            // Register error if image not upload to server.
            $this->logError($e);

            //@todo: throw
            return false;
        }

        return true;
    }

    /**
     * @param Question $question
     * @return array|null
     */
    protected function prepareQuestionToResponse(Question $question): ?array
    {
        // Transform model data.
        return $this->fractalManager->createData(
            (new Fractal\Resource\Item($question, new QuestionTransformer))
        )->toArray();
    }

    /**
     * @param  UpdatePostRequest  $request
     * @param $id
     * @return JsonResponse|object
     *
     * @throws Throwable
     */
    public function update(UpdatePostRequest $request, $id)
    {
        // Find model, if not found throw exception
        $post = Post::query()->findOrFail($id);

        // Save image path from model to variable.
        // If new image pass, delete this image after model is successfully updated.
        $imagePathBeforeStoreNewData = $post->image;

        // Prepare model from request and save data.
        $isUpdated = $this->preparePostAndSave($post, $request);

        // If model not updated, send error response to client.
        if (! $isUpdated) {
            return $this->error('Во время обновления что-то пошло не так, попробуйте еще раз.');
        }

        // Delete oldest image from server, if new image exist
        if ($imagePathBeforeStoreNewData !== $post->image) {
            $this->dropImage($imagePathBeforeStoreNewData);
        }

        // Prepare model to response.
        $preparedPost = $this->preparePostToResponse($post);

        return $this->response($preparedPost);
    }

    /**
     * @param  DeletePostRequest  $request
     * @param $id
     * @return JsonResponse|object
     */
    public function delete(DeletePostRequest $request, $id)
    {
        /** @var Post $post */
        $post = Post::findOrFail($id);
        $pathImageOldestDatabase = $post->image;

        if ($post->delete()) {
            // Drop image, if model successfully deleted.
            $this->dropImage($pathImageOldestDatabase);
        }

        return $this->response('Сущность успешно удалена.');
    }

    /**
     * @param $id
     * @return JsonResponse|object
     */
    public function show($id)
    {
        $post = Question::query()->where('id', $id)->firstOrFail();

        // Prepare model to response.
        $postPrepared = $this->preparePostToResponse($post);

        return $this->response($postPrepared);
    }
}
