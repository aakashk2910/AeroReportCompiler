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
            Profile
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-user"></i> Home</a></li>
            <li class="active">Profile</li>
        </ol>
    </section>





    <!-- Main content -->
    <section class="content">



        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <?php
                        $c = DB::table('pics')->where('userId', \Illuminate\Support\Facades\Auth::user()->id)->value('country');
                        $s = DB::table('pics')->where('userId', \Illuminate\Support\Facades\Auth::user()->id)->value('state');
                        $ct = DB::table('pics')->where('userId', \Illuminate\Support\Facades\Auth::user()->id)->value('city');
                        $pr = DB::table('pics')->where('userId', \Illuminate\Support\Facades\Auth::user()->id)->value('profession');
                        $dp = DB::table('pics')->where('userId', \Illuminate\Support\Facades\Auth::user()->id)->value('filename');
                    ?>
                    <div class="box-body box-profile">
                        <?php $p = DB::table('pics')->where('userId', \Illuminate\Support\Facades\Auth::user()->id)->value('filename'); ?>
                        @if($p)
                            <img src="{!! url('/public/images/catalog/'.$p) !!}" class="profile-user-img img-responsive img-circle" alt="User Image">
                        @else
                            <img src="{!! url('/public/images/catalog/default.jpg') !!}" class="profile-user-img img-responsive img-circle" alt="User Image">
                        @endif

                        <h3 class="profile-username text-center">{!! \Illuminate\Support\Facades\Auth::user()->name !!}</h3>
                        <p class="text-muted text-center"></p>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">About Me</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        {{--<strong><i class="fa fa-book margin-r-5"></i>  Education</strong>
                        <p class="text-muted">
                            B.S. in Computer Science from the University of Tennessee at Knoxville
                        </p>

                        <hr>--}}

                        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                        <p class="text-muted">{!! $c.','.$s.','.$ct !!}</p>

                        <hr>

                        <strong><i class="fa fa-pencil margin-r-5"></i> Profession </strong>
                        <p>{!! $pr !!}</p>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
                        {{--<li><a href="#timeline" data-toggle="tab">Timeline</a></li>--}}
                        <li><a href="#settings" data-toggle="tab">Edit Profile</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">

                            <div class="post" >
                                <div class="box box-solid">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Report Progress</h3>
                                    </div><!-- /.box-header -->

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

                                        <div class="box-body">
                                            <p> {!! $rName !!} </p>
                                            <div class="progress active">
                                                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percentageCompletion;?>%">
                                                    <span class="">@if($percentageCompletion == 100) {!! $percentageCompletion !!}% Completed (Success) @else {!! $percentageCompletion !!}% Completed @endif </span>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->
                                    @endforeach
                                </div><!-- /.box -->
                            </div>
                        </div><!-- /.tab-pane -->

                        <div class="tab-pane" id="settings">
                            <div class="login-box" Style="margin: 10%">
                                {!! Form::open(
                                    array(
                                        'url' => '/uploadPic',
                                        'class' => 'form-horizontal',
                                        'novalidate' => 'novalidate',
                                        'files' => true)) !!}

                                <div class="form-group">
                                    <div style="float: left; margin-top: 20px;">
                                        <label for="files"> <span class="btn btn-primary">Select Image</span></label>
                                        <input style="visibility: hidden; position: absolute;" id="files" class="form-control" type="file" name="image" required>
                                    </div>
                                    <div style="float:left;width: 100px;height: 100px" class="pull-right">
                                        <?php $p = DB::table('pics')->where('userId', \Illuminate\Support\Facades\Auth::user()->id)->value('filename'); ?>
                                        @if($p)
                                            <img src="{!! url('/public/images/catalog/'.$p) !!}" class="profile-user-img img-responsive img-circle" alt="User Image">
                                        @else
                                            <img src="{!! url('/public/images/catalog/default.jpg') !!}" class="profile-user-img img-responsive img-circle" alt="User Image">
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label >Email</label>
                                    <input type="email" class="form-control" name="email" value="{!! \Illuminate\Support\Facades\Auth::user()->email !!}">
                                </div>
                                <div class="form-group">
                                    <label >Country</label>
                                    <input type="text" class="form-control" name="country" value="{!! DB::table('pics')->where('userId', \Illuminate\Support\Facades\Auth::user()->id)->value('country') !!}">
                                </div>

                                <div class="form-group">
                                    <label >State</label>
                                    <input type="text" class="form-control" name="state" value="{!! DB::table('pics')->where('userId', \Illuminate\Support\Facades\Auth::user()->id)->value('state') !!}">
                                </div>

                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" class="form-control" name="city" value="{!! DB::table('pics')->where('userId', \Illuminate\Support\Facades\Auth::user()->id)->value('city') !!}">
                                </div>

                                <div class="form-group">
                                    <label>Profession</label>
                                    <input type="text" class="form-control" name="profession" value="{!! DB::table('pics')->where('userId', \Illuminate\Support\Facades\Auth::user()->id)->value('profession') !!}">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Done</button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
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
