<?php 

require_once("vendor/autoload.php");

use \Slim\Slim;
use \Grg\Page;

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

$app->run();

 ?>