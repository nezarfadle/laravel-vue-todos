<?php

namespace Tests\Feature\Todos;

use Tests\TestCase;
use Illuminate\Http\Response;
use Tests\Traits\CreateUser;
use App\User;
use Todos\Models\Todo;

class UserCanDeleteTodoTest extends TestCase
{
    use CreateUser;
   	
   	public function test_user_can_delete_todo()
   	{
   		
   		factory(User::class)->create([ 'id' => 2 ]);
   		factory(Todo::class)->create([ 'id' => 1, 'user_id' => 1 ]);
   		factory(Todo::class)->create([ 'id' => 2, 'user_id' => 2 ]);	

         $this->assertEquals( 2, Todo::count() );
         
         $id = 1;
         $res= $this->delete("todos/$id");


         $res->assertStatus( Response::HTTP_NO_CONTENT );
         $this->assertEquals( 1, Todo::count() );

   	}

      public function test_user_cannot_delete_others_todos()
      {
         
         factory(User::class)->create([ 'id' => 2 ]);
         factory(Todo::class)->create([ 'id' => 1, 'user_id' => 1 ]);
         factory(Todo::class)->create([ 'id' => 2, 'user_id' => 2 ]);   

         $this->assertEquals( 2, Todo::count() );
         
         $id = 2;
         $res= $this->delete("todos/$id");

         $res->assertStatus( Response::HTTP_FORBIDDEN );
         $this->assertEquals( 2, Todo::count() );

      }
}
