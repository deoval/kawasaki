<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Cliente extends Eloquent{

    protected $table = 'cliente';
    public $timestamps = false;
    protected $primaryKey = 'id_cliente';
}

?>
