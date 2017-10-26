<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Time;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class TimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $time = Time::paginate(15);

        return view('admin.time.index', compact('time'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.time.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, ['userId' => 'required', 'reportId' => 'required', 'start' => 'required', 'end' => 'required', ]);

        Time::create($request->all());

        Session::flash('flash_message', 'Time added!');

        return redirect('admin/time');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $time = Time::findOrFail($id);

        return view('admin.time.show', compact('time'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
        $time = Time::findOrFail($id);

        return view('admin.time.edit', compact('time'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        $this->validate($request, ['userId' => 'required', 'reportId' => 'required', 'start' => 'required', 'end' => 'required', ]);

        $time = Time::findOrFail($id);
        $time->update($request->all());

        Session::flash('flash_message', 'Time updated!');

        return redirect('admin/time');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        Time::destroy($id);

        Session::flash('flash_message', 'Time deleted!');

        return redirect('admin/time');
    }
}
