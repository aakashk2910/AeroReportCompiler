@extends('layouts.master')

@section('content')

    <h1>Adminindex <a href="{{ url('admin/adminindex/create') }}" class="btn btn-primary pull-right btn-sm">Add New Adminindex</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>UserId</th><th>ReportId</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($adminindex as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('admin/adminindex', $item->id) }}">{{ $item->userId }}</a></td><td>{{ $item->reportId }}</td>
                    <td>
                        <a href="{{ url('admin/adminindex/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/adminindex', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $adminindex->render() !!} </div>
    </div>

@endsection
