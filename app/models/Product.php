<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Product extends Eloquent{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product';
    public $id;
    public $barcode;
    public $name;
    public $detail;
    public $price;
    public $major;
    public $img_filename;
    public $item_sold;
}