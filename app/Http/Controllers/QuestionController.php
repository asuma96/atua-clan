<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Transformers\Question\QuestionTransformer;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use JsonException;
use League\Fractal;
use Throwable;

class QuestionController extends \App\Http\Controllers\Controller
{
    /** @var \League\Fractal\Manager */
    protected Fractal\Manager $fractalManager;

    /**
     * @return mixed
     */
    public function index()
    {
        $questions = Question::query()->with('answers')->inRandomOrder()->limit(10)->get();
        $preparedQuestions = $this->prepareQuestionToResponse($questions);
        return $this->response($preparedQuestions);
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
        $isCreated = $this->prepareQuestionAnswerAndSave($question, $request);

        // If model not created, send error response to client.
        if (! $isCreated) {
            return $this->error('Во время создания что-то пошло не так, попробуйте еще раз.');
        }

        // Prepare model to response.
        $preparedUser = $this->prepareQuestionToResponse($question);

        return $this->response($preparedUser);
    }

    //@Todo create percent for answers...and check answers.
    protected function prepareQuestionAnswerAndSave(){

    }
    /**
     * @param $question
     * @return array|null
     */
    protected function prepareQuestionToResponse($question): ?array
    {
        // Transform model data.
        return $this->fractalManager->createData(
            (new Fractal\Resource\Item($question, new QuestionTransformer))
        )->toArray();
    }

    /**
     * @param $id
     * @return JsonResponse|object
     */
    public function show($id)
    {
        $question = Question::query()->where('id', $id)->firstOrFail();

        // Prepare model to response.
        $questionPrepared = $this->preparePostToResponse($question);

        return $this->response($questionPrepared);
    }
}
