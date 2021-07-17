<?php
$FirstName = $LastName =  $PersonalNumber = $Email = $HashedPassword = $StatusId = '';
$hasError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    (empty($_POST['FirstName'])) ? $FirstNameError = 'სახელი აუცილებელია':$FirstName = $_POST['FirstName'];

    (empty($_POST['LastName'])) ? $LastNameError = 'გვარი აუცილებელია ': $LastName = $_POST['LastName'];

    (empty($_POST['PersonalNumber'])) ? $PersonalNumberError = 'ID აუცილებელია' : $PersonalNumber = $_POST['PersonalNumber'];

    (empty($_POST['Email'])) ? $EmailError = 'Email აუცილებელია' : $Email = $_POST['Email'];

    (empty($_POST['Password'])) ? $PasswordError = 'პაროლი აუცილებელია' : $HashedPassword = password_hash($_POST['Password'], PASSWORD_DEFAULT);

    (empty($_POST['StatusId'])) ? $StatusIdError = 'სტატუსის ID აუცილებელია':$StatusId = $_POST['StatusId'];
}

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'gtu123';

$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo 'Error!: ' . $e->getMessage();
}


if (!(isset($FirstNameError, $LastNameError, $PersonalNumberError, $EmailError, $PasswordError, $StatusIdError))) {

    $sql = "SELECT * FROM users WHERE Email = :Email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['Email' => $Email]);
    $existingEmail = $stmt->fetch(PDO::FETCH_BOUND);

    if ($existingEmail) {
        $EmailError = 'Email უკვე რეგისტრირებულია';
        $hasError = true;
    }

    $sql = "SELECT * FROM users WHERE PersonalNumber = :PersonalNumber LIMIT 1";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['PersonalNumber' => $PersonalNumber]);
    $existingPersonalNumber = $stmt->fetch(PDO::FETCH_BOUND);

    if ($existingPersonalNumber) {
        $PersonalNumberError = 'ID უკვე გამოყენებულია';
        $hasError = true;
    }
}

if (!$hasError) {
    $sql = "INSERT INTO users (FirstName, LastName, PersonalNumber, Email, HashedPassword, StatusId) VALUES (:FirstName, :LastName, :PersonalNumber, :Email, :HashedPassword, :StatusId)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['FirstName' => $FirstName, 'LastName' => $LastName, 'PersonalNumber' => $PersonalNumber, 'Email' => $Email, 'HashedPassword' => $HashedPassword, 'StatusId' => $StatusId]);
    $submissionSuccess = true;  
}

include 'index.php';