<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financial extends Model
{
    use HasFactory;

    public function people()
    {
        return $this->belongsTo(People::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
