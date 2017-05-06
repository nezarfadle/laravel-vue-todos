<?php

namespace Todos\Queries;

use Todos\Models\Todo;

class GetTodosQuery
{
	private $userId;

	function __construct($userId) 
	{
		$this->userId = $userId;
	}

	public function get( $take = 20 )
	{
		return Todo::where([ 'user_id' => $this->userId ])->paginate($take);
	}
}