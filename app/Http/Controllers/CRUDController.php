<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aluno;
use App\Nota;
use App\Endereco;
use Validator;
use Illuminate\Validation\Rule;


class CRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
	
		$aluno=null;
		$erro="";
		
		if(!empty($request->get('busca'))){
			if($request->get('escolha') == "cpf"){
				$cpf = str_replace ('.','', $request->get('busca'));
				$cpf = str_replace ('-','', $cpf);
				$alunos = Aluno::where('cpf', '=', $cpf)->get();
			}else if($request->get('escolha') == "nome"){
				$alunos=Aluno::where('nome', '=', $request->get('busca'))->get();	
			}else {
				$alunos=Aluno::where('matricula', '=', $request->get('busca'))->get();
			}
			
			if ($alunos->isEmpty()){
				$erro= "Houve um erro ao realizar a busca.";
			}else{
				$aluno=$alunos[0];
				
				$notaMedia= Nota::where('notas.alunos_id', '=', $aluno->id)->select('notas.valor')->get();
				
				$notaMedia=$notaMedia[0]['valor'];
				
				$enderecos=Endereco::where('enderecos.id', '=', $aluno->enderecos_id)
							->select('enderecos.logradouro','enderecos.numero','enderecos.bairro')->get();
							
				$endereco=$enderecos[0];
				
				
				return view('crud_capgov.index',compact('aluno','notaMedia','endereco','erro'));
			}
		}
		
		return view('crud_capgov.index',compact('aluno','erro'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {	
        return view('crud_capgov.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {	 
	
		$cpf = str_replace ('.','', $request->get('cpf'));
		$cpf = str_replace ('-','', $cpf);
		$request->merge(['cpf' => $cpf]);
			
		$messages = [
			'nome.required'    => 'O nome deve ser registrado',
			'nome.max'    => 'Você estourou o limite de 255 dígitos para nome',
			'cpf.size'    => 'O CPF deve conter 11 dígitos',
			'cpf.required'    => 'CPF deve ser registrado',
			'cpf.unique'    => 'CPF já existente',
			'matricula.max'    => 'Matrícula deve conter menos de 10 dígitos',
			'matricula.required'    => 'Matrícula deve ser registrada',
			'matricula.regex'    => 'Matrícula deve conter apenas números',
			'lancaNota.max'    => 'A média deve ser menor que 10',
			'lancaNota.max'    => 'A média deve ser menor que 10',
			'lancaNota.min'    => 'A média deve ser maior ou igual a 0',
			'lancaNota.numeric'    => 'Nota deve conter apenas números',
			'lancaNota.regex'    => 'Nota deve conter o formato [2].[n]',
			'rua.required'    => 'O endereço deve ser registrado',
			'rua.max'    => 'Você estourou o limite de 255 dígitos endereço',
			'numero.required'    => 'O número de sua residência deve ser registrado',
			'numero.max'    => 'Você estourou o limite de 45 dígitos para número',
			'numero.regex'    => 'O número de sua residência deve conter apenas números',
			'bairro.required'    => 'O bairro deve ser registrado',
			'bairro.max'    => 'Você estourou o limite de 255 dígitos para bairro',
		];
		
		$this->validate($request, [
			'nome'=>'required|max:225',
			'cpf'=>'required|size:11|regex:/^[0-9]+$/| unique:alunos,cpf',
			'matricula' => 'required|max:10|regex:/^[0-9]+$/',
			'lancaNota'=>'required|numeric|min:0|max:10|regex:/^[0-9]{1,2}([.,][0-9]+){0,1}$/',
			'rua'=>'required|max:225',
			'numero'=>'required|max:45|regex:/^[0-9]+$/',
			'bairro'=>'required|max:225',
		],$messages);
	
	
		
		$crudEndereco = new Endereco([
          'logradouro' => $request->get('rua'),
          'numero' => $request->get('numero'),
		  'bairro' => $request->get('bairro')
        ]);
        $crudEndereco->save();

		$enderecos_id=Endereco::where('logradouro', '=',$request->get('rua'))->
										where('numero', '=', $request->get('numero'))->
										where('bairro', '=', $request->get('bairro'))->select('id')->get();
		
		  
		$crudAluno = new Aluno([
          'nome' => $request->get('nome'),
          'matricula' => $request->get('matricula'),
		  'cpf' => $cpf,
		  'enderecos_id' => $enderecos_id[0]['id']
		  
        ]);
		
        $crudAluno->save();
		
		$alunos_id=Aluno::where('cpf', '=', $cpf)->
						  where('enderecos_id', '=', $enderecos_id[0]['id'])->select('id')->get();
		
			
		$soma=0;
		$i=1;
		while ($request->get("nota".strval($i)) != ""){
			$soma+=str_replace (',','.', $request->get("nota".strval($i)));
			$i++;
		}
		
		if($i-1==0){
			$media=0;
		}else{
			$media= $soma / ($i-1);
		}
			
		$crudNotaMedia = new Nota([
			  'valor' => round($media,1),
			  'alunos_id' => $alunos_id[0]['id']
		]);
			
		$crudNotaMedia->save();
	
        return redirect('/crud_capgov');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id=null)
    {
		//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

		
        $crud_aluno = Aluno::find($id);
		$crud_aluno->nome = $request->get('nome');
		$cpf = str_replace ('.','', $request->get('cpf'));
		$cpf = str_replace ('-','', $cpf);
		$request->merge(['cpf' => $cpf]);
		$crud_aluno->cpf = $request->get('cpf');
		$crud_aluno->matricula = $request->get('matricula');
		
		$crud_endereco = Endereco::find($crud_aluno->enderecos_id);
		$crud_endereco->logradouro=$request->get('rua');
		$crud_endereco->numero=$request->get('numero');
		$crud_endereco->bairro=$request->get('bairro');
		
		$busca_nota= Nota::where('notas.alunos_id', '=', $id )->select('notas.id')->get();
		$idNota = $busca_nota[0]{'id'};
		$crud_nota = Nota::find($idNota);
		$crud_nota->valor= round($request->get('nota'),1);
		
				
		$mensagens = [
			'nome.required'    => 'O nome deve ser registrado',
			'nome.max'    => 'Você estourou o limite de 255 dígitos para nome',
			'cpf.size'    => 'O CPF deve conter 11 dígitos',
			'cpf.required'    => 'CPF deve ser registrado',
			'cpf.unique'    => 'CPF já existente',
			'matricula.max'    => 'Matrícula deve conter menos de 10 dígitos',
			'matricula.required'    => 'Matrícula deve ser registrada',
			'matricula.regex'    => 'Matrícula deve conter apenas números',
			'nota.max'    => 'A média deve ser menor que 10',
			'nota.max'    => 'A média deve ser menor que 10',
			'nota.min'    => 'A média deve ser maior ou igual a 0',
			'nota.numeric'    => 'Nota deve conter apenas números',
			'nota.regex'    => 'Nota deve conter o formato [2].[n]',
			'rua.required'    => 'O endereço deve ser registrado',
			'rua.max'    => 'Você estourou o limite de 255 dígitos endereço',
			'numero.required'    => 'O número de sua residência deve ser registrado',
			'numero.max'    => 'Você estourou o limite de 45 dígitos para número',
			'numero.regex'    => 'O número de sua residência deve conter apenas números',
			'bairro.required'    => 'O bairro deve ser registrado',
			'bairro.max'    => 'Você estourou o limite de 255 dígitos para bairro',
		];
		
		$this->validate($request, [
			'nome'=>'required|max:225',
			'cpf'=>'required|size:11|regex:/^[0-9]+$/| unique:alunos,cpf,'.$id,
			'matricula' => 'required|max:10|regex:/^[0-9]+$/',
			'nota'=>'required|numeric|min:0|max:10|regex:/^[0-9]{1,2}([.,][0-9]+){0,1}$/',
			'rua'=>'required|max:225',
			'numero'=>'required|max:45|regex:/^[0-9]+$/',
			'bairro'=>'required|max:225',
		],$mensagens);

		$crud_aluno->save();
		$crud_endereco->save();
		$crud_nota->save();
		
        return redirect('/crud_capgov');
    }
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		
		$crudAluno = Aluno::find($id);
		$crudEndereco = Endereco::find($crudAluno->enderecos_id);
		$notaMedia= Nota::where('notas.alunos_id', '=', $id);
		$notaMedia->delete();
		$crudAluno->delete();
		$crudEndereco->delete();
		
		return redirect('/crud_capgov');
    }
	
	
	//criar tela de apresentação de notas
	public function notas()
    {
	  $busca = Aluno::join('notas', 'alunos.id', '=', 'notas.alunos_id')
            ->select('alunos.nome', 'notas.valor')
			->orderBy('notas.valor', 'dsc')
            ->get();
		
		if(sizeOf($busca) == 0){
			$media=0;
			$maior="Nenhum aluno registrado";
			$menor="Nenhum aluno registrado";
		}else{
			$soma=0;
			$maior=$busca[0]['nome'];
			$menor=$busca[0]['nome'];
			foreach ($busca as $notas){
				$soma+=$notas->valor;
				if($notas->valor > $maior){
					$maior=$notas->nome;
				}
				if($notas->valor < $menor){
					$menor=$notas->nome;
				}
			}
			$media= $soma / sizeOf($busca);	
		}
			
      return view('crud_capgov.notas', compact('busca','media','maior','menor'));
    }
	
}





