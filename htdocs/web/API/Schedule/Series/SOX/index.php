<?php

// CORS Headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');

// Cache Control Headers
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Set Content-Type
header("Content-Type: text/html; charset=UTF-8");

// Start Execution Timer
$startTime = microtime(true);

// Define Allowed Files for Inclusion
$allowedFiles = ['schedule.php', 'index.html']; // Extend if needed

// Default File to Load
$file = 'schedule.php';

// Check if a custom file is requested via GET
if (isset($_GET['file'])) {
    $requestedFile = basename($_GET['file']); // Prevent directory traversal

    // Validate file selection
    if (in_array($requestedFile, $allowedFiles)) {
        $file = $requestedFile;
    } else {
        http_response_code(400);
        die("Invalid file requested.");
    }
}

// Check if file exists before attempting to read
if (!file_exists($file)) {
    http_response_code(404);
    die("Error: Requested file not found.");
}

// Read and output file contents
$pageContent = file_get_contents($file);
echo $pageContent;

// Execution Time Logging
$executionTime = round((microtime(true) - $startTime) * 1000, 2);
error_log("PHP script executed in {$executionTime} ms");

?>
