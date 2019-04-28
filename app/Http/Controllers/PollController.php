<?php

namespace App\Http\Controllers;

use App\Repositories\PollRepository;
use App\Http\Requests\PollUpdateRequest;
use App\Http\Requests\PollCreateRequest;

class PollController extends Controller
{


	/**
	 * Instance de PollRepository
	 *
	 * @var App\Repositories\PollRepository
	 */
	protected $pollRepository;

	/**
	 * Crée une nouvelle instance de PollController
	 *
	 * @param App\Repositories\PollRepository $pollRepository
	 * @return void
	 */
	public function __construct(PollRepository $pollRepository)
	{
		// Les middlewares
		$this->middleware('admin', ['except' => ['index', 'show']]);
		$this->middleware('ajax', ['only' => ['store', 'update']]);

		$this->pollRepository = $pollRepository;
	}

	/**
	 * Traitement de l'URL de base, affichage des sondages
	 *
	 * @return View
	 */
	public function index()
	{
		return view('index', $this->pollRepository->getPaginate(4));
	}

	/**
	 * Affichage du formulaire de création
	 *
	 * @return View
	 */
	public function create()
	{
		return view('polls.create');
	}

	/**
	 * Traitement du formulaire de création
	 *
	 * @param  App\Http\Requests\PollCreateRequest $request;
	 * @return Redirect
	 */
	public function store(PollCreateRequest $request)
	{
		$this->pollRepository->store($request);

		return response()->json();
	}

	/**
	 * Affichage d'un sondage
	 *
	 * @param  integer $id
	 * @return View
	 */
	public function show($id)
	{
		return view('polls.resultats', $this->pollRepository->getPollWithAnswersAndDone($id));
	}

	/**
	 * Affichage du formulaire de modification d'un sondage
	 *
	 * @param  integer $id
	 * @return Mixed
	 */
	public function edit($id)
	{
		// On vérifie que le sondage n'a pas déjà reçu un vote
		if($this->pollRepository->checkPoll($id))
		{
			return redirect('/');
		}

		$poll = $this->pollRepository->getPollWithAnswers($id);

		return view('polls.edit', $poll);
	}

	/**
	 * Traitement du formulaire de modification
	 *
	 * @param  App\Http\Requests\PollUpdateRequest $request;
	 * @param  integer $id
	 * @return Redirect
	 */
	public function update(PollUpdateRequest $request, $id)
	{
		$this->pollRepository->update($request, $id);

		return response()->json();
	}

	/**
	 * Traitement de la suppression d'un sondage
	 *
	 * @param  integer $id
	 * @return Redirect
	 */
	public function destroy($id)
	{
		$this->pollRepository->destroy($id);
		
		return redirect('/');
	}

}
