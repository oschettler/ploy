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
    $unique_name_rule = [
        'name' => 'required|unique:scripts,name',
    ];

    $route_parameters = $this->route()->parameters();
    if (!empty($route_parameters['script'])) {
        // Check for a unique name but ignore the currently updated script
        $unique_name_rule['name'] .= ',' . $route_parameters['script']->id;
    }
		return $unique_name_rule;
	}

}
