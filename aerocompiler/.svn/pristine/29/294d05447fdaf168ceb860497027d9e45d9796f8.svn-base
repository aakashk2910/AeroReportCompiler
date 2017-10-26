<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\score;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class scoreController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $score = score::paginate(15);

        return view('admin.score.index', compact('score'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.score.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['userId' => 'required', 'subCriteriaId' => 'required', 'reportId' => 'required', 'score' => 'required', ]);

        score::create($request->all());

        Session::flash('flash_message', 'score added!');

        return redirect('admin/score');
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
        $score = score::findOrFail($id);

        return view('admin.score.show', compact('score'));
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
        $score = score::findOrFail($id);

        return view('admin.score.edit', compact('score'));
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
        $this->validate($request, ['userId' => 'required', 'subCriteriaId' => 'required', 'reportId' => 'required', 'score' => 'required', ]);

        $score = score::findOrFail($id);
        $score->update($request->all());

        Session::flash('flash_message', 'score updated!');

        return redirect('admin/score');
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
        score::destroy($id);

        Session::flash('flash_message', 'score deleted!');

        return redirect('admin/score');
    }

}
