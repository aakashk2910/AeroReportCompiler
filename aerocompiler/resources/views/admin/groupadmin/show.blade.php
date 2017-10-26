@extends('layouts.master')

@section('content')

    <h1>Groupadmin</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>UserId</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $groupadmin->id }}</td> <td> {{ $groupadmin->userId }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection