@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Home</div>

                    <div class="panel-body">
                        <table>
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Item Price</th>
                                <th>Subtotal</th>
                            </tr>
                            </thead>

                            <tbody>

                            <?php foreach($cart as $row) :?>

                            <tr>
                                <td>
                                    <p><strong><?php echo $row->name;?></strong></p>
                                    <p><?php echo ($row->options->has('size') ? $row->options->size : '');?></p>
                                </td>
                                <td><input type="text" value="<?php echo $row->qty;?>"></td>
                                <td>$<?php echo $row->price;?></td>
                                <td>$<?php echo $row->subtotal;?></td>
                            </tr>

                            <?php endforeach;?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection