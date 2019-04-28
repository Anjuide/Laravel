<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{ 

	/**
	 * La table utilisée par le modèle
	 *
	 * @var string
	 */
	protected $table = 'answers';

	/**
	 * On utilise les dates de mise à jour
	 *
	 * @var bool
	 */
	public $timestamps = true;

	/**
	 * Colonnes pour l'assignement de masse
	 *
	 * @var array
	 */
	protected $fillable = ['answer'];

	/**
	 * Relation de type 1:n
	 *
	 * @return Illuminate\Database\Eloquent\Relations
	 */
	public function poll()
	{
		return $this->belongsTo('App\Models\Poll');
	}

}