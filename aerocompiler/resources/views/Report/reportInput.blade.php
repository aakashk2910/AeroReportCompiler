<?php
use App\subCriterium;use Illuminate\Support\Facades\Input;
        use Illuminate\Support\Facades\DB;
        $opf = DB::table('organizationalprofiles')->get();
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
            {!! wordwrap($cname, 40, '<br>') !!}
            <small>{!! wordwrap($sname, 40, '<br>') !!}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">{!! wordwrap($cname, 40, '<br>') !!}</a></li>
            <li class="active">{!! wordwrap($sname, 40, '<br>') !!}</li>
        </ol>
        <div class="clearfix"></div>
        <div class="clearfix"></div>
    </section>

    <!-- Main content -->
    @foreach($flabel as $fl)
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <?php $text = DB::table('forminputs')->where('subCriteriaId', $sid)->where('labelId', $fl->labelId)->where('userId', $uid)->where('reportId', $reportId)->get(); ?>
                        @if($text)
                            <?php $i = 'a'; ?>
                            @foreach($text as $s)

                                <div class="box @if($s->labelText) collapsed-box @endif">
                                    <div class="box-header">
                                        <h3 class="box-title">{!! $fl->labelText !!} <small> ({!! $i !!})</small></h3>
                                        <!-- tools box -->
                                        <div class="pull-right box-tools">
                                            <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal" title="Key Bussiness Factors">KBF</button>
                                            <button class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title=""><i class="fa fa-plus"></i></button>
                                            <a href="{{ url('/add/'.$uid.'/'.$sid.'/'.$fl->labelId.'/'.$reportId) }}"><button class="btn btn-default btn-sm" data-toggle="tooltip" title="Add">Add</button></a>
                                            @if($i != 'a') <a href="{{ url('/delete/'.$uid.'/'.$sid.'/'.$fl->labelId.'/'.$s->id.'/'.$reportId) }}"><button class="btn btn-default btn-sm" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button></a> @endif
                                        </div><!-- /. tools -->
                                    </div><!-- /.box-header -->
                                    <div class="box-body pad">
                                        {{ Form::open(array('url' => '/update/'.$uid.'/'.$sid.'/'.$fl->labelId.'/'.$s->id.'/'.$reportId )) }}
                                                <!--<form method="post" action="/submit/{!! $uid !!}/{!! $sid !!}/{!! $fl->labelId !!}">-->
                                        <textarea class="textarea" name="{!! $fl->labelText !!}" placeholder="Place text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
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
                        @else
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">{!! $fl->labelText !!} <small></small></h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal" title="Key Bussiness Factors">KBF</button>
                                        <button class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title=""><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Add">Add</button>
                                    </div><!-- /. tools -->
                                </div><!-- /.box-header -->
                                <div class="box-body pad">
                                    {{ Form::open(array('url' => '/submit/'.$uid.'/'.$sid.'/'.$fl->labelId.'/'.$reportId )) }}
                                            <!--<form method="post" action="/submit/{!! $uid !!}/{!! $sid !!}/{!! $fl->labelId !!}">-->
                                        <textarea class="textarea" name="{!! $fl->labelText !!}" placeholder="Place text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">

                                        </textarea>
                                    <div class="box-header">
                                        <div class="box-body">
                                            <div class="checkbox-inline form-group pull-right">
                                                <label>
                                                    <input type="checkbox" class="minimal"  name="A" value="Yes">
                                                    A
                                                </label>
                                                <label>
                                                    <input type="checkbox" class="minimal" name="D" value="Yes"> D
                                                </label>
                                                <label>
                                                    <input type="checkbox" class="minimal" name="L" value="Yes"> L
                                                </label>
                                                <label>
                                                    <input type="checkbox" class="minimal" name="I" value="Yes"> I
                                                </label>
                                            </div>
                                            <button type="submit" class="btn btn-primary pull-left" style="margin-left: 0;">Submit</button>
                                        </div>
                                    </div>
                                    <!--</form>-->
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        @endif
                </div>
            </div><!-- /.col-->
        </div><!-- ./row -->
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
                        <?php
                            $maxScore = DB::table('scoretables')->where('subCriteriaId',$sid)->value('maxScore');
                            $prevScore = DB::table('scores')->where('userId', $uid)->where('subCriteriaId', $sid)->where('reportId', $reportId)->value('score');
                        ?>
                        @if($prevScore)
                            {{ Form::open(array('url' => '/updateScore/'.$uid.'/'.$sid.'/'.$reportId)) }}
                                <!-- SELECT Score -->
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <select class="form-control select2" name="score" id="score">
                                                        <option value="">{!! "Give Score" !!}</option>
                                                        @for($i=10; $i<=100;$i+=10)
                                                            @if($i == $prevScore)
                                                                <option value="{!! $i !!}" selected>{!! $i !!}{!! "%" !!}</option>
                                                            @else
                                                                <option value="{!! $i !!}">{!! $i !!}{!! "%" !!}</option>
                                                            @endif
                                                        @endfor
                                                    </select>
                                                    <input type="hidden" id="maxScore" value="{!! $maxScore !!}">
                                                    <span class="input-group-addon" id="finalScore"></span>
                                                </div><!-- /.form-group -->
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary pull-left" style="margin-left: 0;">Submit</button>
                                    </div>
                            {!! Form::close() !!}
                        @else
                            {{ Form::open(array('url' => '/setScore/'.$uid.'/'.$sid.'/'.$reportId)) }}
                                    <!-- SELECT Score -->
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <select class="form-control select2"  name="score" id="score">
                                                        <option value="">{!! "Give Score" !!}</option>
                                                        @for($i=10; $i<=100;$i+=10)
                                                            <option value="{!! $i !!}">{!! $i !!}{!! "%" !!}</option>
                                                        @endfor
                                                    </select>
                                                    <input type="hidden" id="maxScore" value="{!! $maxScore !!}">
                                                    <span class="input-group-addon" id="finalScore"></span>
                                                </div><!-- /.form-group -->
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary pull-left" style="margin-left: 0;">Submit</button>
                                    </div>
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>

            <?php
                $lastSubId = DB::table('subcriterias')->count();
            ?>
            @if($lastSubId > ($sid))
                <div class="box box-default" style="width:200px; margin-left:40%;" >
                    <a href="{{ url('/report/'.$uid.'/'.($sid + 1).'/'.$reportId) }}"><button class="btn btn-block btn-success btn-lg">Success</button></a>
                </div>
            @endif
        <div class="clearfix"></div>
    </section>

