<?php
// ================= ENABLE ERRORS (LOCAL ONLY) =================
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ================= SESSION =================
session_start();
header("Content-Type: application/json");

// ================= CONFIG =================
$CLOUDRADIUS_AUTH_URL = "https://cloud10user.oneradius.com/api/auths";

// ================= ROUTER =================
$route  = $_GET["route"] ?? "";
$method = $_SERVER["REQUEST_METHOD"];

// Read JSON body
$input = json_decode(file_get_contents("php://input"), true);

// ================= LOGIN =================
if ($route === "login" && $method === "POST") {

    $username = $input["username"] ?? null;
    $password = $input["password"] ?? null;

    if (!$username || !$password) {
        http_response_code(400);
        echo json_encode(["error" => "Username and password required"]);
        exit;
    }

    $payload = json_encode([
        "username" => $username,
        "password" => $password
    ]);

    $ch = curl_init($CLOUDRADIUS_AUTH_URL);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "Accept: application/json"
        ],
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_TIMEOUT => 15
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        http_response_code(500);
        echo json_encode(["error" => "CloudRadius connection failed"]);
        exit;
    }

    curl_close($ch);

    $data = json_decode($response, true);

    if (!isset($data["status"]) || $data["status"] != 200) {
        http_response_code(401);
        echo json_encode(["error" => "Invalid credentials"]);
        exit;
    }

    // Save session
    $_SESSION["user"]  = $data["user_details"];
    $_SESSION["token"] = $data["token"];

    echo json_encode([
        "success" => true,
        "user"    => $data["user_details"]
    ]);
    exit;
}

// ================= SESSION CHECK =================
if ($route === "session" && $method === "GET") {
    if (!isset($_SESSION["user"])) {
        http_response_code(401);
        exit;
    }

    echo json_encode($_SESSION["user"]);
    exit;
}

// ================= DASHBOARD =================
if ($route === "dashboard" && $method === "GET") {
    if (!isset($_SESSION["user"])) {
        http_response_code(401);
        echo json_encode(["error" => "Not logged in"]);
        exit;
    }

    echo json_encode($_SESSION["user"]);
    exit;
}

// ================= PAY =================
if ($route === "pay" && $method === "POST") {
    echo json_encode([
        "redirectUrl" => "/payment-success.html"
    ]);
    exit;
}

// ================= LOGOUT =================
if ($route === "logout" && $method === "POST") {
    session_destroy();
    echo json_encode(["success" => true]);
    exit;
}

// ================= NOT FOUND =================
http_response_code(404);
echo json_encode(["error" => "API route not found"]);
