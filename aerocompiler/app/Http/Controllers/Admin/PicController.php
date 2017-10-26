<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Pic;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class PicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $pic = Pic::paginate(15);

        return view('admin.pic.index', compact('pic'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.pic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, ['userId' => 'required', 'filename' => 'required', 'mime' => 'required', 'original_filename' => 'required', 'country' => 'required', 'state' => 'required', 'city' => 'required', 'profession' => 'required', ]);

        Pic::create($request->all());

        Session::flash('flash_message', 'Pic added!');

        return redirect('admin/pic');
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
        $pic = Pic::findOrFail($id);

        return view('admin.pic.show', compact('pic'));
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
        $pic = Pic::findOrFail($id);

        return view('admin.pic.edit', compact('pic'));
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
        $this->validate($request, ['userId' => 'required', 'filename' => 'required', 'mime' => 'required', 'original_filename' => 'required', 'country' => 'required', 'state' => 'required', 'city' => 'required', 'profession' => 'required', ]);

        $pic = Pic::findOrFail($id);
        $pic->update($request->all());

        Session::flash('flash_message', 'Pic updated!');

        return redirect('admin/pic');
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
        Pic::destroy($id);

        Session::flash('flash_message', 'Pic deleted!');

        return redirect('admin/pic');
    }
}
