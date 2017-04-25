<?php

namespace Todos\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
    	'title', 'complete', 'user_id'
    ];

    public function getUrl()
    {
    	return "todos/$this->id";
    }

}
