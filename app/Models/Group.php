<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', // Thêm trường id vào mảng fillable
        'group_name',
        'title',
        'content',
    ];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
