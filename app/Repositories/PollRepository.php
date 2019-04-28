<?php

namespace App\Repositories;

use Illuminate\Contracts\Auth\Guard;

use App\Models\Poll, App\Models\Answer;

class PollRepository
{

	/**
	 * Instance de Guard.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Crée une nouvelle instance de PollRepository
	 *
	 * @param Illuminate\Contracts\Auth\Guard $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Enregistrement des réponses
	 *
	 * @param  App\Http\Requests\PollUpdateRequest $request;
	 * @param  App\Models\Poll $poll
	 * @return void
	 */
	private function saveAnswers($request, $poll)
	{
		$answers = [];

		foreach ($request->input('answers') as $value) 
		{
			array_push($answers, new Answer(['answer' => $value]));
		}	

		$poll->answers()->saveMany($answers);
	}

	/**
	 * Récupération des sondages existants
	 *
	 * @param  integer $n
	 * @return array
	 */
	public function getPaginate($n)
	{
		
		// La valeur de "polls" est l'ensemble des sondages avec une pagination définie par la variable $n
		$polls = Poll::paginate($n);
		// Les valeurs de "polls_voted" sont les questions pour lesquelles il y a eu des votes
		// méthode has d'Eloquent (https://laravel.com/docs/5.8/eloquent-relationships#relationship-methods-vs-dynamic-properties)
		$polls_voted = Poll::has('users')->lists('question')->all();
		// $polls_voted = Poll::has('answers')->get();
		// On renvoye un tableau avec les clés "polls" et "polls_voted"
		return [ 'polls' => $polls, 'polls_voted' => $polls_voted]; 
	}

	/**
	 * Enregistrement d'un sondage
	 *
	 * @param  App\Http\Requests\PollUpdateRequest $request;
	 * @return void
	 */
	public function store($request)
	{
		// Ici on doit enregistrer dans la base le nouveau sondage
		// Les informations du sondage peuvent être récupérées avec $request->input(...)
		// Il faut enregistrer la question dans la table "polls"
		$poll = Poll::create(['question' => $request->input('question')]);
		// Il faut enregistrer toutes les réponses dans la tables "answers" mais Léo a déjà créé la fonction privée saveAnswers pour ça, il suffit donc de l'appeler
		$this->saveAnswers($request, $poll);
	}

	/**
	 * Récupération des informations d'un sondage pour affichage
	 *
	 * @return array
	 */
	public function getPollWithAnswersAndDone($id)
	{
		// Ici on doit récupérer toutes les informations pour afficher un sondage
		// "poll" contient les informations issues de la table "polls" pour le sondage avec l'identifiant $id et charge les réponses (avec with)
		$poll = Poll::where('id', $id)->with('answers')->firstOrFail();
		//$poll = Poll::with('answers')->find($id);
		// "total" retourne le nombre total de résultats pour le calcul du pourcentage avec la méthode d'aggrégation "sum"
		$total = Answer::sum('result');
		//$total = $poll->answers()->sum('result');
		// "done" contient "true" si un vote a déjà eu lieu pour ce sondage, "false" dans le cas inverse, il y a dans le modèle User la méthode hasVoted qui donne cette information
		if ($this->auth->check()) {
				$done = $this->auth->user()->hasVoted($id);
		}else{
			$done = false;
		}
		// On doit renvoyer un tableau avec les clés "poll", "total" et "done"
		return [ 'poll' => $poll, 'total' => $total, 'done' => $done]; 
	}

	/**
	 * Récupération des informations d'un sondage pour modification
	 *
	 * @param  integer $id
	 * @return mixed
	 */
	public function getPollWithAnswers($id)
	{
		// Ici on doit renvoyer un tableau avec les clé "poll" en chargeant aussi les réponses (avec with)
		// "poll" contient les informations issues de la table "polls" pour le sondage avec l'identifiant $id
		$poll = Poll::where('id', $id)->with('answers')->firstOrFail();
		return ['poll' => $poll];
	}

	/**
	 * Teste qu'un sondage a déjà reçu un vote
	 *
	 * @param  integer $id
	 * @return mixed
	 */
	public function checkPoll($id)
	{
		return $this->getById($id)->users()->count() != 0;
	}

	/**
	 * Mise à jour sondage suite à modification
	 *
	 * @param  App\Http\Requests\PollUpdateRequest $request;
	 * @param  integer $id
	 * @return void
	 */
	public function update($request, $id)
	{
		// Ici on doit mettre à jour les tables "polls" et "answers" à partir du retour du formulaire de modification

		// Les informations du sondage peuvent être récupérées avec $request->input(...)
		$poll = $this->getById($id);
		$poll->question = $request->input('question');
		// Il faut enregistrer la question dans la table "polls"
		$poll->save();
		// Il faut enregistrer toutes les réponses dans la tables "answers" (Attention ! Il y a déjà des réponses pour ce sondage, il faut donc penser à les supprimer !)
		// Léo a déjà créé la fonction privée saveAnswers pour ça, il suffit donc de l'appeler
		$poll->answers()->delete();
		$this->saveAnswers($request, $poll);
	}

	/**
	 * Suppression d'un sondage
	 *
	 * @param  integer $id
	 * @return void
	 */
	public function destroy($id)
	{
		// Ici on doit supprimer le sondage d'identifiant $id
		// Il faut nettoyer les tables "polls", "answers" et "poll_user" (pour cette dernière pensez à la méthode "detach" qui simplifie la syntaxe)
		$poll = $this->getById($id);
		// Suppression des réponses
		$poll->answers()->delete();
		// Détachement des utilisateurs
		$poll->users()->detach();
		// Suppression du sondage
		$poll->delete();
	}

	/**
	 * Récupération sondage par son id
	 *
	 * @param  integer $id
	 * @return void
	 */
	public function getById($id)
	{
		return Poll::find($id);
	}

	/**
	 * Mise à jour d'un vote
	 *
	 * @param  integer $id
	 * @param  integer $option_id
	 * @param  App\Models\User $user
	 * @return void
	 */
	public function saveVote($id, $option_id, $user)
	{
		// Mise à jour du résultat pour la réponse
		Answer::whereId($option_id)->increment('result');

		// Mise à jour du vote pour l'utilisateur
		$user->polls()->attach($id);
	}

}