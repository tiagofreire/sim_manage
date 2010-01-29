<?php

class Main extends Conexao{
  private $corpo;
  private $ext;
  private $dh;
  private $caminho;
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
  public function converteArquivos($caminho, $arquivos){
    $arquivo = explode(",", $arquivos);
    $qtd = count($arquivo);
    for($x=0;$x<$qtd;$x++){
      $tabela = substr(strtolower($arquivo[$x]), 0,2);
      
      $row = 0;
      
      $sql_create_inicio = "CREATE TABLE ".$tabela."(";
      $sql_create_fim = ");";
      $sql_create_campos = "";
      $sql_insert_inicio = "INSERT INTO ".$tabela."(";// VALUES(";
      $sql_insert_fim = ");";
      $sql_insert_campos = "";
      $sql_insert_valores = array();
      $campos_insert ="";
      if (($handle = fopen($caminho.$arquivo[$x], "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
          $num = count($data);
          
          $row++;
          for ($c=0; $c < $num; $c++) {
             $campos_insert .= "\"aaaaaaaaaaaa".$data[$c]."\",";
          }
          $sql_insert_valores[$c] = $campos_insert;
        }
        for($i=0;$i<$num;$i++){
          $sql_insert_campos .= "\"".strtolower($tabela.$i)."\",";
          $sql_create_campos .= $tabela.$i." VARCHAR(255),";
        }
        $sql_insert_campos = substr($sql_insert_campos,0,-1);
        $sql_insert_valores = substr($sql_insert_valores,0,-1);
        $sql_create_campos = substr($sql_create_campos,0,-1);
        //echo $sql_create_inicio.$sql_create_campos.$sql_create_fim; 
        fclose($handle);
      } 
     
      
      echo count($sql_insert_valores);
      echo "A tabela <b>".$tabela."</b> foi criada com <b>".$row."</b> registros: <br /></p>\n";
      //echo "INSERT INTO ".$tabela."(".$sql_insert_campos.") VALUES(".$sql_insert_valores.");<br><br>";
      //self::query_db($sql_create_inicio.$sql_create_campos.$sql_create_fim);
      //self::query_db($sql); 
    }
  }
}
?>

