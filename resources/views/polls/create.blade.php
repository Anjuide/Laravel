@extends('polls/template_form')
 
@section('form')
					{!! Form::open(['route' => 'poll.store', 'method' => 'post', 'class' => 'form-horizontal panel']) !!}	
						<p><strong>Question</strong></p>
						<div class="form-group">
							{!! Form::text('question', null, ['class' => 'form-control', 'placeholder' => 'Question']) !!}
							<small class="help-block"></small>
						</div><hr>
						<div id="answers">
					  		<p><strong>Réponses</strong></p>
							@for($i = 0; $i < 3; $i++)
								<div class="row ligne">
									<div class="form-group">
										<div class="col-md-10">
											{!! Form::text('answers[]', null, ['class' => 'form-control']) !!}
											<small class="help-block"></small>
										</div>
										<div class="col-md-2">
											<button type="button" class="btn btn-danger">Supprimer</button>
										</div>
									</div>
								</div>						
							@endfor
						</div><hr>
						<div class="row">
	  						<button id="add_answer" type="button" class="btn btn-primary pull-right">Ajouter une réponse</button>
	  					</div><hr>
	  					<div class="form-group">
							{!! Form::submit('Envoyer', ['class' => 'btn btn-primary pull-right']) !!}
						</div>
					{!! Form::close() !!}
@stop