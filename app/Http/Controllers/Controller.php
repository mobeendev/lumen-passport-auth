<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public $apiResponse = [
        'success' => true,
        "service_name" => "",
        "code" => "",
        "message" => "",
    ];

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($message = NULL, $data = NULL, $code = 200)
    {
        $this->apiResponse['message'] = isset($message) ? $message : '';
        $this->apiResponse['code'] = isset($code) ? $code : '200';

        if (!empty($data)) {
            $this->apiResponse['data'] = $data;
        }

        return response()->json($this->apiResponse);
    }


}
