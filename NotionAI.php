<?php
function notionai($Cookie,$spaceId,$Text) {
$url = 'https://www.notion.so/api/v3/getCompletion';
$headers = [
    'Accept: application/x-ndjson',
    'Content-Type: application/json',
    'Cookie: token_v2='.$Cookie
    ];
$data = [
    "id" => "ByMxmilu",
    "context" => [
        "type" => "helpMeWrite",
        "pageTitle" => "AI",
        "previousContent" => "",
        "restContent" => "",
        "prompt" => $Text,
    ],
    "model" => "openai-3",
    "spaceId" => $spaceId,
    "isSpacePermission" => false,
    "inferenceReason" => "writer",
];
$data = json_encode($data);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
//echo $response;
$pattern = '/"completion":"(.*?)"/';
preg_match_all($pattern, $response, $matches);
$completions = $matches[1];
$output = implode("", $completions);
return $output;
}