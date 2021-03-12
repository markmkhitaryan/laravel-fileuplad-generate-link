<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable=['slug','original_name','path','count_download','user_id'];
}
