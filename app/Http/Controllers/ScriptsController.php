<?php namespace Branches\Http\Controllers;

use Branches\Http\Requests;
use Branches\Http\Controllers\Controller;

use Branches\Model\Script;
use Branches\Http\Requests\ScriptRequest;

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
	public function store(ScriptRequest $request)
	{
        $script = new Script;
        $script->name = $request->input('name');
        $script->save();

        return redirect('scripts')
            ->with('message', 'Successfully created script!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($script)
	{
        return view('scripts.show', ['script' => $script]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($script)
	{
		return view('scripts.edit')
            ->with('message', $script);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($script, ScriptRequest $request)
	{
        $script->name = $request->input('name');
        $script->save();

        return redirect('scripts')
            ->with('message', 'Successfully updated script!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($script)
	{
        $script->delete();

        return redirect('scripts')
            ->with('message', 'Successfully deleted the script!');
	}

}
