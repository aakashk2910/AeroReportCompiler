<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\scoreTable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class scoreTableController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $scoretable = scoreTable::paginate(15);

        return view('admin.scoretable.index', compact('scoretable'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.scoretable.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['subCriteriaId' => 'required', 'maxScore' => 'required', ]);

        scoreTable::create($request->all());

        Session::flash('flash_message', 'scoreTable added!');

        return redirect('admin/scoretable');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $scoretable = scoreTable::findOrFail($id);

        return view('admin.scoretable.show', compact('scoretable'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $scoretable = scoreTable::findOrFail($id);

        return view('admin.scoretable.edit', compact('scoretable'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $this->validate($request, ['subCriteriaId' => 'required', 'maxScore' => 'required', ]);

        $scoretable = scoreTable::findOrFail($id);
        $scoretable->update($request->all());

        Session::flash('flash_message', 'scoreTable updated!');

        return redirect('admin/scoretable');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        scoreTable::destroy($id);

        Session::flash('flash_message', 'scoreTable deleted!');

        return redirect('admin/scoretable');
    }

}
