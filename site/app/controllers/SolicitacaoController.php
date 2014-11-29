<?php

class SolicitacaoController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	//protected $layout = 'layouts.master';

	public function showWelcome()
	{
		return View::make('hello');
	}



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// get all the cliente
		$solicitacao = Solicitacao::all();
		//$this->layout->content = View::make('cliente.index')->with('cliente', $cliente);

		return View::make('hello')->with('solicitacao', $solicitacao);
	}

}