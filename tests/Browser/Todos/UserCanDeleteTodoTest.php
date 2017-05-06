<?php

namespace Tests\Browser\Todos;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\User;
use Todos\Models\Todo;

class UserCanDeleteTodoTest extends DuskTestCase
{
    
    /**
     * @group foo
     */
    public function test_user_can_delete_todo()
    {
        factory(User::class)->create( [ 'id' => 1, 'email' => 'user1@gmail.com' ] );
        factory(Todo::class, 5)->create();

        $this->browse( function ( Browser $browser ) {
            
            $this->assertCount( 0, $browser->elements('li.completed') );

            $browser->loginAs( User::find(1) )
                    ->visit( '/' )
                    ->waitFor('li.completed')
                    ->mouseover( '.todo-list > li:nth-child(1)' )
                    ->click( '.todo-list > li:nth-child(1) .destroy' )
                    ->pause(1000)
            ;

            $this->assertDatabaseMissing('todos', [ 'id' => 1 ]);
                        
        });
    }
   
}
