@extends('layouts.master')

@section('style')
     <link href="{{mix('/theme/backend/assets/css/datatables.css')}}" type="text/css" rel="stylesheet"/>
@stop
@section('content')

    <div class="container-fluid container-fixed-lg">
        <div class="row">
            <!-- START WIDGET -->
            <div class="row-xs-height">
                <div class="col-xs-height">
                    <div class="p-l-20 p-r-20">
                        <div class="row">
                            <div class="col-lg-3 visible-xlg">
                                <div class="widget-14-chart-legend bg-transparent text-black no-padding pull-right"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-xs-height">
                <div class="col-xs-height relative bg-master-lightest">
                    <div class="widget-14-chart_y_axis"></div>
                    <div class="widget-14-chart rickshaw-chart top-left top-right bottom-left bottom-right"></div>
                </div>
            </div>
            <!-- END WIDGET -->
        </div>
        <div id="rootwizard" class="m-t-50">
            <!-- Success Messages -->
        @include('partial/success_message')
        <!-- END Success Messages -->
            <!-- Error Messages -->
        @include('partial/error_message')
        <!-- END Error Messages -->
            <!-- START CONTAINER FLUID -->
            <div class="container-fluid container-fixed-lg bg-white">
                <!-- START PANEL -->
                <div class="panel panel-transparent">
                    <div class="panel-heading">
                        <div class="panel-title panel-title-margin">Category</div><br/>
                        <div class="pull-left">
                            <a href="{{url('category/create')}}">
                                <button id="show-modal" class="btn create-button btn-cons"><i class="fa fa-plus"></i> Add Category</button>
                            </a>
                        </div>
                        <div class="pull-right">
                            <div class="col-xs-12">
                                <input type="text" id="search-table" class="form-control pull-right" placeholder="Search">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            @include('category.partial.table')
                        </div>
                    </div>
                </div>
                <!-- END PANEL -->
            </div>
            <!-- END CONTAINER FLUID -->
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{mix('/theme/backend/assets/js/datatables.js')}}" type="text/javascript"></script>
    <script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
        $("#check_all").change(function () {
            $("input:checkbox").prop('checked', $(this).prop("checked"));
        });
    </script>
@endsection