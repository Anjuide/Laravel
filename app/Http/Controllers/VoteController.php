<?php

namespace App\Http\Controllers;

use App\Repositories\PollRepository;
use Illuminate\Http\Request;

class VoteController extends Controller
{

	/**
	 * Instance de PollRepository
	 *
	 * @var Lib\Gestion\PollRepository
	 */
	protected $pollRepository;

	/** 
	 * Crée une nouvelle instance de VoteController
	 *
	 * @param App\Repositories\PollRepository $pollRepository
	 * @return void
	 */
	public function __construct(PollRepository $pollRepository)
	{
		$this->middleware('voted');

		$this->pollRepository = $pollRepository;
	}

	/**
	 * Affichage du formulaire de vote
	 *
	 * @return View
	 */
	public function create($id)
	{
		return view('polls.sondage', $this->pollRepository->getPollWithAnswers($id));
	}	

	/**
	 * Traitement du formulaire de vote
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  integer $id
	 * @return Redirect
	 */
	public function store(Request $request, $id)
	{	
		$this->pollRepository->saveVote($id, $request->input('options'), $request->user());

		return redirect(route('poll.show', [$id]))->with('info', 'Merci d\'avoir participé à ce sondage !');
	}	

}
