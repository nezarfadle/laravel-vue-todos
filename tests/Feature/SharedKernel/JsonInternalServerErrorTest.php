<?php

namespace Tests\Feature\SharedKernel;

use Tests\TestCase;
use SharedKernel\Http\JsonInternalServerError;
use Illuminate\Http\Response;

class JsonInternalServerErrorTest extends TestCase
{
    
    public function test_should_return_internal_server_error_http_status_code()
    {
        $uut = new JsonInternalServerError( 200 );
        $this->assertEquals( Response::HTTP_INTERNAL_SERVER_ERROR, $uut->status() );
    }

    public function test_response_conetnt()
    {
    	$uut = new JsonInternalServerError( 200 );
    	$content = json_decode( $uut->content() );
    	$this->assertEquals( 200 , $content->code );
    	$this->assertEquals( "error" , $content->status );
    	$this->assertEquals( "Internal server error" , $content->messages[0] );
    }
}
