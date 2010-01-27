<?php 

class Conexao{

    var $db_HOST = "localhost";
    var $db_PORT = "5432";
    var $db_USER = "postgres";
    var $db_PASS = "postgres";
    var $db = "teste";
    var $CONST_ERRO = "erro ao conectar no nosso banco";
    var $dbc;
    var $last_id;


    function Conexao(){
        $this->connect_db();
    }

    function connect_db(){
        $connect_string = "host=".$this->db_HOST." port=".$this->db_PORT." user=".$this->db_USER." password=".$this->db_PASS." dbname=".$this->db;
        $this->dbc = pg_connect($connect_string);
        return $dbc;
    }  

    function delete_db($table,$id){
        $Campo_id = $this->getPrimaryKey($table);
        $tmp="delete from $table where $Campo_id='$id'";
        $sts = pg_query($this->dbc,$tmp) or die($this->CONST_ERRO . pg_last_error());
        return $sts ;
    }

    function close_db (){
        pg_close($this->dbc);
    }
    
    function insere_db($campos,$valores,$tab){
        $inicio="INSERT INTO $tab(";
        $meio=") VALUES (";
        $fim=")";
        $valor = sizeof($campos);
        $strc="";
        for($i=0;$i <= ($valor-1);$i++){
            $strc.="$campos[$i]";
            if($i != ($valor-1)){
                $strc.=",";
            }
        }
        $strv="";
        for($k=0;$k <= ($valor-1);$k++){
            $strv.="'$valores[$k]'";
            if($k != ($valor-1)){
                $strv.=",";
            }
        }
        $insere="$inicio$strc$meio$strv$fim";

        $this->query_db($insere);
        
        $this->setLastID($tab);
    }

    function query_db($sql){
        return pg_query($this->dbc,$sql) or die($this->CONST_ERRO . pg_last_error());
    }

    function reg_db($table){
        $tmp="select * from $table";
        $sts = pg_query($this->dbc,$tmp) or die($this->CONST_ERRO . pg_last_error());
        $num = pg_num_rows($sts);
        return($num);
    }
    
    function getPrimaryKey($table){
        $sql = "select indexdef from pg_indexes where tablename = '$table' and indexname LIKE '%pkey';";
        $res = pg_query($this->dbc,$sql) or die($this->CONST_ERRO . pg_last_error());
        $resultado = pg_fetch_result($res, 'indexdef');
            $arr_temp = explode("(",$resultado);
            $arr_temp2 = $arr_temp[1];
            $arr_temp = explode(")",$arr_temp2);
        return $arr_temp[0];
    }
    
    function setLastID($table){
        $sequence_name = $table . "_" . $this->getPrimaryKey($table) . "_seq";
        $sql = "select currval('$sequence_name') AS lastid";
        $res = pg_query($this->dbc,$sql) or die($this->CONST_ERRO . pg_last_error());
        $this->last_id = pg_fetch_result($res,'lastid');
    }

    function id_db(){
        return $this->last_id;
    }
};
?>
