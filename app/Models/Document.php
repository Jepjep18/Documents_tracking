<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['department','personnel', 'file_name'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function acceptance()
    {
        return $this->hasOne(DocumentAcceptance::class);
    }
}