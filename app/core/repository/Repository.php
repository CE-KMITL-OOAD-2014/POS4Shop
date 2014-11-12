<?php 
namespace ceddd;
interface Repository{
  public function save($obj);
  public function edit($obj);
  public function delete($obj);
  public static function getById($id);
  public static function getAll();
  public static function find($name);
  public static function where($key,$value);
}