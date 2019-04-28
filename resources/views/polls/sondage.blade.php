@extends('template')

@section('contenu')
	<br>
	<div class="col-sm-offset-3 col-sm-6">
		<div class="panel panel-primary">
			<div class="panel-heading">{{ $poll->question }}</div>
			<div class="panel-body"> 

				<!-- Formulaire de vote -->
				{!! Form::open(['url' => 'vote/' . $poll->id]) !!}
					@foreach ($poll->answers as $index => $answer)
						<div class="radio">
							<label>
								{!! Form::radio('options', $answer->id, $index === 0) !!} {{ $answer->answer }}
							</label>
						</div>
					@endforeach
					{!! Form::submit('Envoyer !', ['class' => 'btn btn-info pull-right']) !!}
				{!! Form::close() !!}
				<!-- Fin du formulaire -->

			</div>
		</div>
	</div>
@stop