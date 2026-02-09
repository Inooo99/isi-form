<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    // Ini agar semua kolom bisa diisi (Mass Assignment)
    protected $guarded = [];
}