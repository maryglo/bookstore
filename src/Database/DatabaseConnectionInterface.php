<?php
namespace Bookstore\Database;

interface DatabaseConnectionInterface {
    public static function getInstance(string $db_connection);
}