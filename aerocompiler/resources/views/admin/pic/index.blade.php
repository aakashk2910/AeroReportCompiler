@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Pic <a href="{{ url('/admin/pic/create') }}" class="btn btn-primary btn-xs" title="Add New Pic"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> UserId </th><th> Filename </th><th> Mime </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($pic as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->userId }}</td><td>{{ $item->filename }}</td><td>{{ $item->mime }}</td>
                    <td>
                        <a href="{{ url('/admin/pic/' . $item->id) }}" class="btn btn-success btn-xs" title="View Pic"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/pic/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Pic"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/pic', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Pic" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Pic',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ));!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $pic->render() !!} </div>
    </div>

</div>
@endsection
