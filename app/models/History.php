<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class History extends Eloquent{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'history';
    public $id;
    public $hid;
    public $product_name;
    public $customer_id;
    public $quantity;
}