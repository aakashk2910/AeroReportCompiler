@extends('layouts.master')

@section('content')

    <h1>Organizationalprofile</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>OpId</th><th>OpName</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $organizationalprofile->id }}</td> <td> {{ $organizationalprofile->opId }} </td><td> {{ $organizationalprofile->opName }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection