<?php

namespace wdd\slug\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slug extends Model
{
    use HasFactory;

    protected $fillable = ['model' , 'slug'];
}
