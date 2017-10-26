<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Criterion;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class CriteriaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $criteria = Criterion::paginate(15);

        return view('admin.criteria.index', compact('criteria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.criteria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['criteriaId' => 'required', 'criteriaName' => 'required', ]);

        Criterion::create($request->all());

        Session::flash('flash_message', 'Criterion added!');

        return redirect('admin/criteria');
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
        $criterion = Criterion::findOrFail($id);

        return view('admin.criteria.show', compact('criterion'));
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
        $criterion = Criterion::findOrFail($id);

        return view('admin.criteria.edit', compact('criterion'));
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
        $this->validate($request, ['criteriaId' => 'required', 'criteriaName' => 'required', ]);

        $criterion = Criterion::findOrFail($id);
        $criterion->update($request->all());

        Session::flash('flash_message', 'Criterion updated!');

        return redirect('admin/criteria');
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
        Criterion::destroy($id);

        Session::flash('flash_message', 'Criterion deleted!');

        return redirect('admin/criteria');
    }

}
