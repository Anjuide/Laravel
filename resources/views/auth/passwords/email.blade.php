@extends('template')

@section('contenu')
	<div class="col-sm-offset-3 col-sm-6">
		<br>
		@if(session('status'))
			<div class="alert alert-success">{{ session('status') }}</div>
		@else
			<div class="panel panel-primary">	
				<div class="panel-heading">Oubli du mot de passe, entrez votre email :</div>
				<div class="panel-body"> 
					<div class="col-sm-12">
						{!! Form::open(['url' => 'password/email']) !!}	
							<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
								{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
								<small class="help-block">{!! $errors->first('email') !!}</small>
							</div>
							{!! Form::submit('Envoyer', ['class' => 'btn btn-primary pull-right']) !!}
						{!! Form::close() !!}
					</div>
				</div>
			</div>
			<a href="javascript:history.back()" class="btn btn-primary">
				<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
			</a>	
		@endif
	</div>
@stop					
 

