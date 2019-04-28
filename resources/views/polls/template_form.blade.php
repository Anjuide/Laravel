@extends('template')

@section('contenu')
	<div class="col-sm-offset-2 col-sm-8">
		<br>
		<div class="panel panel-primary">	
			<div class="panel-heading">Création d'un sondage</div>
			<div class="panel-body"> 
				<div class="col-sm-12">

					<!-- Formulaire -->
					@yield('form')
					<!-- Fin du formulaire -->

				</div>
			</div>
		</div>
		<a href="javascript:history.back()" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
		</a>
	</div>
@stop		

@section('scripts')
	{!! Html::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js') !!}
	<script>

		$(function(){		

			// Nombre de réponses au départ
			var answer_number = $('#answers .ligne').length;

			// Suppression d'une ligne de réponse (utilisation de "on" pour gérer les boutons créés dynamiquement)
			$(document).on('click', '.btn-danger', function(){
				if($('#answers .ligne').length > 3)	$(this).parents('.ligne').remove();	
			});

			// Ajout d'une ligne de réponse
			$("#add_answer").click(function() {
				var html = '<div class="row ligne">\n<div class="form-group">\n'
				+ '<div class="col-md-10">\n'
				+ '{!! Form::text('answers[]', null, ['class' => 'form-control']) !!}\n'
				+ '<small class="help-block"></small>\n'
				+ '</div>\n<div class="col-md-2">\n<button type="button" class="btn btn-danger">Supprimer</button>\n</div>\n</div>\n';
				++answer_number;
				$('#answers').append(html);	
			});

			// Soumission 
			$(document).on('submit', 'form', function(e) {  
				e.preventDefault();
				$.ajax({
					method: $(this).attr('method'),
					url: $(this).attr('action'),
					data: $(this).serialize(),
					dataType: "json"
				})
				.done(function(data) {
					window.location.href = '{!! url('/') !!}';
				})
				.fail(function(data) {
					var obj = data.responseJSON;
					// Nettoyage préliminaire					
					for(var i = 0; i < answer_number + 1; ++i) {
						$('.help-block').eq(i).text('');
						$('.form-group').eq(i).removeClass('has-error');						
					} 
					// Balayage de l'objet
					$.each(data.responseJSON, function (key, value) {
						// Traitement des erreurs de la question
						if(key == 'question') {
							$('.help-block').eq(0).text(value);
							$('.form-group').eq(0).addClass('has-error');							
						}
						// Traitement des erreurs des réponses
						else {
							var i = parseInt(key.slice(-1)) + 1;
							var texte = value[0].replace(key, 'réponse');
							$('.help-block').eq(i).text(texte);
							$('.form-group').eq(i).addClass('has-error');							
						}
					});
				});
			});

		})

	</script>
@stop			
 

