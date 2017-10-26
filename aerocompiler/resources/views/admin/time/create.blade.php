@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Create New Time</h1>
    <hr/>

    {!! Form::open(['url' => '/admin/time', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('userId') ? 'has-error' : ''}}">
                {!! Form::label('userId', 'Userid', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('userId', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('userId', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('reportId') ? 'has-error' : ''}}">
                {!! Form::label('reportId', 'Reportid', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('reportId', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('reportId', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('start') ? 'has-error' : ''}}">
                {!! Form::label('start', 'Start', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::date('start', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('start', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('end') ? 'has-error' : ''}}">
                {!! Form::label('end', 'End', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::date('end', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('end', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
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

</div>
@endsection