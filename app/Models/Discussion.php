<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Message;

class Discussion extends Model
{
    use HasFactory;
    protected $guarded = []; 

    public function message():hasMany
    {
        return $this->hasMany(Message::class);
    }
}
