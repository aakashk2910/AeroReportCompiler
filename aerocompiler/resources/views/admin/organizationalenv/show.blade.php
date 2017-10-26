@extends('layouts.master')

@section('content')

    <h1>Organizationalenv</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>UserId</th><th>ReportId</th><th>OpId</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $organizationalenv->id }}</td> <td> {{ $organizationalenv->userId }} </td><td> {{ $organizationalenv->reportId }} </td><td> {{ $organizationalenv->opId }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection