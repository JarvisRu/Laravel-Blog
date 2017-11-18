<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'p_id','user_id','content',
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
