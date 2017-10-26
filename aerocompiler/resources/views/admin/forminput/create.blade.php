@extends('layouts.master')

@section('content')

    <h1>Create New Forminput</h1>
    <hr/>

    {!! Form::open(['url' => 'admin/forminput', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('reportName') ? 'has-error' : ''}}">
                {!! Form::label('reportName', 'Reportname: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('reportName', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('reportName', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('labelId') ? 'has-error' : ''}}">
                {!! Form::label('labelId', 'Labelid: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('labelId', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('labelId', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('labelText') ? 'has-error' : ''}}">
                {!! Form::label('labelText', 'Labeltext: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('labelText', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('labelText', '<p class="help-block">:message</p>') !!}
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