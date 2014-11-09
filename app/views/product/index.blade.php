@extends('layout')

@section('head')
<title>{{App::make('ceddd\Shop')->getName()}} - Product</title>
@stop

@section('body')
<div class="well">
    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th>Product ID</th>
            <th>Product Barcode</th>
            <th>Product Name</th>
            <th>Product File</th>
            <th>Product Detail</th>
            <th>Cost</th>
            <th>Price</th>
            <th>Create At</th>
            <th>Update At</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($allProduct as $val) {
            ?>
            <tr>
                <td>{{$val->get('id')}}</td>
                <td>{{$val->get('barcode')}}</td>
                <td>{{$val->get('name')}}</td>
                <td>{{$val->get('file')}}</td>
                <td>{{$val->get('detail')}}</td>
                <td>{{$val->get('cost')}}</td>
                <td>{{$val->get('price')}}</td>
                <td>{{$val->get('created_at')}}</td>
                <td>{{$val->get('updated_at')}}</td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>
@stop

@section('js')
@stop