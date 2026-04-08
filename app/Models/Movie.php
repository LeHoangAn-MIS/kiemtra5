<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movie';

    public $timestamps = false; 

    protected $fillable = [
        'id',
        'movie_name', 
        'movie_name_vn', 
        'release_date', 
        'overview_vn', 
        'image', 
        'original_name', 
        'status', // Cột vừa thêm để xóa mềm
        'updated_at'
    ];
    public $incrementing = true; // Tự động tăng
    protected $keyType = 'int';
}