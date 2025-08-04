<?php

function connect_database() : PDO {
    $database = new PDO("mysql:host=127.0.0.1;dbname=app-database","root","root");
    return $database;
}

//Create


// function create_user(string $Utilisateur_id, string $email,string $password) : int | null {
//     $database = connect_database();
//     // TODO
//         $request = $database->prepare("INSERT INTO Utilisateur (name, email, password) VALUES (?, ?, ?)")
//         $isSuccesful = $request->execute([$Utilisateur_id, $email, password_hash($password, PASSWORD_DEFAULT)]);
//        if($isSuccesful){
//            $Utilisateur_id = $database->lastInsertId();
//            return $Utilisateur_id;
//       }else{
//        return false;
//     }
// }
// }