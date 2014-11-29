<?php

	class Solicitacao extends Eloquent
	{
		protected $table = 'solicitacao';

		public $timestamps = false;

		protected $primaryKey = 'id_solicitacao';
	}