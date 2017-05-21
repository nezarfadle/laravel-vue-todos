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
            "todo" => [ "id" => 1 ],
            "code" => "200",
            "status" => "created"
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

    public function test_user_caanot_assign_a_new_todo_to_other_user()
    {
        factory(\App\User::class)->create( [ 'id' => 2 ] );         
        
        $todoTitle = 'todo 1';
        $data = [
            'title' => $todoTitle,
            'user_id' => 2
        ];

        $dbData = [
            'title'     => $todoTitle,
            'user_id'   => 1,
        ];

        $this->assertDatabaseMissing( 'todos', $dbData );
        $res = $this->post('todos', $data);

        $res->assertStatus( Response::HTTP_CREATED );
        $res->assertJson([
            "todo" =>  [ "id" => 1 ],
            "code" => "200",
            "status" => "created",
        ]);
        $this->assertDatabaseHas( 'todos', $dbData );
        $this->assertDatabaseMissing( 'todos', [ 'title' => $todoTitle, 'user_id' => 2 ] );
        
    }

}
