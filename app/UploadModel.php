<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadModel extends Model
{
    protected $table = 'uploadbukti';
    protected $fillable = [
        'userid', 'foto', 'keterangan'
    ];
}
