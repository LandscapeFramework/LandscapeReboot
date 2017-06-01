<?php namespace Landscape\Interfaces\Database;

interface iModel
{
  const ID_COLUMN = '__ID__';

  public static function getCreationSQL();
  public static function getTableName();
  // This needs a lot of TODO
  public static function getAll();
  public static function getByID($id);
  public static function createNew($props=NULL);
  public static function getFields();
  public static function customFields(); // This needs to be overriden
  public function getValue($field);
  public function getID();
  public function save();
  public function delete();
}



?>
