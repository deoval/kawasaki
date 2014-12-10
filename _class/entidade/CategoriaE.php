<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class CategoriaE extends Eloquent{

    protected $table = 'categoria';
    public $timestamps = false;
    protected $primaryKey = 'id_categoria'; 

}

?>