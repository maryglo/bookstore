<?php
    require 'src/Factories/AuthorFactory.php';
    require 'src/Database/PgSqlConnection.php';
    use Bookstore\Factories\AuthorFactory;
    use Bookstore\Database\PgSqlConnection;

    $db = PgSqlConnection::getInstance();
    $author = new AuthorFactory($db);
    $authorParam = isset($_GET['author']) ? $_GET['author'] : '';
    $data = $author->getAuthorsAndBooks($authorParam);