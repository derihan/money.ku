<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    //
    protected $fillable=['user_id','i_judul','i_description','i_jumlah'];

    protected $hidden=[
        'user_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
