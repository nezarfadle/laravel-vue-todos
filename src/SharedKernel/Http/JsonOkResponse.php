<?php

namespace SharedKernel\Http;

use Illuminate\Http\JsonResponse;

class JsonOkResponse extends JsonResponse
{


	public function __construct( $code, $messages, $http_status_code = 200 )
	{
		$data = [
            'code' => $code,
            'status' => 'Success',
            'messages' => $messages,
        ];
		
		parent::__construct($data, $http_status_code);

	}

	
}