<?php

class Library
{
    public static function takeBook($library_card, $book_id)
    {
        $pdo = Db::getConnection();

        $sql = "INSERT INTO `operation` (`library_card`,`book_id`,`status`) 
                VALUES (:library_card,:book_id,:status)";
        $params = [
            ':library_card' => $library_card,
            ':book_id' => $book_id,
            ':status' => 1
        ];

        $query = $pdo->prepare($sql);
        $query->execute($params);

        return $params;
    }

    public static function updateBook($operation_id)
    {
        $pdo = Db::getConnection();

        $params = ['updated record id:' => $operation_id];

        $sql = "UPDATE `operation` SET `status` = 0 , `date_return` = current_timestamp
                WHERE `operation_id` = '$operation_id'";

        $query = $pdo->prepare($sql);
        $query->execute();

        return $params;
    }

    public static function viewHistory()
    {
        $pdo = Db::getConnection();

        $sql = "SELECT `id`, `name`, `genre`, `author`
                FROM `book`
                ORDER BY `id`
                ASC LIMIT 10";

        $query = $pdo->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}


