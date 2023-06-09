<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable=['role'];

    public function users(){
        return $this->HasMany(User::class);
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }
}
