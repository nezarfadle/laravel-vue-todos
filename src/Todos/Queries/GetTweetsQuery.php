<?php

namespace Todos\Queries;

use Todos\Models\Todo;

class GetTweetsQuery
{

	public function get()
	{
		$user = auth()->user();
		return $user->todos()->paginate(20);
	}
}