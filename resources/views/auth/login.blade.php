@extends('template')

@section('contenu')
	<div class="col-sm-offset-3 col-sm-6">
		<br>
		@if(session('error'))
			<div class="alert alert-danger">{{ session('error') }}</div>
		@endif		
		<div class="panel panel-primary">	
			<div class="panel-heading">Connectez-vous !{!! link_to('register', 'Je m\'inscris !', ['class' => 'btn btn-info btn-xs pull-right']) !!}</div>
			<div class="panel-body"> 

				<!-- Formulaire de login -->
				{!! Form::open(['url' => 'login']) !!}	
					<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
						{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
						{!! $errors->first('email', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
						{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Mot de passe']) !!}
						{!! $errors->first('password', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="checkbox">
						<label>
							{!! Form::checkbox('remember') !!}Se rappeler de moi
						</label>
					</div>
					{!! Form::submit('Envoyer', ['class' => 'btn btn-primary pull-right']) !!}
				{!! Form::close() !!}
				<!-- Fin du formulaire -->

			</div>
		</div>

		<!-- Bouton de retour à la page précédente -->
		<a href="javascript:history.back()" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
		</a>

		<!-- Bouton pour l'oubli du mot de passe -->
		{!! link_to('password/reset', 'J\'ai oublié mon mot de passe !', ['class' => 'btn btn-warning pull-right']) !!}
		
	</div>
@stop					
 

