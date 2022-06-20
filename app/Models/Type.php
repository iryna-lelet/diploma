<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

//    public  function incomings(): \Illuminate\Database\Eloquent\Relations\HasMany
//    {
//        return $this->hasMany('App\Models\Incoming');
//    }
//
//    public  function outgoings(): \Illuminate\Database\Eloquent\Relations\HasMany
//    {
//        return $this->hasMany('App\Models\Outgoing');
//    }

    public  function categories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Category');
    }

}
