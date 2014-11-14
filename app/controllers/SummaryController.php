<?php

class SummaryController extends BaseController {

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
