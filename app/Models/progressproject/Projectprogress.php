<?php

namespace App\Models\progressproject;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projectprogress extends Model
{
    use HasFactory;

    protected $table = 'tbprojectprogress';
    protected $primaryKey = 'projectprogressid';
    const CREATED_AT = 'tgladd';
    const UPDATED_AT = 'tgledit';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'projectprogressid', 
        'projectid', 
        'qtymaterial',
        'tgldari',
        'tglsampai',
        'progres',
        'opadd',
        'pcadd', 
        'opedit', 
        'pcedit', 
        'dlt'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'opadd',
        'pcadd',
        'opedit',
        'pcedit',
        'dlt',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'tgladd' => 'datetime',
        'tgledit' => 'datetime',
    ];
}
