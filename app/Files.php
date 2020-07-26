<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $table = 'table_files';
    protected $fillable =['folder_id','files','file_name','size'];
}
