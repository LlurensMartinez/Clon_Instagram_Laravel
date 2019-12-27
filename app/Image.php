<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    // Relacion One to Many / uno a muchos
    public function comments(){
        return $this->hasMany('App\Comment')->orderBy('id', 'desc');
    }

    // Relacion One to Many / Sacar todos los likes de una imagen

    public function likes(){
        return $this->hasMany('App\Like');
    }

    // Relacion de muchos a Uno

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }


}
