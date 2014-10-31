@for ($i=0;$i<count($searchProduct);$i++)
    <a href="{{URL::current().'/'.$searchProduct[$i]->get('id')}}" class="btn btn-default">
        {{$searchProduct[$i]->get('barcode')}} {{$searchProduct[$i]->get('name')}} ({{$searchProduct[$i]->get('price')}})
    </a>
    <br>
@endfor