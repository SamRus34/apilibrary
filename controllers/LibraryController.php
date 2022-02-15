<?php
include_once ROOT . '/models/Library.php';
header('Content-type: application/json');

class LibraryController
{
    public static function actionTake($library_card, $book_id)
    {
        $getBook = Library::takeBook($library_card, $book_id);

        echo json_encode($getBook,JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);

    }

    public static function actionReturn($operation_id)
    {
        $returnBook = Library::returnBook($operation_id);

        echo json_encode($returnBook,JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);

    }

    public static function actionView()
    {
        $bookList = Library::viewHistory();

        echo json_encode($bookList,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

    }

}