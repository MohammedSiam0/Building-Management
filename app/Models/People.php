<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class People extends Model
{
    use HasFactory;
    protected $table ='peoples';

        public function service(){
            return $this->hasMany(Financial::class ,'people_id');
        }
}
