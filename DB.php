<?php 

class DB {
	
	private static function connect() {

        $pdo = new PDO('mysql:host=webdev.cse.buffalo.edu;dbname=wandika;charset=utf8', 'wandika_user', 'wandika19!');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }


    public static function query($query, $params = array()){
        $statement = self::connect()->prepare($query);
        $statement->execute($params);
        /*$data = $statement->fetchAll();
        return $data;*/
    }
}



 ?>