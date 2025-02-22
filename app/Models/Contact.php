<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = ['user_id', 'phone'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function note(): MorphOne {
        return $this->morphOne(Note::class, 'notable');
    }

}
