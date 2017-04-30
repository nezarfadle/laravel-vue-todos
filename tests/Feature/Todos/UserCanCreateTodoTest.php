<?php

namespace Tests\Feature\Todos;

use Tests\TestCase;
use Illuminate\Http\Response;
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

        $res->assertStatus( Response::HTTP_CREATED );
        $res->assertJson([
            "id" => 1,
            "code" => "200",
            "status" => "created",
            "links" => [
                'href' => env('APP_URL') . 'todos/1'
            ]
        ]);
    	$this->assertDatabaseHas( 'todos', $dbData );

    }


    public function test_invalid_request_to_create_todo_should_fail()
    {
        $data = [
            'title' => ''
        ];

        $this->assertEquals( 0, Todo::count() );
        $res = $this->post( 'todos', $data );
        $res->assertStatus( Response::HTTP_UNPROCESSABLE_ENTITY );
        $this->assertEquals( 0, Todo::count() );

    }

}
