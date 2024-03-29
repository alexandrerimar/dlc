<?php
session_start();
require 'db.php';

$validation1 = isset($_SESSION['consent']) ? $_SESSION['consent'] : 0;
$validation2 = isset($_SESSION['gamer']) ? $_SESSION['gamer'] : 0;

if ($validation1 != 1 && $valitation2 != 1) {
	header('Location: ./index.php');
}


$msg = '';

function is_blank($value) {
    return empty($value) && !is_numeric($value);
}

if(filter_has_var(INPUT_POST, 'submit')){

	/*Informações Pessoais*/
	$nascimento = $_POST['nascimento'] ?? '';
	$sexo = $_POST['sexo'] ?? '';
	$estado_civil = $_POST['estado_civil'] ?? '';
	$residencia = $_POST['residencia'] ?? '';
	$naturalidade = $_POST['naturalidade'] ?? '';
	$escolaridade = $_POST['escolaridade'] ?? '';
	$is_estudante = $_POST['is_estudante'] ?? '';
	$formacao = $_POST['formacao'] ?? '';
	$horario_estudo = $_POST['horario_estudo'] ?? '';
	$profask = $_POST['profask'] ?? '';
	$profissao = $_POST['profissao'] ?? '';
	$h_trabalho = $_POST['h_trabalho'] ?? '';
	$alcool = $_POST['alcool'] ?? '';
	$tabaco = $_POST['tabaco'] ?? '';
	$odroga = $_POST['odroga'] ?? '';
	$jogo_freq = $_POST['jogo_freq'] ?? '';
	$hora_semana = $_POST['hora_semana'] ?? '';
	$jogoporvida = $_POST['jogoporvida'] ?? '';
	$sessaojogo = $_POST['sessaojogo'] ?? '';
	$comp = $_POST['comp'] ?? '';

	/*Preferência de Jogo*/
	$ordergp1 = 1;
	$gamep1 = $_POST['gamep1'] ?? '';
	$gamep_time1 = $_POST['gamep-time1'] ?? '';
	$gamep_mode1 = $_POST['gamep-mode1'] ?? '';

	$ordergp2 = 2;
	$gamep2 = $_POST['gamep2'] ?? '';
	$gamep_time2 = $_POST['gamep-time2'] ?? '';
	$gamep_mode2 = $_POST['gamep-mode2'] ?? '';

	$ordergp3 = 3;
	$gamep3 = $_POST['gamep3'] ?? '';
	$gamep_time3 = $_POST['gamep-time3'] ?? '';
	$gamep_mode3 = $_POST['gamep-mode3'] ?? '';

	$ordergp4 = 4;
	$gamep4 = $_POST['gamep4'] ?? '';
	$gamep_time4 = $_POST['gamep-time4'] ?? '';
	$gamep_mode4 = $_POST['gamep-mode4'] ?? '';

	$ordergp5 = 5;
	$gamep5 = $_POST['gamep5'] ?? '';
	$gamep_time5 = $_POST['gamep-time5'] ?? '';
	$gamep_mode5 = $_POST['gamep-mode5'] ?? '';


	/*Preferência de Plataforma*/
	$orderpp1 = 1;
	$platp1 = $_POST['platp1'] ?? '';

	$orderpp2 = 2;
	$platp2 = $_POST['platp2'] ?? '';

	$orderpp3 = 3;
	$platp3 = $_POST['platp3'] ?? '';

	$orderpp4 = 4;
	$platp4 = $_POST['platp4'] ?? '';


	/*Questionário*/
	$q1 = $_POST['q1'] ?? '';
	$q2 = $_POST['q2'] ?? '';
	$q3 = $_POST['q3'] ?? '';
	$q4 = $_POST['q4'] ?? '';
	$q5 = $_POST['q5'] ?? '';
	$q6 = $_POST['q6'] ?? '';
	$q7 = $_POST['q7'] ?? '';
	$q8 = $_POST['q8'] ?? '';
	$q9 = $_POST['q9'] ?? '';
/*infopessoais fim*/

	function validatedate($val){
		if (is_blank($val) == True) {
			return false;
		} else{
			$date = explode('-', $val);			
			$mes = $date[1] ?? 00;
			$dia = $date[2] ?? 00;
			$ano = $date[0] ?? 0000;
			if (checkdate($mes, $dia, $ano) === True) {
				return $val;
			} else {
				return false;
			} 
		}
	}
	function validateint($val){
		if (
			filter_var($val, FILTER_VALIDATE_INT,array('options'=>array('min_range'=>0, 'max_range'=>168))) === 0 || 
			filter_var($val, FILTER_VALIDATE_INT,array('options'=>array('min_range'=>0, 'max_range'=>168)))) {
   			return $val;
		} else {
    		return 0;
		}
	}


	$arr = array(				
		"semana" => array(
			"hora_semana" => $hora_semana,
			"gamep_time1" => $gamep_time1, 
			"gamep_time2" => $gamep_time2,
			"gamep_time3" => $gamep_time3,
			"gamep_time4" => $gamep_time4,
			"gamep_time5" => $gamep_time5
		),
		"jogoporvida" => $jogoporvida,
		"sessaojogo" => $sessaojogo,
		"binary" => array(
			"is_estudante" => $is_estudante, 
			"profask" => $profask, 
			"comp" => $comp,
		),
		"jogo_freq" => $jogo_freq,
		"fiveopt" => array(
			"alcool" => $alcool, 
			"tabaco" => $tabaco, 
			"odroga" => $odroga,
			"q1" => $q1,
			"q2" => $q2,
			"q3" => $q3,
			"q4" => $q4,
			"q5" => $q5,
			"q6" => $q6,
			"q7" => $q7,
			"q8" => $q8,
			"q9" => $q9 
		),
		"nascimento" => $nascimento,
		"texto" => array(
			"profissao" => $profissao,
			"gamep1" => $gamep1,
			"gamep2" => $gamep2,
			"gamep3" => $gamep3,
			"gamep4" => $gamep4,
			"gamep5" => $gamep5,
			"sexo" => $sexo,
			"estado_civil" => $estado_civil,
			"residencia" => $residencia,
			"naturalidade" => $naturalidade,
			"escolaridade" => $escolaridade,
			"formacao" => $formacao,
			"horario_estudo" => $horario_estudo,
			"h_trabalho" => $h_trabalho,
			"gamep_mode1" => $gamep_mode1,
			"gamep_mode2" => $gamep_mode2,
			"gamep_mode3" => $gamep_mode3,
			"gamep_mode4" => $gamep_mode4,
			"gamep_mode5" => $gamep_mode5,
			"platp1" => $platp1,
			"platp2" => $platp2,
			"platp3" => $platp3,
			"platp4" => $platp4
		)
	);

	$validate = array(
		"semana" => array(
			"filter" => FILTER_CALLBACK,
			'flags'  => FILTER_REQUIRE_ARRAY|FILTER_NULL_ON_FAILURE,
			"options" => 'validateint'
		),
		"jogoporvida" => array(
			"filter" => FILTER_VALIDATE_INT,
			"options" => array(
				"min_range" => 1,
				"max_range" => 69
			)
		),
		"sessaojogo" => array(
			"filter" => FILTER_VALIDATE_INT,
			"options" => array(
				"min_range" => 1,
				"max_range" => 24
			)
		),
		"binary" => array(
			"filter" => FILTER_VALIDATE_INT,
			'flags'  => FILTER_REQUIRE_ARRAY,
			"options" => array(
				"min_range" => 0,
				"max_range" => 1
			)
		),
		"jogo_freq" => array(
			"filter" => FILTER_VALIDATE_INT,
			"options" => array(
				"min_range" => 1,
				"max_range" => 3
			)
		),
		"fiveopt" => array(
			"filter" => FILTER_VALIDATE_INT,
			'flags'  => FILTER_REQUIRE_ARRAY,
			"options" => array(
				"min_range" => 1,
				"max_range" => 5
			)
		),
		"nascimento" => array(
			"filter" => FILTER_CALLBACK,
			"options" => 'validatedate'
		),
		"texto" => array(
			"filter" => FILTER_CALLBACK,
			"options" => 'ucwords'
		)
	);

	$va = filter_var_array($arr, $validate);
	print_r(filter_var_array($arr, $validate));
	extract($va);
	extract($semana);
	extract($binary);
	extract($fiveopt);
	extract($texto);
	


	if (empty($nascimento) || empty($sexo) || empty($estado_civil) || empty($residencia) || empty($naturalidade) || empty($escolaridade) || is_blank($is_estudante) || is_blank($profask) || empty($alcool) || empty($tabaco) || empty($odroga) || empty($jogo_freq) || empty($hora_semana) || empty($jogoporvida) || empty($sessaojogo) || is_blank($comp) || empty($gamep1) || empty($gamep2) || empty($gamep3) || empty($gamep_mode1) || empty($gamep_mode2) || empty($gamep_mode3) || empty($gamep_time1) || empty($gamep_time2) || empty($gamep_time3) || empty($platp1) || empty($platp2) || empty($platp3) || empty($platp4) || empty($q1) || empty($q2) || empty($q3) || empty($q4) || empty($q5) || empty($q6) || empty($q7) || empty($q8) || empty($q9)) {
			
			$msg = "Preencha todos os campos necessários1.";

			if ($profask == 1) {
				if (empty($profissao) || empty($h_trabalho)) {
					$msg = "Preencha todos os campos necessários2.";
				} 
			}
			elseif ($is_estudante == 1) {
				if (empty($horario_estudo)) {
					$msg = "Preencha todos os campos necessários3.";	
				}
				elseif ($escolaridade == "ESC" || $escolaridade == "ESI" || $escolaridade == "PGC" || $escolaridade == "PGI") {
					if (empty($formacao)){
						$msg = "Preencha todos os campos necessários4.";
					}
				}
			}
		} else {	
			$msg = "ok";
			echo $msg;	
			/*db_insertion*/
			/*personal_info*/


			var_dump($gamep_time1, $gamep_time2, $gamep_time3, $gamep_time4, $gamep_time5);

			$query1 = "INSERT INTO personal_info (
				nascimento,
				sexo,
				estado_civil,
				residencia,
				naturalidade,
				escolaridade,
				is_estudante,
				area_formacao,
				horario_estudo,
				trabalha,
				profissao,
				horario_trab,
				alcool,
				tabaco,
				outra_droga,
				freq_jogo,
				hora_semana,
				tempo_vida,
				tempo_sessao,
				is_comp
				)
				VALUES (
				'$nascimento',
				'$sexo',
				'$estado_civil',
				'$residencia',
				'$naturalidade',
				'$escolaridade',
				'$is_estudante',
				'$formacao',
				'$horario_estudo',
				'$profask',
				'$profissao',
				'$h_trabalho',
				'$alcool',
				'$tabaco',
				'$odroga',
				'$jogo_freq',
				'$hora_semana',
				'$jogoporvida',
				'$sessaojogo',
				'$comp'
			)";
			insert($query1);
			$_SESSION['user_id'] = mysqli_insert_id(db_connect());
			$user_id = $_SESSION['user_id'];


			$query2_1 = "INSERT INTO preferencia_jogo (
				user_id,
				ordem,
				titulo,
				hora_semanag,
				gamep_mode
				)
				VALUES (
				'$user_id',
				'$ordergp1',
				'$gamep1',
				'$gamep_time1',
				'$gamep_mode1'
			) ";
			insert($query2_1);

			$query2_2 = "INSERT INTO preferencia_jogo (
				user_id,
				ordem,
				titulo,
				hora_semanag,
				gamep_mode
				)
				VALUES (
				'$user_id',
				'$ordergp2',
				'$gamep2',
				'$gamep_time2',
				'$gamep_mode2'
			) ";
			insert($query2_2);

			$query2_3 = "INSERT INTO preferencia_jogo (
				user_id,
				ordem,
				titulo,
				hora_semanag,
				gamep_mode
				)
				VALUES (
				'$user_id',
				'$ordergp3',
				'$gamep3',
				'$gamep_time3',
				'$gamep_mode3'
			) ";
			insert($query2_3);

			$query2_4 = "INSERT INTO preferencia_jogo (
				user_id,
				ordem,
				titulo,
				hora_semanag,
				gamep_mode
				)
				VALUES (
				'$user_id',
				'$ordergp4',
				'$gamep4',
				'$gamep_time4',
				'$gamep_mode4'
			) ";
			insert($query2_4);

			$query2_5 = "INSERT INTO preferencia_jogo (
				user_id,
				ordem,
				titulo,
				hora_semanag,
				gamep_mode
				)
				VALUES (
				'$user_id',
				'$ordergp5',
				'$gamep5',
				'$gamep_time5',
				'$gamep_mode5'
			)";
			insert($query2_5);


			$query3_1 = "INSERT INTO preferencia_plataforma (
				user_id,
				ordem,
				plataforma
				)
				VALUES (
				'$user_id',
				'$orderpp1',
				'$platp1'
			)";
			insert($query3_1);

			$query3_2 = "INSERT INTO preferencia_plataforma (
				user_id,
				ordem,
				plataforma
				)
				VALUES (
				'$user_id',
				'$orderpp2',
				'$platp2'
			)";
			insert($query3_2);

			$query3_3 = "INSERT INTO preferencia_plataforma (
				user_id,
				ordem,
				plataforma
				)
				VALUES (
				'$user_id',
				'$orderpp3',
				'$platp3'
			)";
			insert($query3_3);

			$query3_4 = "INSERT INTO preferencia_plataforma (
				user_id,
				ordem,
				plataforma
				)
				VALUES (
				'$user_id',
				'$orderpp4',
				'$platp4'
			)";
			insert($query3_4);

			$query4 = "INSERT INTO questionario (
				user_id, q1, q2, q3, q4, q5, q6, q7, q8, q9
				)
				VALUES (
				'$user_id', '$q1', '$q2', '$q3', '$q4', '$q5', '$q6', '$q7', '$q8', '$q8'
			)";			
			insert($query4);

			header('Location: ./intro2');
		} 

		echo $msg;
};
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Pesquisa sobre Hábitos de Jogador</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
 </head>
 <body>
 <script src="./formscript.js" type="text/JavaScript"></script>



