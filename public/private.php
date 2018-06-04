<?php 
if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || $_SERVER['PHP_AUTH_USER'] !== 'demo' || $_SERVER['PHP_AUTH_PW'] !== 'demo') {
 
    header("WWW-Authenticate: Basic realm=\"Secure Page\"");
    header("HTTP\ 1.0 401 Unauthorized");
    echo 'No soup for you';
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Basic HTTP Authentication</title>
</head>
<body>
 
<h1>Secure Page</h1>
 
<p>This is a page with secure content...</p>
 
</body>
</html>
