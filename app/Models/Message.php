<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Discussion;

class Message extends Model
{
    use HasFactory;
    protected $table = 'message';
    protected $guarded =[]; 
    public $timestamps =true; 

    public function discussion(): BelongsTo
    {
       return $this->belongsTo(Discussion::class);
    }
}
