$(document).ready(function(){
	var pacientes = [];
	var html = "";
	var posicao = 0;
	var total = 0;
	//Salvando pacientes em array, para assim lista-los
	$.ajax({
		type: "POST",
		url: "php/controle.php?f=listPatients",
		dataType: 'json',
		beforeSend: function(){
          exibirLoad();
        },
		success: function(response){
			toral = response.length;	
			for (var i = 0; i < total ; i++) {
				pacientes.push({
					nome: response.nome[i],
					sobrenome: response.sobrenome[i],
					cpf: response.cpf[i],
					email: response.email[i],
					nascimento: response.nascimento[i],
					genero: response.genero[i],
					tipo_sanguineo: response.tipo_sanguineo[i],
					endereco: response.endereco[i],
					cidade: response.cidade[i],
					estado: response.estado[i],
					cep: response.cep[i]
				});
            
          	}
		}
	});

	//Botão Proximo ou Voltar
	$("#btn_proximo").click(function(){
		$("#btn_proximo").attr("disabled", false);
		$("#btn_anterior").attr("disabled", false);
		exibirLoad();
		html = "";
		var n=0;
		for(var i = posicao; i < (posicao + 15); i++){
			if(i<=total){
				html += "<tr>";
				html += 	"<td>"+ pacientes[i]['nome'] + "</td>";
				html += 	"<td>"+ pacientes[i]['sobrenome'] + "</td>";
				html += 	"<td>"+ pacientes[i]['cpf'] + "</td>";
				html += 	"<td>"+ pacientes[i]['email'] + "</td>";
				html += 	"<td>"+ pacientes[i]['nascimento'] + "</td>";
				html += 	"<td>"+ pacientes[i]['genero'] + "</td>";
				html += 	"<td>"+ pacientes[i]['tipo_sanguineo'] + "</td>";
				html += 	"<td>"+ pacientes[i]['endereco'] + "</td>";
				html += 	"<td>"+ pacientes[i]['cidade'] + "</td>";
				html += 	"<td>"+ pacientes[i]['estado'] + "</td>";
				html += 	"<td>"+ pacientes[i]['cep'] + "</td>";
				html += "</tr>";
				n=i;
			}else{
				$("#btn_proximo").attr("disabled", true);
			}
			
		}	
		posicao = n;
		$(".corpo_tabela").empty();
		$(".corpo_tabela").append(html);
		ocultarLoad();
	});
	
	$("#btn_anterior").click(function(){
		$("#btn_proximo").attr("disabled", false);
		$("#btn_anterior").attr("disabled", false);
		exibirLoad();
		html = "";
		var n=0;
		if((posicao - 15) <0){
			var cont = 0;
			posicao = 15
		}else{
			var cont = posicao-15;
		}
		for(var i = cont; i < posicao; i++){
			html += "<tr>";
			html += 	"<td>"+ pacientes[i]['nome'] + "</td>";
			html += 	"<td>"+ pacientes[i]['sobrenome'] + "</td>";
			html += 	"<td>"+ pacientes[i]['cpf'] + "</td>";
			html += 	"<td>"+ pacientes[i]['email'] + "</td>";
			html += 	"<td>"+ pacientes[i]['nascimento'] + "</td>";
			html += 	"<td>"+ pacientes[i]['genero'] + "</td>";
			html += 	"<td>"+ pacientes[i]['tipo_sanguineo'] + "</td>";
			html += 	"<td>"+ pacientes[i]['endereco'] + "</td>";
			html += 	"<td>"+ pacientes[i]['cidade'] + "</td>";
			html += 	"<td>"+ pacientes[i]['estado'] + "</td>";
			html += 	"<td>"+ pacientes[i]['cep'] + "</td>";
			html += "</tr>";
			n=i;				
		}	
		if(cont==0){
			$("#btn_anterior").attr("disabled", true);
		}
		posicao = cont;
		$(".corpo_tabela").empty();
		$(".corpo_tabela").append(html);
		ocultarLoad();
	});

});
function exibirLoad(){
  $('#LOADINGSAVE').show();
  $("input,select,button").attr('disabled', true);
}

function ocultarLoad(){
  $('#LOADINGSAVE').hide();
  $("input,select,button").attr('disabled', false);
}