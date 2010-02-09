var ajax = {
  carregando : function(caminho){
    caminho = null;
	document.getElementById('diretorio').value='/';
	document.getElementById('btn_busca').click();
  },
  buscaId : function(caminho){
	var path = caminho;
	if(path.substr(-1) != '/'){
	  path = path + '/';
	}
  },
  navegaDiretorio : function(nome_dir, novo_dir){
    var path = document.getElementById('diretorio').value;
	if(path.substr(-1) != '/'){
	  path = path + '/';
	}
    document.getElementById('diretorio').value=path+novo_dir;
	document.getElementById('btn_busca').click();
  },
  voltaDir : function(){
    var path = document.getElementById('diretorio').value;
    var path_arr = path.split("/");
    var path_total = path_arr.length-1;
    var cami = '';
    for(var x=0;x<path_total;x++){
      cami += path_arr[x]+'/';
    }
    document.getElementById('diretorio').value = cami;
    //alert(cami);
    document.getElementById('btn_busca').click();
  },
  listaArquivos : function(caminho){
	var path = caminho;
	if(path.substr(-1) != '/'){
	  path = path + '/';
	}
	//alert(path);
  },
  
  enter : function(event){
    if (event.keyCode==13)
      document.getElementById('busca_dir').click();
  }
}

