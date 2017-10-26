<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\formLabel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class formLabelController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $formlabel = formLabel::paginate(15);

        return view('admin.formlabel.index', compact('formlabel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.formlabel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['labelId' => 'required', 'labelText' => 'required', ]);

        formLabel::create($request->all());

        Session::flash('flash_message', 'formLabel added!');

        return redirect('admin/formlabel');
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
        $formlabel = formLabel::findOrFail($id);

        return view('admin.formlabel.show', compact('formlabel'));
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
        $formlabel = formLabel::findOrFail($id);

        return view('admin.formlabel.edit', compact('formlabel'));
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
        $this->validate($request, ['labelId' => 'required', 'labelText' => 'required', ]);

        $formlabel = formLabel::findOrFail($id);
        $formlabel->update($request->all());

        Session::flash('flash_message', 'formLabel updated!');

        return redirect('admin/formlabel');
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
        formLabel::destroy($id);

        Session::flash('flash_message', 'formLabel deleted!');

        return redirect('admin/formlabel');
    }

}
