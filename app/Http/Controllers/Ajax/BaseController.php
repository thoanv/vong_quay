<?php
/**
 * Created by PhpStorm.
 * User: vietlv
 * Date: 11/30/2018
 * Time: 9:40 AM
 */

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * @param $result
     * @param $message
     * @return JsonResponse
     */
    public function sendResponse($result, $message=null)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message
        ];

        return response()->json($response, 200);
    }

    /**
     * @param $error
     * @param array $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
