<?php namespace Branches\Http\Requests;

use Branches\Http\Requests\Request;

class ScriptRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        // Check for a unique name but ignore the currently updated script
        $script_id = $this->route()->parameters()['script']->id;
		return [
            'name' => 'required|unique:scripts,name,' . $script_id,
		];
	}

}
