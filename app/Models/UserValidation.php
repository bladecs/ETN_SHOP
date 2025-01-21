<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserValidation extends Model
{
    protected $table = 'user';
    protected $fillable = ['username','email', 'password'];
    protected $guarded = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }
}
