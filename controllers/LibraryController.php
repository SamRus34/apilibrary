<?php
include_once ROOT . '/models/Library.php';
header('Content-type: application/json');

class LibraryController
{
    public static function actionTake($library_card, $book_id)
    {
        $checkList = Library::checkBook($library_card, $book_id);

        if (array_sum($checkList) == 0) {
            Library::takeBook($library_card, $book_id);
        } else {
            return [print_r(json_encode('Неудача. Вы уже взяли эту книгу!', JSON_UNESCAPED_UNICODE))];
        }
        return [print_r(json_encode('Успех! Вы взяли книгу.', JSON_UNESCAPED_UNICODE))];

    }

    public static function actionReturn($operation_id)
    {
        $returnBook = Library::returnBook($operation_id);

        return [print_r(json_encode('Вы вернули книгу!', JSON_UNESCAPED_UNICODE))];

    }

    public static function actionView()
    {
        $bookList = Library::viewHistory();

        echo json_encode('Список книг и читателей, взявших их: ',JSON_UNESCAPED_UNICODE);
        echo json_encode($bookList, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
        return true;

    }

    public static function actionCheck($library_card, $book_id)
    {
        $returnBook = Library::checkBook($library_card, $book_id);

        print_r($returnBook);
        return true;

    }

}