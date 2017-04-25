<?php

namespace SharedKernel\Http;

use Illuminate\Http\JsonResponse;

class JsonInvalidEntityResponse extends JsonResponse
{


	public function __construct( $code, $messages )
	{
		
		$errors = [];
		foreach ($messages as $error) {
			$errors[] = $error[0];
		}

		$data = [
            'code' => $code,
            'status' => "Error",
            'messages' => $errors
        ];
		
		parent::__construct($data, 422);

	}
	
}