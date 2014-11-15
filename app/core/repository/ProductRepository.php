<?php 
namespace ceddd;
class ProductRepository implements Repository{
  
  public function save($product){
    $productEloquent = new \ProductEloquent;
    if($product->get('id')!=null)
      return false; // old product should edit
    $productEloquent->barcode = $product->get('barcode');
    $productEloquent->name = $product->get('name');
    $productEloquent->file = $product->get('file');
    $productEloquent->detail = $product->get('detail');
    $productEloquent->cost = $product->get('cost');
    $productEloquent->price = $product->get('price');
    if($productEloquent->save()){
      $product->set('id',$productEloquent->id);
      return true;
    }
    return false;
  }
            
  public function edit($product){
    if($product->get('id')){ //TODO if not found -> how to handler?
      $productEloquent = \ProductEloquent::find($product->get('id'));
      if($productEloquent){
        $productEloquent->barcode = $product->get('barcode');
        $productEloquent->name = $product->get('name');
        $productEloquent->file = $product->get('file');
        $productEloquent->detail = $product->get('detail');
        $productEloquent->cost = $product->get('cost');
        $productEloquent->price = $product->get('price');
        return $productEloquent->save();
      }
    }
    return false;
  }

  public function delete($product){
    if($product->get('id')){
      $productEloquent = \ProductEloquent::find($product->get('id'));
      $productEloquent->isDelete=true;
      $productEloquent->save();
    }
    return false;
  }
          
  public function getById($id){
    $productEloquent = \ProductEloquent::find($id);
    if($productEloquent){
      $product = \App::make('ceddd\Product');
      $product->set('id',$productEloquent->id);
      $product->set('barcode',$productEloquent->barcode);
      $product->set('name',$productEloquent->name);
      $product->set('file',$productEloquent->file);
      $product->set('detail',$productEloquent->detail);
      $product->set('cost',$productEloquent->cost);
      $product->set('price',$productEloquent->price);
      $product->set('created_at',$productEloquent->created_at);
      $product->set('updated_at',$productEloquent->updated_at);
      $product->set('isDelete',$productEloquent->isDelete);
      return $product;
    }
    return NULL;
  }
  
  public function getAll(){
    $arrayOfProductEloquent = \ProductEloquent::where('isDelete', '=', 0)->get();
    if(count($arrayOfProductEloquent)==0)
      return NULL;
    $result=array();
    foreach($arrayOfProductEloquent as $key => $productEloquent){
      $result[$key]=$this->toObj($productEloquent);
    } 
    return $result;
  }

  public function find($value){
    $arrayOfProductEloquent = \ProductEloquent::where('name', 'like', '%'.$value.'%')->orWhere('barcode', 'like', '%'.$value.'%');
    $arrayOfProductEloquent = $arrayOfProductEloquent->where('isDelete', '=', 0)->get();
    if(count($arrayOfProductEloquent)==0)
      return NULL;
    $result=array();
    foreach($arrayOfProductEloquent as $key => $productEloquent){
      $result[$key]=$this->toObj($productEloquent);
    } 
    return $result;
  }
          
  public function where($col,$value){
    $arrayOfProductEloquent = \ProductEloquent::where($col, 'like', '%'.$value.'%')->get();
    if(count($arrayOfProductEloquent)==0)
      return NULL;
    $result=array();
    foreach($arrayOfProductEloquent as $key => $productEloquent){
      $result[$key]=$this->toObj($productEloquent);
    } 
    return $result;
  }

  private function toObj($productEloquent){
    $product = \App::make('ceddd\Product');
    $product->set('id',$productEloquent->id);
    $product->set('barcode',$productEloquent->barcode);
    $product->set('name',$productEloquent->name);
    $product->set('file',$productEloquent->file);
    $product->set('detail',$productEloquent->detail);
    $product->set('cost',$productEloquent->cost);
    $product->set('price',$productEloquent->price);
    $product->set('created_at',$productEloquent->created_at);
    $product->set('updated_at',$productEloquent->updated_at);
    return $product;
  }
}