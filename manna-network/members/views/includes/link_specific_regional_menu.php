<?php
echo '<br>in link_specific_regional_menu.php';
//echo $linkInfo->thisLinksRegionalInfo($_GET['link_id'], $_GET['agent_ID']);
echo '<br>$location_id = ', $location_id;
echo '<br>dirname( __FILE__, 5 ) = '. dirname( __FILE__, 5 ).'/manna-configs/db_cfg';
//grab the last entry from log and return hash of timestamp
if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 5 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 5 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 5 ). "/manna-configs/db_cfg/pdo_connect.php");
echo '<br>$username = ', $username;
try {
    $dbh = new PDO('mysql:host=localhost;dbname=orlandor_agents', $username, $password);
  /*  $stmt = $dbh->prepare("SELECT * FROM categories_regional2 where id = ?");
$stmt->execute([$location_id]);
$sth->debugDumpParams();
*/
$sth = $dbh->prepare('SELECT *
    FROM categories_regional2
    WHERE id = :location_id');
$sth->bindParam(':location_id', $location_id, PDO::PARAM_INT);
//$sth->bindValue(':colour', $colour, PDO::PARAM_STR, 12);
$sth->execute();

$sth->debugDumpParams();

foreach ($sth as $row) {
  print_r($row);
}

echo '<br>$row[id] = ', $row['id'];

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
try {
$sth = $dbh->prepare('SELECT *
    FROM categories_regional2
    WHERE id = :location_id');
$sth->bindParam(':location_id', $location_id, PDO::PARAM_INT);
//$sth->bindValue(':colour', $colour, PDO::PARAM_STR, 12);
$sth->execute();

$sth->debugDumpParams();

foreach ($sth as $row) {
  print_r($row);
}

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}






/*
include(dirname( __FILE__, 5 ). "/manna-configs/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 5 ). "/manna-configs/db_cfg/pdo_connect.php");
//SELECT `id`, `name`, `parent`, `lft`, `rgt` FROM `categories_regional2` WHERE 1

$stmt = $mysqli->prepare("SELECT * FROM categories_regional2 where id = ?");
$stmt->execute([$location_id]);
foreach ($stmt as $row) {
  print_r($row);
}

$stmt = $dbh->prepare("SELECT * FROM REGISTRY where name = ?");
$stmt->execute([$_GET['name']]);
foreach ($stmt as $row) {
  print_r($row);
}
*/
/*
$link = mysqli_connect("server", "user", "password", "database"); */

$query = "SQL STATEMENTS;"; /*  first query : Notice the 2 semicolons at the end ! */
$query .= "SQL STATEMENTS;"; /* Notice the dot before = and the 2 semicolons at the end ! */
$query .= "SQL STATEMENTS;"; /* Notice the dot before = and the 2 semicolons at the end ! */
$query .= "SQL STATEMENTS"; /* last query : Notice the dot before = at the end ! */



?>
