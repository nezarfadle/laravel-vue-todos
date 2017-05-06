<?php

namespace Tests\Feature\Todos;

use Tests\TestCase;
use Illuminate\Http\Response;
use Tests\Traits\CreateUser;
use App\User;
use Todos\Models\Todo;

class UserCanDeleteMultibleTodosTest extends TestCase
{
	
    use CreateUser;

    public function test_user_can_delete_multible_todos_owned_by_him_only()
    {

        factory(User::class)->create([ 'id' => 2 ]);
   		factory(Todo::class, 4)->create();
   		factory(Todo::class, 1)->create( [ 'user_id' => 2 ]);	

        $this->assertEquals( 5, Todo::count() );
        $this->assertDatabaseHas('todos', [ 'id' => 1 ]);
   		$this->assertDatabaseHas('todos', [ 'id' => 2 ]);
   		$this->assertDatabaseHas('todos', [ 'id' => 3 ]);
   		$this->assertDatabaseHas('todos', [ 'id' => 4 ]);
   		$this->assertDatabaseHas('todos', [ 'id' => 5 ]);

        $res= $this->delete("todos/delete/multi?ids=1,2,6");
        
        $res->assertStatus( Response::HTTP_NO_CONTENT );
        $this->assertDatabaseMissing('todos', [ 'id' => 1 ]);
   		$this->assertDatabaseMissing('todos', [ 'id' => 2 ]);
   		$this->assertDatabaseHas('todos', [ 'id' => 3 ]);
   		$this->assertDatabaseHas('todos', [ 'id' => 4 ]);
   		$this->assertDatabaseHas('todos', [ 'id' => 5 ]);

    }
}
