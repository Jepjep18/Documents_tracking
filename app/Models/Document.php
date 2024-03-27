<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'personnel_office',
        'uploaded_documents',
        'accept_date',
        'reuploaded_documents',
        'released_date',
        'remarks',
    ];
}
