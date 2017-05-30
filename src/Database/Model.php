<?php namespace Landscape\Database;

require_once("vendor/autoload.php");

use Landscape\Interfaces\Database\iModel;

abstract class Model implements iModel
{
  protected $fields;

  public function __construct()
  {
    $this->fields = $this::getFields();
  }

  public static function getCreationSQL()
  {
    $table = static::getTableName();
    $data = "CREATE TABLE $table (\n";
    foreach (static::getFields() as $name => $type)
    {
        $data = $data . "$name $type,\n";
    }
    $data = $data . ");\n";
    return $data;
  }

  // Thanks to https://stackoverflow.com/a/19533226/3700391
  public static function getTableName()
  {
    $cl = explode("\\", get_called_class());
    $cl = array_pop($cl);
    return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $cl));
  }

  // This needs a lot of TODO
  abstract public static function getAll();
  abstract public static function getByID();
  abstract public static function createNew();

  final public static function getFields()
  {
    $f =  [static::ID_COLUMN => "INTEGER PRIMARY KEY"];
    $f += static::customFields();
    return $f;
  }

  public static function customFields()
  {
    return [];
  }

  public function getValue($field)
  {
    return $this->fields[$field]->getValue();
  }

  abstract public function getID();
  abstract public function save();
  abstract public function delete();
}

print(Model::getCreationSQL());

?>
