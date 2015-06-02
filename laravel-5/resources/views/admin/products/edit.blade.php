@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit Product
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css -->
<link rel="stylesheet" href="{{ asset('/plugins/AdminJhon/vendors/wizard/jquery-steps/css/wizard.css') }}">
<link rel="stylesheet" href="{{ asset('/plugins/AdminJhon/vendors/wizard/jquery-steps/css/jquery.steps.css') }}">
<link href="{{ asset('/plugins/AdminJhon/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Edit product</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Home
            </a>
        </li>
        <li>
            <a href="{{ url('admin/products') }}">
                Products
            </a>
        </li>
        <li class="active">Update Product</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"> <i class="livicon" data-name="users" data-size="16" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                        Editing product : {{ $product->name}}
                    </h3>
                    <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                    </span>
                </div>
                <div class="panel-body">

                    <!-- errors -->
                    <div class="has-error">
                        {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                        {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                        {!! $errors->first('password_confirm', '<span class="help-block">:message</span>') !!}
                        {!! $errors->first('group', '<span class="help-block">:message</span>') !!}
                        {!! $errors->first('pic', '<span class="help-block">:message</span>') !!}
                    </div>

                    <!--main content-->
                    <div class="row">

                        <div class="col-md-12">

                            <!-- BEGIN FORM WIZARD WITH VALIDATION -->
                            <form class="form-wizard form-horizontal" action="{{route('product_update', $product->id)  }}" method="POST" id="wizard" enctype="multipart/form-data">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <!-- first tab -->
                                <h1>Product Profile</h1>
                                <section>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Name *</label>
                                        <div class="col-sm-10">
                                            <input id="name" name="name" type="text" placeholder="Name" class="form-control required" value="{{{ Input::old('name', $product->name) }}}" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="col-sm-2 control-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="description" id="description" class="form-control" rows="2">{{{ Input::old('description', $product->description) }}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="price" class="col-sm-2 control-label">Price *</label>
                                        <div class="col-sm-10">
                                            <input id="price" name="price" type="text" placeholder="Price" class="form-control required" value="{{{ Input::old('price', $product->price) }}}" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="stock_amount" class="col-sm-2 control-label">Stock Amount *</label>
                                        <div class="col-sm-10">
                                            <input id="stock_amount" name="stock_amount" type="number" placeholder="Stock Amount" class="form-control required" value="{{{ Input::old('stock_amount', $product->stock_amount) }}}" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tax_value" class="col-sm-2 control-label">Tax</label>
                                        <div class="col-sm-10">
                                            <input id="tax_value" name="tax_value" type="number" placeholder="Taxes" class="form-control" value="{{{ Input::old('tax_value', $product->tax_value) }}}" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="valid_at" class="col-sm-2 control-label">Valid At</label>
                                        <div class="col-sm-10">
                                            <input id="valid_at" name="valid_at" type="text" placeholder="Valid At" class="form-control" data-mask="9999-99-99" value="{{{ Input::old('valid_at', $product->valid_at) }}}"  placeholder="yyyy-mm-dd"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="link" class="col-sm-2 control-label">External Link</label>
                                        <div class="col-sm-10">
                                            <input id="link" name="link" type="text" placeholder="External Link" class="form-control" value="{{{ Input::old('link', $product->link) }}}" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="file" class="col-sm-2 control-label">Image</label>
                                        <div class="col-sm-10">
                                            <input id="file" name="file" type="file" placeholder="Image" class="form-control" value="{{{ Input::old('file', $product->image) }}}" />
                                        </div>
                                    </div>
                                    
                                    <p>(*) Mandatory</p>
                                
                                </section>
                            </form>
                            <!-- END FORM WIZARD WITH VALIDATION --> 
                        </div>
                    </div>
                    <!--main content end--> 
                </div>
            </div>
        </div>
    </div>
    <!--row end-->
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('/plugins/AdminJhon/vendors/wizard/jquery-steps/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/plugins/AdminJhon/vendors/wizard/jquery-steps/js/jquery.steps.js') }}"></script>
    <script src="{{ asset('/plugins/AdminJhon/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
    <script src="{{ asset('/plugins/AdminJhon/js/pages/add_user.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(e){
            $('.disabled').css('display','none');
        });
    </script>
<<<<<<< HEAD
@stop
=======
@stop
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
