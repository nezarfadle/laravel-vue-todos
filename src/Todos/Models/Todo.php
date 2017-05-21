<?php

namespace Todos\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
    	'title', 'complete'
    ];
    protected $hidden = [ 'user_id', 'created_at', 'updated_at' ];
    protected $appends = ['href'];
    
    public function getId()
    {
    	return $this->id;
    }
    
    public function getUrl()
    {
    	return "todos/$this->id";
    }

    public function getCompleteAttribute($value)
    {
        return (bool) $value;
    }

    public function getHrefAttribute()
    {
        return "/todos/{$this->id}";
    }

}
