<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\QuestionGetPercentRequest;
use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Models\User;
use App\Transformers\Question\QuestionTransformer;
use App\Transformers\Serializer\ArraySerializer;
use App\Transformers\User\UserTransformer;
use Exception;
use Illuminate\Http\JsonResponse;
use JsonException;
use League\Fractal;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\DataArraySerializer;
use Throwable;

class QuestionController extends \App\Http\Controllers\Controller
{

    /**
     * @return mixed
     */
    public function index()
    {

        $questions = Question::query()->with('answers')->inRandomOrder()->limit(10)->paginate(10);
        $resource = $this->prepareQuestionToResponse($questions);

        return view('pages.quiz', [
            'questions' => $resource->toJson(),
            'user' => [
                'name' => session()->get('user')['name'] ?? User::query()->orderBy('created_at','desc')->first()['name'],
                'id' => session()->get('user')['id'] ?? User::query()->orderBy('created_at','desc')->first()['id']
            ]
        ]);
    }

    /**
     * @param $question
     * @return Fractal\Scope
     */
    protected function  prepareQuestionToResponse($question): Fractal\Scope
    {
        // Transform model data.
        $result = new Fractal\Resource\Collection($question->getCollection(), new QuestionTransformer());
        $result->setPaginator(new IlluminatePaginatorAdapter($question));
        $this->fractalManager->setSerializer(new DataArraySerializer());

        return $this->fractalManager->createData($result);
    }

    /**
     * @param $userId
     * @param QuestionGetPercentRequest $request
     * @return array|null
     */
    public function getPercent($userId, QuestionGetPercentRequest $request)
    {
        $answers = $request->get('answers');

        $i = 0;

        foreach ($answers as $answer) {
            $i += $answer === "true" ? 1 : 0;
        }
        $percent = $i / 11 * 100;

        $user = User::query()->findOrFail($userId);
        $user->percent = round($percent);
        $user->qr = true;
        $user->save();

        return $this->fractalManager->createData(
            (new Fractal\Resource\Item($user, new UserTransformer()))
        )->toArray();
    }
}
