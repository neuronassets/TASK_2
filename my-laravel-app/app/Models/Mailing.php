<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// class corresponding to mailing table in db
class Mailing extends Model {
    
    // for lavarel testing
    use HasFactory;
    
    // table name
    protected $table = 'mailing';
    // table field
    protected $fillable = ['email'];
}
