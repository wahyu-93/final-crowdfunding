<?php

namespace App;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\User;

class Otp extends Model
{
    use UsesUuid;
    
    protected $fillable = ['otp_code', 'valid_date', 'user_id'];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}

