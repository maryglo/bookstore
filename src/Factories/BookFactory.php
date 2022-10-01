<?php
namespace Bookstore\Factories;

class BookFactory {

    protected $conn;
    protected $table = 'books';

    public function __construct($db)
    {
        $this->conn = $db->getConnection();
    }

    /**
     * Insert book to db
     */
    public function insertBooks($authorId, $data)
    {
        $vals = "($1, $2)";
        $prepared_statement_name = 'insert_book';
        $result = pg_query_params($this->conn, 'SELECT name FROM pg_prepared_statements WHERE name = $1', array($prepared_statement_name));

        $sqlString = 'INSERT INTO ' . $this->table . ' (author_id, name) values ' . $vals . ' ON CONFLICT (name, author_id) DO UPDATE SET name = EXCLUDED.name RETURNING id';
        if (pg_num_rows($result) == 0) {
            pg_prepare($this->conn, $prepared_statement_name, $sqlString);
        }

        $ids = [];
        foreach($data as $book) {
            $sql = pg_execute($this->conn, $prepared_statement_name, [$authorId, $book]);
            $id = pg_fetch_row($sql);
            $ids[] = $id ? $id[0] : $id;
        }

        return $ids;
    }
}