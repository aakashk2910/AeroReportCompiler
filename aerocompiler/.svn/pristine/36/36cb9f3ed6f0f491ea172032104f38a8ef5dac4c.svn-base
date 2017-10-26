@extends('layouts.master')

@section('content')

    <h1>Scoretable <a href="{{ url('admin/scoretable/create') }}" class="btn btn-primary pull-right btn-sm">Add New Scoretable</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>SubCriteriaId</th><th>MaxScore</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($scoretable as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('admin/scoretable', $item->id) }}">{{ $item->subCriteriaId }}</a></td><td>{{ $item->maxScore }}</td>
                    <td>
                        <a href="{{ url('admin/scoretable/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/scoretable', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $scoretable->render() !!} </div>
    </div>

@endsection
