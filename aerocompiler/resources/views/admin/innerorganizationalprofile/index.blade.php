@extends('layouts.master')

@section('content')

    <h1>Innerorganizationalprofile <a href="{{ url('admin/innerorganizationalprofile/create') }}" class="btn btn-primary pull-right btn-sm">Add New Innerorganizationalprofile</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>OpInnerId</th><th>OpSubId</th><th>OpInnerName</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($innerorganizationalprofile as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('admin/innerorganizationalprofile', $item->id) }}">{{ $item->opInnerId }}</a></td><td>{{ $item->opSubId }}</td><td>{{ $item->opInnerName }}</td>
                    <td>
                        <a href="{{ url('admin/innerorganizationalprofile/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/innerorganizationalprofile', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $innerorganizationalprofile->render() !!} </div>
    </div>

@endsection
