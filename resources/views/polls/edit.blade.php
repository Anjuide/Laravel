@extends('polls/template_form')

@section('form')
					{!! Form::open(['route' => ['poll.update',  $poll->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}
						<p><strong>Question</strong></p>
						<div class="form-group">
					  		{!! Form::text('question', $poll->question, ['class' => 'form-control', 'placeholder' => 'Question']) !!}
							<small class="help-block"></small>
						</div><hr>
						<div id="answers">
							<p><strong>Réponses</strong></p>
							@foreach ($poll->answers as $i => $answer)
								<div class="row ligne">
									<div class="form-group">
										<div class="col-md-10">
											{!! Form::text('answers[]', $answer->answer, ['class' => 'form-control']) !!}
											<small class="help-block"></small>
										</div>
										<div class="col-md-2">
											<button type="button" class="btn btn-danger">Supprimer</button>
										</div>
									</div>
								</div>						 
							@endforeach
						</div><hr>
						<div class="form-group">
							<button id="add_answer" type="button" class="btn btn-primary pull-right">Ajouter une réponse</button>
						</div><hr>
						<div class="form-group">
							{!! Form::submit('Envoyer', ['class' => 'btn btn-primary pull-right']) !!}
						</div>
					{!! Form::close() !!}
@stop