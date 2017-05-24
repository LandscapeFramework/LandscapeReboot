<?php namespace Landscape\Database;

require_once("vendor/autoload.php");

use \Landscape\Interfaces\Database\iDatabase;
use \Landscape\Exceptions\DatabaseException;

class Database implements iDatabase
{
  private static $handle = NULL;

  public static function isConnected()
  {
    return self::$handle != NULL;
  }

  public static function connect($url, $user=null, $pass=null, $options=null)
  {
    $handle = new \PDO($url, $user, $pass, $options);
    $handle->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    self::$handle = $handle;
  }

  public static function disconnect()
  {
    self::$handle = null;
  }

  public static function getHandle()
  {
    if (self::$handle != NULL)
      return self::$handle;
    else
      throw new DatabaseException("You are trying to access a Database which is not connceted");
  }
}

?>
