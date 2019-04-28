<?php

namespace App\Http\Requests;

class PollCreateRequest extends Request
{

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() 
	{
		$rules = [
			'question' => 'required|max:255|unique:polls',
			'answers.*' => 'required|max:255'
		];

		return $rules;
	}

}