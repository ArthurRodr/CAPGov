@extends('master')
@section('content')
<div class="divCreate">
	<br>
	<form action="{{url('crud_capgov')}}" method="post">
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
				<input type="text" class="form-control form-control-lg" id="nome" placeholder="Nome" name="nome" value="">
			</div>

			<label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">CPF</label>
			<div class="col-sm-10">
				<input type="text" class="form-control form-control-lg" id="cpf" placeholder="CPF" name="cpf" value="" >
			</div>

			<label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Matrícula</label>
			<div class="col-sm-10">
				<input type="text" class="form-control form-control-lg" id="matricula" placeholder="Matrícula" name="matricula" value="">
			</div>

			<label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Nota</label>
			<div class="col-sm-10">
				<table id="notas"></table>
				<br>
			</div>
										
			<div class="iconplus">
										
				<a href="" data-popup-open="popup-1"><span class="glyphicon glyphicon-plus"></span></a>
										  
			</div>
										
			<label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Rua</label>
			<div class="col-sm-10">
				<input type="text" class="form-control form-control-lg" id="rua" placeholder="Rua" name="rua" value="" >
			</div>

			<label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Número</label>
			<div class="col-sm-10">
				<input type="text" class="form-control form-control-lg" id="numero" placeholder="Número" name="numero" value="" >
			</div>

			<label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Bairro</label>
			<div class="col-sm-10">
				<input type="text" class="form-control form-control-lg" id="bairro" placeholder="Bairro" name="bairro" value="" >
			</div>
										
			<div class="popup" data-popup="popup-1">									
				
				<div class="popup-inner">
					<p id="pNota"><font size="5">Nota</font></p> 
					<input type="text" class="form-control form-control-lg" id="inputNotas" placeholder="Nota" name="lancaNota" value="0.0" >
					<input type="button" id="btnNota" class="btn btn-default" value="OK" >
					<a class="popup-close" data-popup-close="popup-1" href="#">x</a>
				</div>
												
			</div>

		</div>
		<br>
		<div class="salvar">
			<button class="btn btn-default" type="submit"><img class="imgicn" src="{{asset('icones/disq.png')}}" alt="disquete" > Salvar</button>
		</div>
	</form>
	
					
</div>
@endsection