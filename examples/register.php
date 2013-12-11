<?php

	$player     = $_POST["playerName"];
	$playerPwd1 = $_POST["playerPwd1"];
	$playerPwd2 = $_POST["playerPwd2"];

	if($playerPwd1 == $playerPwd2) {
		include 'connMagicBandit.php';
		$search = mysql_query("SELECT * FROM player AS p WHERE p.character_name LIKE '$player'", $connMB);
		if(@mysql_num_rows($search)==0) {
			$sql = "INSERT INTO player (character_name, pwd, city, country, creation_lat, creation_lng) ";
			$sql .= " VALUES('" . $player . "', " ;
			$sql .= " '" . md5($playerPwd1) . "', ";
			$sql .= " 'Campinas', 'Brasil', -22, -44) " ;
			$rs = mysql_query($sql, $connMB);
			if($rs === FALSE) {
				$result = array(["status"=>"Fracasso", "message"=>"Não foi possível se conectar ao Banco de Dados!"]);
				die(mysql_error());
			} else {
				$result = array(["status"=>"Sucesso", "message"=>"Registrado! Pode começar a Colheita!"]);
			}
		} else {
			$result = array(["status"=>"Fracasso", "message"=>"Nome do Jogador já Existente!"]);
		}
	} else {
		$result = array(["status"=>"Fracasso", "message"=>"Digite Duas Vezes a Mesma Senha!"]);
	}

	echo json_encode($result);

?>