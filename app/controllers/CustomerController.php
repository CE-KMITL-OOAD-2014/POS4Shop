<?php

class CustomerController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |   Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function showIndex()
    {
        return View::make('index');
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
            // Normally we would do something with the data.
            return 'Data was saved.';
        }

        return Redirect::to('/customer/add');
    }

}
