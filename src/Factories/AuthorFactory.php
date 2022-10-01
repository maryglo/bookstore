<?php
namespace Bookstore\Factories;

class AuthorFactory {

    protected $conn;
    protected $table = 'authors';

    public function __construct($db)
    {
        $this->conn = $db->getConnection();
    }

    /**
     * Get All authors and books
     */
    public function getAuthorsAndBooks($author = '')
    {
        $sqlString = 'SELECT author.name as author, book.name as book FROM ' . $this->table . ' author LEFT JOIN books book ON author.id = book.author_id';
        $param     = [];

        if (!empty($author)) {
            $sqlString .= ' WHERE author.name ILIKE $1';
            $param      = ["%".$author."%"];
        }

        pg_prepare($this->conn, "authors_and_books", $sqlString);
        $sql = pg_execute($this->conn, "authors_and_books", $param);

        return pg_fetch_all($sql);
    }

    /**
     * Insert author to db
     */
    public function insertAuthor($data)
    {
        $prepared_statement_name = 'author';
        $result = pg_query_params($this->conn, 'SELECT name FROM pg_prepared_statements WHERE name = $1', array($prepared_statement_name));

        $sqlString = 'INSERT INTO ' . $this->table . ' VALUES($1) ON CONFLICT (name) DO UPDATE SET name = EXCLUDED.name RETURNING id';

        if (pg_num_rows($result) == 0) {
            pg_prepare($this->conn, "author", $sqlString);
        }

        $sql = pg_execute($this->conn, "author", $data);

        return pg_fetch_row($sql);
    }
}