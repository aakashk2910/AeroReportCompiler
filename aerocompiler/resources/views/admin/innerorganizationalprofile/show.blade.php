@extends('layouts.master')

@section('content')

    <h1>Innerorganizationalprofile</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>OpInnerId</th><th>OpSubId</th><th>OpInnerName</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $innerorganizationalprofile->id }}</td> <td> {{ $innerorganizationalprofile->opInnerId }} </td><td> {{ $innerorganizationalprofile->opSubId }} </td><td> {{ $innerorganizationalprofile->opInnerName }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection