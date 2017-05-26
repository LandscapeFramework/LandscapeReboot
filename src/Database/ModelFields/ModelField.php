<?php namespace Landscape\Database\ModelFields;

require_once("vendor/autoload.php");

use Landscape\Interfaces\Database\iModelField;

abstract class ModelField implements iModelField
{
  protected $value = NULL;

  public static function getSQLDefinition()
  {
    return "BLOB"; // Data is stored as it is parsed
  }

  public function __construct($options)
  {
    if(isset($options['default']))
      $this->setValue($options['default']);
  }

  public function isReady()
  {
    return $this->value != NULL;
  }

  public function setValue($value)
  {
    $this->value = $value;
  }

  public function parseValue($value)
  {
    $this->setValue($value);
  }

  public function getValue()
  {
    return $this->value;
  }

  public function getRawValue()
  {
    return $this->getValue();
  }
}

?>
