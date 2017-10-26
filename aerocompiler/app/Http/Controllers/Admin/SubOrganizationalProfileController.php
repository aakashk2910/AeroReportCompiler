<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SubOrganizationalProfile;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class SubOrganizationalProfileController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $suborganizationalprofile = SubOrganizationalProfile::paginate(15);

        return view('admin.suborganizationalprofile.index', compact('suborganizationalprofile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.suborganizationalprofile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['opSubId' => 'required', 'opId' => 'required', 'opSubName' => 'required', ]);

        SubOrganizationalProfile::create($request->all());

        Session::flash('flash_message', 'SubOrganizationalProfile added!');

        return redirect('admin/suborganizationalprofile');
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
        $suborganizationalprofile = SubOrganizationalProfile::findOrFail($id);

        return view('admin.suborganizationalprofile.show', compact('suborganizationalprofile'));
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
        $suborganizationalprofile = SubOrganizationalProfile::findOrFail($id);

        return view('admin.suborganizationalprofile.edit', compact('suborganizationalprofile'));
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
        $this->validate($request, ['opSubId' => 'required', 'opId' => 'required', 'opSubName' => 'required', ]);

        $suborganizationalprofile = SubOrganizationalProfile::findOrFail($id);
        $suborganizationalprofile->update($request->all());

        Session::flash('flash_message', 'SubOrganizationalProfile updated!');

        return redirect('admin/suborganizationalprofile');
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
        SubOrganizationalProfile::destroy($id);

        Session::flash('flash_message', 'SubOrganizationalProfile deleted!');

        return redirect('admin/suborganizationalprofile');
    }

}
