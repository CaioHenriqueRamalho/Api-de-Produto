<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class apiproducts extends Model
{
    use HasFactory;
    
    protected $table = 'apiproducts';
    protected $fillable =["id", "name", "description","value", "status"];
    
}
