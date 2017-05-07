<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'size'];

    public function add($user)
    {
        $this->guardAgainstTooManyMembers();
        
    	$this->members()->save($user);
    }

    public function members()
    {
    	return $this->hasMany(User::class);
    }

    public function count()
    {
    	return $this->members()->count();
    }

    public function guardAgainstTooManyMembers()
    {
        if ($this->count() >= $this->size) {
            throw new \Exception;
        }
    }
}