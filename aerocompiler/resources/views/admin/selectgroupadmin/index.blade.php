@extends('layouts.master')

@section('content')

    <h1>Selectgroupadmin <a href="{{ url('admin/selectgroupadmin/create') }}" class="btn btn-primary pull-right btn-sm">Add New Selectgroupadmin</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>UserId</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($selectgroupadmin as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('admin/selectgroupadmin', $item->id) }}">{{ $item->userId }}</a></td>
                    <td>
                        <a href="{{ url('admin/selectgroupadmin/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/selectgroupadmin', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $selectgroupadmin->render() !!} </div>
    </div>

@endsection
