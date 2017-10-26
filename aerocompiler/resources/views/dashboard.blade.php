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
        '#ffff00',
        '#3c8dbc',
        '#932ab6',
        '#f56954',
        '#00a65a',
        '#ff0000',
        '#cc0066',
        '#ffff00',
        '#3c8dbc',
        '#932ab6',
        '#f56954',
        '#00a65a',
        '#ff0000',
        '#cc0066',
        '#ffff00',
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

                <?php
                $rpId = DB::table('adminindices')->where('userId', \Illuminate\Support\Facades\Auth::user()->id)->get();
                ?>
                @foreach($rpId as $ir)
                    <?php $reportsId = DB::table('reports')->where('id', $ir->reportId)->value('reportId');
                    $reportsName = DB::table('reports')->where('id', $ir->reportId)->value('reportName'); ?>
                    <li class="treeview">
                        <a href="{{ url('/openReport/'.$ir->reportId) }}">
                            <i class="fa fa-table"></i> <span>{!! wordwrap($reportsName.'('.$reportsId.')' ,28 , '<br>') !!}</span> <i class="fa fa-angle-left pull-right"></i>
                        </a>
                    </li>
                @endforeach
                <li class="treeview">
                    <a href="/createReport">
                        <i class="fa fa-table"></i> <span> Create New Report </span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
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
            <small></small>
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
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>

                            <?php $tReport = DB::table('adminindices')->where('userId', \Illuminate\Support\Facades\Auth::user()->id)->count('id'); ?>
                            {!! $tReport !!}

                        </h3>
                        <p>Total Reports</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-pricetag-outline"></i>
                    </div>
                    {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
                </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            <?php
                                $Report = DB::table('adminindices')->where('userId', \Illuminate\Support\Facades\Auth::user()->id)->get();
                                $cReport=0
                            ?>

                            @foreach($Report as $r)


                                        <?php   $com = DB::table('forminputs')->where('userId', Auth::user()->id)->where('reportId', $r->reportId)->get();
                                        $arr = [];
                                        foreach($com as $cm){
                                            array_push($arr, $cm->subCriteriaId);
                                        }
                                        $uarrcount = sizeof(array_unique($arr));
                                        $percentageCompletion = ceil($uarrcount * 100 / 17);
                                        ?>

                                        @if($percentageCompletion == 100)
                                            <?php ++$cReport ?>
                                        @endif
                            @endforeach
                            {!! $cReport !!}

                        </h3>
                        <p>Reports Completed</p>
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
                        <h3> {!! $tReport - $cReport !!} </h3>
                        <p>Reports Pending</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->



        <div class="row">

            <?php
                $Report = DB::table('adminindices')->where('userId', \Illuminate\Support\Facades\Auth::user()->id)->get();
            ?>
                <section class="col-lg-12 connectedSortable">
                <div class="box box-primary">
                    <div class="box-header">
                        <i class="fa fa-bar-chart-o"></i>
                        <h3 class="box-title">Report Status</h3>
                        <div class="box-tools pull-left">
                            <button class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div><!-- /.box-header -->

                    <div class="box-body">
                        <div class="row">
                        @foreach($Report as $r)
                                <?php $c = 0; ?>

                                <a href="{{ url('/openReport/'.$r->reportId) }}">
                                <div class="col-md-3 col-sm-5 col-xs-5 text-center">
                                    <?php   $com = DB::table('forminputs')->where('userId', Auth::user()->id)->where('reportId', $r->reportId)->get();
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
                                    <div class="knob-label"> {!! wordwrap(\Illuminate\Support\Facades\DB::table('reports')->where('id', $r->reportId)->value('reportName'), 30, "<br>") !!} </div>
                                </div><!-- ./col -->
                                </a>
                        @endforeach
                        </div><!-- /.row -->
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </section>
        </div><!-- /.row -->

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
                <!-- Report List -->
                <div class="box box-primary">
                    <div class="box-header">
                        <i class="ion ion-clipboard"></i>
                        <h3 class="box-title">Report List</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <ul class="todo-list">
                            @if($rpId = DB::table('adminindices')->where('userId', \Illuminate\Support\Facades\Auth::user()->id)->get())
                                <?php
                                    $rpId = DB::table('adminindices')->where('userId', \Illuminate\Support\Facades\Auth::user()->id)->get();
                                ?>
                                @foreach($rpId as $ir)
                                    <?php $reportsId = DB::table('reports')->where('id', $ir->reportId)->value('reportId');
                                    $reportsName = DB::table('reports')->where('id', $ir->reportId)->value('reportName'); ?>
                                    <li>
                                        <a href="{{ url('/openReport/'.$ir->reportId) }}">
                                        <!-- drag handle -->
                                              <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                              </span>
                                                    <!-- todo text -->
                                                    <span class="text">{!! $reportsId !!} ({!! $reportsName !!})</span>
                                                    <!-- Emphasis label -->
                                                    <?php
                                                    $curr = time();
                                                    $s = DB::table('reports')->where('reportId', $reportsId)->value('created_at');
                                                    $start =strtotime($s);
                                                    $time = $curr - $start;
                                                    $day = floor($time/(60*60*24));;
                                                    $hr = date("H:i:s", $time);

                                                    ?>
                                                    <small class="label label-info"><i class="fa fa-clock-o"></i>     @if($day>31){!! floor($day/31) !!} Months {!! floor($day%31) !!} Days @else {!! $day !!} Days @endif   {!! $hr !!} </small>
                                                    <!-- General tools such as edit or delete-->
                                        </a>
                                    </li>
                                @endforeach

                                <li>
                                    <!-- drag handle -->
                          <span class="handle">
                            <i class="fa fa-ellipsis-v"></i>
                            <i class="fa fa-ellipsis-v"></i>
                          </span>
                                    <!-- todo text -->
                                    <span class="text">Create New Report</span>
                                    <!-- Emphasis label -->
                                    <a href="/createReport"><small class="label label-success"><i class="fa fa-plus"></i> New Report</small></a>
                                    <!-- General tools such as edit or delete-->
                                </li>

                            @else
                                <li>
                                    <!-- drag handle -->
                          <span class="handle">
                            <i class="fa fa-ellipsis-v"></i>
                            <i class="fa fa-ellipsis-v"></i>
                          </span>
                                    <!-- todo text -->
                                    <span class="text">No Report yet...</span>
                                    <!-- Emphasis label -->
                                    <a href="/createReport"><small class="label label-success"><i class="fa fa-plus"></i> New Report</small></a>
                                    <!-- General tools such as edit or delete-->
                                </li>
                             @endif
                        </ul>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </section><!-- /.Left col -->

            <section class="col-lg-5 connectedSortable">
                <!-- Calendar -->
                <div class="box box-primary bg-green-gradient">
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
        </div><!-- /.row -->

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
                                <div class="progress-bar progress-bar-success" style="width:<?php echo ceil($percentageCompletion);?>%"></div>
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
