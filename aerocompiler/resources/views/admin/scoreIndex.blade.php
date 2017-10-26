<?php
use Illuminate\Support\Facades\DB;
?>

@extends('master')

@section('content')


        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Map Scores
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Score Mapping</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Get Score -->
                <?php $score = DB::table('scoretables')->get(); ?>
                @if($score)
                    <div class="box box-center">
                        <div class="box-header with-border">
                            <h3 class="box-title">Enter Scores</h3>
                        </div><!-- /.box-header -->
                        {{ Form::open(array('url' => '/updateMappedScore')) }}
                            @foreach($data1 as $s)
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>{!! $s->subCriteriaName !!}</label>
                                        <div class="input-group" style="max-width: 600px">
                                            <div class="input-group-addon">
                                                <i class="fa fa-bar-chart"></i>
                                            </div>
                                            <?php $scores = DB::table('scoretables')->where('subCriteriaId', $s->id)->value('maxScore'); ?>
                                            <input type="number" class="form-control" name="{!! $s->id !!}" @if($scores != '') value="{!! $scores !!}" @endif >
                                        </div><!-- /.input group -->
                                    </div><!-- /.form group -->
                                </div><!-- /.box-body -->
                            @endforeach
                        <div class="clearfix"></div>
                        <div class="clearfix"></div>
                        <div class="clearfix"></div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        {{ Form::close() }}
                    </div><!-- /.box -->
                @else
                    <div class="box box-center">
                        <div class="box-header with-border">
                            <h3 class="box-title">Enter Scores</h3>
                        </div><!-- /.box-header -->
                        {{ Form::open(array('url' => '/mappedScore')) }}
                        @foreach($data1 as $s)
                            <div class="box-body">
                                <div class="form-group">
                                    <label>{!! $s->subCriteriaName !!}</label>
                                    <div class="input-group" style="max-width: 600px">
                                        <div class="input-group-addon">
                                            <i class="fa fa-bar-chart"></i>
                                        </div>
                                        <input type="number" class="form-control" name="{!! $s->id !!}" required>
                                    </div><!-- /.input group -->
                                </div><!-- /.form group -->
                            </div><!-- /.box-body -->
                        @endforeach
                        <div class="clearfix"></div>
                        <div class="clearfix"></div>
                        <div class="clearfix"></div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        {{ Form::close() }}
                    </div><!-- /.box -->
                @endif
                <div class="clearfix"></div>
                <div class="clearfix"></div>
                <div class="clearfix"></div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

@endsection