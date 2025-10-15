<?php
$file = 'online.json';
$timeout = 120;
$ip = $_SERVER['REMOTE_ADDR'];
$data = [];
if (file_exists($file)) {
    $data = json_decode(file_get_contents($file), true) ?: [];
}
$now = time();
foreach ($data as $key => $last) {
    if ($now - $last > $timeout) {
        unset($data[$key]);
    }
}
$data[$ip] = $now;
file_put_contents($file, json_encode($data));
echo count($data);
?>