<?php namespace Landscape\Interfaces\Database;

interface iModelField
{
  public static function getSQLDefinition(); // Return a SQL column type
  public function __construct($options);
  public function isReady();  // Return true if the field contains it's value
  public function setValue($value);
  public function parseValue($value); // Basicly this could be the same as setValue but you might do some fancy stuff when loading from Database
  public function getValue();
  public function getRawValue(); // Data as it should be stored in the table
}



?>
