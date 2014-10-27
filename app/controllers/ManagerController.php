<?php

class ManagerController extends BaseController {

    public function showIndex()
    {
        return "manager";
    }

    // Add manager
    public function showAdd()
    {
        return View::make('manager.add');
    }

    public function actionAdd()
    {
        $data = Input::only(array('name','username','password'));
        $rules = ceddd\ManagerRepository::getRules();
        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            $manager = App::make('ceddd\\Manager');
            $manager->set('name',$data['name']);
            $manager->set('username',$data['username']);
            $manager->set('password',$data['password']);
            if($manager->save())
                Redirect::to('/manager/add')->with('msg',"Add ".$data['name']." successfull.");
        }
        return Redirect::to('/manager/add')->withErrors($validator);
    }
    public function showView($id){
        $manager = App::make('ceddd\\Manager');
        $manager = $manager->getById($id);
        if($manager==NULL)
            return App::abort(404);
        return View::make('manager.view')->with('manager',$manager);
    }

    // Del manager
    public function actionDel(){
        $data  = Input::get("id");
        $manager = App::make('ceddd\\Manager');
        $manager = $manager->getById($data);
        $manager->delete();
        return Response::make('delete '.$data, 200);
    }

    // Shop cal
    public function showShopCal($item){

    }
    public function actionShopCal($item){

    }

    // Shop setting
    public function showShopSetting(){

    }
    public function actionshowShopSetting(){

    }

    // Shop history
    public function showHistory(){

    }
}
