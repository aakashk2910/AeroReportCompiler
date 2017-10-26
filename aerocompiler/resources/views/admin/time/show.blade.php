@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Time {{ $time->id }}
        <a href="{{ url('admin/time/' . $time->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Time"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/time', $time->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Time',
                    'onclick'=>'return confirm("Confirm delete?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $time->id }}</td>
                </tr>
                <tr><th> UserId </th><td> {{ $time->userId }} </td></tr><tr><th> ReportId </th><td> {{ $time->reportId }} </td></tr><tr><th> Start </th><td> {{ $time->start }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
