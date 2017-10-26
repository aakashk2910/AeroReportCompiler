<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\subCriterium;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class subCriteriaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $subcriteria = subCriterium::paginate(15);

        return view('admin.subcriteria.index', compact('subcriteria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.subcriteria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['subCriteriaId' => 'required', 'criteriaId' => 'required', 'subCriteriaName' => 'required', ]);

        subCriterium::create($request->all());

        Session::flash('flash_message', 'subCriterium added!');

        return redirect('admin/subcriteria');
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
        $subcriterium = subCriterium::findOrFail($id);

        return view('admin.subcriteria.show', compact('subcriterium'));
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
        $subcriterium = subCriterium::findOrFail($id);

        return view('admin.subcriteria.edit', compact('subcriterium'));
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
        $this->validate($request, ['subCriteriaId' => 'required', 'criteriaId' => 'required', 'subCriteriaName' => 'required', ]);

        $subcriterium = subCriterium::findOrFail($id);
        $subcriterium->update($request->all());

        Session::flash('flash_message', 'subCriterium updated!');

        return redirect('admin/subcriteria');
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
        subCriterium::destroy($id);

        Session::flash('flash_message', 'subCriterium deleted!');

        return redirect('admin/subcriteria');
    }

}
