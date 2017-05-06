<?php

namespace Todos\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use SharedKernel\Http\CreatedJsonResponse;
use SharedKernel\Http\NoContentJsonResponse;
use Todos\Requests\CreateTodoRequest;
use App\User;
use Todos\Models\Todo;
use \Todos\Queries\GetTodosQuery;
use Todos\Exceptions\ForbiddenAction;
use \SharedKernel\Http\UnauthorizedActionJsonResponse;

class TodosController extends Controller
{

	public function landing()
	{
		return view("todos::landing");	
	}

    public function index(GetTodosQuery $query)
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

    public function destroy( Todo $todo )
    {

    	try {
    	   
    		$user = auth()->user();
    		$user->deleteTodo($todo);
    		return new NoContentJsonResponse();

    	} 
        
        catch (ForbiddenAction $e) {
            return new UnauthorizedActionJsonResponse();
        }

        catch (\Exception $e) {
            return new JsonInternalServerError( 201 );
    	}

    }

    public function update( Todo $todo, CreateTodoRequest $req )
    {

        $user = auth()->user();

        try {
            
            $user->updateTodo($todo, $req->all());
            return new NoContentJsonResponse();

        } 

        catch (ForbiddenAction $e) {
            return new UnauthorizedActionJsonResponse();
        }

        catch (\Exception $e) {
            return new JsonInternalServerError( 201 );
        }
    }
}
