<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalProyek extends Model
{
    use HasFactory;

    protected $table = 'tbjadwalproyek';
    protected $primaryKey = 'jadwalproyekid';
    const CREATED_AT = 'tgladd';
    const UPDATED_AT = 'tgledit';

    protected $fillable = [
        'jadwalproyekid', 
        'namaproyek', 
        'location', 
        'startdate', 
        'finishdate', 
        'opadd', 
        'pcadd', 
        'opedit', 
        'pcedit', 
        'dlt'
    ];

    
    protected $casts = [
        'tgladd' => 'datetime',
        'tgledit' => 'datetime',
    ];
}
