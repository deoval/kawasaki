<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
	'driver'    => 'mysql',
	'host'      => 'appmobi.in',
	'database'  => 'appmobi_moto',
	'username'  => 'appmobi_moto',
	'password'  => 'anb2014',
	'charset' => "utf8",
	'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

/*use Illuminate\Database\Eloquent\Model as Eloquent;

class ClienteEloquent extends Eloquent{

    protected $table = 'cliente';
    public $timestamps = false;
    protected $primaryKey = 'id_cliente';
   
}

$clienteelo = ClienteEloquent::all();

 var_dump($clienteelo);*/