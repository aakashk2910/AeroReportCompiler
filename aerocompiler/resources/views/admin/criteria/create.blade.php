@extends('layouts.master')

@section('content')

    <h1>Create New Criterion</h1>
    <hr/>

    {!! Form::open(['url' => 'admin/criteria', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('criteriaId') ? 'has-error' : ''}}">
                {!! Form::label('criteriaId', 'Criteriaid: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('criteriaId', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('criteriaId', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('criteriaName') ? 'has-error' : ''}}">
                {!! Form::label('criteriaName', 'Criterianame: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('criteriaName', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('criteriaName', '<p class="help-block">:message</p>') !!}
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