@extends('layouts.master')

@section('content')

    <h1>Organizationalprofile <a href="{{ url('admin/organizationalprofile/create') }}" class="btn btn-primary pull-right btn-sm">Add New Organizationalprofile</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>OpId</th><th>OpName</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($organizationalprofile as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('admin/organizationalprofile', $item->id) }}">{{ $item->opId }}</a></td><td>{{ $item->opName }}</td>
                    <td>
                        <a href="{{ url('admin/organizationalprofile/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/organizationalprofile', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $organizationalprofile->render() !!} </div>
    </div>

@endsection
