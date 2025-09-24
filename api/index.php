<?php
header("Content-Type: application/json");

$usersFile = 'users.json';

function getUsers() {
    global $usersFile;
    if (!file_exists($usersFile)) file_put_contents($usersFile, json_encode([]));
    $data = file_get_contents($usersFile);
    return json_decode($data, true);
}

function saveUsers($users) {
    global $usersFile;
    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
}

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// --- GET /users ---
if ($request === "/api/users" && $method === "GET") {
    echo json_encode(getUsers());
    exit;
}

// --- POST /users ---
if ($request === "/api/users" && $method === "POST") {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!isset($input['name']) || !isset($input['email'])) {
        http_response_code(400);
        echo json_encode(["error" => "Faltan datos: name y email"]);
        exit;
    }

    $users = getUsers();
    $newId = $users ? end($users)["id"] + 1 : 1;

    $newUser = [
        "id" => $newId,
        "name" => $input["name"],
        "email" => $input["email"]
    ];

    $users[] = $newUser;
    saveUsers($users);

    http_response_code(201);
    echo json_encode($newUser);
    exit;
}

// --- POST /login ---
if ($request === "/api/login" && $method === "POST") {
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['username'])) {
        http_response_code(400);
        echo json_encode(["error" => "Falta el nombre de usuario"]);
        exit;
    }

    $username = $input['username'];
    $users = getUsers();
    $found = false;

    foreach ($users as $user) {
        if ($user['name'] === $username) {
            $found = true;
            break;
        }
    }

    if ($found) {
        echo json_encode(["success" => true, "message" => "Usuario encontrado"]);
    } else {
        http_response_code(401);
        echo json_encode(["success" => false, "message" => "Usuario no encontrado"]);
    }
    exit;
}

// --- RUTA NO ENCONTRADA ---
http_response_code(404);
echo json_encode(["error" => "Not Found"]);
exit;
