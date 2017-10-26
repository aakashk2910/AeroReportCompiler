@extends('layouts.master')

@section('content')

    <h1>Criteria <a href="{{ url('admin/criteria/create') }}" class="btn btn-primary pull-right btn-sm">Add New Criterion</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>CriteriaId</th><th>CriteriaName</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($criteria as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('admin/criteria', $item->id) }}">{{ $item->criteriaId }}</a></td><td>{{ $item->criteriaName }}</td>
                    <td>
                        <a href="{{ url('admin/criteria/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/criteria', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $criteria->render() !!} </div>
    </div>

@endsection
