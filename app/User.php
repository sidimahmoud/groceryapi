<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    const TYPE = [
        'CLIENT' => 1,
        'LIVREUR' => 2,
        'SUPERMARKET' => 3,
        'ADMIN' => 4,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'username',
        'gender',
        'mobile',
        'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /*
    **
     * Check whether the user is a customer
     *
     * @return bool
     */
    public function isClient(): bool
    {
        return $this->type == self::TYPE['CLIENT'];
    }

    /**
     * Check whether the user is a translator
     *
     * @return bool
     */
    public function isLivreur(): bool
    {
        return $this->type == self::TYPE['LIVREUR'];
    }

    /**
     * Check whether the user is a translator
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->type == self::TYPE['ADMIN'];
    }
    /**
     * Check whether the user is a translator
     *
     * @return bool
     */
    public function isSuperMarket(): bool
    {
        return $this->type == self::TYPE['SUPERMARKET'];
    }
}
