<?php

namespace Todos\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
    	'title', 'complete', 'user_id'
    ];

    protected $hidden = [ 'user_id', 'created_at', 'updated_at' ];

    public function getId()
    {
    	return $this->id;
    }
    
    public function getUrl()
    {
    	return "todos/$this->id";
    }

}
