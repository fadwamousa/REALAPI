<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use App\Transformers\UserTransformer;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    use Notifiable ,HasApiTokens, SoftDeletes;

    protected $dates    = ['deleted_at'];
    const VERIFIED_USER   = '1';
    Const UNVERIFIED_USER = '0';
    const ADMIN_USER = 'true';
    const REGULAR_USER = 'false';

    protected $table = "users";

    public $transformer = UserTransformer::class;


    protected $fillable = [
        'name', 'email', 'password','verified','verification_token','admin'
    ];
    //verified email or  not
    //admin is 0 or 1


    protected $hidden = [
        'password', 'remember_token','verification_token'
    ];
    //this is not pass in json response when we return a resource of user

    public function setNameAttribute($name){
      $this->attributes['name'] = strtolower($name);
    }
    //the mutators method modify the name of user before inserting DB.

    public function getNameAttribute($name){
      return ucwords($name);
    }

    public function setEmailAttribute($email){
      $this->attributes['email'] = strtolower($email);
    }

    public function getEmailAttribute($email){
      return ucwords($email);
    }


    public function isVerified(){
      return $this->verified == User::VERIFIED_USER;
    }


    public function isAdmin(){
      return $this->admin == User::ADMIN_USER;
    }

    public static function generateVerificationCode(){
      return str_random(40);
    }
}
