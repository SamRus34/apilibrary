<?php

class Db
{
    public static function getConnection()
    {
        $paramsPath = ROOT.'/config/configDb.php';
        $params = include($paramsPath);

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $pdo = new PDO($dsn, $params['user'], $params['password']);

        return $pdo;
    }

}