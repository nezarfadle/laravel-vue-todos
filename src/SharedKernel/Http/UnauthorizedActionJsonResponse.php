<?php

namespace SharedKernel\Http;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UnauthorizedActionJsonResponse extends JsonResponse
{

	public function __construct()
	{	
		parent::__construct( [ 'message' => 'Unauthorized action' ], Response::HTTP_FORBIDDEN );
	}
	
}