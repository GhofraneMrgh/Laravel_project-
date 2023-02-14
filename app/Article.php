<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
     protected $fillable = [
        'externalId', 'title', 'description', 'publicationDate', 'link', 'mainPicture'
    ];
}
