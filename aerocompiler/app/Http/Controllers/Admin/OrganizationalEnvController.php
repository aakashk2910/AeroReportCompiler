<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\OrganizationalEnv;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class OrganizationalEnvController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $organizationalenv = OrganizationalEnv::paginate(15);

        return view('admin.organizationalenv.index', compact('organizationalenv'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.organizationalenv.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['userId' => 'required', 'reportId' => 'required', 'opId' => 'required', 'opSubId' => 'required', 'f1' => 'required', 'f2' => 'required', 'f3' => 'required', ]);

        OrganizationalEnv::create($request->all());

        Session::flash('flash_message', 'OrganizationalEnv added!');

        return redirect('admin/organizationalenv');
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
        $organizationalenv = OrganizationalEnv::findOrFail($id);

        return view('admin.organizationalenv.show', compact('organizationalenv'));
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
        $organizationalenv = OrganizationalEnv::findOrFail($id);

        return view('admin.organizationalenv.edit', compact('organizationalenv'));
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
        $this->validate($request, ['userId' => 'required', 'reportId' => 'required', 'opId' => 'required', 'opSubId' => 'required', 'f1' => 'required', 'f2' => 'required', 'f3' => 'required', ]);

        $organizationalenv = OrganizationalEnv::findOrFail($id);
        $organizationalenv->update($request->all());

        Session::flash('flash_message', 'OrganizationalEnv updated!');

        return redirect('admin/organizationalenv');
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
        OrganizationalEnv::destroy($id);

        Session::flash('flash_message', 'OrganizationalEnv deleted!');

        return redirect('admin/organizationalenv');
    }

}
