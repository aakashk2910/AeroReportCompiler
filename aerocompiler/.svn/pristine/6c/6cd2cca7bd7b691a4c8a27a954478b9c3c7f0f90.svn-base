<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\FormInput;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class FormInputController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $forminput = FormInput::paginate(15);

        return view('admin.forminput.index', compact('forminput'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.forminput.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['reportName' => 'required', 'labelId' => 'required', 'labelText' => 'required', ]);

        FormInput::create($request->all());

        Session::flash('flash_message', 'FormInput added!');

        return redirect('admin/forminput');
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
        $forminput = FormInput::findOrFail($id);

        return view('admin.forminput.show', compact('forminput'));
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
        $forminput = FormInput::findOrFail($id);

        return view('admin.forminput.edit', compact('forminput'));
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
        $this->validate($request, ['reportName' => 'required', 'labelId' => 'required', 'labelText' => 'required', ]);

        $forminput = FormInput::findOrFail($id);
        $forminput->update($request->all());

        Session::flash('flash_message', 'FormInput updated!');

        return redirect('admin/forminput');
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
        FormInput::destroy($id);

        Session::flash('flash_message', 'FormInput deleted!');

        return redirect('admin/forminput');
    }

}
