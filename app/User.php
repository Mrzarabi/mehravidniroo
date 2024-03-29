<?php

namespace App;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Role;
use App\Models\Ticket;
use App\Notifications\PasswordResetNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Nicolaslopezj\Searchable\SearchableTrait;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use Notifiable, SearchableTrait, LaratrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'avatar',
        'name',
        'family',
        'address',
        'phone_number',
        'national_code',
        'email', 
        'password',
        'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
        'api_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Searchable rules.
     *
     * Columns and their priority in search results.
     * Columns with higher values are more important.
     * Columns with equal values have equal importance.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'users.name' => 10,
            'users.family'  => 10,
        ],
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if ( ! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token));
    }

    /**
     * Relations
     */

    /**
     * Each User can has many Articless
     */
    public function articles() {
        return $this->hasMany(Article::class);
    }

    /**
     * Each User can has many products
     */
    public function products() {
        return $this->hasMany(Product::class);
    }

    /**
     * Each User can has many comments
     */
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    /**
     * Each User can has many comments
     */
    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

    /**
     * Each User belongs to one Role
     */
    public function role() {
        return $this->belongsTo(Role::class);
    }
}
