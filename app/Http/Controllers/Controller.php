<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /** @var \League\Fractal\Manager */
    protected mixed $fractalManager;

    public function __construct()
    {

        $this->fractalManager = app()->make(Fractal\Manager::class);

        /* ToDo: Remove, after "list" refactoring as Admin/BannerController.php */
        //$this->fractalManager->setSerializer(new ArraySerializer());
        $this->setDefaultFractalSerializer();
    }

    public function setDefaultFractalSerializer(): void
    {
        $this->fractalManager->setSerializer(new ArraySerializer());
    }
}
