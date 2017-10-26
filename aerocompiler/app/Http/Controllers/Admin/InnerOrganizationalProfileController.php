<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\InnerOrganizationalProfile;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class InnerOrganizationalProfileController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $innerorganizationalprofile = InnerOrganizationalProfile::paginate(15);

        return view('admin.innerorganizationalprofile.index', compact('innerorganizationalprofile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.innerorganizationalprofile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['opInnerId' => 'required', 'opSubId' => 'required', 'opInnerName' => 'required', ]);

        InnerOrganizationalProfile::create($request->all());

        Session::flash('flash_message', 'InnerOrganizationalProfile added!');

        return redirect('admin/innerorganizationalprofile');
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
        $innerorganizationalprofile = InnerOrganizationalProfile::findOrFail($id);

        return view('admin.innerorganizationalprofile.show', compact('innerorganizationalprofile'));
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
        $innerorganizationalprofile = InnerOrganizationalProfile::findOrFail($id);

        return view('admin.innerorganizationalprofile.edit', compact('innerorganizationalprofile'));
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
        $this->validate($request, ['opInnerId' => 'required', 'opSubId' => 'required', 'opInnerName' => 'required', ]);

        $innerorganizationalprofile = InnerOrganizationalProfile::findOrFail($id);
        $innerorganizationalprofile->update($request->all());

        Session::flash('flash_message', 'InnerOrganizationalProfile updated!');

        return redirect('admin/innerorganizationalprofile');
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
        InnerOrganizationalProfile::destroy($id);

        Session::flash('flash_message', 'InnerOrganizationalProfile deleted!');

        return redirect('admin/innerorganizationalprofile');
    }

}
