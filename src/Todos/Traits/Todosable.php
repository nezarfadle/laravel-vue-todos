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
}