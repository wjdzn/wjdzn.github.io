@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
View Product Details
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css -->
<link href="{{ asset('/plugins/AdminJhon/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/plugins/AdminJhon/vendors/x-editable/css/bootstrap-editable.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/plugins/AdminJhon/css/pages/user_profile.css') }}" rel="stylesheet" type="text/css"/>
<!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>View Product</h1>
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
        <li class="active">View Product</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <ul class="nav  nav-tabs ">
                <li class="active">
                    <a href="#tab1" data-toggle="tab"> <i class="livicon" data-name="shopping-cart" data-size="16" data-c="#000" data-hc="#000" data-loop="true"></i>
                        Product Profile
                    </a>
                </li>
            </ul>
            <div  class="tab-content mar-top">
                <div id="tab1" class="tab-pane fade active in">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        @lang('products/title.product_profile')
                                    </h3>

                                </div>
                                <div class="panel-body">
                                    {{--<div class="col-md-4">--}}
                                        {{--<h4 class="text-primary"> Profile Pic</h4>--}}
                                        {{--<div class="img-file"> --}}
                                            {{--@if($user->pic)--}}
                                                {{--<img src="{{{ url('/').'/uploads/users/'.$user->pic }}}" alt="profile pic" class="img-max">--}}
                                            {{--@else--}}
                                                {{--<img src="http://placehold.it/200x200" alt="profile pic">--}}
                                            {{--@endif   --}}
                                        {{--</div>--}}
                                        {{--<hr>--}}
                                        {{--<div>--}}
                                            {{--<h4 class="text-primary">Bio</h4>--}}
                                            {{--<div>{{ nl2br($user->bio)}}</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="col-md-8">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <form method="post" action="#">

                                                <table class="table table-bordered table-striped" id="users">
    
                                                    <tr>
                                                        <td>@lang('products/title.name')</td>
                                                        <td>
                                                            {{ $product->name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>@lang('products/title.price')</td>
                                                        <td>
                                                            {{ $product->price }}
                                                        </td>
                                                    </tr>
                                                    @if($product->link)
                                                    <tr>
                                                        <td>@lang('products/title.link')</td>
                                                        <td>
                                                           <a href="{{$product->link}}" target="_blank">{{ $product->link }}</a>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    @if($product->image)
                                                    <tr>
                                                        <td>@lang('products/title.image')</td>
                                                        <td>
                                                           <img src="{{ url($product->image) }}" width="300" height="300">
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    <tr>
                                                        <td>@lang('products/title.description')</td>
                                                        <td>
                                                            {{ $product->description }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>@lang('products/title.stock_amount')</td>
                                                        <td>
                                                            {{ $product->stock_amount }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>@lang('products/title.tax_value')</td>
                                                        <td>
                                                            {{ $product->tax_value }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>@lang('products/title.valid_at')</td>
                                                        <td>
                                                            {{ $product->valid_at }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>@lang('users/title.created_at')</td>
                                                        <td>
                                                            {{{ $product->created_at->diffForHumans() }}}
                                                        </td>
                                                    </tr> 
                                                </table>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<!-- Bootstrap WYSIHTML5 -->
<script  src="{{ asset('/plugins/AdminJhon/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<<<<<<< HEAD
@stop
=======
@stop
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
