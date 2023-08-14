<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\HTtp\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function sendResponse($result, $message)
    {
        $response = [
            'status' => Response::HTTP_OK,
            'message' => $message,
            'data' => $result,
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    protected function sendError($error, $errorMessages = [], $status = Response::HTTP_BAD_REQUEST)
    {
        $response = [
            'status' => $status,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $status);
    }
}
