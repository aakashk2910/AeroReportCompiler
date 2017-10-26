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
            Report Assign
            <small>Select report forom the Dropdown</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Report Assign</li>
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
                    {{ Form::open(array('url' => '/reportassigned')) }}
                        <div class="box-body no-padding">
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">
                                    <tbody>
                                    @foreach($user as $u)
                                        <tr>
                                            <td class="mailbox-name">{!! $u->name !!}</td>
                                            @if(!(DB::table('adminindices')->where('userId', $u->id)->get()))
                                            <td class="mailbox-star"><a href="#"><i class="fa fa-star text-white"></i></a></td>
                                            <!-- select -->
                                            <td>
                                            <div class="form-group">
                                                <select class="form-control" name="{!! $u->id !!}">
                                                    <option value="">Select Report</option>
                                                    @foreach($report as $r)
                                                        <option value="{!! $r->id !!}">{!! $r->reportId !!}({!! $r->reportName !!})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            </td>
                                            @else
                                            <td class="mailbox-star"><a href="#"><i class="fa fa-star text-black"></i></a></td>
                                            <td>
                                            <div class="form-group" >
                                                <select class="form-control" name="{!! $u->id !!}">
                                                    <option value="">Select Report</option>
                                                    @foreach($report as $r)
                                                        @if(DB::table('adminindices')->where('userId', $u->id)->value('reportId') == $r->id)
                                                            <option value="{!! $r->id !!}" selected>{!! $r->reportId !!}({!! $r->reportName !!})</option>
                                                        @else
                                                            <option value="{!! $r->id !!}">{!! $r->reportId !!}({!! $r->reportName !!})</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            </td>
                                            @endif
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
                    {{ Form::close()}}
                </div><!-- /. box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- Page Script -->
@endsection