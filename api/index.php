<?php

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

function getConnection() {
    $dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $dbname="bookstore";

    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbh;
}

$app->post('/login', function () {
    $request = \Slim\Slim::getInstance()->request();
    $body = ($request->getBody());

    $user = json_decode($body);
    if ($user->username == "guest" && $user->password == "secret") {
        echo '{ "login": "true" }';
    }
    else {
        echo '{ "login": "false" }';
    }
});

$app->get('/books', function () {
    $sql = "SELECT * FROM books ORDER BY title";
    try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $books = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($books);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
});

$app->get('/books/:id', function ($id) {
    $sql = "SELECT * FROM books WHERE id = :id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $params = array("id" => $id);
        $stmt->execute($params);
        $book = $stmt->fetchObject();
        $db = null;
        echo json_encode($book);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
});

$app->post('/books', function () {
    $request = \Slim\Slim::getInstance()->request();
    $body = ($request->getBody());
    $book = json_decode($body);

    $sql = "INSERT INTO books(title, author, isbn, publisher, year, price) ".
            "VALUES (:title, :author, :isbn, :publisher, :year, :price)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $params = array(
            "title" => $book->title,
            "author" => $book->author,
            "isbn" => $book->isbn,
            "publisher" => $book->publisher,
            "year" => $book->year,
            "price" => $book->price
        );
        $stmt->execute($params);
        $book->id = $db->lastInsertId();
        $db = null;
        echo json_encode($book);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
});

$app->put('/books/:id', function ($id) {
    $request = \Slim\Slim::getInstance()->request();
    $body = ($request->getBody());
    $book = json_decode($body);

    $sql = "UPDATE books SET title = :title, author = :author, " .
            "isbn = :isbn, publisher = :publisher, year = :year, price = :price ".
            "WHERE id = :id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $params = array(
            "id" => $id,
            "title" => $book->title,
            "author" => $book->author,
            "isbn" => $book->isbn,
            "publisher" => $book->publisher,
            "year" => $book->year,
            "price" => $book->price
        );
        $stmt->execute($params);
        $db = null;
        echo json_encode($book);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
});

$app->delete('/books/:id', function ($id) {
    //$request = \Slim\Slim::getInstance()->request();
    //$body = ($request->getBody());
    //$book = json_decode($body);

    $sql = "DELETE FROM books WHERE id = :id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $params = array(
            "id" => $id
        );
        $stmt->execute($params);
        $db = null;
		echo json_encode(null);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
});

$app->run();
