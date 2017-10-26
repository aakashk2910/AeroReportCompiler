@extends('layouts.master')

@section('content')

    <h1>Create New Organizationalenv</h1>
    <hr/>

    {!! Form::open(['url' => 'admin/organizationalenv', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('userId') ? 'has-error' : ''}}">
                {!! Form::label('userId', 'Userid: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('userId', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('userId', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('reportId') ? 'has-error' : ''}}">
                {!! Form::label('reportId', 'Reportid: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('reportId', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('reportId', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('opId') ? 'has-error' : ''}}">
                {!! Form::label('opId', 'Opid: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('opId', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('opId', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('opSubId') ? 'has-error' : ''}}">
                {!! Form::label('opSubId', 'Opsubid: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('opSubId', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('opSubId', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('f1') ? 'has-error' : ''}}">
                {!! Form::label('f1', 'F1: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('f1', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('f1', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('f2') ? 'has-error' : ''}}">
                {!! Form::label('f2', 'F2: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('f2', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('f2', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('f3') ? 'has-error' : ''}}">
                {!! Form::label('f3', 'F3: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('f3', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('f3', '<p class="help-block">:message</p>') !!}
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

@endsection