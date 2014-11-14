<?php 
namespace ceddd;
class Summary{
  private $self;

  function __construct(HistoryRepository $repository){
    $this->self['repository']=$repository;
    $this->self['topSell']=NULL;
    $this->self['item']=NULL;
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

  public function getDaily($date=NULL){
    $result=array();

    return $result;    
  }

}
