<?php namespace Landscape\Interfaces\Database;

interface iModel
{
  public static function getCreationSQL();
  public static function getTableName();
  // This needs a lot of TODO
  public static function getAll();
  public static function createNew();
  public function getFields();
  public function getValue($field);
  public function save();
  public function delete();
}



?>
