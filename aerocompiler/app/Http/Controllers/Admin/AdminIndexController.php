<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AdminIndex;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class AdminIndexController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $adminindex = AdminIndex::paginate(15);

        return view('admin.adminindex.index', compact('adminindex'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.adminindex.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['userId' => 'required', 'reportId' => 'required', ]);

        AdminIndex::create($request->all());

        Session::flash('flash_message', 'AdminIndex added!');

        return redirect('admin/adminindex');
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
        $adminindex = AdminIndex::findOrFail($id);

        return view('admin.adminindex.show', compact('adminindex'));
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
        $adminindex = AdminIndex::findOrFail($id);

        return view('admin.adminindex.edit', compact('adminindex'));
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
        $this->validate($request, ['userId' => 'required', 'reportId' => 'required', ]);

        $adminindex = AdminIndex::findOrFail($id);
        $adminindex->update($request->all());

        Session::flash('flash_message', 'AdminIndex updated!');

        return redirect('admin/adminindex');
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
        AdminIndex::destroy($id);

        Session::flash('flash_message', 'AdminIndex deleted!');

        return redirect('admin/adminindex');
    }

}
