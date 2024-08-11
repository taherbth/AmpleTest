<div class="row row-same-height">
    <div class="panel panel-default">
        <div class="panel-heading title-color">
            <h4 class="panel-title">Category</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-7">
                <div class="padding-30">
                    <div class="form-group-attached">
                        <div class="form-group form-group-default required">
                            {{ Form::label('name', 'Name') }}
                            {{ Form::text('name',null, ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>
                </div>
                <br/>
                <div class="toggle-on-off toggle-padding-custom">
                    {{ Form::label('display', 'Display') }}:
                    <input type="checkbox" data-init-plugin="switchery" @php if($category) { if( $category->active ) echo 'checked'; } @endphp name="active"/>
                </div>
                <div class="padding-30">
                    <div class="form-group-attached">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title">Parent Category</div>
                            </div>
                            <div class="panel-body">
                                    <div id="radio-tree" class="tree-category col-md-6" tree-type-attr="radio-tree">

                                    </div>

                                {{--<div id="radio-tree" class="tree-category col-md-6" tree-type-attr="radio-tree"></div>--}}
                                {{ Form::hidden('product_categories[]', '', ['id' => 'product_categories']) }}
                                {{ Form::hidden('parent', $category_parent, ['id' => 'parent']) }} {{--By default parent id: 1, as system default category is 'Home'--}}
                                {{ Form::hidden('this_category', $category ? $category->id: '', ['id' => 'this_category']) }} {{--By default parent id: 1, as system default category is 'Home'--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="btn create-button btn-cons pull-right" type="submit">
        <span>Save</span>
    </button>
</div>


