<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * Relation de type 1:n
	 *
	 * @return Illuminate\Database\Eloquent\Relations
	 */
	public function polls()
	{
		return $this->belongsToMany('App\Models\Poll')->withTimestamps();
	}

	/**
	 * Vérification rôle administrateur
	 *
	 * @return bool
	 */
	public function isAdmin()
	{
		return $this->admin == 1;
	}

	/**
	 * Test de déjà voté
	 *
	 * @param  integer $id
	 * @return bool
	 */
	public function hasVoted($id)
	{
		return $this->polls->contains($id);
	}

}
