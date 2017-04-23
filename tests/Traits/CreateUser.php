<?php

namespace Tests\Traits;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

trait CreateUser
{

    use DatabaseMigrations, DatabaseTransactions;

	public function setup()
    {
    	parent::setup();
    	$testName = str_replace(["test", "_"], ["", " "], $this->getName());
    	$testName = preg_replace_callback("/[a-zA-Z0-9]{3,}\b/", function($match){
    		return ucfirst($match[0]);
    	}, $testName);

    	dump(" ->" . $testName);

    	factory(User::class)->create();
    	\Auth::loginUsingId(1);
    }
}