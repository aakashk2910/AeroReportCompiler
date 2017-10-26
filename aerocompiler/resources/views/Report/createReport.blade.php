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
                Create New Report
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">New Report</a></li>
            </ol>
        </section>


        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Details</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        {{ Form::open(array('url' => '/saveReport/'.\Illuminate\Support\Facades\Auth::user()->id )) }}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Report ID</label>
                                    <input type="text" class="form-control" id="rid" name="rid" placeholder="Enter Report ID">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Report Name</label>
                                    <input type="text" class="form-control" id="rname" name="rname" placeholder="Enter Report Name">
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        {{ Form::close() }}
                    </div><!-- /.box -->
                </div>
            </div>
        </section>
    </div>
@endsection

