<?php namespace Branches\Http\Controllers;

use Branches\Http\Requests;
use Branches\Http\Controllers\Controller;
use Branches\Commands\UpdateWorkingCopy;
use Branches\Model\Update;

use Illuminate\Http\Request;

class UpdatesController extends Controller {

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
	public function show(Update $update)
	{
        return view('updates.show', ['update' => $update]);
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
	
	public function run(Update $update)
	{
    	$this->dispatch(new UpdateWorkingCopy($update));
    	return redirect()
    	    ->route('updates.show', $update->id)
    	    ->with('message', "Update #{$update->id} complete");
	}

}
