<?php
use App\subCriterium;use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

$op = DB::table('organizationalprofiles')->where('opId',2)->first();
$opSub = DB::table('suborganizationalprofiles')->get();
$opInner = DB::table('innerorganizationalprofiles')->get();
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
                    <li class="active"><a href="#"><i class="fa fa-table"></i>Score Table</a></li>
                    <li class="active"><a href="#"><i class="fa fa-table"></i>ADLI Matrix</a></li>
                    <li class="active"><a href="#"><i class="fa fa-folder-open-o"></i>Final Report</a></li>
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
            {!! "Organizational Profile" !!}
            <small>{!! $op->opName !!}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">{!! "Oraganizational Profile" !!}</a></li>
            <li class="active">{!! $op->opName !!}</li>
        </ol>
        <div class="clearfix"></div>
        <div class="clearfix"></div>
    </section>



    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            $cn ='a';
            ?>
            @foreach($opSub as $sub)
                @if($sub->opId == $op->opId)
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">{!! $sub->opSubName !!} ({!! $cn !!})</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                {{ Form::open(array('url' =>'/kbf2save/'.$uid.'/'.$reportId.'/'.$cn.'/'.$op->opId )) }}
                                <table class="table table-bordered table-hover kbfInput">
                                    <thead>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>{!! $sub->opSubName !!}</th>
                                        <th>Factor 1</th>
                                        <th>Factor 2</th>
                                        <th>Factor 3</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    $c = 1;
                                    ?>
                                    @foreach($opInner as $inner)
                                        @if($inner->opSubId == $sub->opSubId)
                                            @if(DB::table('organizationalenvs')->where('userId', $uid)->where('reportId', $reportId)->where('opId', $op->opId)->where('opSubId',$cn)->where('opInnerId',$inner->id)->get())
                                                <tr>
                                                    <?php
                                                    $col = DB::table('organizationalenvs')->where('userId', $uid)->where('reportId', $reportId)->where('opId', $op->opId)->where('opSubId',$cn)->where('opInnerId',$inner->id)->first();
                                                    ?>
                                                    <input type="hidden" name="opInner_{!! $inner->id !!}" value="{!! $inner->id !!}">
                                                    <td>{!! $c !!}</td>
                                                    <td style="max-width: 400px">{!! $inner->opInnerName !!}</td>
                                                    <td><textarea class="textarea" name="f1_{!! $inner->id !!}" placeholder="{!! "Enter Factor ".$count !!}" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                                            {!! $col->f1 !!}
                                                        </textarea>
                                                    </td>
                                                    <td><textarea class="textarea" name="f2_{!! $inner->id !!}" placeholder="{!! "Enter Factor ".($count + 1) !!}" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                                            {!! $col->f2 !!}
                                                        </textarea>
                                                    </td>
                                                    <td><textarea class="textarea" name="f3_{!! $inner->id !!}" placeholder="{!! "Enter Factor ".($count + 2) !!}" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                                            {!! $col->f3 !!}
                                                        </textarea>
                                                    </td>
                                                </tr>
                                                <?php $c++; ?>
                                            @else
                                                <tr>
                                                    <input type="hidden" name="opInner_{!! $inner->id !!}" value="{!! $inner->id !!}">
                                                    <td>{!! $c !!}</td>
                                                    <td style="max-width: 400px">{!! $inner->opInnerName !!}</td>
                                                    <td><textarea class="textarea" name="f1_{!! $inner->id !!}" placeholder="{!! "Enter Factor ".$count !!}" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea></td>
                                                    <td><textarea class="textarea" name="f2_{!! $inner->id !!}" placeholder="{!! "Enter Factor ".($count + 1) !!}" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea></td>
                                                    <td><textarea class="textarea" name="f3_{!! $inner->id !!}" placeholder="{!! "Enter Factor ".($count + 2) !!}" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea></td>
                                                </tr>
                                                <?php $c++; ?>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>{!! $sub->opSubName !!}</th>
                                        <th>Factor 1</th>
                                        <th>Factor 2</th>
                                        <th>Factor 3</th>
                                    </tr>
                                    </tfoot>
                                </table>
                                <div class="box-header">
                                    <div class="box-body">
                                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                    <?php $cn++; ?>
                @endif
            @endforeach


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
@endsection