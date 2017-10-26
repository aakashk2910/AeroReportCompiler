<?php
use Illuminate\Support\Facades\DB;

/*$rid = DB::table('adminindices')->where('userId', \Illuminate\Support\Facades\Auth::user()->id)->value('reportId');
$reportId = DB::table('reports')->where('id', $rid)->value('reportId');
$reportName = DB::table('reports')->where('id', $rid)->value('reportName');*/

$color = [
        '#3c8dbc',
        '#932ab6',
        '#f56954',
        '#00a65a',
        '#ff0000',
        '#cc0066',
        '#ffff00'
];
/*$rid = DB::table('reports')->where('reportId', $reportId)->value('id');
$examiners = DB::table('adminindices')->where('reportId', $rid)->get();*/
?>

@extends('master')

@section('content')

        <!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php $p = DB::table('pics')->where('userId', \Illuminate\Support\Facades\Auth::user()->id)->value('filename'); ?>
                @if($p)
                    <img src="{!! url('/public/images/catalog/'.$p) !!}" class="img-circle" alt="User Image">
                @else
                    <img src="{!! url('/public/images/catalog/default.jpg') !!}" class="img-circle" alt="User Image">
                @endif
            </div>
            <div class="pull-left info">
                <p>
                    @if (Auth::guest())
                        Guest
                    @else
                        {{ Auth::user()->name }}
                    @endif
                </p>
                {{--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>--}}
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->

        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="{{ url('/dashboard')  }}">
                    <i class="fa fa-dashboard"></i> <span> Dashboard </span> <i class="fa fa-angle-left pull-right"></i>
                </a>
            </li>
            <!-- For Examiners -->
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-table"></i> <span> Organizational Profile </span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{ url('/kbf1/'.Auth::user()->id.'/'.$reportId) }}"><i class="fa fa-table"></i>Organizational Description</a></li>
                        <li class="active"><a href="{{ url('/kbf2/'.Auth::user()->id.'/'.$reportId) }}"><i class="fa fa-table"></i>Organizational Challenges</a></li>
                    </ul>
                </li>
                @foreach($data as $criteria)
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-files-o"></i> <span> {!! wordwrap($criteria->criteriaName, 24, '<br>') !!} </span> <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <?php $criteriaId = $criteria->criteriaId; ?>
                        <ul class="treeview-menu">
                            @foreach($data1 as $subCriteria)
                                @if($subCriteria->criteriaId == $criteriaId)
                                    <li class="active"><a href="{{ url('/report/'.Auth::user()->id.'/'.$subCriteria->id.'/'.$reportId) }}"><i class="fa fa-edit"></i>{!! wordwrap($subCriteria->subCriteriaName, 30, '<br>')  !!}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endforeach

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder-o"></i> <span> Final </span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ url('/finalScore/'.$reportId) }}"><i class="fa fa-table"></i>Score Table</a></li>
                    <li class="active"><a href="{{ url('/adli/'.$reportId) }}"><i class="fa fa-table"></i>ADLI Matrix</a></li>
                    <li class="active"><a href="{{ url('/finalReport/'.$reportId) }}"><i class="fa fa-folder-open-o"></i>Final Report</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>{!! \Illuminate\Support\Facades\DB::table('reports')->where('id', $reportId)->value('reportName') !!}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-xs-6" id="timeR">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">

                        <?php
                        $com = DB::table('forminputs')->where('userId', Auth::user()->id)->where('reportId', $reportId)->get();
                        $arr = [];
                        foreach($com as $cm){
                            array_push($arr, $cm->subCriteriaId);
                        }
                        $uarrcount = sizeof(array_unique($arr));
                        $percentageCompletion = ceil($uarrcount * 100 / 17);

                            $end = DB::table('times')->where('reportId', $reportId)->value('end');
                            if($end){
                                $curr = time();

                                $time = $end - $curr;
                                $day = floor($time/(60*60*24));
                                $hr = date("H:i:s", $time);
                            }
                        ?>
                        <h3>
                        @if($end)
                            @if(ceil($percentageCompletion) != 100)
                                @if($day < 0 || $hr < 0)
                                    Time Expired
                                @else
                                    {!! $day !!}<sup style="font-size: 20px">Days</sup>
                                    {!! $hr !!}<sup style="font-size: 20px"></sup>
                                @endif
                            @else
                                Report Completed on Time!
                            @endif
                        @else
                                {!! 0 !!} <sup style="font-size: 20px">Days</sup>

                        @endif
                        </h3>
                        <p>Time Remaining</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-clock"></i>
                    </div>
                    {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
                </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>

                            {!! ceil($percentageCompletion) !!}

                            <sup style="font-size: 20px">%</sup></h3>
                        <p>Report Completed</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
                </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3> {!! ceil(100 - $percentageCompletion) !!}<sup style="font-size: 20px">%</sup> </h3>
                        <p>Report Pending</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->



        <div class="row">

        </div><!-- /.row -->
            <div class="row">

            </div><!-- /.row -->

            <!-- / End Of Completion chart -->

        <!-- Main row -->
        <div class="row">
                <div class="col-xs-8">
                    <div class="box box-solid">
                        <div class="box-header">
                            <i class="fa fa-bar-chart-o"></i>
                            <h3 class="box-title">Report Status</h3>
                            <div class="box-tools pull-left">
                                <button class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div><!-- /.box-header -->

                        <?php

                        ?>

                        <div class="box-body">
                            <div class="row">
                                <?php $c = 0; ?>

                                <div class="col-md-12 col-sm-14 col-xs-14 text-center">
                                    <?php   $com = DB::table('forminputs')->where('userId', Auth::user()->id)->where('reportId', $reportId)->get();
                                    $arr = [];
                                    foreach($com as $cm){
                                    array_push($arr, $cm->subCriteriaId);
                                    }
                                    $uarrcount = sizeof(array_unique($arr));
                                    $percentageCompletion = ceil($uarrcount * 100 / 17);
                                    ?>
                                    <input type="text" class="knob"
                                           value="{!! $percentageCompletion !!}"
                                           data-skin="tron"  data-thickness="0.2" data-width="90" data-height="90" data-fgColor="{!! $color[$c++] !!}" data-readonly="true">
                                    <div class="knob-label"> {{ $percentageCompletion }}% Completed </div>
                                </div><!-- ./col -->

                            </div><!-- /.row -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->

            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Report Deadline</h3>
                    </div>
                    {{ Form::open(array('url' => '/dateRange/'.$reportId)) }}
                    <div class="box-body">
                        <!-- Date range -->
                        <div class="form-group">
                            <label>Date range:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="range" class="form-control pull-right" id="reservationtime">
                            </div><!-- /.input group -->
                        </div><!-- /.form group -->
                        <button type="submit" class="btn btn-primary btn-block btn-flat pull-right" style="width: 20%">Done</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
            <div class="clearfix"></div>

        </div><!-- /.row -->

        <div class="row">
            <section class="col-lg-5 connectedSortable">
                <!-- Calendar -->
                <div class="box box-solid bg-green-gradient">
                    <div class="box-header">
                        <i class="fa fa-calendar"></i>
                        <h3 class="box-title">Calendar</h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <!-- button with a dropdown -->
                            {{--<div class="btn-group">
                                <button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li><a href="#">Add new event</a></li>
                                    <li><a href="#">Clear events</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">View calendar</a></li>
                                </ul>
                            </div>--}}
                            <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div><!-- /. tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <!--The calendar -->
                        <div id="calendar" style="width: 100%"></div>
                    </div><!-- /.box-body -->
                    {{--<div class="box-footer text-black">
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- Progress bars -->
                                <div class="clearfix">
                                    <span class="pull-left">Task #1</span>
                                    <small class="pull-right">90%</small>
                                </div>
                                <div class="progress xs">
                                    <div class="progress-bar progress-bar-green" style="width: 90%;"></div>
                                </div>

                                <div class="clearfix">
                                    <span class="pull-left">Task #2</span>
                                    <small class="pull-right">70%</small>
                                </div>
                                <div class="progress xs">
                                    <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                                </div>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <div class="clearfix">
                                    <span class="pull-left">Task #3</span>
                                    <small class="pull-right">60%</small>
                                </div>
                                <div class="progress xs">
                                    <div class="progress-bar progress-bar-green" style="width: 60%;"></div>
                                </div>

                                <div class="clearfix">
                                    <span class="pull-left">Task #4</span>
                                    <small class="pull-right">40%</small>
                                </div>
                                <div class="progress xs">
                                    <div class="progress-bar progress-bar-green" style="width: 40%;"></div>
                                </div>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div>--}}
                </div><!-- /.box -->
            </section><!-- right col -->
        </div>
    </section>
</div><!-- /.row (main row) -->

</section><!-- /.content -->

</div><!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-list-alt"></i></a></li>
        {{--<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>--}}
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
                <?php
                $Report = DB::table('adminindices')->where('userId', \Illuminate\Support\Facades\Auth::user()->id)->get();
                ?>
                @foreach($Report as $r)
                    <?php $c = 0; ?>
                    <?php   $com = DB::table('forminputs')->where('userId', Auth::user()->id)->where('reportId', $r->reportId)->get();
                    $arr = [];
                    foreach($com as $cm){
                    array_push($arr, $cm->subCriteriaId);
                    }
                    $uarrcount = sizeof(array_unique($arr));
                    $percentageCompletion = ceil($uarrcount * 100 / 17);
                    $rName = wordwrap(\Illuminate\Support\Facades\DB::table('reports')->where('id', $r->reportId)->value('reportName'), 30, "<br>");
                    ?>

                    <li>
                        <a href="javascript::;">
                            <h4 class="control-sidebar-subheading">
                                {!! $rName !!}
                                <span class="label label-danger pull-right">{!! $percentageCompletion !!}%</span>
                            </h4>
                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-success" style="width:{!!$percentageCompletion!!}%"></div>
                            </div>
                        </a>
                    </li>

                @endforeach
            </ul><!-- /.control-sidebar-menu -->

        </div><!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>

            </form>
        </div><!-- /.tab-pane -->
    </div>
</aside><!-- /.control-sidebar -->



<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->
@endsection
