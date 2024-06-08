<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class User extends Model implements Authenticatable
{
    use HasFactory;

    protected $table = 'user';
    protected $primaryKey = 'id';

    protected $fillable = ['name','password', 'email' , 'uid', 'created_at', 'updated_at', 'remember_token', 'role'];

    public function getAuthIdentifierName()
    {
        return 'name';
    }

    public function getAuthIdentifier()
    {
        return $this->attributes['name'];
    }

    public function getAuthPassword()
    {
        return $this->attributes['password'];
    }

    public function getRememberToken()
    {
        return $this->attributes['remember_token'];
    }

    public function setRememberToken($value)
    {
        $this->attributes['remember_token'] = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

}