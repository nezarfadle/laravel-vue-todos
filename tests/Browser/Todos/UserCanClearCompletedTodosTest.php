<?php

namespace Tests\Browser\Todos;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\User;
use Todos\Models\Todo;

class UserCanClearCompletedTodosTest extends DuskTestCase
{
    
    public function test_user_can_clear_his_completed_todos()
    {

        factory( User::class )->create( [ 'id' => 1, 'email' => 'user1@gmail.com' ] );
        factory(Todo::class, 2)->create( [ 'complete' => true ] );
        factory(Todo::class, 3)->create( [ 'complete' => false ] );        

        $this->browse( function ( Browser $browser ) {
            
            $this->assertCount( 0, $browser->elements('li.completed') );

            $browser->loginAs( User::find(1) )
                    ->visit( '/' )
                    ->waitFor('li.completed')
                    ->click( '.clear-completed' )
                    ->pause(1000)
            ;

            $this->assertDatabaseMissing('todos', [ 'id' => 1 ]);
            $this->assertDatabaseMissing('todos', [ 'id' => 2 ]);
                        
        });
    }    
}
