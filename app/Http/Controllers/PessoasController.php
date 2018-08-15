<?php

namespace App\Http\Controllers;

use\Validator;
use App\Pessoa;
use App\Telefone;
use Illuminate\Http\Request;

class PessoasController extends Controller
{
	private $telefones_controller;
	private $pessoa;

		public function __construct(TelefonesController $telefones_controller)
		{
			$this->telefones_controller = $telefones_controller;
			$this->pessoa = new Pessoa();
 
		}


    public function index($letra)
    {
    	$list_pessoas = Pessoa::indexLetra($letra);
    	return view('contatos.index', [
    		'pessoas' => $list_pessoas,
    		'criterio' => $letra
    	]);
    }

    public function buscar(Request $request)
    {
    	$pessoas = Pessoa::where('nome', 'LIKE', '%' . $request->criterio . '$')->get();
    	return view('contatos.index', [
    		'pessoas' => $pessoas, 
    		'criterio' => $request->criterio
    	]);
    	
    }

    public function novoview()
    {
    	return view('contatos.create');
    }

    public function store(Request $request)

    {

    	$validacao = $this->validacao($request->all());

    	if ($validacao->fails()){
    		return redirect()->back()
    			->withErrors($validacao->errors())
	   			->withInput($request->all());
    	}



    	$pessoa = Pessoa::create($request->all());
    	if ($request->ddd && $request->telefone){
    		$telefone = new Telefone();
    		$telefone->ddd = $request->ddd;
    		$telefone->telefone = $request->telefone;
    		$telefone->pessoa_id = $pessoa->id;
    		$this->telefones_controller->store($telefone);
    	}
    	return redirect('/pessoas')->with('messager', 'Pessoa criada com sucesso');
    }

    public function excluirView($id)
    {

    	return view('contatos.delete', [
    		'pessoa' => $this->getPessoa($id)
    	]);

    }

    public function destroy($id)
    {
    	$this->getPessoa($id)->delete();
    	return redirect(url('pessoas'))->with('success', 'Excluido');
    }


    public function editarView($id)
    {
    	return view ('contatos.edit', [
    		'pessoa' => $this->getPessoa($id)
    	]);
    	//var_dump($this->pessoa->find($id)->nome);
    }

    public function update(Request $request)

    {
    	$validacao = $this->validacao($request->all());

    	if ($validacao->fails()){
    		return redirect()->back()
    			->withErrors($validacao->errors())
	   			->withInput($request->all());
    	}


    	$pessoa = $this->getPessoa($request->id);
    	$pessoa->update($request->all());
    	return redirect('/pessoas');
    }

    protected function getPessoa($id)
    {
    	return $this->pessoa->find($id);
    } 

    private function validacao($data)
    {
    	if(array_key_exists('ddd', $data) && array_key_exists('telefone', $data)) {
    	if ($data['ddd'] || $data['telefone']) {
    		$regras['ddd'] = 'required|size:2';
    		$regras['telefone'] = 'required';
    	}
    }
    	$regras['nome'] = 'required|min:3';
    	

    	$mensagens = [
    		'nome.required' => 'campo nome e obrigatorio',
    		'nome.min' => 'Campo nome deve ter ao menos 3 letras',
    		'ddd.required' => 'campo ddd e obrigatorio',
    		'ddd.size' => 'campo ddd deve ter 2 digitos',
    		'telefone.required' => 'campo telefone e obrigatorio'
    	];

    	return Validator::make($data, $regras, $mensagens);
    }
}
