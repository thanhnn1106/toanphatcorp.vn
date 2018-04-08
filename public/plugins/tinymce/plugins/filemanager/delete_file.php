<?php

session_start();
if($_SESSION["verify"] != "FileManager4TinyMCE") die('forbiden');
include 'config.php';
include('utils.php');

$path=$_POST['path'];
$path_thumbs=$_POST['path_thumb'];

if(strpos($path,$upload_dir)===FALSE) die('wrong path');

unlink($path);
if (file_exists($abs_root_path.$path_thumbs))
unlink($abs_root_path.$path_thumbs);

?>
