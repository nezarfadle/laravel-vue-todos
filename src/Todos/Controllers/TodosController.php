<?php

namespace Todos\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use SharedKernel\Http\CreatedJsonResponse;
use SharedKernel\Http\NoContentJsonResponse;
use Todos\Requests\CreateTodoRequest;
use App\User;
use \Todos\Queries\GetTweetsQuery;


class TodosController extends Controller
{

	public function landing()
	{
		return view("todos::landing");	
	}

    public function index(GetTweetsQuery $query)
    {
        return $query->get();
    }

    public function store(CreateTodoRequest $req)
    {
		
		$title 	= $req->get( 'title' );
		$user 	= auth()->user();
		
		try {
		    
		    $todo = $user->addTodo( $title );
		    return new CreatedJsonResponse( $todo->getId(), 200, $todo->getUrl() );

    	} catch (\Exception $e) {

            return new JsonInternalServerError( 200 );

    	}    	
    }

    public function destroy( $id )
    {

    	try {
    		
    		$user = auth()->user();
    		$user->deleteTodo($id);
    		return new NoContentJsonResponse();

    	} catch (\Exception $e) {

            return new JsonInternalServerError( 201 );

    	}
    }

    public function update($id, CreateTodoRequest $req)
    {

        // $title = $req->get('title');
        $user = auth()->user();

        try {
            
            // $user->updateTodo($id, $title);
            $user->updateTodo($id, $req->all());
            return new NoContentJsonResponse();

        } catch (\Exception $e) {

            return new JsonInternalServerError( 202 );

        }   
    }
}
