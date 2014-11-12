<?php

class CustomerController extends BaseController {

    public function showIndex()
    {
        $customer = App::make('ceddd\Customer');
        $allCustomer = $customer->getAll();
        return View::make('customer.index')->with('allCustomer',$allCustomer);
    }

    public function showAdd()
    {
        return View::make('customer.add');
    }

    public function actionAdd()
    {
        $data = Input::only('name');
        $rules = ceddd\CustomerRepository::getRules();
        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            $c = App::make('ceddd\\Customer');
            $c->set('name',$data['name']);
            if($c->save())
                Redirect::to('/customer/add')->with('msg',"Add ".$data['name']." successfull.");
        }
        return Redirect::to('/customer/add')->withErrors($validator);
    }

    public function showEdit($id)
    {
        $customer = App::make('ceddd\\Customer');
        $customer = $customer->getById($id);
        if($customer==NULL)
            return App::abort(404);
        $ctm['id'] = $customer->get('id');        
        $ctm['name'] = $customer->get('name');
        $ctm['created_at'] = $customer->get('created_at');
        $ctm['updated_at'] = $customer->get('updated_at');
        return View::make('customer.edit',$ctm);
    }

    public function actionEdit($id)
    {
        $data = Input::only('name');

        $rules = ceddd\CustomerRepository::getRules();
        $rules['id']='exists:customers';

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            $ctm = App::make('ceddd\\Customer');
            $customer = $ctm->getById($id);
            $customer->set('id',$id);
            $customer->set('name',$data['name']);
            $customer->edit();
            return Redirect::to('/customer/'.$id);
        }

        return Redirect::to('/customer/'.$id.'/edit')->withErrors($validator);
    }

    public function showView($id)
    {
        $customer = App::make('ceddd\\Customer');
        $customer = $customer->getById($id);
        if($customer==NULL)
            return App::abort(404);

        $history = $customer->getHistory($id);
        return View::make('customer.view')->with(array('customer'=>$customer,'history'=>$history));
    }

    public function api($id){
        $customer = App::make('ceddd\\Customer');
        $customer = $customer->getById($id);
        if($customer==NULL)
            return App::abort(404);
        return json_encode($customer->toJson());
    }

    /*public function showHistory($cid)
    {
        $history = App::make('ceddd\\History');
        $history = $history->getByCustomerId($cid);
        if($history==NULL)
            return App::abort(404);
        return View::make('customer.history')->with('history',$history);
    }*/

    public function actionDel(){
        $data  = Input::get("id");
        $customer = App::make('ceddd\\Customer');
        $customer = $customer->getById($data);
        $customer->delete();
        return Response::make('delete '.$data, 200);
    }
}
