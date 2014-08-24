<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class TopSell extends Eloquent{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admin';
    public $id;
    public $username;
    public $password;
}