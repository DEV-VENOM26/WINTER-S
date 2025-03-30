<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin_panel";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // جلب جميع المستخدمين
        $stmt = $conn->prepare("SELECT username, coins FROM users");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($users);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // تحديث عدد الـ coins
        $data = json_decode(file_get_contents("php://input"));
        $stmt = $conn->prepare("UPDATE users SET coins = :coins WHERE username = :username");
        $stmt->bindParam(':coins', $data->coins);
        $stmt->bindParam(':username', $data->username);
        $stmt->execute();
        echo json_encode(["status" => "success"]);
    }

} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
