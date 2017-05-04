<?php

namespace Tests\Feature\Todos;

use Tests\TestCase;
use Illuminate\Http\Response;
use Todos\Models\Todo;
use Tests\Traits\CreateUser;

class UserCanUpdateTodoTest extends TestCase
{
	
	use CreateUser;

    public function test_user_can_update_his_own_todo()
    {
 		
 		factory(Todo::class)->create( [ 'id' => 1, 'title' => 'todo 1' ] );   	    
 		$data = [
 			'title' => 'todo 2'
 		];

 		$this->assertDatabaseHas( 'todos', [ 'title' => 'todo 1'] );
 		$this->assertDatabaseMissing( 'todos', [ 'title' => 'todo 2'] );
 		
 		$res = $this->put( 'todos/1', $data );
 		
 		$res->assertStatus( Response::HTTP_NO_CONTENT );
 		$this->assertDatabaseHas( 'todos', [ 'title' => 'todo 2'] );
 		$this->assertDatabaseMissing( 'todos', [ 'title' => 'todo 1'] );

    }

    public function test_invalid_request_to_update_todo_should_fail()
    {
		factory(Todo::class)->create( [ 'id' => 1, 'title' => 'todo 1' ] );   	    
 		$data = [
 			'title' => ''
 		];

 		$this->assertDatabaseHas( 'todos', [ 'title' => 'todo 1'] );
 		
 		$res = $this->put( 'todos/1', $data );
 		
 		$res->assertStatus( Response::HTTP_UNPROCESSABLE_ENTITY	 );
 		$this->assertDatabaseHas( 'todos', [ 'title' => 'todo 1'] );
 		
    }

    public function test_user_cannot_update_other_users_todos_be_injecting_user_id_in_the_request()
    {

        factory(\App\User::class)->create( [ 'id' => 2 ] );         
        factory(Todo::class)->create( [ 'id' => 1, 'title' => 'todo 1' ] );         
        $data = [
            'title' => 'todo 2',
            'user_id' => 2
        ];

        $this->assertDatabaseHas( 'todos', [ 'title' => 'todo 1', 'user_id' => 1] );
        $this->assertDatabaseMissing( 'todos', [ 'title' => 'todo 2', 'user_id' => 1] );
        
        $res = $this->put( 'todos/1', $data );
        
        $this->assertDatabaseHas( 'todos', [ 'title' => 'todo 2', 'user_id' => 1 ] );
        $this->assertDatabaseMissing( 'todos', [ 'title' => 'todo 2', 'user_id' => 2 ] );
        
    }

    public function test_user_cannot_update_other_users_todos()
    {

        factory(\App\User::class)->create( [ 'id' => 2 ] );         
        factory(Todo::class)->create( [ 'id' => 1, 'title' => 'todo 1', 'user_id' => 2 ] );         
        $data = [
            'title' => 'todo 2'
        ];

        $this->assertDatabaseHas( 'todos', [ 'title' => 'todo 1', 'user_id' => 2] );
        $this->assertDatabaseMissing( 'todos', [ 'title' => 'todo 2', 'user_id' => 1] );
        
        $res = $this->put( 'todos/1', $data );
        $res->assertStatus( Response::HTTP_FORBIDDEN );
        $this->assertDatabaseHas( 'todos', [ 'title' => 'todo 1', 'user_id' => 2 ] );
        $this->assertDatabaseMissing( 'todos', [ 'title' => 'todo 2', 'user_id' => 1 ] );
        
    }
}
