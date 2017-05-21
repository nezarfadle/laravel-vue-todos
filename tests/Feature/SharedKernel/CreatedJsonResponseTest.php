<?php

namespace Tests\Feature\SharedKernel;

use Tests\TestCase;
use SharedKernel\Http\CreatedJsonResponse;
use Illuminate\Http\Response;

class CreatedJsonResponseTest extends TestCase
{
    
    public function test_should_return_created_http_status_code()
    {
        $todo = factory(\Todos\Models\Todo::class)->make();
        $uut = new CreatedJsonResponse( $todo, 200, 'todos/1' );
        $this->assertEquals( Response::HTTP_CREATED, $uut->status() );
    }

    public function test_response_conetnt()
    {
        $todo = factory(\Todos\Models\Todo::class)->make([ 'id' => 1 ]);
    	$uut = new CreatedJsonResponse( $todo, 200, 'todos/1' );
    	$response = json_decode( $uut->content() );
        $this->assertEquals( json_decode($todo) , $response->todo );
    	$this->assertEquals( 200 , $response->code );
    	$this->assertEquals( "created" , $response->status );
    }
}
