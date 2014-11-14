<?php 
namespace ceddd;
class ProductRepository implements Repository{
  
  
  public function save($product){
    $p = new \ProductEloquent;
    if($product->get('id')!=null)
      return false; // old product should edit
    $p->barcode = $product->get('barcode');
    $p->name = $product->get('name');
    $p->file = $product->get('file');
    $p->detail = $product->get('detail');
    $p->cost = $product->get('cost');
    $p->price = $product->get('price');
    if($p->save()){
      $product->set('id',$p->id);
      return true;
    }
    return false;
  }
            
  public function edit($product){
    if($product->get('id')){ //TODO if not found -> how to handler?
      $p = \ProductEloquent::find($product->get('id'));
      if($p==NULL)
        return false;
      $p->barcode = $product->get('barcode');
      $p->name = $product->get('name');
      $p->file = $product->get('file');
      $p->detail = $product->get('detail');
      $p->cost = $product->get('cost');
      $p->price = $product->get('price');
      return $p->save();
    }
    return false;
  }

  public function delete($product){
    if($product->get('id')){
      $m = \ProductEloquent::find($product->get('id'));
      return $m->delete();
    }
    return false;
  }
          
  public function getById($id){
    $product = \ProductEloquent::find($id);
    if($product){
      $p = \App::make('ceddd\Product');
      $p->set('id',$product->id);
      $p->set('barcode',$product->barcode);
      $p->set('name',$product->name);
      $p->set('file',$product->file);
      $p->set('detail',$product->detail);
      $p->set('cost',$product->cost);
      $p->set('price',$product->price);
      $p->set('created_at',$product->created_at);
      $p->set('updated_at',$product->updated_at);
      return $p;
    }
    return NULL;
  }
  
  public function getAll(){
    $all = \ProductEloquent::all();
    if(count($all)==0)
      return NULL;
    $result=array();
    foreach($all as $key => $val){
      $p = \App::make('ceddd\Product');
      $p->set('id',$val->id);
      $p->set('barcode',$val->barcode);
      $p->set('name',$val->name);
      $p->set('file',$val->file);
      $p->set('detail',$val->detail);
      $p->set('cost',$val->cost);
      $p->set('price',$val->price);
      $p->set('created_at',$val->created_at);
      $p->set('updated_at',$val->updated_at);
      $result[$key]=$p;
    } 
    return $result;
  }


  public function find($value){
    $where = \ProductEloquent::where('name', 'like', '%'.$value.'%')->orWhere('barcode', 'like', '%'.$value.'%')->get();
    if(count($where)==0)
      return NULL;
    $result=array();
    foreach($where as $key => $val){
      $p = \App::make('ceddd\Product');
      $p->set('id',$val->id);
      $p->set('barcode',$val->barcode);
      $p->set('name',$val->name);
      $p->set('file',$val->file);
      $p->set('detail',$val->detail);
      $p->set('cost',$val->cost);
      $p->set('price',$val->price);
      $p->set('created_at',$val->created_at);
      $p->set('updated_at',$val->updated_at);
      $result[$key]=$p;
    } 
    return $result;
  }
          
  public function where($col,$value){
    $where = \ProductEloquent::where($col, 'like', '%'.$value.'%')->get();
    if(count($where)==0)
      return NULL;
    $result=array();
    foreach($where as $key => $val){
      $p = \App::make('ceddd\Product');
      $p->set('id',$val->id);
      $p->set('barcode',$val->barcode);
      $p->set('name',$val->name);
      $p->set('file',$val->file);
      $p->set('detail',$val->detail);
      $p->set('cost',$val->cost);
      $p->set('price',$val->price);
      $p->set('created_at',$val->created_at);
      $p->set('updated_at',$val->updated_at);
      $result[$key]=$p;
    } 
    return $result;
  }
}