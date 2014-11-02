<?php

class HistoryController extends BaseController {

    public function showView()
    {
        $history = App::make('ceddd\History');
        $allHistory = $history->getAll();
        return View::make('history.view')->with('allHistory',$allHistory);
    }

}
