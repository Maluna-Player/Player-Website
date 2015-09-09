<?php

class DbConnection
{
    public static function getPDO()
    {
        try
        {
            $pdo = new PDO('mysql:host=localhost;dbname=player_db;charset=utf8', 'root', '',
                            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }

        return $pdo;
    }
}
