<?php

class CustomerController extends BaseController {

    public function showIndex()
    {
        return "Customer";
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

    public function showView($id)
    {
        $customer = App::make('ceddd\\Customer');
        $customer = $customer->getById($id);
        if($customer==NULL)
            return App::abort(404);
        return View::make('customer.view')->with('customer',$customer);
    }

    public function actionDel(){
        $data  = Input::get("id");
        $customer = App::make('ceddd\\Customer');
        $customer = $customer->getById($data);
        $customer->delete();
        return Response::make('delete '.$data, 200);
    }
}
