<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $table = 'table_folder';

    protected $fillable =['name_of_folder'];
}
