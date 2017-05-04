<?php

namespace Tests\Feature\Todos;

use Tests\TestCase;

use Todos\Models\Todo;
use Tests\Traits\CreateUser;

class UserCanRetrieveHisTodosTest extends TestCase
{
	
	use CreateUser;

    public function test_todos_structure()
    {
        
        factory(Todo::class, 5)->create();

        $res = $this->get('todos');
        $res->assertStatus(200)
            ->assertJsonStructure( 
                [ 'data' => [
                    [ 'id', 'title' ] 
                ]] 
            );
        

    }

    public function test_user_can_retrieve_his_todos()
    {
    	
    	factory(Todo::class, 5)->create();

    	$res = $this->get('todos');
    	$todos = $res->assertStatus(200)
                      ->decodeResponseJson();

        $this->assertCount( 5, $todos["data"] );

    }
    
}
