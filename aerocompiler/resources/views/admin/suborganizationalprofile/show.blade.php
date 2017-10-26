@extends('layouts.master')

@section('content')

    <h1>Suborganizationalprofile</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>OpSubId</th><th>OpId</th><th>OpSubName</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $suborganizationalprofile->id }}</td> <td> {{ $suborganizationalprofile->opSubId }} </td><td> {{ $suborganizationalprofile->opId }} </td><td> {{ $suborganizationalprofile->opSubName }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection