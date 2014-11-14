<?php 
namespace ceddd;
class HistoryRepository implements Repository{
  
  
  public function save($history){
    if($history->get('id')!=null)
      return false;
    $arrItem = $history->get('item');
    $count = count($arrItem);
    for($i=0;$i < $count;$i++){
      $h              = new \HistoryEloquent;
      $h->hid         = $history->get('hid');
      $h->product_id  = $arrItem[$i]->get('item')->get('id');
      $h->quantity    = $arrItem[$i]->get('quantity');
      $h->price       = $arrItem[$i]->get('price');
      $h->customer_id = $history->get('customer_id');
      $h->manager_id  = $history->get('manager_id');
      if(!$h->save()){
        return false;
      }
    }
    return true;
  }
           
  public function edit($history){
    if($history->get('id')){
      $h = \HistoryEloquent::find($history->get('id'));
      if($h==NULL)
        return false;
      $h->hid = $history->get('hid');
      $h->product_id = $history->get('product_id');
      $h->quantity = $history->get('quantity');
      $h->price = $history->get('price');
      $h->customer_id = $history->get('customer_id');
      $h->manager_id = $history->get('manager_id');
      return $h->save();
    }
    return false;
  }

  public function delete($history){
    if($history->get('hid')){
      $m = \HistoryEloquent::find($history->get('id'));
      return $m->delete();
    }
    return false;
  }

  public function getAll(){
    $all = \HistoryEloquent::all();
    if(count($all) == 0)
      return NULL;
    return $this->packToObj($all);
  }

  public function getById($id){
    $history = \HistoryEloquent::find($id);
    $soldItem = \App::make('ceddd\SoldItem');
    $product = \App::make('ceddd\Product');
    if($history){
      $h = \App::make('ceddd\History');
      $h->set('id',$history->id);
      $h->set('hid',$history->hid);
      $soldItem->set('item',$product->getById($history->product_id));
      $soldItem->set('quantity',$history->quantity);
      $soldItem->set('price',$history->price);
      $h->set('item',array($soldItem));
      $h->set('customer_id',$history->customer_id);
      $h->set('manager_id',$history->manager_id);
      $h->set('created_at',$history->created_at);
      $h->set('updated_at',$history->updated_at);
      return $h;
    }
    return NULL;
  }

  public function find($hid){ 
    $where = \HistoryEloquent::where('hid', $hid)->get();
    if(count($where)==0)
      return NULL;
    $soldItem = \App::make('ceddd\SoldItem');
    $product = \App::make('ceddd\Product');
    $result=array();
    foreach($where as $key => $val){
      $h = \App::make('ceddd\History');
      $h->set('id',$val->id);
      $h->set('hid',$val->hid);
      $h->set('customer_id',$val->customer_id);
      $h->set('manager_id',$val->manager_id);
      $soldItem->set('item',$product->getById($val->product_id));
      $soldItem->set('quantity',$val->quantity);
      $soldItem->set('price',$val->price);
      $h->set('item',$soldItem);
      $h->set('created_at',$val->created_at);
      $h->set('updated_at',$val->updated_at);
      $result[$key]=$h;
    }
    return $result;
  }

  private function byObj($history){
    $h = \App::make('ceddd\History');
    $h->set('id',$history->id);
    $h->set('hid',$history->hid);
    $soldItem->set('item',$product->getById($history->product_id));
    $soldItem->set('quantity',$history->quantity);
    $soldItem->set('price',$history->price);
    $h->set('item',array($soldItem));
    $h->set('customer_id',$history->customer_id);
    $h->set('manager_id',$history->manager_id);
    $h->set('created_at',$history->created_at);
    $h->set('updated_at',$history->updated_at);
    return $h;
  }


  public function where($pack, $query, $order=NULL){
    $queryResult = array();
    $queryResult = \HistoryEloquent::where($query[0]['column'],$query[0]['operator'],$query[0]['value']);
    for ($i=1; $i <count($query); $i++) { 
      $queryResult->where($query[$i]['column'],$query[$i]['operator'],$query[$i]['value']);
    }
    
    if($order!=NULL){
      $queryResult->orderBy($order['column'],$order['asc']);
    }

    $queryResult = $queryResult->get();

    if(count($queryResult) == 0)
      return NULL;

    if($pack){
      return $this->packToObj($queryResult);
    }else{
      return $this->byRow($queryResult);
    }
  }

  public function deleteByHID($history){
    return \HistoryEloquent::where('hid', '=', $history->get('hid'))->delete();
  }
  
  public function getLast(){
    $h = \HistoryEloquent::all();
    $history = $h->last();

    if(count($history)==0)
      return NULL;
    return $history->hid;
  }

  public function getByProductId($pid){
    $history = \HistoryEloquent::where('product_id', $pid)->get();
    if(count($history)==0)
      return NULL;
    return $this->byRow($history);
  }

  public function getByCustomerId($cid){
    $history = \HistoryEloquent::where('customer_id', $cid)->get();
    if(count($history)==0)
      return NULL;

    return $this->packToObj($history);
  }

  private function packToObj($history)
  {
    $product = \App::make('ceddd\Product');
    $h = \App::make('ceddd\History');
    $tempH = \App::make('ceddd\History');
    $result = array();
    $soldArray = array();
    $i = 0;
    $arrCount = 0;
    foreach($history as $val){
      if($i == 0){
        $tempH = $val;
        $i++;
      }
      if($val->hid != $tempH->hid){
        $h->set('item',$soldArray);
        $result[$i-1]=$h;
        $tempH = $val;
        unset($soldArray);
        unset($h);
        $h = \App::make('ceddd\History');
        $soldArray = array();
        $arrCount = 0;
        $i++;
      }
      $h->set('id',$tempH->id);
      $h->set('hid',$tempH->hid);
      $h->set('customer_id',$tempH->customer_id);
      $h->set('manager_id',$tempH->manager_id);
      $h->set('created_at',$tempH->created_at);
      $h->set('updated_at',$tempH->updated_at);
      $soldItem = \App::make('ceddd\SoldItem');
      $soldItem->set('item',$product->getById($val->product_id));
      $soldItem->set('quantity',$val->quantity);
      $soldItem->set('price',$val->price);
      $soldArray[$arrCount] = $soldItem;
      $arrCount++;
    }
    $h->set('item',$soldArray);
    $result[$i-1]=$h;
    return $result;
  }

  private function byRow($queryResult){
    $result = array();
    $product = \App::make('ceddd\Product');

    foreach($queryResult as $key => $val){
      $history = \App::make('ceddd\History');
      $history->set('id',$val->id);
      $history->set('hid',$val->hid);
      $soldItem = \App::make('ceddd\SoldItem');
      $soldItem->set('item',$product->getById($val->product_id));
      $soldItem->set('quantity',$val->quantity);
      $soldItem->set('price',$val->price);
      $arrOfSoldItem[0]=$soldItem;
      $history->set('item',$arrOfSoldItem);
      $history->set('manager_id',$val->manager_id);
      $history->set('customer_id',$val->customer_id);
      $history->set('created_at',$val->created_at);
      $history->set('updated_at',$val->updated_at);
      $result[$key]=$history;
    }
    return $result;
  }

}

          
