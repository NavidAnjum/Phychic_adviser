<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['profile_id','name','duration_minutes','price'];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
