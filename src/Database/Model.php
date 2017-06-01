<?php namespace Landscape\Database;

require_once("vendor/autoload.php");

use Landscape\Interfaces\Database\iModel;
use Landscape\Database\Database;

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

  public static function newFromDataMap($map)
  {
    //TODO: we get the data as Hashtable (e.g. by DB query) and we need to set the fields
  }

  public static function getAll()
  {
    //TODO: A bit more complicated: need to create custom array-like object to
    //delay the actual fetch until every filter/sort rule is added to the query
    //or the first dataset is requested
  }

  public static function getByID($id)
  {
    $col = static::ID_COLUMN;
    $s = static::getTableName();
    $sql = "SELECT * from $s WHERE $col == $id;";
    Database::getHandle()->query($sql);
  }

  public static function createNew($props=NULL)
  {
    // Create a new Object and fill all fields specified in $props
  }

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

  public function getID()
  {
    return $this->fields[static::ID_COLUMN]->getValue();
  }
    
  abstract public function save();
  abstract public function delete();
}

Database::connect("sqlite:test.db");
print(Model::getCreationSQL());
print_r(Model::getByID(1));

?>
