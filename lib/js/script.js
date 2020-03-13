var pacientes = [];
var html = "";
var posicao = 0;
var total = 0;

$(document).ready(function(){
	//Salvando pacientes em array, para assim lista-los
	$.ajax({
		type: 'POST',
		url: 'lib/php/controler.php?func=listPatients',
		dataType: 'JSON',
    	cache: false, 
		beforeSend: function(){
          exibirLoad();
        },
		success: function(response){
			total = response.length;
			for (var i = 0; i < total ; i++) {
				pacientes.push({
					nome: response[i].nome,
					sobrenome: response[i].sobrenome,
					cpf: response[i].cpf,
					email: response[i].email,
					nascimento: response[i].datanascimento,
					genero: response[i].genero,
					tipo_sanguineo: response[i].tiposanguineo,
					endereco: response[i].endereco,
					cidade: response[i].cidade,
					estado: response[i].estado,
					cep: response[i].cep
				});
          	}
          	Function_preencher_adicao();
		}
	});

	//Botão Proximo ou Voltar
	$("#btn_proximo").click(function(){
		Function_preencher_adicao();
	});
	
	$("#btn_anterior").click(function(){
		html = "";
		var n = posicao - 15;
		if( n <=0){
			var cont = 0;
			posicao = 15;
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
		}	
		posicao = cont;
		$(".corpoTabela").empty();
		$(".corpoTabela").append(html);
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
function Function_preencher_adicao(){
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
		}
	}	
	posicao = n+1;
	$(".corpoTabela").empty();
	$(".corpoTabela").append(html);
    ocultarLoad();
}