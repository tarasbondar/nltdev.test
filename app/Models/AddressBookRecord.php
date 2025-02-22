<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddressBookRecord extends Model
{

    protected $table = 'address_book';

    protected $fillable = ['user_id', 'contact_id'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function contact() {
        return $this->belongsTo(Contact::class, 'contact_id');
    }

}
