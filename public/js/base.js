    $(document).ready(function () {
		
		//controlador navbar
        var url = window.location.href.split('?')[0];
		
        $('ul.nav a[href="'+ url +'"]').parent().addClass('active');
		
        $('ul.nav a').filter(function() {
             return this.href == url;
        }).parent().addClass('active');
	   

		//mascara para CPF
		var $campoCpf = $("#cpf,#cpfBusca");
        $campoCpf.mask('000.000.000-00', {reverse: true});
		
		
		//controla campo de busca para os dados
		$("#escolha").val("cpf");
		$('#escolha').change(function(){
			var selecionado=document.getElementById('escolha').value;
			
			if(selecionado == "cpf"){
				document.getElementById("buscaDiv").innerHTML = 
					'<input type="text" class="form-control form-control-lg" id="cpfBusca" placeholder="Digite um CPF" name="busca">';
			}
			else if(selecionado == "matricula"){
				document.getElementById("buscaDiv").innerHTML = 
					'<input type="number" class="form-control form-control-lg" id="matriculaBusca" placeholder="Digite uma Matrícula" name="busca">';
			}else{
				document.getElementById("buscaDiv").innerHTML = 
					'<input type="text" class="form-control form-control-lg" id="nomeBusca" placeholder="Digite um nome" name="busca">';
			}
			
		});

		
		//para abrir a janela de popup de notas
		$('[data-popup-open]').on('click', function(e)  {
			var targeted_popup_class = jQuery(this).attr('data-popup-open');
			$('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
	 
			e.preventDefault();
		});
	 
			// para fechar a janela de popup
		$('[data-popup-close]').on('click', function(e)  {
			var targeted_popup_class = jQuery(this).attr('data-popup-close');
			$('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
	 
			e.preventDefault();
		});
		
		// captura o valor do popup e adiciona na tabela de notas
		var index = 1;
		$('#btnNota').on('click', function(e)  {
			
			  var table=document.getElementById("notas");
			  var t1=document.getElementById("inputNotas").value;
			  if(t1 != ""){
				  var row=table.insertRow(table.rows.length);
				  var cell1=row.insertCell(0);
				  cell1.name = "nota"+index;
				  cell1.id = index;
				  document.getElementById(index).innerHTML = '<input class="inputNotas" name="'+"nota"+index+'" readonly value="'+t1+'">';
				  index++;
				  $('[data-popup="popup-1"]').fadeOut(350);
			  }
		});
		
		 //Filtro de digitos, numeros e "."
		 $("#nota,#inputNotas").keydown(function (e) {
			// permite: backspace, delete, tab, escape, enter e "."
			if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
				  // permite: Ctrl+A,Ctrl+C,Ctrl+V, Command+A,Ctrl+Z
				  ((e.keyCode == 65 || e.keyCode == 86 || e.keyCode == 67 || e.keyCode == 90) && (e.ctrlKey === true || e.metaKey === true)) ||
				  // permite: home, end, left, right, down, up
				  (e.keyCode >= 35 && e.keyCode <= 40)) {
				  return;
			}
			// Certifique-se de que é um número e pare o dígito
			if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
				e.preventDefault();
			}
		});
		
		//Filtro de digitos, apenas numeros
		$("#numero,#matricula").keydown(function (e) {
			// permite: backspace, delete, tab, escape e enter
			if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
				  // permite: Ctrl+A,Ctrl+C,Ctrl+V, Command+A ,Ctrl+Z
				  ((e.keyCode == 65 || e.keyCode == 86 || e.keyCode == 67 || e.keyCode == 90) && (e.ctrlKey === true || e.metaKey === true)) ||
				  // permite: home, end, left, right, down, up
				  (e.keyCode >= 35 && e.keyCode <= 40)) {
				  return;
			}
			// Certifique-se de que é um número e pare o dígito
			if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
				e.preventDefault();
			}
		});

});
