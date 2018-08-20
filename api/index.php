<?php
header('content-type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
require 'class.api.php';

$API = new api();

$post = file_get_contents("php://input");
$post = json_decode($post, 1);
$res = array();

if (!is_array($post)) {
	$post = $_POST;
}

$_POST = $post;

if (isset($post['acao'])) {

	$res = $API->{$post['acao']}($post);

} else {

	$res = $post;
}

echo json_encode($res);
// var_dump($res);

?>