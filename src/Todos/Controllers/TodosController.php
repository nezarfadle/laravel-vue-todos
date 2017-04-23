<?php

namespace Todos\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TodosController extends Controller
{

	public function landing()
	{
		return view("todos::landing");	
	}

    public function store()
    {
    	
    }
}
