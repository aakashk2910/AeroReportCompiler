<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\groupAdmin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class groupAdminController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $groupadmin = groupAdmin::paginate(15);

        return view('admin.groupadmin.index', compact('groupadmin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.groupadmin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['userId' => 'required', ]);

        groupAdmin::create($request->all());

        Session::flash('flash_message', 'groupAdmin added!');

        return redirect('admin/groupadmin');
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
        $groupadmin = groupAdmin::findOrFail($id);

        return view('admin.groupadmin.show', compact('groupadmin'));
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
        $groupadmin = groupAdmin::findOrFail($id);

        return view('admin.groupadmin.edit', compact('groupadmin'));
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

        $groupadmin = groupAdmin::findOrFail($id);
        $groupadmin->update($request->all());

        Session::flash('flash_message', 'groupAdmin updated!');

        return redirect('admin/groupadmin');
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
        groupAdmin::destroy($id);

        Session::flash('flash_message', 'groupAdmin deleted!');

        return redirect('admin/groupadmin');
    }

}
