<?php

require_once 'serverconfig.php';



define('PROTOCOL', (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://');

$G_parts = explode('/', $_SERVER['REQUEST_URI']);

$G_global_url = $_SERVER['SERVER_NAME'];
$documentRoot = $_SERVER['DOCUMENT_ROOT'];

if (DOMAIN_START_PATH == 1) {
    $G_global_url = $_SERVER['SERVER_NAME'] . '/' . $G_parts[DOMAIN_START_PATH];
    
    $documentRoot = $_SERVER['DOCUMENT_ROOT'] . '/' . $G_parts[DOMAIN_START_PATH];
   
}

$G_global_url = PROTOCOL . $G_global_url . '/' ;
$documentRoot = $documentRoot . '/';



Define("URL", $G_global_url);
Define('ROOT_PATH', $documentRoot);
Define("VERSION", 6);

Define('ADMIN_UPLOADS_PATH',ROOT_PATH.'admin/uploads/');
Define('ADMIN_UPLOADS_URL',URL.'admin/uploads/');
function redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);
    Exit();
}
