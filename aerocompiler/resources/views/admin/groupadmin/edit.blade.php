@extends('layouts.master')

@section('content')

    <h1>Edit Groupadmin</h1>
    <hr/>

    {!! Form::model($groupadmin, [
        'method' => 'PATCH',
        'url' => ['admin/groupadmin', $groupadmin->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('userId') ? 'has-error' : ''}}">
                {!! Form::label('userId', 'Userid: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('userId', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('userId', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

@endsection