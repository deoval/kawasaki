<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class ClienteE extends Eloquent{

    protected $table = 'cliente';
    public $timestamps = false;
    protected $primaryKey = 'id_cliente';
   
}

?>
