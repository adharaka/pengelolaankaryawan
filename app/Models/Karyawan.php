<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
protected $table = 'karyawan';
protected $fillable = ['nik', 'nama', 'departemen', 'shift'];
}
