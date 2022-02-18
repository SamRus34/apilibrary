<?php
include_once ROOT . '/models/Library.php';
header('Content-type: application/json');

class LibraryController
{
    public static function actionTake($library_card, $book_id)
    {
        $checkDuplicate = Library::checkBook($library_card, $book_id);

        if (array_sum($checkDuplicate) == 0) {
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

    public static function actionView($library_card)
    {
        $bookList = Library::viewHistory($library_card);

        echo json_encode('Список книг, которые взял этот читатель: ',JSON_UNESCAPED_UNICODE);
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