<?php 

session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use \Grg\Page;
use \Grg\PageAdmin;
use \Grg\Model\User;

$app = new Slim;

$app->config('debug', true);

$app->get('/', function() {
    
	$page = new Page();

	$page->setTpl("index");

	// echo "OK";
	// $sql = new Grg\DB\Sql();
	// $results = $sql->select("select * from tb_users");
	// echo json_encode($results);

});

$app->get('/admin', function() {
    
	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("index");

});

$app->get('/admin/login', function() {
    
	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("login");

});

$app->post('/admin/login', function() {

	User::login($_POST["deslogin"], $_POST["despassword"]);

	header("Location: /admin");
	exit;

});

$app->get('/admin/logout', function() {

	User::logout();

	header("Location: /admin/login");
	exit;

});

$app->run();

 ?>