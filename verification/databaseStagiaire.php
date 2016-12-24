<?php

// We will use PDO to execute database stuff. 
// This will return the connection to the database and set the parameter
// to tell PDO to raise errors when something bad happens
function getDbConnection() {
  $db = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER . ";charset=utf8", DB_USER, DB_PASSWORD);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
  return $db;
}

// This is the 'search' function that will return all possible rows starting with the keyword sent by the user
function serachForKeyword($keyword) {
  
    $db = getDbConnection();
    // $stmt = $db->prepare("SELECT name_en as country FROM `countries` WHERE name_en LIKE ? ORDER BY country");
    $stmt = $db->prepare("SELECT CONCAT(nom,' ', prenom) as name FROM `stagiaire` WHERE old = 0 AND (nom LIKE ? OR prenom LIKE ?) ORDER BY name");

    $keyword = $keyword . '%';
	$stmt->bindParam(2, $keyword, PDO::PARAM_STR, 100);
    $stmt->bindParam(1, $keyword, PDO::PARAM_STR, 100);


    $isQueryOk = $stmt->execute();
  
    $results = array();

    
    if ($isQueryOk) {
      
      $results = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
	
    } else {
      trigger_error('Error executing statement.', E_USER_ERROR);
    }

return $results;
}

?>