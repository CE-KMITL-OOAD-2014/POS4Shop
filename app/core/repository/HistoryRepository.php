<?php 
namespace ceddd;
class HistoryRepository implements Repository{
  
  public function save($history){
    if($history->get('id')!=null)
      return false;
    $arrOfItem = $history->get('item');
    $count = count($arrOfItem);
    for($i=0;$i < $count;$i++){
      $historyElo              = new \HistoryEloquent;
      $historyElo->hid         = $history->get('hid');
      $historyElo->product_id  = $arrOfItem[$i]->get('item')->get('id');
      $historyElo->quantity    = $arrOfItem[$i]->get('quantity');
      $historyElo->price       = $arrOfItem[$i]->get('price');
      $historyElo->customer_id = $history->get('customer_id');
      $historyElo->manager_id  = $history->get('manager_id');
      if($historyElo->save()){
        $history->set('id',$historyElo->id);
      }else{
        return false;
      }
    }
    return true;
  }
           
  public function edit($history){
    if($history->get('id')){
      $historyElo = \HistoryEloquent::find($history->get('id'));
      if($historyElo==NULL)
        return false;
      $historyElo->hid = $history->get('hid');
      $historyElo->product_id = $history->get('product_id');
      $historyElo->quantity = $history->get('quantity');
      $historyElo->price = $history->get('price');
      $historyElo->customer_id = $history->get('customer_id');
      $historyElo->manager_id = $history->get('manager_id');
      return $historyElo->save();
    }
    return false;
  }

  public function delete($history){
    if($history->get('hid')){
      $historyElo = \HistoryEloquent::find($history->get('id'));
      return $historyElo->delete();
    }
    return false;
  }

  public function getAll(){
    $arrOfHistoryElo = \HistoryEloquent::all();
    if(count($arrOfHistoryElo) == 0)
      return NULL;
    return $this->packToObj($arrOfHistoryElo);
  }

  // ID is useless for History, Use HID instead
  public function getById($hid){
    return $this->find($hid);
  }

  public function find($hid){ 
    $arrOfHistoryElo = \HistoryEloquent::where('hid', $hid)->get();
    if(count($arrOfHistoryElo)==0)
      return NULL;
    return $this->packToObj($arrOfHistoryElo);
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

    $arrOfHistoryElo = $queryResult->get();

    if(count($arrOfHistoryElo) == 0)
      return NULL;

    if($pack){
      return $this->packToObj($arrOfHistoryElo);
    }else{
      return $this->byRow($arrOfHistoryElo);
    }
  }

  public function deleteByHid($hid){
    return \HistoryEloquent::where('hid', '=', $hid)->delete();
  }
  
  public function getLastHid(){
    $arrOfHistoryElo = \HistoryEloquent::all();
    $historyElo = $arrOfHistoryElo->last();

    if(count($historyElo)==0)
      return NULL;
    return $historyElo->hid;
  }

  // For topSell
  public function getByProductId($pid){
    $arrOfHistoryElo = \HistoryEloquent::where('product_id', $pid)->get();
    if(count($arrOfHistoryElo)==0)
      return NULL;
    return $this->byRow($arrOfHistoryElo);
  }

  public function getByCustomerId($cid){
    $arrOfHistoryElo = \HistoryEloquent::where('customer_id', $cid)->get();
    if(count($arrOfHistoryElo)==0)
      return NULL;
    return $this->packToObj($arrOfHistoryElo);
  }

  /**
  * Map HistoryEloquent to History and pack it to Array
  */
  private function packToObj($arrOfHistoryElo){
    $product = \App::make('ceddd\Product');
    $history = \App::make('ceddd\History');
    $tempH = \App::make('ceddd\History');
    $result = array();
    $soldArray = array();
    $i = 0;
    $arrCount = 0;
    foreach($arrOfHistoryElo as $historyElo){
      if($i == 0){
        $tempH = $historyElo;
        $i++;
      }
      if($historyElo->hid != $tempH->hid){
        $history->set('item',$soldArray);
        $result[$i-1]=$history;
        $tempH = $historyElo;
        unset($soldArray);
        unset($history);
        $history = \App::make('ceddd\History');
        $soldArray = array();
        $arrCount = 0;
        $i++;
      }
      $history->set('id',$tempH->id);
      $history->set('hid',$tempH->hid);
      $history->set('customer_id',$tempH->customer_id);
      $history->set('manager_id',$tempH->manager_id);
      $history->set('created_at',$tempH->created_at);
      $history->set('updated_at',$tempH->updated_at);
      $soldItem = \App::make('ceddd\SoldItem');
      $soldItem->set('item',$product->getById($historyElo->product_id));
      $soldItem->set('quantity',$historyElo->quantity);
      $soldItem->set('price',$historyElo->price);
      $soldArray[$arrCount] = $soldItem;
      $arrCount++;
    }
    $history->set('item',$soldArray);
    $result[$i-1]=$history;
    return $result;
  }

  /**
  * Map HistoryEloquent to History and return Array of History
  */
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

          
