<?php

    session_start();
/*Conexão com banco de dados*/
    require('../database/conexao.php');


//função de validação

    function validaCampos(){
        $erros = [];

        if(!isset($_POST['descricao']) || $_POST['descricao'] == ""){
            $erros[] = "O campo descrição é de preenchimento obrigatório";
        }
        return $erros;
    }
   

/*
Tratamento dos dados vindos do formulario
- tipos de ação
- execução dos processos da ação solicitada
*/

    switch ($_POST['acao']) {
        case 'inserir':

            // echo var_dump($_POST);exit;

            //chamada da função de validação de erros
            $erros = validaCampos();
            // echo var_dump($erros);exit;

            //verificar se existem erros:
            if(count($erros) > 0){

                $_SESSION["erros"] = $erros;

                header('location: index.php');

                exit();
            }

            // echo 'INSERIR';exit;
            $descricao = $_POST['descricao'];

            //montagem da instrução SQL de inserção de dados
            $sql = "INSERT INTO tbl_categoria (descricao) VALUES ('$descricao')";

            // echo $sql;exit;

            /*
            mysqli_query parametros
            1 - Uma conexão aberta e válida
            2 - Uma instrução sql válida
            */
            $resultado = mysqli_query($conexao, $sql);

            header('location: index.php');
            // echo '<pre>';
            // var_dump($resultado);
            // echo '</pre>';
            // exit;
            break;


        case 'deletar':
            
            $categoriaID = $_POST['categoriaId'];

            $sql = "DELETE FROM tbl_categoria WHERE id = $categoriaID";

            $resultado = mysqli_query($conexao, $sql);

            header('location: index.php');

            break;
        
        default:
            # code...
            break;
    }