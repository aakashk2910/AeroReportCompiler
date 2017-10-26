@extends('layouts.master')

@section('content')

    <h1>Groupadmin <a href="{{ url('admin/groupadmin/create') }}" class="btn btn-primary pull-right btn-sm">Add New Groupadmin</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>UserId</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($groupadmin as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('admin/groupadmin', $item->id) }}">{{ $item->userId }}</a></td>
                    <td>
                        <a href="{{ url('admin/groupadmin/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/groupadmin', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $groupadmin->render() !!} </div>
    </div>

@endsection
