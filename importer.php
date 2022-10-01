<?php
require 'src/Processors/DirectoryProcessor.php';
require 'src/Factories/BookFactory.php';
require 'src/Factories/AuthorFactory.php';
require 'src/Database/PgSqlConnection.php';

use Bookstore\Factories\{BookFactory, AuthorFactory};
use Bookstore\Processors\DirectoryProcessor;
use Bookstore\Database\PgSqlConnection;

$dh = new DirectoryProcessor();
$data = $dh->getDirectoryAndFiles('public/bookstore');
$db = PgSqlConnection::getInstance();
$book   = new BookFactory($db);
$author = new AuthorFactory($db);

foreach($data as $item) {
    if ($item) {
        foreach($item as $key => $books) {
            $author_id = $author->insertAuthor([$key]);

            if ($author_id) {

                echo "<p>Successfully inserted / updated author " . $key . "</p>";

                $res = $book->insertBooks($author_id[0], $books);
            }
        }
    }
}
?>