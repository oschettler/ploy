<?php namespace Branches\Http\Controllers;

use Branches\Http\Requests;
use Branches\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Branches\Model\Repo;
use Branches\Http\Requests\RepoRequest;


class ReposController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($repo)
	{
		return view('repos.show', ['repo' => $repo]);
	}

    public function setScript(Request $request, $repo)
    {
        $repo->script_id = $request->input('script_id');
        $repo->save();
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
	public function update(Request $request, $id)
	{
		$repo = Repo::find($id)->firstOrFail();
        $repo->update_script = $request->input('update_script');	
        $repo->save();
        return redirect('/home')->with('message', 'Script updated');	
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
