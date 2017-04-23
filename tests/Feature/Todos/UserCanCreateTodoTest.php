<?php

namespace Tests\Feature\Todos;

use Tests\TestCase;
use Tests\Traits\CreateUser;
use Todos\Models\Todo;

class UserCanCreateTodoTest extends TestCase
{
    use CreateUser;

    public function test_user_can_create_todo()
    {
        $todoTitle = 'todo 1';
    	$data = [
    		'title' => $todoTitle
    	];

        $dbData = [
            'title'     => $todoTitle,
            'user_id'   => 1,
        ];

    	$this->assertDatabaseMissing( 'todos', $dbData );
        $res = $this->post('todos', $data);

        $res->assertStatus( 201 );
    	$this->assertDatabaseHas( 'todos', $dbData );

    }


    public function test_invalid_request_should_fail()
    {
        $data = [
            'title' => ''
        ];

        $this->assertEquals( 0, Todo::count() );
        $res = $this->post( 'todos', $data );
        $res->assertStatus( 422 );
        $this->assertEquals( 0, Todo::count() );

    }

}
