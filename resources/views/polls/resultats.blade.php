@extends('template')

@section('contenu')
  <br>
	<div class="col-sm-offset-3 col-sm-6">

		<!-- Informations en alertes -->
		@if(auth()->guest())
			<div class="alert alert-warning">Vous devez être connecté pour participer aux sondages !</div>
		@elseif($done)
			@if(session('info'))
				<div class="alert alert-success">{{ session('info') }}</div>
			@else
				<div class="alert alert-warning">Vous avez déjà participé à ce sondage !</div>
			@endif
		@endif

		<div class="panel panel-primary">
			<div class="panel-heading">
				{{ $poll->question }} 
				@if(auth()->check() && !$done)
					{!! link_to('vote/' . $poll->id, 'Votez vous aussi !', ['class' => 'btn btn-info btn-xs pull-right']) !!}
				@endif
			</div>
			<div class="panel-body"> 
				<p>Voici les résultats actuels :</p>

					<!-- Balayage de toutes les réponses -->
					@foreach ($poll->answers as $index => $answer)
						<p>
							<strong>{{ $answer->answer }}</strong> : {{ $answer->result }}
							@if ($answer->result > 1) votes	@else vote	@endif
						</p>
						<div class="progress">
							<?php $pourcentage = $total == 0 ? 0 : number_format($answer->result / $total * 100) ?>
						  <div class="progress-bar progress-bar-success" style="width: {{ $pourcentage }}%;">
						  	{{ $pourcentage }} %
						  </div>
						</div> 	
					@endforeach
					<!-- Fin du balayage -->

			</div>	
		</div>

		@if(!session('info'))
			<a href="javascript:history.back()" class="btn btn-primary">
				<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
			</a>
		@else
			{!! link_to('/', 'Retour à l\'accueil', ['class' => 'btn btn-primary']) !!}		
		@endif
		
	</div>
@stop