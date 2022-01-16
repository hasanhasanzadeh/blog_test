<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table='comments';
    protected $fillable=[
      'body',
      'commentable_type',
      'commentable_id',
      'status'
    ];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'parent_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
