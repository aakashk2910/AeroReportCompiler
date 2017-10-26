@extends('layouts.master')

@section('content')

    <h1>Edit Scoretable</h1>
    <hr/>

    {!! Form::model($scoretable, [
        'method' => 'PATCH',
        'url' => ['admin/scoretable', $scoretable->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('subCriteriaId') ? 'has-error' : ''}}">
                {!! Form::label('subCriteriaId', 'Subcriteriaid: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('subCriteriaId', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('subCriteriaId', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('maxScore') ? 'has-error' : ''}}">
                {!! Form::label('maxScore', 'Maxscore: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('maxScore', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('maxScore', '<p class="help-block">:message</p>') !!}
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