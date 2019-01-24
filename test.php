<?php
function getConnection() {
    $dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $dbname="john";

    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbh;
}

$conn = getConnection();

echo '<pre>';
print_r($conn);
echo '</pre>';

$sql = "SELECT * FROM books ORDER BY title";
try {
	$db = getConnection();
	$stmt = $db->query($sql);
	$books = $stmt->fetchAll(PDO::FETCH_OBJ);
	$db = null;
	echo json_encode($books);
} 
catch(PDOException $e) {
	echo '{"error":{"text":'. $e->getMessage() .'}}';
}
?>