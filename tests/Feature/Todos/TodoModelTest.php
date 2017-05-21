<?php

namespace Tests\Feature\Todos;

use Tests\TestCase;
use Tests\Traits\CreateUser;
use \Todos\Models\Todo;

class TodoModelTest extends TestCase
{
    
    use CreateUser;

    public function test_todo_model_can_return_its_own_url()
    {
    	$todo = factory( Todo::class )->make( ['id' => 1] );
        $this->assertEquals( '/todos/1', $todo->href );
    }
}
