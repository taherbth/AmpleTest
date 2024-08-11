@extends('layouts.master')

@section('style')
    <link href="{{mix('/theme/backend/assets/css/fancytree/fancytree.css')}}" type="text/css" rel="stylesheet"/>
@endsection

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
            <div class="tab-pane padding-20 active slide-left">
                {{ Form::model($category, ['route' => ['category.update', $category->id],'method' => 'put', 'id' => 'form-project']) }}
                    {{ csrf_field() }}
                        @include('category.partial.form')
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@section('plugin-script')
    <script src="{{mix('/theme/backend/assets/js/fancytree.js')}}" type="text/javascript"></script>
    <script src="{{mix('/theme/backend/assets/js/tree_category_script.js')}}" type="text/javascript"></script>
@endsection
