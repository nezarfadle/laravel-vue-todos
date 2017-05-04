<?php

namespace Todos\Traits;

use Todos\Models\Todo;
use Todos\Exceptions\ForbiddenAction;

trait Todosable
{

	public function todos()
	{
		return $this->hasMany( Todo::class );
	}

	public function addTodo( $title )
	{
		return $this->todos()->create( [ 
			'title' 	=> $title,
			'complete' 	=> false
		]);
	}

	public function deleteTodo(Todo $todo)
	{

		if (\Gate::denies('manage-todo', $todo))
        {
            throw new ForbiddenAction();
        }

		$todo->delete();
	}

	public function updateTodo(Todo $todo, $data)
	{
		
		if (\Gate::denies('manage-todo', $todo))
        {
            throw new ForbiddenAction();
        }

		return $todo->fill($data)->update();	

	}
}