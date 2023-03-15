<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Transformers\User\UserTransformer;
use League\Fractal;

class UserController extends \App\Http\Controllers\Controller
{
    /** @var \League\Fractal\Manager */
    protected Fractal\Manager $fractalManager;

    /**
     * @param UserRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create(UserRequest $request)
    {
        // Create new model
        $user = new User();
        $user->create(['name', $request->get('name')]);
        $user->save();
        $user =  $this->fractalManager->createData(
            (new Fractal\Resource\Item($user, new UserTransformer()))
        )->toArray();
        return view('pages.quiz', [
            'user' => $user
        ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete( $id)
    {
        /** @var User $user */
        $user = User::findOrFail($id);

        $user->delete();

        return $this->response('Пользователь успешно удален.');
    }

    /**
     * @param $id
     * @return array|null
     */
    public function show($id)
    {
        $user = User::query()->where('id', $id)->firstOrFail();

        return $this->fractalManager->createData(
            (new Fractal\Resource\Item($user, new UserTransformer()))
        )->toArray();
    }
}
