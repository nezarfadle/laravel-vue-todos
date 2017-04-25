<?php

namespace Todos\Traits;

use Todos\Models\Todo;

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
			'complete' 	=> false,
			'user_id'	=> $this->id,
		]);
	}

	public function deleteTodo($id)
	{
		return $this->todos()
			->where( 'id', $id )
			->where( 'user_id', $this->id )
			->delete();
	}
}