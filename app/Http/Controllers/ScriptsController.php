<?php namespace Branches\Http\Controllers;

use Illuminate\Html\FormFacade as Form;

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
        return view('scripts.edit')
            ->with('page_title', "Create a script")
            ->with('form_tag', Form::open([
                'route' => ['scripts.store'],
                'method' => 'POST',
                'id' => 'script-form'
            ]))
            ->with('btn_text', 'Create the Script!');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ScriptRequest $request)
	{
        $script = Script::create($request->only(['name', 'description', 'body']));
        $script->user_id = $request->user()->id;
        $script->save();

        return redirect('scripts')
            ->with('message', 'Successfully created script!');
	}

	/**
	 * Show the form for editing the specified resource.
	 * Script derived from "route model binding"
     * @see http://laravel.com/docs/5.0/routing#route-model-binding
     *
	 * @param  Script $script
	 * @return Response
	 */
	public function edit(Script $script)
	{
		return view('scripts.edit')
            ->with('page_title', "Edit script #{$script->id} '{$script->name}'")
            ->with('script', $script)
            ->with('form_tag', Form::model($script, [
                'id' => 'script-form',
                'route' => ['scripts.update', $script->id],
                'method' => 'POST'
            ]))
            ->with('btn_text', 'Edit the Script!')
            ->with('last_versions', $script->lastVersions());
	}

	/**
	 * Update the specified resource in storage.
     * Script derived from "route model binding"
     * @see http://laravel.com/docs/5.0/routing#route-model-binding
	 *
	 * @param  Script $script
	 * @return Response
	 */
	public function update(Script $script, ScriptRequest $request)
	{
        if (!$request->input('save')) {
            return redirect('scripts')
                ->with('message', 'Edit aborted');
        }
        $script->fill($request->only(['name', 'description', 'body']));
        $script->save();

        return redirect('scripts')
            ->with('message', 'Successfully updated script!');
	}

	/**
	 * Remove the specified resource from storage.
     * Script derived from "route model binding"
     * @see http://laravel.com/docs/5.0/routing#route-model-binding
	 *
	 * @param  Script $script
	 * @return Response
	 */
	public function destroy(Script $script)
	{
        $script->delete();

        return redirect('scripts')
            ->with('message', 'Successfully deleted the script!');
	}

}
