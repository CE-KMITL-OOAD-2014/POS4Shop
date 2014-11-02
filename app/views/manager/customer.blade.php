@for ($i=0;$i<count($searchCustomer);$i++)
<a href="{{URL::current().'/'.$searchCustomer[$i]->get('id')}}" class="btn btn-default">
    {{$searchCustomer[$i]->get('name')}} )
</a>
<br>
@endfor