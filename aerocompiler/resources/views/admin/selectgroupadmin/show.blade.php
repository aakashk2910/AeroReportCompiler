@extends('layouts.master')

@section('content')

    <h1>Selectgroupadmin</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>UserId</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $selectgroupadmin->id }}</td> <td> {{ $selectgroupadmin->userId }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection