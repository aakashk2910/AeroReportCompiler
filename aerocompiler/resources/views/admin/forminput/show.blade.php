@extends('layouts.master')

@section('content')

    <h1>Forminput</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>ReportName</th><th>LabelId</th><th>LabelText</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $forminput->id }}</td> <td> {{ $forminput->reportName }} </td><td> {{ $forminput->labelId }} </td><td> {{ $forminput->labelText }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection