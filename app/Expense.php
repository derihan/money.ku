<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    //
    protected $fillable=['user_id','e_judul','e_description','e_jumlah'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    
}
