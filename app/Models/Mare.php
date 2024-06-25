<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mare extends Model
{

    use HasFactory;

    protected $fillable = ['latitude','longitude', 'user_id'];

    public function user () {

        return $this->belongsTo(User::class);
    }

    public function pictures() {
        return $this->hasMany(Picture::class);
    }



}
