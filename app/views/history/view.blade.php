@extends('layout')

@section('head')
<title>{{App::make('ceddd\Shop')->getName()}} - history</title>
@stop

@section('body')
<div class="well">
  <h3>รายการการขายสินค้า</h3>
  <table class="table table-striped table-hover ">
    <thead>
      <tr>
        <th>ID</th>
        <th>รายการ</th>
        <th>จำนวน</th>
        <th>ราคา</th>
        <th>ลูกค้า</th>
        <th>ผู้จัดการ</th>
        <th>เมื่อ</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
      if(count($allHistory))
        foreach ($allHistory as $val) {
          $customer = App::make('ceddd\Customer');
          $manager = App::make('ceddd\Manager');
          $customer = $customer->getById($val->get('customer_id'));
          if($customer!=NULL)
            $customerName=$customer->get('name');
          else
            $customerName='-'; 

          $manager = $manager->getById($val->get('manager_id'));
          $manager = $manager->get('name');
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
            <td>{{$customerName}}</td>
            <td>{{$manager}}</td>
            <td>{{$val->get('updated_at')}}</td>
            <td><button type="button" class="btn btn-danger" onclick="delConfirm({{$val->get('hid')}})">ลบ</button></td>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>
  </div>

  @stop

  @section('js')
  
  <script type="text/javascript">    

    function delConfirm(hid){
      swal({
        title: "Are you sure?",
        text: "You will not be able to recover!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
      },
      function(){
        swal("Deleted!", "Deleted.", "success. Wait for refresh in a few second");
        $.post("{{URL::current()}}",{hid:hid},function(result){
          window.location.assign("{{URL::to('history')}}");
        });
      }
      );
    }
  </script>
  @stop