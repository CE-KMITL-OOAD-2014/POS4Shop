<?php

class ProductController extends BaseController {

    public function showIndex()
    {
        return "Product manager";
    }

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
            $product = App::make('ceddd\Product');
            $product->set('barcode',$data['barcode']);
            $product->set('name',$data['name']);
            $product->set('file',$newFileName);
            $product->set('detail',$data['detail']);
            $product->set('cost',$data['cost']);
            $product->set('price',$data['price']);
            $file->move(app_path().'/../public/upload/product/', $newFileName);
            $product->save();
            Redirect::to('/product/add')->with('msg',"Add ".$data['barcode']." : ".$data['name']." successfull.");
        }

        return Redirect::to('/product/add')->withErrors($validator);
    }

    public function showEdit()
    {
        return View::make('product.add');
    }

    public function actionEdit()
    {
        return View::make('product.add');
    }

    public function showView($id)
    {
        $product = App::make('ceddd\Product');
        $product = $product->getById($id);
        if($product==NULL)
            return App::abort(404);
        return View::make('product.view')->with('product',$product);
    }

    public function showDel()
    {
        return View::make('product.add');
    }

    public function actionDel()
    {
        return View::make('product.add');
    }

    public function showTopSell()
    {
        return View::make('product.add');
    }

}
