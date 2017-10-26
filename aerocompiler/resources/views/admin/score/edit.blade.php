@extends('layouts.master')

@section('content')

    <h1>Edit Score</h1>
    <hr/>

    {!! Form::model($score, [
        'method' => 'PATCH',
        'url' => ['admin/score', $score->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('userId') ? 'has-error' : ''}}">
                {!! Form::label('userId', 'Userid: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('userId', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('userId', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('subCriteriaId') ? 'has-error' : ''}}">
                {!! Form::label('subCriteriaId', 'Subcriteriaid: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('subCriteriaId', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('subCriteriaId', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('reportId') ? 'has-error' : ''}}">
                {!! Form::label('reportId', 'Reportid: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('reportId', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('reportId', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('score') ? 'has-error' : ''}}">
                {!! Form::label('score', 'Score: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('score', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('score', '<p class="help-block">:message</p>') !!}
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