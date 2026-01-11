<?php

namespace App\Models;

use CodeIgniter\Model;

class FilmModel extends Model
{
    protected $table = 'listfilm';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'slug',
        'judul',
        'sutradara',
        'synopsis',
        'cover'
    ];

    protected $useTimestamps = true;
}
