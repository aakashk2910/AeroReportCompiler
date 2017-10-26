@extends('layouts.master')

@section('content')

    <h1>Edit Suborganizationalprofile</h1>
    <hr/>

    {!! Form::model($suborganizationalprofile, [
        'method' => 'PATCH',
        'url' => ['admin/suborganizationalprofile', $suborganizationalprofile->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('opSubId') ? 'has-error' : ''}}">
                {!! Form::label('opSubId', 'Opsubid: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('opSubId', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('opSubId', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('opId') ? 'has-error' : ''}}">
                {!! Form::label('opId', 'Opid: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('opId', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('opId', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('opSubName') ? 'has-error' : ''}}">
                {!! Form::label('opSubName', 'Opsubname: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('opSubName', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('opSubName', '<p class="help-block">:message</p>') !!}
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