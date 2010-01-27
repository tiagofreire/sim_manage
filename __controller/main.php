<?php

  include "../__class/Conexao.class.php";
  include "../__class/Main.class.php";

  
  $mai = new Main;
  
  switch($_GET['acao']){
    case "mostraDir":
      $mai->mostraDir($_GET['nome_dir']);
    break;
    case "converteArquivos":
      $mai->converteArquivos($_GET['nome_dir']);
    break;
  }
  
?>
