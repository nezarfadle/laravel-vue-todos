<?php

namespace Todos\Queries;

use Todos\Models\Todo;

class GetTweetsQuery
{

	public function get()
	{
		return Todo::paginate(20);
	}
}