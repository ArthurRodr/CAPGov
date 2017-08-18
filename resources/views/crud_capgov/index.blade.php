@extends('master')
@section('content') 

<div id="divRowBusca">
	<form action="{{action('CRUDController@index')}}" method="get">
		{{csrf_field()}}
		<div class="row">
			<div id="buscaDiv" class="col-sm-5">
				<input type="text" class="form-control form-control-lg" id="cpfBusca" class="busca" placeholder="Digite um CPF" name="busca">
			</div>
			<div class="col-sm-2">
				<select class= "selectclas" id="escolha" name="escolha" >
					<option value="cpf">CPF</option>
					<option value="nome">Nome</option>
					<option value="matricula">Matricula</option>
				</select>
			</div>
			<div class="col-sm-1">
				<button class="btn btn-default" id="btnBuscar" type="submit">
					<img class="imgicn" src="{{asset('icones/disq.png')}}" alt="disquete" >  Buscar
				</button>
			</div>
		</div>
	</form>
	@if($aluno==null)
		
		@if($erro!="")
			<ul id ="ulErro" class="list-group">
				<li class="list-group-item list-group-item-warning">{{$erro}}</li>
			</ul>
		@endif
</div>

	@elseif($aluno!=null)

		<div class="divCreate">
			<br>
			<form action="{{action('CRUDController@update', $aluno->id )}}" method="PUT">
				<div class="form-group row"> 
					{{csrf_field()}}
								
					@if($errors->any())
						<ul class="list-group">
							@foreach($errors->all() as $error)
								<li class="list-group-item list-group-item-warning">{{$error}}</li>
							@endforeach
						</ul>
					@endif
								
					<label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Nome</label>
					<div class="col-sm-10">
						<input type="text" class="form-control form-control-lg" id="nome" placeholder="Nome" name="nome" value="{{$aluno->nome}}">
					</div>

					<label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">CPF</label>
					<div class="col-sm-10">
						<input type="text" class="form-control form-control-lg" id="cpf" placeholder="CPF" name="cpf" value="{{$aluno->cpf}}">
					</div>

					<label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Matrícula</label>
					<div class="col-sm-10">
						<input type="text" class="form-control form-control-lg" id="matricula" placeholder="Matrícula" name="matricula" value="{{$aluno->matricula}}">
					</div>

					<label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Nota (Média)</label>
					<div class="col-sm-10">
						<input type="text" class="form-control form-control-lg" id="nota" placeholder="Nota" name="nota" value="{{$notaMedia}}">
					</div>

					<label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Rua</label>
					<div class="col-sm-10">
						<input type="text" class="form-control form-control-lg" id="rua" placeholder="Rua" name="rua" value="{{$endereco->logradouro}}">
					</div>

					<label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Número</label>
					<div class="col-sm-10">
						<input type="text" class="form-control form-control-lg" id="numero" placeholder="Número" name="numero" value="{{$endereco->numero}}">
					</div>

					<label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Bairro</label>
					<div class="col-sm-10">
						<input type="text" class="form-control form-control-lg" id="bairro" placeholder="Bairro" name="bairro" value="{{$endereco->bairro}}">
					</div>

				</div>
				<br>
				<div class="divbuttons">
					<div class="col-sm-2">
						<button class="btn btn-default" type="submit">
							<img class="imgicn" src="{{asset('icones/edit.png')}}" alt="editar" > Editar
						</button>
					</div>

			</form>
								
					<div class="col-sm-2">
						<a href="{{action('CRUDController@destroy', $aluno->id )}}" class="btn btn-default">
							<img class="imgicn" src="{{asset('icones/delete.png')}}" alt="deletar" >  Deletar
						</a>
					</div>
				</div>
						
					
		</div>
	@endif
			
@endsection