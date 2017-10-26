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

<?php $reportsId = DB::table('reports')->where('id', $reportId)->value('reportId');
$reportsName = DB::table('reports')->where('id', $reportId)->value('reportName'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h1>
            {{ $reportsName }}
            <small>{{ $reportsId }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Final</a></li>
            <li class="active">Final Report</li>
        </ol>
    </div>



<!-- Main Content -->
<div class="content body">
    <div class="row">
        <section class="col-lg-12 connectedSortable">
            <div class="box">
            <div STYLE="margin: 8%">
            @foreach($data as $criteria)
                    <div class="box-header">
                        <h1 class="page-header"><b>{{ $criteria->criteriaName }}</b></h1>
                    </div><!-- /.box-header -->
                    {{--<h1 class="page-header"><b>{!! wordwrap($criteria->criteriaName, 40, '<br>') !!}</b></h1>--}}
                    <?php $criteriaId = $criteria->criteriaId; ?>
                    <div class="box-body">
                        @foreach($data1 as $subCriteria)
                            @if($subCriteria->criteriaId == $criteriaId)
                                <h3 class="page-header"><b>{!! wordwrap($subCriteria->subCriteriaName, 40, '<br>')  !!}</b></h3>
                                @foreach($flabel as $fl)
                                    <?php $text = DB::table('forminputs')->where('subCriteriaId', $subCriteria->id)->where('labelId', $fl->labelId)->where('userId', Auth::user()->id)->where('reportId', $reportId)->get(); ?>
                                    <?php $i = 'a'; ?>
                                        @foreach($text as $s)
                                            @if($i == 'a')
                                                <h3 class="page-header">{!! $fl->labelText !!}</h3>
                                            @endif
                                            <p class="lead">
                                                <b>{{ $i }} .</b> {{ strip_tags($s->labelText, '<b>')  }}
                                            </p>
                                            <?php $i++; ?>
                                        @endforeach
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                    <hr style="display: block;margin-top: 0.5em;margin-bottom: 0.5em;margin-left: auto;margin-right: auto;border-style: inset;border-width: 1px;">
                    {{--<hr style="display: block;margin-top: 0.5em;margin-bottom: 0.5em;margin-left: auto;margin-right: auto;border-style: inset;border-width: 1px;">--}}
                @endforeach
            </div>
        </div>
            <!-- ============================================================= -->
        </section>
    </div>
</div>


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Score Table </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th style="width: 10px">#</th>
                                <th>Categories and Items</th>
                                <th>Score(%)</th>
                                <th>Score</th>
                                <th>Max Score</th>
                            </tr>
                            <?php $total=0; $totalMax=0; ?>
                            @foreach($data as $criteria)
                                <tr>
                                    <td><b>{!! $criteria->id !!}</b></td>
                                    <td></td>
                                    <td><b>{!! $criteria->criteriaName !!}</b></td>
                                    <!--

                                        Total Score Calculation

                                    -->
                                    <?php $tScore=0; $tMaxScore=0; ?>
                                    <?php $criteriaId = $criteria->criteriaId; ?>
                                    @foreach($data1 as $subCriteria)
                                    @if($subCriteria->criteriaId == $criteriaId)
                                    <?php
                                    $perScore = \Illuminate\Support\Facades\DB::table('scores')->where('userId',Auth::user()->id)->where('reportId', $reportId)->where('subCriteriaId',$subCriteria->id)->value('score');
                                    $mScore = \Illuminate\Support\Facades\DB::table('scoretables')->where('id',$subCriteria->id)->value('maxScore');
                                    $score = $perScore/100 * $mScore;


                                    $tScore += $score;
                                    $tMaxScore += \Illuminate\Support\Facades\DB::table('scoretables')->where('id',$subCriteria->id)->value('maxScore');

                                    ?>
                                    @endif
                                    @endforeach
                                    <?php
                                    $total += $tScore;
                                    $totalMax += $tMaxScore;
                                    ?>
                                            <!--

                                        End

                                    -->
                                    <td><b>{!! ceil($tScore/$tMaxScore * 100)  !!}</b></td>
                                    <td><b>{!! ceil($tScore) !!}</b></td>
                                    <td><b>{!! $tMaxScore !!}</b></td>
                                </tr>
                                <?php $criteriaId = $criteria->criteriaId; ?>
                                <?php $sub = 0; ?>
                                @foreach($data1 as $subCriteria)
                                    @if($subCriteria->criteriaId == $criteriaId)
                                        <tr>
                                            <td></td>
                                            <td>{!! $criteria->id.'.'.++$sub !!}</td>
                                            <td>{!! $subCriteria->subCriteriaName !!}</td>
                                            <?php
                                            $perScore = \Illuminate\Support\Facades\DB::table('scores')->where('userId',Auth::user()->id)->where('reportId', $reportId)->where('subCriteriaId',$subCriteria->id)->value('score');
                                            $mScore = \Illuminate\Support\Facades\DB::table('scoretables')->where('id',$subCriteria->id)->value('maxScore');
                                            $score = $perScore/100 * $mScore;
                                            ?>
                                            <td>{!! ceil($perScore) !!}</td>
                                            <td>{!! ceil($score) !!}</td>
                                            <td>{!! $mScore !!}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                            <tr>
                                <td><b>8</b></td>
                                <td></td>
                                <td><b>Final Score</b></td>
                                <td><b>{!! ceil($total / $totalMax * 100) !!}</b></td>
                                <td><b>{!! ceil($total) !!}</b></td>
                                <td><b>{!! ceil($totalMax) !!}</b></td>
                            </tr>
                        </table>
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->
                    {{--<div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>--}}
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div>

        <div class="box box-default" style="width:200px; margin-left:40%;" >
            <a href="{{ url('/downloadReport/'.$reportId) }}"><button class="btn btn-block btn-primary btn-lg">Download</button></a>
        </div>
        <div class="clearfix"></div>
    </section>

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
