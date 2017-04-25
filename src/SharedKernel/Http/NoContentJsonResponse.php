<?php

namespace SharedKernel\Http;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class NoContentJsonResponse extends JsonResponse
{

	public function __construct()
	{
		parent::__construct( [], Response::HTTP_NO_CONTENT );
	}
}