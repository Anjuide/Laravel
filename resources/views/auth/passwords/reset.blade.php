@extends('template')

@section('contenu')
	<div class="col-sm-offset-3 col-sm-6">
		<br>
		@if(session('error'))
			<div class="alert alert-danger">{{ session('error') }}</div>
		@endif
		<div class="panel panel-primary">	
			<div class="panel-heading">Création d'un nouveau mot de passe</div>
			<div class="panel-body"> 
				<div class="col-sm-12">
					<!-- Formulaire -->
					{!! Form::open(['url' => 'password/reset', 'method' => 'post', 'class' => 'form-horizontal panel']) !!}	
						{!! Form::hidden('token', $token) !!}
						<div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
							{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
							{!! $errors->first('email', '<small class="help-block">:message</small>') !!}
						</div>
						<div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
							{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Mot de passe']) !!}
							{!! $errors->first('password', '<small class="help-block">:message</small>') !!}
						</div>
						<div class="form-group">
							{!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirmation mot de passe']) !!}
						</div>
						{!! Form::submit('Envoyer', ['class' => 'btn btn-primary pull-right']) !!}
					{!! Form::close() !!}
					<!-- Fin du formulaire -->
				</div>
			</div>
		</div>
	</div>
@stop					
 

