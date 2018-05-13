<?php
/**
 * Created by PhpStorm.
 * User: Diego
 * Date: 01/05/2018
 * Time: 17:39
 */

namespace app\lib;

use PDO;

class DataBase{
    public static function conectar(){

        $pdo = new PDO('mysql:host=localhost;dbname=practicaslim;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        return $pdo;
    }
}
?>