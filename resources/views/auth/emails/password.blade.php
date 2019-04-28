{!! link_to('password/reset/' . $token . '?email='. urlencode($user->getEmailForPasswordReset()), 'Cliquez ici pour réinitialiser votre mot de passe') !!}
