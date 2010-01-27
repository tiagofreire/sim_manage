var xmlhttp	= false;
var xmlhttp2= false;
try{
  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
  xmlhttp2= new ActiveXObject("Msxml2.XMLHTTP");
}catch(e){
  try{
    xmlhttp	= new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp2= new ActiveXObject("Microsoft.XMLHTTP");
  }catch (E){
    xmlhttp = false;
    xmlhttp2= false;
  }
}
if(!xmlhttp && typeof XMLHttpRequest != "undefined"){
  xmlhttp = new XMLHttpRequest();
  xmlhttp2= new XMLHttpRequest();
}

var ajax = {
  carregando : function(caminho){
    caminho = null;
    var html = '<div id="popup">&nbsp;</div>Localização: <input type="text" id="nome_dir" onKeyPress="ajax.enter(event);" name="nome_dir" size="93" value="">';
    html += '<input type="button" name="busca_dir" id="busca_dir" onclick="javascript: ajax.buscaId(document.getElementById(\'nome_dir\').value)" value="Buscar">';
    html += '<div id="resultado">&nbsp;</div>';
    document.body.innerHTML = html;
	document.getElementById('nome_dir').value='/';
	document.getElementById('busca_dir').click();
  },
  buscaId : function(caminho, arquivos){
	var path = caminho;
	if(path.substr(-1) != '/'){
	  path = path + '/';
	}
	if(arquivos!=''){
	xmlhttp.open('GET','__controller/main.php?acao=mostraDir&nome_dir='+path,true);
	xmlhttp.onreadystatechange = function(){
	if(xmlhttp.readyState == 1) document.getElementById('resultado').innerHTML = "<div id='load'>carregando...</div>";
      if(xmlhttp.readyState == 4){
        if(xmlhttp.status == 200){
          if(xmlhttp.responseText){
            document.getElementById('resultado').innerHTML = xmlhttp.responseText;
          }else{
            document.getElementById('resultado').innerHTML = "Nenhum resultado encontrado!";
          }
        }
      }
    }
    }else{
      alert('nenhum');
    }
    xmlhttp.send(null);
  },
  navegaDiretorio : function(nome_dir, novo_dir){
    document.getElementById('nome_dir').value=novo_dir;
	document.getElementById('busca_dir').click();
  },
  voltaDir : function(){
    var path = document.getElementById('nome_dir').value;
    var path_arr = path.split("/");
    var path_total = path_arr.length-1;
    var cami = '';
    for(var x=0;x<path_total;x++){
      cami += path_arr[x]+'/';
    }
    document.getElementById('nome_dir').value = cami;
    //alert(cami);
    document.getElementById('busca_dir').click();
  },
  listaArquivos : function(caminho){
	var path = caminho;
	if(path.substr(-1) != '/'){
	  path = path + '/';
	}
	    //alert(path);
	
  },
  converteArquivos : function(caminho, arquivos){
    var arquivo = arquivos.split(',');
    var x=0;
    var i=0;
    var n=0;
    var html = '<div class="topo"><ul><li><a href="javascript:void(0);" onclick="document.getElementById(\'popup\').style.display=\'none\';">x</a></li></ul></div>';
    html += '<div class="corpo" id="corpo"><ul>';
    for(x;x < arquivo.length;x++){
      html += '<li id="arq_'+x+'">'+arquivo[x]+'</li>';
    }
    html += '</ul></div>';
     
    setInterval(function () {
       if(i<x){
         document.getElementById('arq_'+i).innerHTML = '<img src="__img/load.gif">';
       }
         setTimeout(function(){
         if(n<x){
           alert(arquivo[n]);
           xmlhttp2.open('GET','__controller/main.php?acao=converteArquivos&nome_dir='+arquivo[n],true);
           xmlhttp2.onreadystatechange = function(){
             if(xmlhttp2.readyState == 4){
               if(xmlhttp2.status == 200){
                 if(xmlhttp2.responseText){
                   
                   document.getElementById('arq_'+n).innerHTML = xmlhttp2.responseText;
                   document.getElementById('arq_'+n).innerHTML = "s";
                 }else{
                   document.getElementById('arq_'+n).innerHTML = "Nenhum resultado encontrado!";
                 }
               }
             }
           }
           xmlhttp2.send(null);         
           
         }
         n++;
       },1000);
       i++;
    }, 1000);
    
    
    document.getElementById('popup').style.display='block'; 
    document.getElementById('popup').innerHTML = html;
    this.buscaId(caminho,'AAAAAA');
  },
  
  enter : function(event){
    if (event.keyCode==13)
      document.getElementById('busca_dir').click();
  }
}
