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

    public function showView($id){

    }

    public function actionDel($id){

    }
}
