<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kv extends Model
{
    //
    use HasFactory;

    protected $fillable = ['identifier','content', 'user_id','mare_id'];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function mare () {
        return $this->belongsTo(Mare::class);
    }
}
