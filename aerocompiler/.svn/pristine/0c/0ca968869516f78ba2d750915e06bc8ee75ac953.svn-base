<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Report;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class ReportController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $report = Report::paginate(15);

        return view('admin.report.index', compact('report'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.report.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['reportId' => 'required', 'reportName' => 'required', ]);

        Report::create($request->all());

        Session::flash('flash_message', 'Report added!');

        return redirect('admin/report');
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
        $report = Report::findOrFail($id);

        return view('admin.report.show', compact('report'));
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
        $report = Report::findOrFail($id);

        return view('admin.report.edit', compact('report'));
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
        $this->validate($request, ['reportId' => 'required', 'reportName' => 'required', ]);

        $report = Report::findOrFail($id);
        $report->update($request->all());

        Session::flash('flash_message', 'Report updated!');

        return redirect('admin/report');
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
        Report::destroy($id);

        Session::flash('flash_message', 'Report deleted!');

        return redirect('admin/report');
    }

}
