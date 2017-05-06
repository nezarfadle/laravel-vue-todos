<?php

namespace Tests\Browser\Todos;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\User;
use Todos\Models\Todo;

class UserCanMarkTodoAsCompletedTest extends DuskTestCase
{
    
    public function test_user_can_mark_todo_as_completed()
    {

        factory(User::class)->create( [ 'id' => 1, 'email' => 'user1@gmail.com' ] );
        factory(Todo::class, 5)->create([ 'user_id' => 1]);

        $this->browse(function (Browser $browser) {
     
            $this->assertDatabaseMissing( 'todos', [ 'id' => 1, 'complete' => true ] );
            $this->assertDatabaseMissing( 'todos', [ 'id' => 5, 'complete' => true ] );
            
            $browser->loginAs(User::find(1))
                    ->visit('/')
                    ->waitFor('li.completed')
                    ->check('.todo-list > li:nth-child(1) .toggle')
                    ->check('.todo-list > li:nth-child(5) .toggle')
                    ->pause(1000)
            ;

            $this->assertDatabaseHas( 'todos', [ 'id' => 1, 'complete' => true ] );
            $this->assertDatabaseHas( 'todos', [ 'id' => 5, 'complete' => true ] );
            
        });
    }

}
