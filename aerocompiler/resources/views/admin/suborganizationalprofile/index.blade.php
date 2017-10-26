@extends('layouts.master')

@section('content')

    <h1>Suborganizationalprofile <a href="{{ url('admin/suborganizationalprofile/create') }}" class="btn btn-primary pull-right btn-sm">Add New Suborganizationalprofile</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>OpSubId</th><th>OpId</th><th>OpSubName</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($suborganizationalprofile as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('admin/suborganizationalprofile', $item->id) }}">{{ $item->opSubId }}</a></td><td>{{ $item->opId }}</td><td>{{ $item->opSubName }}</td>
                    <td>
                        <a href="{{ url('admin/suborganizationalprofile/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/suborganizationalprofile', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $suborganizationalprofile->render() !!} </div>
    </div>

@endsection
