<?php
header('Content-Type: application/json');
echo '<pre>' . json_encode($data, JSON_PRETTY_PRINT) . '</pre>';
?>