</div><!-- /.content-wrapper -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Key Bussiness Factors</h4>
            </div>
            <div class="modal-body">
                @foreach($opf as $op)
                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{!! $op->opName !!}</h3>
                </div><!-- /.box-header -->
                    <div class="box-body">
                        <?php
                            $cn ='a';
                        ?>
                        @foreach($opSub as $sub)
                        @if($sub->opId == $op->opId)
                        <table class="table table-bordered kbfOutput">
                            <tr>
                                <th>Sr.</th>
                                <th>{!! $sub->opSubName !!}</th>
                                <th>Factor 1</th>
                                <th>Factor 2</th>
                                <th>Factor 3</th>
                            </tr>
                                <?php
                                $c = 1;
                                ?>
                                @foreach($opInner as $inner)
                                    @if($inner->opSubId == $sub->opSubId)
                                        @if(DB::table('organizationalenvs')->where('userId', $uid)->where('reportId', $reportId)->where('opId', $op->opId)->where('opSubId',$cn)->where('opInnerId',$inner->id)->get())
                                            <tr>
                                                <?php
                                                $col = DB::table('organizationalenvs')->where('userId', $uid)->where('reportId', $reportId)->where('opId', $op->opId)->where('opSubId',$cn)->where('opInnerId',$inner->id)->first();
                                                ?>
                                                <td style="width: 50px" @!important>{!! $c !!}</td>
                                                <td style="width: 200px" @!important>{!! $inner->opInnerName !!}</td>
                                                <td>
                                                                {!! $col->f1 !!}
                                                </td>
                                                <td>
                                                                {!! $col->f2 !!}
                                                </td>
                                                <td>
                                                                {!! $col->f3 !!}
                                                </td>
                                            </tr>
                                            <?php $c++; ?>
                                        @endif
                                    @endif
                                @endforeach
                                <tr>
                                    <th>Sr.</th>
                                    <th>{!! $sub->opSubName !!}</th>
                                    <th>Factor 1</th>
                                    <th>Factor 2</th>
                                    <th>Factor 3</th>
                                </tr>
                        </table>
                        <?php $cn++ ?>
                        @endif
                        @endforeach
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

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

