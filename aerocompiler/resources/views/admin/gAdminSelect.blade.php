@extends('master')

@section('content')
        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Admin Select
            <small>13 new messages</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Admin Select</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Examiners</h3>
                        <div class="box-tools pull-right">
                            <div class="has-feedback">
                                <input type="text" class="form-control input-sm" placeholder="Search Examiners">
                                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                            </div>
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    {{ Form::open(array('url' => '/selectGA')) }}
                        <div class="box-body no-padding">
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">
                                    <tbody>
                                    @foreach($user as $u)
                                        <?php
                                            $gad = DB::table('selectgroupadmins')->where('userId', $u->id)->get();
                                        $id = DB::table('adminindices')->where('userId', \Illuminate\Support\Facades\Auth::user()->id)->value('reportId');
                                        $reportId = DB::table('reports')->where('id', $id)->value('reportId');
                                        $reportName = DB::table('reports')->where('id', $id)->value('reportName');

                                        ?>
                                        <tr>
                                            <td><input type="checkbox" class="minimal" name="{!! $u->id !!}" @if($gad) checked @endif ></td>
                                            <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                                            <td class="mailbox-name"><a href="#">{!! $u->name !!}</a></td>
                                            <td class="mailbox-subject"><b>Thakur College Of Engineering & Technology</b></td>
                                            <td class="mailbox-date">{!! $reportName !!}({!! $reportId !!})</td>
                                        </tr>
                                            @endforeach
                                        </tbody>
                                    </table><!-- /.table -->
                                </div><!-- /.mail-box-messages -->
                        </div><!-- /.box-body -->
                        <div class="box-footer padding">
                            <div class="mailbox-controls">
                                <!-- Check all button -->
                                <div class="btn-group pull-right">
                                    <button type="submit" class="btn btn-default "><i class="fa fa-thumbs-up"></i> Done</button>
                                </div><!-- /.btn-group -->
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    {{ Form::close() }}
                </div><!-- /. box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <!-- Page Script -->
@endsection