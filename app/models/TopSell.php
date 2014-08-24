<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class TopSell extends Eloquent{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'top_sell';
    public $id;
    public $product_id;
    public $rank;
}