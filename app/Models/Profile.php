<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';
    protected $fillable = ['user_id', 'phone', 'address','color','name','logo','weblink'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }           
}
