<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
	public function likes()
	{
		return $this->morphMany(Like::class, 'likeable');
	}

    public function like()
    {
    	$like = new Like(['user_id' => Auth::id()]);

    	$this->likes()->save($like);
    }

    public function isLiked()
    {
    	return !! $this->likes()
    				->where('user_id', Auth::id())
    				->count();
    }		
}
