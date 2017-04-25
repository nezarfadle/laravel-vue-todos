<?php

namespace SharedKernel\Http;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class JsonInternalServerError extends JsonResponse
{

	public function __construct( $codeId )
	{
		$data['code'] 	  = $codeId;
		$data['status']   = 'error';
		$data['messages'] = [ 'Internal server error' ];
		parent::__construct( $data, Response::HTTP_INTERNAL_SERVER_ERROR );
	}
	
}