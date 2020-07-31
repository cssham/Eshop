<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'short_description', 'long_description', 'price','deleted_at',
    ];
    public function category(){
        return $this->belongsTo('App\Category');
    }
}
