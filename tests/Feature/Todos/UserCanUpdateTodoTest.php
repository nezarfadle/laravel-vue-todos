<?php

namespace Tests\Feature\Todos;

use Tests\TestCase;
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
 		
 		$this->assertDatabaseHas( 'todos', [ 'title' => 'todo 2'] );
 		$this->assertDatabaseMissing( 'todos', [ 'title' => 'todo 1'] );

    }
}
