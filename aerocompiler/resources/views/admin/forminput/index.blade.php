@extends('layouts.master')

@section('content')

    <h1>Forminput <a href="{{ url('admin/forminput/create') }}" class="btn btn-primary pull-right btn-sm">Add New Forminput</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>ReportName</th><th>LabelId</th><th>LabelText</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($forminput as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('admin/forminput', $item->id) }}">{{ $item->reportName }}</a></td><td>{{ $item->labelId }}</td><td>{{ $item->labelText }}</td>
                    <td>
                        <a href="{{ url('admin/forminput/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/forminput', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $forminput->render() !!} </div>
    </div>

@endsection
