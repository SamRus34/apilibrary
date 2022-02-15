<?php
include_once ROOT . '/models/Library.php';
header('Content-type: application/json');

class LibraryController
{
    public static function actionTake($library_card, $book_id)
    {
        //$getBook = array();
        $getBook = Library::takeBook($library_card, $book_id);

        echo json_encode($getBook,JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
        //return true;

    }

    public static function actionUpdate($operation_id)
    {
        //$returnBook = array();
        $returnBook = Library::updateBook($operation_id);

        echo json_encode($returnBook,JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
        //return true;
    }

    public static function actionView()
    {
        //$bookList = array();
        $bookList = Library::viewHistory();

        echo json_encode($bookList,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
        //return true;
    }

}