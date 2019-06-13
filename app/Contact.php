<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * The attributes that are mass assignable.
     * 
     * @var Array
     */
    protected $fillable = [
        'name',
        'owner_id',
        'phone',
        'email',
        'address'
    ];

    /**
     * Get the contact owner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function owner(){
        return $this->hasOne(User::class, 'owner_id', 'id');
    }
}
