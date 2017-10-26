@extends('layouts.master')

@section('content')

    <h1>Subcriteria <a href="{{ url('admin/subcriteria/create') }}" class="btn btn-primary pull-right btn-sm">Add New Subcriterium</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>SubCriteriaId</th><th>CriteriaId</th><th>SubCriteriaName</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($subcriteria as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('admin/subcriteria', $item->id) }}">{{ $item->subCriteriaId }}</a></td><td>{{ $item->criteriaId }}</td><td>{{ $item->subCriteriaName }}</td>
                    <td>
                        <a href="{{ url('admin/subcriteria/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/subcriteria', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $subcriteria->render() !!} </div>
    </div>

@endsection
