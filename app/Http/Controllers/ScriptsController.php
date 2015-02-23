<?php namespace Branches\Http\Controllers;

use Branches\Http\Requests;
use Branches\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Branches\Model\Script;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Input;

class ScriptsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $scripts = Script::all();
        return view('scripts.index')->with('scripts', $scripts);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('scripts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $rules = array(
            'name'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('scripts/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $script = new Script;
            $script->name = Input::get('name');
            $nerd->save();

            // redirect
            return redirect('nerds')
                ->with('message', 'Successfully created script!');
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return view('scripts.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
