<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'size'];

    public function add($users)
    {
        $this->guardAgainstTooManyMembers($users);

        $method = $users instanceof User ? 'save' : 'saveMany';

    	$this->members()->$method($users);
    }

    public function members()
    {
    	return $this->hasMany(User::class);
    }

    public function count()
    {
    	return $this->members()->count();
    }

    public function guardAgainstTooManyMembers($users)
    {
        $numUsersToAdd = ($users instanceof User) ? 1 : $users->count();

        $newTeamCount = $this->count() + $numUsersToAdd;

        if ($newTeamCount > $this->size) {
            throw new \Exception;
        } 
    }

    public function remove(User $user)
    {
        $user->leaveTeam($user);
    }
}
