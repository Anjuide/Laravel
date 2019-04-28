<?php

namespace App\Http\Requests;

class PollUpdateRequest extends Request
{

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$id = $this->poll;
		$rules = [
			'question' => 'required|max:255|unique:polls,question,' . $id,
			'answers.*' => 'required|max:255'
		];

		return $rules;
	}

}