<?php 
namespace ceddd;
class Summary{
  private $self;

  function __construct(HistoryRepository $repository){
    $this->self['repository']=$repository;
    $this->self['topSell']=NULL;
    $this->self['item']=NULL;
    $this->self['summary']=NULL;
  }

  public function get($key){
    return $this->self[$key];
  }

  public function set($key,$value){
    $this->self[$key]=$value;            
  }

  public function getProductSoldQuantity($productId){
    $result=0;
    $history=$this->self['repository']->getByProductId($productId);
    $size=count($history);

    for ($i=0; $i < $size; $i++) { 
      $result+=$history[$i]->get('item')[0]->get('quantity');
    }

    return $result;
  }

  public function getProductType(){
    $monthTime = date("Y-m-d H:i:s", strtotime('-1 month'));
    $query=array();
    $statment['column']='created_at';
    $statment['operator']='>=';
    $statment['value']=$monthTime;
    $query[0]=$statment;

    $order['column']='product_id';
    $order['asc']='asc';

    $arrayOfHistory = $this->self['repository']->where(false,$query,$order);

    $result = array();
    if(count($arrayOfHistory)>0){
      foreach($arrayOfHistory as $val){
        $productId = $val->get('item')[0]->get('item')->get('id');
        if (!in_array($productId, $result)) {
          array_push($result, $productId);        
        }
      }
    }

    return $result;
  }

  public function getTopSell(){
    $arrOfProductId = $this->getProductType();
    $result=array();
    foreach($arrOfProductId as $val){
      $result[strval($val)]= $this->getProductSoldQuantity($val);
    }

    uasort($result, function ($a, $b)
    {
      if ($a == $b) {
        return -1;
      }
      //return ($a < $b) ? -1 : 1;
      return ($a < $b) ? 1 : -1;
    });

    $topSell=array();
    $i=0;
    foreach($result as $pid => $val){
      $product = \App::make('ceddd\\Product');
      $product = $product->getById($pid);
      $topSell[$i]=$product;
      $i++;
      if($i==10)
        break;
    }

    $this->self['topSell']=$topSell;
    \Session::put('top', $topSell);
    return $this->self['topSell'];
  } 

  public function getDaily($year,$month,$day){
    $date=$day.'-'.$month.'-'.$year;
    $dateStart = date("Y-m-d H:i:s", strtotime($date));
    $dateEnd = date("Y-m-d H:i:s", strtotime($date)+(60*60*24)-1);

    $query=array();
    $statment['column']='created_at';
    $statment['operator']='>=';
    $statment['value']=$dateStart;
    $query[0]=$statment;

    $statment['column']='created_at';
    $statment['operator']='<=';
    $statment['value']=$dateEnd;
    $query[1]=$statment;

    $arrayOfHistory = $this->self['repository']->where(false,$query);
    if($arrayOfHistory==NULL)
      return NULL;
    $result=array();
    foreach ($arrayOfHistory as $key => $history) {
      $result[$key] = $history;
    }
    $this->self['summary']=$result;
    return $result;
  }

  public function getMonthly($year,$month){
    $date='1-'.$month.'-'.$year;
    $dateStart = date("Y-m-d H:i:s", strtotime($date));
    $dateEnd = date("Y-m-d H:i:s", strtotime($date)+(30*60*60*24)-1);

    $query=array();
    $statment['column']='created_at';
    $statment['operator']='>=';
    $statment['value']=$dateStart;
    $query[0]=$statment;

    $statment['column']='created_at';
    $statment['operator']='<=';
    $statment['value']=$dateEnd;
    $query[1]=$statment;

    $arrayOfHistory = $this->self['repository']->where(false,$query);
    if($arrayOfHistory==NULL)
      return NULL;
    $result=array();
    foreach ($arrayOfHistory as $key => $history) {
      $result[$key] = $history;
    }
    $this->self['summary']=$result;
    return $result;
  }

  public function report(){
    $result=array();
    $result['total']=0;
    $result['cost']=0;
    $result['net']=0;

    $size=count($this->self['summary']);
    for ($i=0; $i < $size; $i++) { 
      $quantity = $this->self['summary'][$i]->get('item')[0]->get('quantity');
      $price = $this->self['summary'][$i]->get('item')[0]->get('price');
      $cost = $this->self['summary'][$i]->get('item')[0]->get('item')->get('cost');

      $result['cost']+=$quantity*$cost;
      $result['total']+=$quantity*$price;
    }

    $result['net']=$result['total']-$result['cost'];
    return $result;
  }

  //$monthTime = date("Y-m-d H:i:s", strtotime('-1 month'));
}
