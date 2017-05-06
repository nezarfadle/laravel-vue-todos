<?php

namespace Tests\Browser\Todos;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\User;
use Todos\Models\Todo;

class UserCanEditTodoTest extends DuskTestCase
{
    
     public function test_user_can_edit_todo()
    {
       
        factory(User::class)->create( [ 'id' => 1, 'email' => 'user1@gmail.com' ] );
        $this->browse(function (Browser $browser) {
            
     
            $this->assertDatabaseMissing('todos', [ 'title' => 'todo 1'] );
            $this->assertDatabaseMissing('todos', [ 'title' => 'todo 2'] );
            
            $browser->loginAs(User::find(1))
                    ->visit('/')
                    ->keys('input#title', 'todo 1', '{enter}')
                    ->waitFor('li.completed')
                    ->type('.text-todo:first-child', 'todo 2')
            ;

            
            $browser->click('input#title');
            $browser->pause(1000);
            
            $this->assertDatabaseMissing('todos', [ 'title' => 'todo 1'] );
            $this->assertDatabaseHas('todos', [ 'title' => 'todo 2'] );

        });
    }

}
