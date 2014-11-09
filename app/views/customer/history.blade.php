@extends('layout')

@section('head')
<title>{{App::make('ceddd\Shop')->getName()}} - Customer history</title>
@stop

@section('body')
<div class="well">
    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th>History ID</th>
            <th>Product Name</th>
            <th>quantity</th>
            <th>price</th>
            <th>Customer Name</th>
            <th>Manager Name</th>
            <th>Create at</th>
            <th>Update at</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($history as $val) {
            $customer = \App::make('ceddd\Customer');
            $manager = \App::make('ceddd\Manager');
            $customer = $customer->getById($val->get('customer_id'));
            $manager = $manager->getById($val->get('manager_id'));
            ?>
            <tr>
                <td>{{$val->get('hid')}}</td>
                <?php
                $soldArr = $val->get('item');
                $nameArr = array();
                $quantityArr = array();
                $priceArr = array();
                $count = 0;
                foreach ($soldArr as $soldVal) {
                    $nameArr[$count] = $soldVal->get('item')->get('name');
                    $quantityArr[$count] =  number_format((float)$soldVal->get('quantity'), 2, '.', '');
                    $priceArr[$count] =  number_format((float)$soldVal->get('price'), 2, '.', '');
                    $count++;
                }
                ?>
                <td><?php foreach ($nameArr as $nameVal) echo $nameVal."<br>";?></td>
                <td><?php foreach ($quantityArr as $quantityVal) echo $quantityVal."<br>"; ?></td>
                <td><?php foreach ($priceArr as $priceVal) echo $priceVal."<br>"; ?></td>
                <td>{{$customer->get('name')}}</td>
                <td>{{$manager->get('name')}}</td>
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