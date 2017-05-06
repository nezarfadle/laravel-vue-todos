<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use Todos\Models\Todo;

class ExampleTest extends DuskTestCase
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
    
    /**
     * @group foo
     */
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
