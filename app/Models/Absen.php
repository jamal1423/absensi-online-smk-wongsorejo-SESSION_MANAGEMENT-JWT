<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;
    protected $table = 'absen';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kelas',
        'nama',
        'userlog',
        'c_in',
        'tanggal_c_in',
        'c_out',
        'tanggal_c_out',
        'longitude',
        'latitude',
        'lokasi',
    ];
}
