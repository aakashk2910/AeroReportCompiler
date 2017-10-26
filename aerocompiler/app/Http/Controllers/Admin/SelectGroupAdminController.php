<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SelectGroupAdmin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class SelectGroupAdminController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $selectgroupadmin = SelectGroupAdmin::paginate(15);

        return view('admin.selectgroupadmin.index', compact('selectgroupadmin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.selectgroupadmin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['userId' => 'required', ]);

        SelectGroupAdmin::create($request->all());

        Session::flash('flash_message', 'SelectGroupAdmin added!');

        return redirect('admin/selectgroupadmin');
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
        $selectgroupadmin = SelectGroupAdmin::findOrFail($id);

        return view('admin.selectgroupadmin.show', compact('selectgroupadmin'));
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
        $selectgroupadmin = SelectGroupAdmin::findOrFail($id);

        return view('admin.selectgroupadmin.edit', compact('selectgroupadmin'));
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
        $this->validate($request, ['userId' => 'required', ]);

        $selectgroupadmin = SelectGroupAdmin::findOrFail($id);
        $selectgroupadmin->update($request->all());

        Session::flash('flash_message', 'SelectGroupAdmin updated!');

        return redirect('admin/selectgroupadmin');
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
        SelectGroupAdmin::destroy($id);

        Session::flash('flash_message', 'SelectGroupAdmin deleted!');

        return redirect('admin/selectgroupadmin');
    }

}
