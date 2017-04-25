<?php

namespace Tests\Feature\SharedKernel;

use Tests\TestCase;
use SharedKernel\Http\CreatedJsonResponse;
use Illuminate\Http\Response;

class CreatedJsonResponseTest extends TestCase
{
    
    public function test_should_return_created_http_status_code()
    {
        $uut = new CreatedJsonResponse( 200, 'todos/1' );
        $this->assertEquals( Response::HTTP_CREATED, $uut->status() );
    }

    public function test_response_conetnt()
    {
    	$uut = new CreatedJsonResponse( 200, 'todos/1' );
    	$content = json_decode( $uut->content() );
    	$this->assertEquals( 200 , $content->code );
    	$this->assertEquals( "created" , $content->status );
    	$this->assertEquals( 
    		"http://localhost/todos/1", 
    		$content->links->href
    	);
    }
}
