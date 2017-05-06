<?php

namespace Tests\Browser\Todos;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\User;
use Todos\Models\Todo;

class UserCanAddTodoTest extends DuskTestCase
{
    
    public function test_user_can_add_todo()
    {

        factory( User::class )->create( [ 'id' => 1, 'email' => 'user1@gmail.com' ] );
        $this->assertDatabaseMissing( 'todos', [ 'title' => 'todo 1'] );

        $this->browse( function ( Browser $browser ) {
            
            $this->assertCount( 0, $browser->elements('li.completed') );

            $browser->loginAs( User::find(1) )
                    ->visit( '/' )
                    ->keys( 'input#title', 'todo 1', '{enter}' )
                    ->waitFor( 'li.completed' )
            ;

            $this->assertCount( 1, $browser->elements('li.completed'));
            $this->assertDatabaseHas('todos', [ 'title' => 'todo 1'] );
                        
        });
    }

}
