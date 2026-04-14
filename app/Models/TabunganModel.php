<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TabunganModel extends Model
{
    protected $table = 'tabungan';

    protected $fillable = [
        'nominal',
        'tanggal',
        'tipe'
        ];
}
