@extends('layouts.master')

@section('content')

    <h1>Formlabel <a href="{{ url('admin/formlabel/create') }}" class="btn btn-primary pull-right btn-sm">Add New Formlabel</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>LabelId</th><th>LabelText</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($formlabel as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('admin/formlabel', $item->id) }}">{{ $item->labelId }}</a></td><td>{{ $item->labelText }}</td>
                    <td>
                        <a href="{{ url('admin/formlabel/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/formlabel', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $formlabel->render() !!} </div>
    </div>

@endsection
