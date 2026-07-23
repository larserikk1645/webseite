<?php
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["text"]) || trim($data["text"]) === "") {
    http_response_code(400);
    echo json_encode(["error" => "Kein Text"]);
    exit;
}

$commentsFile = "comments.json";
$comments = json_decode(file_get_contents($commentsFile), true);

$comments[] = [
    "name" => $data["name"] ?: "Gast",
    "text" => $data["text"],
    "time" => date("d.m.Y H:i:s")
];

file_put_contents($commentsFile, json_encode($comments, JSON_PRETTY_PRINT));

echo json_encode(["ok" => true]);
?>
