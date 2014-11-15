<?php 
namespace ceddd;
interface Repository{
  public function save($obj);
  public function edit($obj);
  public function delete($obj);
  public function getById($id);
  public function getAll();
  public function find($name);
}