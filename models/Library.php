<?php

class Library
{
    public static function takeBook($library_card, $book_id)
    {
        $sql = "INSERT INTO operation (library_card, book_id, status) 
                VALUES (:library_card, :book_id, :status)";
        $params = [
            ':library_card' => $library_card,
            ':book_id' => $book_id,
            ':status' => 1
        ];

        $query = Db::getConnection()->prepare($sql);
        $query->execute($params);

        return $params;
    }

    public static function returnBook($operation_id)
    {
        $sql = "UPDATE operation SET status = NULL, date_return = current_timestamp
                WHERE operation_id = '$operation_id'";

        $query = Db::getConnection()->prepare($sql);
        $query->execute();

        return $operation_id;
    }

    public static function viewHistory($library_card)
    {
        $sql = "SELECT u.name, u.surname, b.name AS book_name, b.genre, b.author 
                FROM user u
                JOIN operation o
                    ON o.library_card = u.library_card
                JOIN book b
                    ON b.id = o.book_id
                WHERE o.status = 1 AND u.library_card = '$library_card'
                ORDER BY o.operation_id ASC";

        $query = Db::getConnection()->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS);
    }

    public static function checkBook($library_card, $book_id)
    {
        $sql = "SELECT COUNT(*) AS count FROM operation 
                WHERE status = 1 AND library_card = '$library_card' AND book_id = '$book_id'";

        $query = Db::getConnection()->prepare($sql);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

}


