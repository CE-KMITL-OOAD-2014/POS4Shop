<?php

class ProductController extends BaseController {

    public function showIndex()
    {
        return "Product manager";
    }
    //--- Add
    public function showAdd()
    {
        return View::make('product.add');
    }

    public function actionAdd()
    {
        $data = Input::only(array('barcode','name','detail','cost','price'));

        $rules = ceddd\ProductRepository::getRules();

        $file = Input::file('img');
        $data['file']=$file;
        $newFileName = $data['barcode'].".".$file->guessExtension();

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            $product = App::make('ceddd\\Product');
            $product->set('barcode',$data['barcode']);
            $product->set('name',$data['name']);
            $product->set('file',$newFileName);
            $product->set('detail',$data['detail']);
            $product->set('cost',$data['cost']);
            $product->set('price',$data['price']);
            $file->move(app_path().'/../public/upload/product/', $newFileName);
            if($product->save()==true)
                Redirect::to('/product/add')->with('msg',"Add ".$data['barcode']." : ".$data['name']." successfull.");
        }
        return Redirect::to('/product/add')->withErrors($validator);
    }

    //--- Edit
    public function showEdit($id)
    {
        $product = App::make('ceddd\\Product');
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

        $rules = ceddd\ProductRepository::getRules();
        $rules['id']='exists:products';

        $file = Input::file('img');
        $data['file']=$file;
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
            return Redirect::to('/product/'.$id);
        }

        return Redirect::to('/product/'.$id.'/edit')->withErrors($validator);
    }

    //--- View
    public function showView($id)
    {
        $product = App::make('ceddd\\Product');
        $product = $product->getById($id);
        if($product==NULL)
            return App::abort(404);
        return View::make('product.view')->with('product',$product);
    }

    //--- Del
    public function actionDel(){
        $data  = Input::get("id");
        $product = App::make('ceddd\\Product');
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
