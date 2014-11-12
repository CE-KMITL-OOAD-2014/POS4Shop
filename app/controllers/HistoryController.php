<?php

class HistoryController extends BaseController {

    public function showView()
    {
        $history = App::make('ceddd\History');
        $allHistory = $history->getAll();
        return View::make('history.view')->with('allHistory',$allHistory);
    }

    public function actionDel(){
      $history = App::make('ceddd\History');
      $history->set('hid',Input::get('hid'));
      $history->deleteByHID();
      return "del".Input::get('hid');
    }

}
