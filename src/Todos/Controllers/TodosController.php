<?php

namespace Todos\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Todos\Requests\CreateTodoRequest;
use App\User;

class TodosController extends Controller
{

	public function landing()
	{
		return view("todos::landing");	
	}

    public function store(CreateTodoRequest $req)
    {
		
		$title 	= $req->get( 'title' );
		$user 	= auth()->user();
		
		try {
		    
		    $user->addTodo( $title );
		    return new JsonResponse( [], 201 );

    	} catch (\Exception $e) {

		    return new JsonResponse( [], 500 );

    	}    	
    }
}
