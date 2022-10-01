<?php
namespace Bookstore\Database;

require 'src/Database/DatabaseConnectionInterface.php';
use Bookstore\Database\DatabaseConnectionInterface;

class PgSqlConnection implements DatabaseConnectionInterface {
    private static $dbInstance = null;
    private $conn;
    private static $_connection_type = 'pgsql';

    private function __construct($config)
    {
        $this->conn = pg_connect('host=' . $config['host'] . ' dbname=' . $config['db'] .' user=' . $config['username'] . ' password=' . $config['password']);
    }

    private function __clone(){}

    public static function getInstance($db_connection = 'pgsql')
    {
        // Check if database is null
        if ( self::$dbInstance == null  ) {
	    self::$_connection_type = $db_connection;
	    $config = self::getConfig();
	    // Create a new PDO connection
	    try {
	        self::$dbInstance = new self($config);
	    } catch (\Exception $e) {
		echo $e->getMessage();
	    }
	}
        return self::$dbInstance;
    }

    public function getConnection()
    {
        return $this->conn;
    }

    private static function getConfig()
    {
        $config = include 'config/database.php';
        return $config['connections'][self::$_connection_type];
    }
}
