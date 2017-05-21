<?php

namespace SharedKernel\Http;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CreatedJsonResponse extends JsonResponse
{


	public function __construct( $todo, $codeId, $resourceUrl )
	{
		
		$data['code'] 	  = $codeId;
		$data['status']   = 'created';
		$data['todo'] 	  = $todo;
		
		parent::__construct( $data, Response::HTTP_CREATED );

	}
	
}