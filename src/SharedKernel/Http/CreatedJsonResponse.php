<?php

namespace SharedKernel\Http;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CreatedJsonResponse extends JsonResponse
{


	public function __construct( $id, $codeId, $resourceUrl )
	{
		$data['code'] 	  = $codeId;
		$data['status']   = 'created';
		$data['id'] 	  = $id;
		$data['links']    = [
			'href' => env('APP_URL') . $resourceUrl
		];
		
		parent::__construct( $data, Response::HTTP_CREATED );

	}
	
}