<div class = "container">
	<div class="border-bottom pb-3 mb-5">
		<h4 class="display-4"> Questionário </h4>
		<h5><small class="text-muted"> Responda as perguntas abaixo, considerando seus hábitos como jogador. </small></h5>
	</div>
	<div class="row justify-content-center text-justify">		
		<div class="col-sm-10 col-lg-8">
		</div>
	</div>
	<form id="subject-info" action='<?php htmlspecialchars($_SERVER['PHP_SELF']);?>' method="post">
	<fieldset>
		<legend> Informações Pessoais </legend>

		<div class="form-row">
			<div class="form-group col-sm-3">
	    	<label for="nascimento col-form-label">Data de Nascimento</label>
	    	<input type="date" class="form-control" name="nascimento" id="nascimento" max='2001-11-13' required>
	  		</div>

			<div class="form-group col-sm-4">
				<label for="sexo">Sexo</label>
    			<select class="form-control" name="sexo" id="sexo" required>
    				<option value="Selecione" selected disabled hidden>Selecione</option>
      				<option value="M">Masculino</option>
      				<option value="F">Feminino</option>
    			</select>
			</div>

				<div class="form-group col-sm-5">
				<label for="estado_civil">Estado civil</label>
    			<select class="form-control" name="estado_civil" id="estado_civil" required>
    				<option value="Selecione" selected disabled hidden>Selecione</option>
				    <option value="S">Solteiro(a)</option>
				    <option value="C">Casado(a)</option>
				    <option value="N">Namorando</option>
				    <option value="D">Divorciado(a)</option>
				    <option value="V">Viúvo(a)</option>
				</select>
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-sm-4">
				<label for="residencia">Residência atual</label>
    			<select class="form-control" name="residencia" id="residencia" required>
    				<option value="Selecione" selected disabled hidden>Selecione</option>
      				<option value="AC">Acre</option>
				    <option value="AL">Alagoas</option>
				    <option value="AP">Amapá</option>
				    <option value="AM">Amazonas</option>
				    <option value="BA">Bahia</option>
				    <option value="CE">Ceará</option>
				    <option value="DF">Distrito Federal</option>
				    <option value="ES">Espírito Santo</option>
				    <option value="GO">Goiás</option>
				    <option value="MA">Maranhão</option>
				    <option value="MT">Mato Grosso</option>
				    <option value="MS">Mato Grosso do Sul</option>
				    <option value="MG">Minas Gerais</option>
				    <option value="PA">Pará</option>
				    <option value="PB">Paraíba</option>
				    <option value="PR">Paraná</option>
				    <option value="PE">Pernambuco</option>
				    <option value="PI">Piauí</option>
				    <option value="RJ">Rio de Janeiro</option>
				    <option value="RN">Rio Grande do Norte</option>
				    <option value="RS">Rio Grande do Sul</option>
				    <option value="RO">Rondônia</option>
				    <option value="RR">Roraima</option>
				    <option value="SC">Santa Catarina</option>
				    <option value="SP">São Paulo</option>
				    <option value="SE">Sergipe</option>
				    <option value="TO">Tocantins</option>
				    <option value="EX">Estrangeiro</option>
    			</select>
			</div>

			<div class="form-group col-sm-4">
				<label for="naturalidade">Naturalidade</label>
    			<select class="form-control" name="naturalidade" id="naturalidade" required>
    				<option value="Selecione" selected disabled hidden>Selecione</option>
      				<option value="AC">Acre</option>
				    <option value="AL">Alagoas</option>
				    <option value="AP">Amapá</option>
				    <option value="AM">Amazonas</option>
				    <option value="BA">Bahia</option>
				    <option value="CE">Ceará</option>
				    <option value="DF">Distrito Federal</option>
				    <option value="ES">Espírito Santo</option>
				    <option value="GO">Goiás</option>
				    <option value="MA">Maranhão</option>
				    <option value="MT">Mato Grosso</option>
				    <option value="MS">Mato Grosso do Sul</option>
				    <option value="MG">Minas Gerais</option>
				    <option value="PA">Pará</option>
				    <option value="PB">Paraíba</option>
				    <option value="PR">Paraná</option>
				    <option value="PE">Pernambuco</option>
				    <option value="PI">Piauí</option>
				    <option value="RJ">Rio de Janeiro</option>
				    <option value="RN">Rio Grande do Norte</option>
				    <option value="RS">Rio Grande do Sul</option>
				    <option value="RO">Rondônia</option>
				    <option value="RR">Roraima</option>
				    <option value="SC">Santa Catarina</option>
				    <option value="SP">São Paulo</option>
				    <option value="SE">Sergipe</option>
				    <option value="TO">Tocantins</option>
				    <option value="EX">Estrangeiro</option>
    			</select>
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-sm-3">
				<label for="escolaridade">Escolaridade</label>
    			<select class="form-control" name="escolaridade" id="escolaridade" onclick="grade();" required>
    				<option value="Selecione" selected disabled hidden>Selecione</option>
				    <option value="EFC">Ensino Fundamental Completo</option>
				    <option value="EMC">Ensino Medio Completo</option>
				    <option value="ESC">Ensino Superior Completo</option>
				     <option value="PGC">Pós-Graduação Completa</option>
				    <option value="EFI">Ensino Fundamental Incompleto</option>
				    <option value="EMI">Ensino Medio Incompleto</option>
				    <option value="ESI">Ensino Superior Incompleto</option>
				     <option value="PGI">Pós-Graduação Incompleta</option>
				</select>
			</div>

			<div class = "col-sm-3"> 
				<div class="mb-3">Você estuda atualmente?</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="is_estudante" type="radio" value="1" id="is_estudante1" onclick="isstudent();" required>
					<label class="form-check-label" for="is_estudante1">Sim</label>
				</div>				
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="is_estudante" type="radio" value="0" id="is_estudante2" onclick="isstudent();" required>
					<label class="form-check-label" for="is_estudante2">Não</label>
				</div>		
			</div>
				

			<div class="form-group col-sm-4">
				<label for="formacao">Área de Formação</label>
    			<select class="form-control" name="formacao" id="formacao" disabled required>
    				<option value="Selecione" selected disabled hidden>Qual área você cursa/formou-se?</option>
				    <option value="H">Ciências Humanas</option>
				    <option value="E">Ciências Exatas</option>
				    <option value="B">Ciências Biológicas</option>
				    <option value="T">Curso Tecnólogo</option>
				</select>
			</div>

			<div class="form-group col-sm-2">
				<label for="horario_estudo">Período</label>
    			<select class="form-control" name="horario_estudo" id="horario_estudo" disabled required>
    				<option value="Selecione" selected disabled hidden>Selecione</option>
				    <option value="M">Matutino</option>
				    <option value="V">Vespertino</option>
				    <option value="N">Noturno</option>
				    <option value="I">Integral</option>
				</select>
			</div>

		</div>

		<div class="form-row">
			<div class = "col-sm-3"> 
				<div>Você trabalha atualmente?</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="profask" type="radio" value="1" id="profask1" onclick="isworker();" required>
					<label class="form-check-label" for="profask1">Sim</label>
				</div>				
				<div class="form-check form-check-inline">
					<input class="form-check-input" name="profask" type="radio" value="0" id="profask2" onclick="isworker();" required>
					<label class="form-check-label" for="profask2">Não</label>
				</div>		
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-sm-6">
				<label for="profissao" class = "col-form-label" value="profissao">Profissão</label>
	    		<input type="text" class="form-control" name="profissao" id="profissao" placeholder="Profissão" disabled required>
			</div>
			<div class="form-group col-sm-6">
				<label for="h_trabalho" class="col-form-label">Condição de Trabalho</label>
    			<select class="form-control" name="h_trabalho" id="h_trabalho" disabled required>
    				<option value="Selecione" selected disabled hidden>Selecione</option>
				    <option value="C">Período Completo</option>
				    <option value="M">Meio Período</option>
				    <option value="E">Eventualmente</option>
				</select>
			</div>			
		</div>

		<fieldset>
			<legend> Uso de Drogas </legend>

			<div class="row align-items-center">
				<div class = "col-sm-3"> 
					<div style="margin-bottom:10px;">Você faz uso de Álcool?</div>
					<div class="form-check">
						<input class="form-check-input" name="alcool" type="radio" value="1" id="alcool1" required>
						<label class="form-check-label" for="alcool1">Nunca fiz</label>
					</div>				
					<div class="form-check">
						<input class="form-check-input" name="alcool" type="radio" value="2" id="alcool2" >
						<label class="form-check-label" for="alcool2">Diariamente</label>
					</div>	
					<div class="form-check">
						<input class="form-check-input" name="alcool" type="radio" value="3" id="alcool3" >
						<label class="form-check-label" for="alcool3">Semanalmente</label>
					</div>	
					<div class="form-check">
						<input class="form-check-input" name="alcool" type="radio" value="4" id="alcool4" >
						<label class="form-check-label" for="alcool4">Mensalmente</label>
					</div>	
					<div class="form-check">
						<input class="form-check-input" name="alcool" type="radio" value="5" id="alcool5" >
						<label class="form-check-label" for="alcool5">Alguma vez na Vida</label>
					</div>		
				</div>

				<div class = "col-sm-3"> 
					<div style="margin-bottom:10px;">Você faz uso de Tabaco?</div>
					<div class="form-check">
						<input class="form-check-input" name="tabaco" type="radio" value="1" id="tabaco1" required>
						<label class="form-check-label" for="tabaco1">Nunca fiz</label>
					</div>				
					<div class="form-check">
						<input class="form-check-input" name="tabaco" type="radio" value="2" id="tabaco2">
						<label class="form-check-label" for="tabaco2">Diariamente</label>
					</div>	
					<div class="form-check">
						<input class="form-check-input" name="tabaco" type="radio" value="3" id="tabaco3">
						<label class="form-check-label" for="tabaco3">Semanalmente</label>
					</div>	
					<div class="form-check">
						<input class="form-check-input" name="tabaco" type="radio" value="4" id="tabaco4">
						<label class="form-check-label" for="tabaco4">Mensalmente</label>
					</div>	
					<div class="form-check">
						<input class="form-check-input" name="tabaco" type="radio" value="5" id="tabaco5">
						<label class="form-check-label" for="tabaco5">Alguma vez na Vida</label>
					</div>		
				</div>

				<div class = "col-sm-3"> 
					<div style="margin-bottom:10px;">Você faz uso de Alguma outra Droga?</div>
					<div class="form-check">
						<input class="form-check-input" name="odroga" type="radio" value="1" id="odroga1" required>
						<label class="form-check-label" for="odroga1">Nunca fiz</label>
					</div>				
					<div class="form-check">
						<input class="form-check-input" name="odroga" type="radio" value="2" id="odroga2">
						<label class="form-check-label" for="odroga2">Diariamente</label>
					</div>	
					<div class="form-check">
						<input class="form-check-input" name="odroga" type="radio" value="3" id="odroga3">
						<label class="form-check-label" for="odroga3">Semanalmente</label>
					</div>	
					<div class="form-check">
						<input class="form-check-input" name="odroga" type="radio" value="4" id="odroga4">
						<label class="form-check-label" for="odroga4">Mensalmente</label>
					</div>	
					<div class="form-check">
						<input class="form-check-input" name="odroga" type="radio" value="5" id="odroga5">
						<label class="form-check-label" for="odroga5">Alguma vez na Vida</label>
					</div>		
				</div>
			</div>
		</fieldset>
  	</fieldset>

  	<fieldset> 
  		<legend> Hábitos de Jogo </legend>

  		<div class="form-row">
  			<div class = "form-group col-sm-6"> 
				<div>Com que frequência você joga videogame?</div>			
				<div class="form-check">
					<input class="form-check-input" name="jogo_freq" type="radio" value="1" id="jogo_freq1" required>
					<label class="form-check-label" for="jogo_freq1">Diariamente</label>
				</div>	
				<div class="form-check">
					<input class="form-check-input" name="jogo_freq" type="radio" value="2" id="jogo_freq2">
					<label class="form-check-label" for="jogo_freq2">Semanalmente</label>
				</div>	
				<div class="form-check">
					<input class="form-check-input" name="jogo_freq" type="radio" value="3" id="jogo_freq3">
					<label class="form-check-label" for="jogo_freq3">Mensalmente</label>
				</div>					
			</div>

			<div class="form-group col-sm-6">
			    <label for="hora_semana">Em média, quantas horas por semana você costuma jogar?</label>
			    <div class="input-group">
				    <input type="number" class="form-control" style="max-width: 80px;" name="hora_semana" id="hora_semana" min='1' max="168" required>
				    <div class="input-group-append">
		    			<span class="input-group-text" id="basic-addon1">Hora/Semana</span>
		  			</div>
	  			</div>
  			</div>  			
  		</div>

	  	<div class='form-row'>
	  		<div class="form-group col-sm-6">
			    <label for="jogoporvida">Aproximadamente, há quanto tempo em sua vida você joga videogame?</label>
			    <div class="input-group">
				    <input type="number" class="form-control" style="max-width: 80px;" name="jogoporvida" id="jogoporvida" min='1' max="69" required>
				    <div class="input-group-append">
		    			<span class="input-group-text" id="basic-addon2">Anos</span>
		  			</div>
	  			</div>
  			</div>

  			<div class="form-group col-sm-6">
			    <label for="sessaojogo">Quanto tempo, em média, você passa em uma sessão de jogo?</label>
			    <div class="input-group">
				    <input type="number" class="form-control" style="max-width: 80px;" name="sessaojogo" id="sessaojogo" min='1' max="24" required>
				    <div class="input-group-append">
		    			<span class="input-group-text" id="basic-addon3">Hora(s)</span>
		  			</div>
	  			</div>
  			</div>
	  	</div>

	  	<div class="form-row">
	  		<div class = "col"> 
					<div style="margin-bottom:10px;">
						Você joga videogame competitivamente e/ou como parte de uma equipe profissional?
					</div>
					<div class="form-check-inline">
						<input class="form-check-input" name="comp" type="radio" value="1" id="comp1" required>
						<label class="form-check-label" for="comp1">Sim</label>
					</div>				
					<div class="form-check-inline">
						<input class="form-check-input" name="comp" type="radio" value="0" id="comp2" required>
						<label class="form-check-label" for="comp2">Não</label>
					</div>	
				</div>
	  	</div>
  	</fieldset>
  	<fieldset>
  		<legend class="mt-5"> Preferências de Jogo </legend>
  		<div class="row">
  			<div class="col-sm-12 text-justify">
  				<p> As próximas perguntas têm o objetivo de avaliar os seus hábitos relacionados a videogames e são válidas para qualquer plataforma (computador, smartphone, tablet e console de jogo) e para qualquer tipo de jogo (online, off-line, tiro em primeira pessoa, puzzles, ação etc.). Você deve considerar seus hábitos de jogo referentes aos últimos 12 meses. </p>
  			</div>
  			<div class="col-sm-12 text-justify mt-3">
  				<h4> Jogos Preferidos </h4>
  				<p> Indique na tabela abaixo o título de ao menos 3 dos <b>jogos</b> mais jogados por você e o respectivo <b>tempo médio</b> que passa jogando cada um deles. Indique também a <b>modalidade</b> de preferência. Para jogos com duas modalidades, <i>multiplayer</i> (multiplos jogadores) e <i>singleplayer</i> (um jogador), indique a modalidade que você mais joga. </p>
  			</div>
  		</div>
  		<div class="row">
  			<div class="table-responsive">
	  			<table class="table">
					<thead>
					    <tr>
					    	<th scope="col">Ordem</th>
					    	<th scope="col">Título do Jogo</th>
					    	<th scope="col">Horas por semana</th>
					    	<th scope="col">Singleplayer ou multiplayer</th>
					    </tr>
					  </thead>
					  <tbody>
					    <tr>
					      <th scope="row">1</th>
					      <td>
					      	<div class="form-group">
	    						<label class="sr-only" for="gamep1">Jogo 1</label>
	    						<input type="text" class="form-control" id="gamep1" name="gamep1" placeholder="Jogo 1" required>
 							</div>
					      </td>
					      <td>
					      	<div class="form-group">
								<label class="sr-only" for="gamep-time1">Horas por semana no Jogo 1</label>								
								<input type="number" class="form-control" name="gamep-time1" id="gamep-time1" min='1' max="168" required>			
  							</div>
					      </td>
					      <td>
					      	<div class="form-group">
								<label class="sr-only" for="gamep-mode1">Modo preferido para Jogo 1</label>
				    			<select class="form-control" name="gamep-mode1" id="gamep-mode1" required>
				    				<option value="Selecione" selected disabled hidden>Selecione</option>
								    <option value="s">Singleplayer</option>
								    <option value="m">Multiplayer</option>							     
								</select>
							</div>
					      </td>
					    </tr>
					    <tr>
					      <th scope="row">2</th>
					      <td>
					      	<div class="form-group">
	    						<label class="sr-only" for="gamep2">Jogo 2</label>
	    						<input type="text" class="form-control" id="gamep2" name="gamep2" placeholder="Jogo 2" required>
 							</div>
					      </td>
					      <td>
					      	<div class="form-group">
								<label class="sr-only" for="gamep-time2">Horas por semana no Jogo 2</label>								
								<input type="number" class="form-control" name="gamep-time2" id="gamep-time2" min='1' max="168" required>			
  							</div>
					      </td>
					      <td>
					      	<div class="form-group">
								<label class="sr-only" for="gamep-mode2">Modo preferido para Jogo 2</label>
				    			<select class="form-control" name="gamep-mode2" id="gamep-mode2" required>
				    				<option value="Selecione" selected disabled hidden>Selecione</option>
								    <option value="s">Singleplayer</option>
								    <option value="m">Multiplayer</option>							     
								</select>
							</div>
					      </td>
					    </tr>
					    <tr>
					      <th scope="row">3</th>
					      <td>
					      	<div class="form-group">
	    						<label class="sr-only" for="gamep3">Jogo 3</label>
	    						<input type="text" class="form-control" id="gamep3" name="gamep3" placeholder="Jogo 3" required>
 							</div>
					      </td>
					      <td>
					      	<div class="form-group">
								<label class="sr-only" for="gamep-time3">Horas por semana no Jogo 3</label>								
								<input type="number" class="form-control" name="gamep-time3" id="gamep-time3" min='1' max="168" required>			
  							</div>
					      </td>
					      <td>
					      	<div class="form-group">
								<label class="sr-only" for="gamep-mode3">Modo preferido para Jogo 3</label>
				    			<select class="form-control" name="gamep-mode3" id="gamep-mode3" required>
				    				<option value="Selecione" selected disabled hidden>Selecione</option>
								    <option value="s">Singleplayer</option>
								    <option value="m">Multiplayer</option>							     
								</select>
							</div>
					      </td>
					    </tr>
					    <tr>
					      <th scope="row">4</th>
					      <td>
					      	<div class="form-group">
	    						<label class="sr-only" for="gamep4">Jogo 4 </label>
	    						<input type="text" class="form-control" id="gamep4" name="gamep4" placeholder="Jogo 4">
 							</div>
					      </td>
					      <td>
					      	<div class="form-group">
								<label class="sr-only" for="gamep-time4">Horas por semana no Jogo 4</label>								
								<input type="number" class="form-control" name="gamep-time4" id="gamep-time4" min='1' max="168">			
  							</div>
					      </td>
					      <td>
					      	<div class="form-group">
								<label class="sr-only" for="gamep-mode4">Modo preferido para Jogo 4</label>
				    			<select class="form-control" name="gamep-mode4" id="gamep-mode4">
				    				<option value="Selecione" selected disabled hidden>Selecione</option>
								    <option value="s">Singleplayer</option>
								    <option value="m">Multiplayer</option>							     
								</select>
							</div>
					      </td>
					    </tr>
					    <tr>
					      <th scope="row">5</th>
					      <td>
					      	<div class="form-group">
	    						<label class="sr-only" for="gamep5">Jogo 5</label>
	    						<input type="text" class="form-control" id="gamep5" name="gamep5" placeholder="Jogo 5">
 							</div>
					      </td>
					      <td>
					      	<div class="form-group">
								<label class="sr-only" for="gamep-time5">Horas por semana no Jogo 5</label>								
								<input type="number" class="form-control" name="gamep-time5" id="gamep-time5" min='1' max="168">			
  							</div>
					      </td>
					      <td>
					      	<div class="form-group">
								<label class="sr-only" for="gamep-mode5">Modo preferido para Jogo 5</label>
				    			<select class="form-control" name="gamep-mode5" id="gamep-mode5">
				    				<option value="Selecione" selected disabled hidden>Selecione</option>
								    <option value="s">Singleplayer</option>
								    <option value="m">Multiplayer</option>							     
								</select>
							</div>
					      </td>
					    </tr>
					  </tbody>
				</table>
		</div>
  		</div>
  	
  		<div class="row">
  			<div class="col-sm-12 text-justify mt-3">
  				<h4> Plataforma Preferidos </h4>
  				<p> Indique a ordem em que você prefere jogar dependendo da plataforma (de 1: preferida a 4: menos preferida).  </p>
  			</div>
  			<div class="table-responsive">
	  			<table class="table">
					<thead>
					    <tr>
					    	<th scope="col" class="col-3">Ordem de Preferência</th>
					    	<th scope="col">Plataforma</th>					    
					    </tr>
					  </thead>
					  <tbody>
					    <tr>
					    	<th scope="row">1</th>					      
				    		<td>
			      			<div class="form-group">
								<label class="sr-only" for="platp1">Plataforma de Jogo 1</label>
				    			<select class="form-control" name="platp1" id="platp1" required>
				    				<option value="Selecione" selected disabled hidden>Selecione</option>
								    <option value="PC">Computador/Notebook</option>
								    <option value="CO">Console de Jogo</option>
								    <option value="SM">Smartphone</option>
								    <option value="TB">Tablet</option>  
								</select>
							</div>
				      		</td>
					    </tr>
					    <tr>
					    	<th scope="row">2</th>					      
				    		<td>
			      			<div class="form-group">
								<label class="sr-only" for="platp2">Plataforma de Jogo 2</label>
				    			<select class="form-control" name="platp2" id="platp2" required>
				    				<option value="Selecione" selected disabled hidden>Selecione</option>
								    <option value="PC">Computador/Notebook</option>
								    <option value="CO">Console de Jogo</option>
								    <option value="SM">Smartphone</option>
								    <option value="TB">Tablet</option>  
								</select>
							</div>
				      		</td>
					    </tr>
					    <tr>
					    	<th scope="row">3</th>					      
				    		<td>
			      			<div class="form-group">
								<label class="sr-only" for="platp3">Plataforma de Jogo 3</label>
				    			<select class="form-control" name="platp3" id="platp3" required>
				    				<option value="Selecione" selected disabled hidden>Selecione</option>
								    <option value="PC">Computador/Notebook</option>
								    <option value="CO">Console de Jogo</option>
								    <option value="SM">Smartphone</option>
								    <option value="TB">Tablet</option>  
								</select>
							</div>
				      		</td>
					    </tr>
					    <tr>
					    	<th scope="row">4</th>					      
				    		<td>
			      			<div class="form-group">
								<label class="sr-only" for="platp4">Plataforma de Jogo 4</label>
				    			<select class="form-control" name="platp4" id="platp4" required>
				    				<option value="Selecione" selected disabled hidden>Selecione</option>
								    <option value="PC">Computador/Notebook</option>
								    <option value="CO">Console de Jogo</option>
								    <option value="SM">Smartphone</option>
								    <option value="TB">Tablet</option>  
								</select>
							</div>
				      		</td>
					    </tr>
					   </tbody>
				</table>
		</div>
  		</div>
  	</fieldset>
  	<fieldset>
  		<legend class="mt-3"> </legend>
  		<div class="row">
  			<div class="col-sm-12 text-justify">
  				<p> As questões que se seguem remetem a toda e qualquer atividade relacionada ao tempo despendido em videogames nos últimos 12 meses. As atividades relacionadas com os videogames referem-se, mais concretamente, a qualquer tempo despendido em jogar (quer pela Internet ou não), jogos em consoles, computadores, notebooks ou em qualquer outro tipo de dispositivo móvel (por exemplo: celular, tablet, etc.). A questões deverão ser respondidas dentro de uma escala com cinco opções (Nunca, Raramente, Algumas Vezes, Frequentemente, Quase Sempre). </p>
  			</div>
  		</div>
  		<div class="table-responsive">
  			<table class="table">
 				<thead>
 					<tr>
 						<th scope="col" class="col-1">#</th>
 						<th scope="col" class="col-auto"></th>
 						<th scope="col" class="col-1">Resposta</th>
 					</tr>
 				</thead>
 				<tbody>
 					<tr>
 						<th scope="row">1</th>
 						<td> 
 							Você se sente preocupado com o seu comportamento em relação aos videogames? (Exemplos: Pensa sobre sessões de jogos anteriores ou antecipa a próxima sessão que irá jogar; Jogar tornou-se a principal atividade do seu dia-a-dia.)
 						</td>
 						<td>
 							<div class="form-check">						
 							 <input class="form-check-input" type="radio" name="q1" id="q1-1" value="1" required>
 							 <label class="form-check-label" for="q1-1">Nunca</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q1" id="q1-2" value="2">
 							 <label class="form-check-label" for="q1-2">Raramente</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q1" id="q1-3" value="3">
 							 <label class="form-check-label" for="q1-3">Algumas vezes</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q1" id="q1-4" value="4">
 							 <label class="form-check-label" for="q1-4">Frequentemente</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q1" id="q1-5" value="5">
 							 <label class="form-check-label" for="q1-5">Quase sempre</label>
 							</div>
 						</td>
 					</tr>
 					<tr>
 						<th scope="row">2</th>
 						<td> 
 							Você se sente mais irritado(a), ansioso(a) ou até mesmo triste quando tenta reduzir ou parar de jogar?
 						</td>
 						<td>
 							<div class="form-check">						
 							 <input class="form-check-input" type="radio" name="q2" id="q2-1" value="1" required>
 							 <label class="form-check-label" for="q2-1">Nunca</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q2" id="q2-2" value="2">
 							 <label class="form-check-label" for="q2-2">Raramente</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q2" id="q2-3" value="3">
 							 <label class="form-check-label" for="q2-3">Algumas vezes</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q2" id="q2-4" value="4">
 							 <label class="form-check-label" for="q2-4">Frequentemente</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q2" id="q2-5" value="5">
 							 <label class="form-check-label" for="q2-5">Quase sempre</label>
 							</div>
 						</td>
 					</tr>
 					<tr>
 						<th scope="row">3</th>
 						<td> 
 							Você sente necessidade de passar cada vez mais tempo jogando para obter satisfação ou prazer?
 						</td>
 						<td>
 							<div class="form-check">						
 							 <input class="form-check-input" type="radio" name="q3" id="q3-1" value="1" required>
 							 <label class="form-check-label" for="q3-1">Nunca</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q3" id="q3-2" value="2">
 							 <label class="form-check-label" for="q3-2">Raramente</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q3" id="q3-3" value="3">
 							 <label class="form-check-label" for="q3-3">Algumas vezes</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q3" id="q3-4" value="4">
 							 <label class="form-check-label" for="q3-4">Frequentemente</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q3" id="q3-5" value="5">
 							 <label class="form-check-label" for="q3-5">Quase sempre</label>
 							</div>
 						</td>
 					</tr>
 					<tr>
 						<th scope="row">4</th>
 						<td> 
 							Você falha sistematicamente quando tenta reduzir ou deixar de jogar?
 						</td>
 						<td>
 							<div class="form-check">						
 							 <input class="form-check-input" type="radio" name="q4" id="q4-1" value="1" required>
 							 <label class="form-check-label" for="q4-1">Nunca</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q4" id="q4-2" value="2">
 							 <label class="form-check-label" for="q4-2">Raramente</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q4" id="q4-3" value="3">
 							 <label class="form-check-label" for="q4-3">Algumas vezes</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q4" id="q4-4" value="4">
 							 <label class="form-check-label" for="q4-4">Frequentemente</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q4" id="q4-5" value="5">
 							 <label class="form-check-label" for="q4-5">Quase sempre</label>
 							</div>
 						</td>
 					</tr>
 					<tr>
 						<th scope="row">5</th>
 						<td> 
 							Você perdeu o interesse por outras atividades de lazer em função do seu envolvimento com os videogames?
 						</td>
 						<td>
 							<div class="form-check">						
 							 <input class="form-check-input" type="radio" name="q5" id="q5-1" value="1" required>
 							 <label class="form-check-label" for="q5-1">Nunca</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q5" id="q5-2" value="2">
 							 <label class="form-check-label" for="q5-2">Raramente</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q5" id="q5-3" value="3">
 							 <label class="form-check-label" for="q5-3">Algumas vezes</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q5" id="q5-4" value="4">
 							 <label class="form-check-label" for="q5-4">Frequentemente</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q5" id="q5-5" value="5">
 							 <label class="form-check-label" for="q5-5">Quase sempre</label>
 							</div>
 						</td>
 					</tr>
 					<tr>
 						<th scope="row">6</th>
 						<td> 
 							Você já continuou a jogar com a mesma intensidade mesmo sabendo que isso estava causando problemas entre você e outras pessoas?
 						</td>
 						<td>
 							<div class="form-check">						
 							 <input class="form-check-input" type="radio" name="q6" id="q6-1" value="1" required>
 							 <label class="form-check-label" for="q6-1">Nunca</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q6" id="q6-2" value="2">
 							 <label class="form-check-label" for="q6-2">Raramente</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q6" id="q6-3" value="3">
 							 <label class="form-check-label" for="q6-3">Algumas vezes</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q6" id="q6-4" value="4">
 							 <label class="form-check-label" for="q6-4">Frequentemente</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q6" id="q6-5" value="5">
 							 <label class="form-check-label" for="q6-5">Quase sempre</label>
 							</div>
 						</td>
 					</tr>
 					<tr>
 						<th scope="row">7</th>
 						<td> 
 							Você já escondeu de algum familiar, terapeuta ou outra pessoa, a quantidade de tempo que passou jogando?
 						</td>
 						<td>
 							<div class="form-check">						
 							 <input class="form-check-input" type="radio" name="q7" id="q7-1" value="1" required>
 							 <label class="form-check-label" for="q7-1">Nunca</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q7" id="q7-2" value="2">
 							 <label class="form-check-label" for="q7-2">Raramente</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q7" id="q7-3" value="3">
 							 <label class="form-check-label" for="q7-3">Algumas vezes</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q7" id="q7-4" value="4">
 							 <label class="form-check-label" for="q7-4">Frequentemente</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q7" id="q7-5" value="5">
 							 <label class="form-check-label" for="q7-5">Quase sempre</label>
 							</div>
 						</td>
 					</tr>
 					<tr>
 						<th scope="row">8</th>
 						<td> 
 							Você joga para evitar ou aliviar sentimentos difíceis (Exemplos: impotência, culpa, ansiedade)?
 						</td>
 						<td>
 							<div class="form-check">						
 							 <input class="form-check-input" type="radio" name="q8" id="q8-1" value="1" required>
 							 <label class="form-check-label" for="q8-1">Nunca</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q8" id="q8-2" value="2">
 							 <label class="form-check-label" for="q8-2">Raramente</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q8" id="q8-3" value="3">
 							 <label class="form-check-label" for="q8-3">Algumas vezes</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q8" id="q8-4" value="4">
 							 <label class="form-check-label" for="q8-4">Frequentemente</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q8" id="q8-5" value="5">
 							 <label class="form-check-label" for="q8-5">Quase sempre</label>
 							</div>
 						</td>
 					</tr>
 					<tr>
 						<th scope="row">9</th>
 						<td> 
 							Você já colocou em risco, perdeu um relacionamento importante, oportunidade de trabalho ou educacional, por causa dos videogames?
 						</td>
 						<td>
 							<div class="form-check">						
 							 <input class="form-check-input" type="radio" name="q9" id="q9-1" value="1" required>
 							 <label class="form-check-label" for="q9-1">Nunca</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q9" id="q9-2" value="2">
 							 <label class="form-check-label" for="q9-2">Raramente</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q9" id="q9-3" value="3">
 							 <label class="form-check-label" for="q9-3">Algumas vezes</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q9" id="q9-4" value="4">
 							 <label class="form-check-label" for="q9-4">Frequentemente</label>
 							</div>
 							<div class="form-check">
 							 <input class="form-check-input" type="radio" name="q9" id="q9-5" value="5">
 							 <label class="form-check-label" for="q9-5">Quase sempre</label>
 							</div>
 						</td>
 					</tr>


  			</table>
  		</div>	
	</fieldset>
	<div class="form-row mb-5 mt-3">
		<div class="offset-9 offset-sm-10">
			<button type="submit" name="submit" class="btn btn-success">Prosseguir</button>
		</div>
	</div>


	</form>
</div>




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>