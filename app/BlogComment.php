<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class BlogComment extends Model
{
    protected $table = 'blog_comment';
    protected $primaryKey = 'blog_comment_id';
}
