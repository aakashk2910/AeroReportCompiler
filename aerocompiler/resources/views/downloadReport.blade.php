<?php

$name = DB::table('reports')->where('reportId', $reportId)->value('reportName');
header("Content-Type: application/vnd.ms-word");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Report-".$name.".doc");


use Illuminate\Support\Facades\DB;
?>
        <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<base href="{{URL::asset('/')}}" target="_top">

<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.5 -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="plugins/iCheck/all.css">
<!-- Morris chart -->
<link rel="stylesheet" href="plugins/morris/morris.css">
<!-- jvectormap -->
<link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
<!-- Date Picker -->
<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
table, th, td {
border: 1px solid black;
border-collapse: collapse;
}
</style>
<?php $reportsId = DB::table('reports')->where('id', $reportId)->value('reportId');
$reportsName = DB::table('reports')->where('id', $reportId)->value('reportName'); ?>

                <h1>
                        {{ $reportsName }}
                        <small>{{ $reportsId }}</small>
                </h1>


                                        @foreach($data as $criteria)

                                                        <h2><b>{{ $criteria->criteriaName }}</b></h2>
                                                <?php $criteriaId = $criteria->criteriaId; ?>

                                                        @foreach($data1 as $subCriteria)
                                                                @if($subCriteria->criteriaId == $criteriaId)
                                                                        <h3><b>{!! wordwrap($subCriteria->subCriteriaName, 40, '<br>')  !!}</b></h3>
                                                                        @foreach($flabel as $fl)
                                                                                <?php $text = DB::table('forminputs')->where('subCriteriaId', $subCriteria->id)->where('labelId', $fl->labelId)->where('userId', Auth::user()->id)->where('reportId', $reportId)->get(); ?>
                                                                                <?php $i = 'a'; ?>
                                                                                @foreach($text as $s)
                                                                                        @if($i == 'a')
                                                                                                <h3>{!! $fl->labelText !!}</h3>
                                                                                        @endif
                                                                                        <p>
                                                                                                <b>{{ $i }}</b> {{ strip_tags($s->labelText, '<b>')  }}
                                                                                        </p>
                                                                                        <?php $i++; ?>
                                                                                @endforeach
                                                                        @endforeach
                                                                @endif
                                                        @endforeach
                                                        <hr style="display: block;margin-top: 0.5em;margin-bottom: 0.5em;margin-left: auto;margin-right: auto;border-style: inset;border-width: 1px;">
                                                {{--<hr style="display: block;margin-top: 0.5em;margin-bottom: 0.5em;margin-left: auto;margin-right: auto;border-style: inset;border-width: 1px;">--}}
                                        @endforeach

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
                                                        </section>