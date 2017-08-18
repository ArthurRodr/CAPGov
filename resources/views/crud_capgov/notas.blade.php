@extends('master')
@section('content')
<div class= "divNotas">
	<h4>Média da turma:</h4>
	<p>{{round($media,1)}}</p>
	
	<div>
		<h4>Melhor Aluno:</h4>
		<p>{{$maior}}</p>
	</div>
	<div class="piorAluno">
		<h4>Pior Aluno:</h4>
		<p>{{$menor}}</p>
	</div>
	
	
	<h4>Alunos:</h4>
	<table>
		<tr id="trNota">
			<th id="thNome">Nome</th>
			<th>Nota</th>
		</tr>
		@foreach($busca as $notaAlunos)
		  <tr>
			<td>{{$notaAlunos->nome}}</td>
			<td id="tdNota">{{$notaAlunos->valor}}</td>
		  </tr>
		@endforeach
	</table>
</div>
@endsection