<?php

class Main extends Conexao{
  private $corpo;
  private $ext;
  private $dh;
  private $tipos = array("BAS","ORC","BAL","DCR","LCO","DCD","CRD","OUT","OSE","CPF","PAT","CTR");
    
  public function mostraDir($dir){
    if(is_dir($dir)){
      $this->dh = opendir($dir);
      $this->ext = "";
      $arquivo_todos = array();
      $converter = array();
      
      $i=0;
      
      while (false !== ($filename = readdir($this->dh)) ) {
        switch($filename){
  	      case is_dir($dir.$filename):
  	        $this->ext = "<img src='__img/folder.jpg'> &nbsp;";
  	      break;
  	      case is_file($dir.$filename):
  	        $this->ext = "<img src='__img/file.jpg'> &nbsp;";
  	      break;
  	    }
        if (is_dir($dir.$filename) && $filename != "." && $filename != ".." && substr($filename,0,1) !=".") { 
  	      $arquivo_todos[$i] = $this->ext. "<a href=\"javascript:void(0);\" onclick=\"javascript:ajax.navegaDiretorio('nome_dir', '".$_GET['nome_dir'].$filename."');\">".$filename."</a>";
  	    }
        if (is_file($dir.$filename) && array_search(substr($filename,-3), $this->tipos)) { 
  	      $arquivo_todos[$i] = $this->ext.$filename;
  	      $converter[$i] = $filename;
  	      #copy($dir.$filename, "../__files/".date("YmdHis")."_".$filename);
  	    }   
  	    $i++;
      }
      
      asort($arquivo_todos);
      
      $this->corpo .= "<p>Existem <b>".count($converter)."</b> a serem convertidos. ";
      if(count($converter)>0){
        $this->corpo .= "<a href=\"#\" onclick=\"javascript:ajax.converteArquivos('".$dir."','".implode(",",$converter)."');\">Clique aqui</a> para atualizar o banco.</p>";
      }
      $this->corpo .= "<p><a href=\"javascript:void(0);\" onclick=\"javascript:ajax.voltaDir();\">..</a></p>";
      $n = 0;
      $this->corpo .= "<ul>";
      foreach($arquivo_todos as $arq){
        if($n%2==0) $var = "class='par'"; else $var = "";
        $this->corpo .= "<li ".$var.">".$arq."</li>";
        $n++;
      }
      $this->corpo .= "</ul>";
      echo $this->corpo;
    }else{
      echo "O diretorio não existe!";
    }
  }
  public function converteArquivos($arquivo){
    //self::mostraDir($arquivo);
    echo "a"; 
  }
}
?>

