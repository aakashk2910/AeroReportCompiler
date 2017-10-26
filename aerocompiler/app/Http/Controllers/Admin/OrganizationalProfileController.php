<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\OrganizationalProfile;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class OrganizationalProfileController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $organizationalprofile = OrganizationalProfile::paginate(15);

        return view('admin.organizationalprofile.index', compact('organizationalprofile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.organizationalprofile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['opId' => 'required', 'opName' => 'required', ]);

        OrganizationalProfile::create($request->all());

        Session::flash('flash_message', 'OrganizationalProfile added!');

        return redirect('admin/organizationalprofile');
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
        $organizationalprofile = OrganizationalProfile::findOrFail($id);

        return view('admin.organizationalprofile.show', compact('organizationalprofile'));
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
        $organizationalprofile = OrganizationalProfile::findOrFail($id);

        return view('admin.organizationalprofile.edit', compact('organizationalprofile'));
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
        $this->validate($request, ['opId' => 'required', 'opName' => 'required', ]);

        $organizationalprofile = OrganizationalProfile::findOrFail($id);
        $organizationalprofile->update($request->all());

        Session::flash('flash_message', 'OrganizationalProfile updated!');

        return redirect('admin/organizationalprofile');
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
        OrganizationalProfile::destroy($id);

        Session::flash('flash_message', 'OrganizationalProfile deleted!');

        return redirect('admin/organizationalprofile');
    }

}
