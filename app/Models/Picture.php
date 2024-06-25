<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = ['path','user_id','mare_id','observed_at'];

    public function user () {

        return $this->belongsTo(User::class);
    }

    public function mare () {

        return $this->belongsTo(Mare::class);
    }

}
