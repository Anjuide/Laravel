@extends('template')

@section('contenu')
<br>
<div class="col-sm-offset-3 col-sm-6">

	<!-- Affichage des alertes -->
	@if(session()->has('info'))
	<div class="alert alert-success">{{ session('info') }}</div>
	@endif

	<div class="panel panel-primary">

		<div class="panel-heading">
			<h3 class="panel-title">Liste des sondages</h3>
		</div>

		<table class="table">

			<!-- Balayage de tous les sondages -->
			@foreach ($polls as $poll)
			<tr>
				<td class="text-primary"><strong>{{ $poll->question }}</strong></td>
				<td>
					{!! link_to_route('poll.show', 'Voir', [$poll->id], ['class' => 'btn btn-success btn-block']) !!}
				</td>
				@if(auth()->check() && auth()->user()->admin)
				<td>
					{!! link_to_route('poll.edit', 'Modifier', [$poll->id], ['class' => 'btn btn-warning btn-block']) !!}
					<!-- . (in_array($poll->question, $polls_voted)? ' disabled' : '') -->
				</td>
				<td>
					{!! Form::open(['method' => 'DELETE', 'route' => ['poll.destroy', $poll->id]]) !!}
					{!! Form::submit('Supprimer', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Voulez-vous vraiment supprimer ce sondage ?\')']) !!}
					{!! Form::close() !!}
				</td>
				@endif
			</tr>
			@endforeach
			<!-- Fin du balayage -->

		</table>

	</div>
	@if(auth()->check() && auth()->user()->admin)
	{!! link_to_route('poll.create', 'Ajouter un sondage', null, ['class' => 'btn btn-info pull-right']) !!}
	@endif

	<!-- Pagination -->
	{!! $polls->render(); !!}

</div>
@stop