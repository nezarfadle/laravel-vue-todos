<?php

namespace Tests\Feature\SharedKernel;

use Tests\TestCase;
use SharedKernel\Http\NoContentJsonResponse;
use Illuminate\Http\Response;

class NoContentJsonResponseTest extends TestCase
{
    
    public function test_should_return_no_content_http_status_code()
    {
        $uut = new NoContentJsonResponse();
        $this->assertEquals( Response::HTTP_NO_CONTENT, $uut->status() );
    }
}
