<?php namespace Branches\Http\Requests;

use Branches\Http\Requests\Request;

class RepoRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
