<?php

namespace Tests\Browser\Todos;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\User;
use Todos\Models\Todo;

class UserCanSeeHisTodosTest extends DuskTestCase
{
    /**
     * @group foo
     */
    public function test_user_can_see_his_todos()
    {

        factory(User::class)->create( [ 'id' => 1, 'email' => 'user1@gmail.com' ] );
        factory(Todo::class)->create([ 'title' => 'todo 1']);

        $this->browse(function (Browser $browser) {
            
            $browser->loginAs(User::find(1))
                    ->visit('/')
                    ->waitFor('li.completed');
        
            $el = $browser->elements('.todo-list > li:nth-child(1) .text-todo');
            $title = $el[0]->getAttribute('value');
            
            $this->assertEquals( 'todo 1', $title );
         

        });
    }
}
