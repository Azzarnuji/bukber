<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function responseTemplate( $httpCode = 200, $message = 'Success', mixed $data =null)
    {
        return [
            'httpCode' => $httpCode,
            'message' => $message,
            'data' => $data
        ];
    }
}
