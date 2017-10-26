<?php
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
?>
@extends('master')

@section('content')


        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {!! $cname !!}
            <small>{!! $sname !!}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">{!! $cname !!}</a></li>
            <li class="active">{!! $sname !!}</li>
        </ol>
        <div class="clearfix"></div>
        <div class="clearfix"></div>
    </section>

    <!-- Main content -->
    @foreach($flabel as $fl)
        <section class="content">
            <?php $text = DB::table('forminputs')->where('subCriteriaId', $sid)->where('reportId', $rid)->where('labelId', $fl->labelId)->get(); ?>
            @if($text)
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                            <?php $i = 'a'; ?>
                            @foreach($text as $s)

                                <div class="box @if($s->labelText) collapsed-box @endif">
                                    <div class="box-header">
                                        <h3 class="box-title">{!! $fl->labelText !!} <small> ({!! $i !!})</small> <small> ({!! DB::table('users')->where('id', $s->userId)->value('name') !!})</small></h3>
                                        <!-- tools box -->
                                        <div class="pull-right box-tools">
                                            <button class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title=""><i class="fa fa-plus"></i></button>
                                            <a href="{{ url('/add/'.$uid.'/'.$sid.'/'.$fl->labelId) }}"><button class="btn btn-default btn-sm" data-toggle="tooltip" title="Add">Add</button></a>
                                            @if($i != 'a' ) <a href="{{ url('/delete/'.$uid.'/'.$sid.'/'.$fl->labelId.'/'.$s->id) }}"><button class="btn btn-default btn-sm" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button></a> @endif
                                        </div><!-- /. tools -->
                                    </div><!-- /.box-header -->
                                    <div class="box-body pad">
                                        {{ Form::open(array('url' => '/update/'.$uid.'/'.$sid.'/'.$fl->labelId.'/'.$s->id )) }}
                                                <!--<form method="post" action="/submit/{!! $uid !!}/{!! $sid !!}/{!! $fl->labelId !!}">-->
                                        <textarea class="textarea" name="{!! $fl->labelText !!}" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                            {!! $s->labelText !!}
                                        </textarea>
                                        <div class="box-header">
                                            <div class="box-body">
                                                <div class="checkbox-inline form-group pull-right">
                                                    <label>
                                                        <input type="checkbox" class="minimal" name="A" value="Yes" @if($s->A) checked @endif> A
                                                    </label>
                                                    <label>
                                                        <input type="checkbox" class="minimal" name="D" value="Yes" @if($s->D) checked @endif> D
                                                    </label>
                                                    <label>
                                                        <input type="checkbox" class="minimal" name="L" value="Yes" @if($s->L) checked @endif> L
                                                    </label>
                                                    <label>
                                                        <input type="checkbox" class="minimal" name="I" value="Yes" @if($s->I) checked @endif> I
                                                    </label>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                        <!--</form>-->
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                <?php $i++; ?>
                            @endforeach
                    </div>
                </div><!-- /.col-->
            </div><!-- ./row -->
            @endif
        </section><!-- /.content -->
    @endforeach
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Score <small></small></h3>
                            <!-- tools box -->
                            <div class="pull-right box-tools">
                                <button class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title=""><i class="fa fa-minus"></i></button>
                            </div><!-- /. tools -->
                        </div><!-- /.box-header -->
                        <form method="post" action="#">
                            <div class="box-body pad">
                                <input type="number" name="score" id="score">
                            </div>
                            <div class="box-body pad">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div><!-- /.content-wrapper -->
@endsection

