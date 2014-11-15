<?php

class ProductController extends BaseController {

  public function showIndex()
  {
    $product = App::make('ceddd\Product');
    $allProduct = $product->getAll();
    return View::make('product.index')->with('allProduct',$allProduct);
  }
    //--- Add
  public function showAdd()
  {
    return View::make('product.add');
  }

  public function actionAdd()
  {
    $data = Input::only(array('barcode','name','detail','cost','price'));

    $rules = ceddd\Product::getRules();

    $file = Input::file('file');
    $data['file']=$file;
    $newFileName="";
    if($file==NULL){
      $rules['file'] = "";
    }else{
      $newFileName = $data['barcode'].".".$file->guessExtension();            
    }
    $validator = Validator::make($data, $rules);
    if ($validator->passes()) {

      $product = App::make('ceddd\Product');
      $product->set('barcode',$data['barcode']);
      $product->set('name',$data['name']);
      $product->set('detail',$data['detail']);
      $product->set('cost',$data['cost']);
      $product->set('price',$data['price']);
      if($file!=NULL){
        $product->set('file',$newFileName);
        $file->move(app_path().'/../public/upload/product/', $newFileName);
      }
      if($product->save()==true){
        Redirect::to('/product')->with('msg',"เพิ่ม <b>".$data['name']."</b> สำเร็จ");
                //return Redirect::to('/product/'.$product->get('id'));
      }
    }
    return Redirect::to('/product')->withErrors($validator);
  }

    //--- Edit
  public function showEdit($id)
  {
    $product = App::make('ceddd\Product');
    $product = $product->getById($id);
    if($product==NULL)
      return App::abort(404);

    $pd['id'] = $product->get('id');
    $pd['barcode'] = $product->get('barcode');
    $pd['name'] = $product->get('name');
    $pd['file'] = $product->get('file');
    $pd['detail'] = $product->get('detail');
    $pd['cost'] = $product->get('cost');
    $pd['price'] = $product->get('price');
    $pd['created_at'] = $product->get('created_at');
    $pd['updated_at'] = $product->get('updated_at');
        //var_dump($pd);
    return View::make('product.edit',$pd);
        //return View::make('product.edit')->with('product',$pd);
  }

  public function actionEdit($id)
  {
    $data = Input::only(array('barcode','name','detail','cost','price'));

    $rules = ceddd\Product::getRules();
    $rules['id']='exists:products';
    $rules['barcode']='required|min:4';

    $file = Input::file('file');
    $data['file']=$file;
    $newFileName="";
    if($data['file']!=NULL)
      $newFileName = $data['barcode'].".".$file->guessExtension();

    $validator = Validator::make($data, $rules);
    if ($validator->passes()) {
      $pd = App::make('ceddd\Product');
      $product = $pd->getById($id);
      $product->set('id',$id);
      $product->set('barcode',$data['barcode']);
      $product->set('name',$data['name']);
      if($data['file']!=NULL)
        $product->set('file',$newFileName);
      $product->set('detail',$data['detail']);
      $product->set('cost',$data['cost']);
      $product->set('price',$data['price']);

      if($data['file']!=NULL)
        $file->move(app_path().'/../public/upload/product/', $newFileName);
      $product->edit();
      return Redirect::to('/product/'.$id)->with('msg',"แก้ไข <b>".$data['name']."</b> สำเร็จ");
    }

    return Redirect::to('/product/'.$id.'/edit')->withErrors($validator);
  }

    //--- View
  public function showView($id)
  {
    $product = App::make('ceddd\Product');
    $product = $product->getById($id);
    if($product==NULL)
      return App::abort(404);
    return View::make('product.view')->with('product',$product);
  }

    //api
  public function api($id){
    $product = App::make('ceddd\Product');
    $product = $product->getById($id);
    if($product==NULL)
      return App::abort(404);

    return json_encode($product->json());
  }

    //--- Del
  public function actionDel(){
    $data  = Input::get("id");
    $product = App::make('ceddd\Product');
    $product = $product->getById($data);
    $product->delete();
    return Response::make('delete '.$data, 200);
  }

    //--- TopSell
  public function showTopSell()
  {
    return View::make('product.add');
  }

}
