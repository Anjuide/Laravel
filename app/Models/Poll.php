<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{

	/**
	 * La table utilisée par le modèle
	 *
	 * @var string
	 */
	protected $table = 'polls';

	/**
	 * On utilise les dates de mise à jour
	 *
	 * @var bool
	 */
	public $timestamps = true;

	/**
	 * Attributs autorisés en ensignement de masse.
	 *
	 * @var array
	 */
	protected $fillable = ['question'];
 
	/**
	 * Relation de type 1:n
	 *
	 * @return Illuminate\Database\Eloquent\Relations
	 */
	public function answers()
	{
		return $this->hasMany('App\Models\Answer');
	}

	/**
	 * Relation de type n:n
	 *
	 * @return Illuminate\Database\Eloquent\Relations
	 */
	public function users()
	{
		return $this->belongsToMany('App\Models\User')->withTimestamps();
	}

}