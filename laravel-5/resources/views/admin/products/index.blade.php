@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Products List
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('/plugins/AdminJhon/vendors/datatables/css/dataTables.bootstrap.css') }}" />
<link href="{{ asset('/plugins/AdminJhon/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Products</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Home
            </a>
        </li>
        <li class="active">
            <a href="{{ url('admin/products') }}">
                Products
            </a>
        </li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <button class="btn btn-primary btn-create" onclick="window.location='{{route("product_new")}}'">Create new product</button>
            <div class="panel-heading">
                <h4 class="panel-title"> <i class="livicon" data-name="barcode" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Products List
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table table-bordered " id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>IMG</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Stock Amount</th>
                            <th>Tax</th>
                            <th>Ext Link</th>
                            <th>Valid at</th>
                            <th>Create at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                    	<tr>
                            <td>{{ $product->id }}</td>
                            <td>@if($product->image) <img src={{ url($product->image) }} width="100" height="100"> @endif </td>
                    		<td>{{ $product->name }}</td>
            				<td>{{ $product->description }}</td>
                            <td>{{ $product->price }} $</td>
                            <td>{{ $product->stock_amount }}</td>
                            <td>{{ $product->tax_value }}</td>
                            <td><a href="{{ $product->link }}" target="_blank">{{ $product->link }}</a></td>
                            <td>{{ $product->valid_at }}</td>
            				{{--<td>--}}
            					{{--@if($user->activated)--}}
            						{{--Activated--}}
            					{{--@else--}}
            						{{--Pending--}}
            					{{--@endif--}}
            				{{--</td>--}}
            				<td>{{{ $product->created_at->diffForHumans() }}}</td>
            				<td>
                               <a href="{{ route('product_show', $product->id) }}"><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view product"></i></a>
                                <a href="{{ route('product_update', $product->id) }}"><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update product"></i></a>
                                <a href="{{ route('product_confirm_delete', $product->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="product-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete product"></i></a>
                            </td>
            			</tr>
                    @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>    <!-- row-->
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript" src="{{ asset('/plugins/AdminJhon/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/plugins/AdminJhon/vendors/datatables/dataTables.bootstrap.js') }}"></script>

<script>
$(document).ready(function() {
	$('#table').DataTable();
});
</script>

<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content"></div>
  </div>
</div>
<script>
$(function () {
	$('body').on('hidden.bs.modal', '.modal', function () {
		$(this).removeData('bs.modal');
	});
});
</script>
<<<<<<< HEAD
@stop
=======
@stop
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
