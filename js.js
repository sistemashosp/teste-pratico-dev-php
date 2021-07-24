function request(url, data, callback) {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', url, true);
	var loader = document.createElement('div');
	loader.className = 'loader';
	document.body.appendChild(loader);
	xhr.addEventListener('readystatechange', function() {
		if(xhr.readyState === 4) {
			if(callback) {
				callback(xhr.response);
			}
			loader.remove();
		}
	});

	var formData = data ? (data instanceof FormData ? data : new FormData(document.querySelector(data))) : new FormData();

	var csrfMetaTag = document.querySelector('meta[name="csrf_tkn"]');
	if(csrfMetaTag) {
		formData.append('csrf_tkn', csrfMetaTag.getAttribute('content'));
	}

	xhr.send(formData);
}

function sucesso(){
	$(".sucesso").attr("style", "display: block");
	$(".blur").attr("style", "display: block");
	$(".blur").click(function(){
		$(".blur").attr("style", "display: none");
		$(".sucesso").attr("style", "display: none");
	});
}

function enviarFile(){
	request("/teste-pratico-dev-php/cadastra.php", '#arquivoCSV', function(data){

		document.getElementById('errs').innerHTML = "";
		var transition = document.getElementById('errs').style.transition;
		document.getElementById('errs').style.transition = "none";
		document.getElementById('errs').style.opacity = 0;
		try{
			data = JSON.parse(data);
			if('erro' in data){
				data = data.erro
			}else{
				sucesso();
				return 0;
			}
			if(!(data instanceof Array)){
				throw Exception('ERRO DE DADOS');
			}
			//Show errors to user
			for(var i = 0;i < data.length;++i) {
				switch(data[i]) {
					case 1:
						document.getElementById('errs').innerHTML += '<div class="err"><b>Formato do arquivo inválido.</b></div>';
						break;
					case 2:
						document.getElementById('errs').innerHTML += '<div class="err"><b>Erro ao gravar tipo sanguíneo.</b></div>';
						break;
					case 3:
						document.getElementById('errs').innerHTML += '<div class="err"><b>Erro ao inserir paciente.</b></div>';
                        break;
                    case 4:
						document.getElementById('errs').innerHTML += '<div class="err"><b>Erro ao carregar arquivo.</b></div>';
                    break;
                    case 5:
						document.getElementById('errs').innerHTML += '<div class="err"><b>CSRF Inválido.</b></div>';
                    break;
					default:
						document.getElementById('errs').innerHTML += '<div class="err"><b>Ocorreu um erro inesperado.</b> Tente novamente.</div>';
				}
			}
		}
		catch(e) {
			document.getElementById('errs').innerHTML = '<div class="err"><b>Ocorreu um erro inesperado.</b> Tente novamente</div>';
		}
		setTimeout(function() {
			document.getElementById('errs').style.transition = transition;
			document.getElementById('errs').style.opacity = 1;
		}, 10);
	});
}
