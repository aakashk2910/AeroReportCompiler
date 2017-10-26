@extends('layouts.master')

@section('content')

    <h1>Create New Innerorganizationalprofile</h1>
    <hr/>

    {!! Form::open(['url' => 'admin/innerorganizationalprofile', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('opInnerId') ? 'has-error' : ''}}">
                {!! Form::label('opInnerId', 'Opinnerid: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('opInnerId', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('opInnerId', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('opSubId') ? 'has-error' : ''}}">
                {!! Form::label('opSubId', 'Opsubid: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('opSubId', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('opSubId', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('opInnerName') ? 'has-error' : ''}}">
                {!! Form::label('opInnerName', 'Opinnername: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('opInnerName', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('opInnerName', '<p class="help-block">:message</p>') !!}
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