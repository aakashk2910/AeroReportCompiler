@extends('layouts.master')

@section('content')

    <h1>Create New Subcriterium</h1>
    <hr/>

    {!! Form::open(['url' => 'admin/subcriteria', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('subCriteriaId') ? 'has-error' : ''}}">
                {!! Form::label('subCriteriaId', 'Subcriteriaid: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('subCriteriaId', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('subCriteriaId', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('criteriaId') ? 'has-error' : ''}}">
                {!! Form::label('criteriaId', 'Criteriaid: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('criteriaId', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('criteriaId', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('subCriteriaName') ? 'has-error' : ''}}">
                {!! Form::label('subCriteriaName', 'Subcriterianame: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('subCriteriaName', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('subCriteriaName', '<p class="help-block">:message</p>') !!}
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