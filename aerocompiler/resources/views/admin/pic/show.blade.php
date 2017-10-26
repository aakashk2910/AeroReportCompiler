@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Pic {{ $pic->id }}
        <a href="{{ url('admin/pic/' . $pic->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Pic"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/pic', $pic->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Pic',
                    'onclick'=>'return confirm("Confirm delete?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $pic->id }}</td>
                </tr>
                <tr><th> UserId </th><td> {{ $pic->userId }} </td></tr><tr><th> Filename </th><td> {{ $pic->filename }} </td></tr><tr><th> Mime </th><td> {{ $pic->mime }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
