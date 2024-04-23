<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentAcceptance extends Model
{
    protected $fillable = ['user_id', 'file_name', 'accepted_at', 'reuploaded_file_name'];
}