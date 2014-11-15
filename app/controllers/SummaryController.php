<?php

class SummaryController extends BaseController {

  public function showIndex(){

    return View::make('summary.index');
  }

  public function actionIndex(){
    $day=Input::get('day');
    $month=Input::get('month');
    $year=Input::get('year');

    return Redirect::to("/summary/$year/$month/$day");
  }

  public function showDaily($year,$month,$day){

    $summary = App::make('ceddd\Summary');
    $history=$summary->getDaily($year,$month,$day);
    $report=$summary->report();
    return View::make('summary.daily')->with(array('history'=>$history,'report'=>$report,'date'=>"$day-$month-$year"));
  }

  public function showMonthly($year,$month){
    $summary = App::make('ceddd\Summary');
    $history=$summary->getMonthly($year,$month);
    $report=$summary->report();
    return View::make('summary.monthly')->with(array('history'=>$history,'report'=>$report,'date'=>"$month-$year"));
  }

}
