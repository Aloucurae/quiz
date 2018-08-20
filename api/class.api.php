<?php 
include 'class.db.php';

class api extends Db {

	function __construct(){
	}	

	function session($post){
		$res = isset($_SESSION['AUTH']) ? $_SESSION['AUTH'] : false;
		return $res;
	}	

	function logout($post){

		unset($_SESSION['AUTH']);

	}

	function login($post){

		$sql = 'SELECT * FROM usuarios WHERE usua_logi = :logi';

		$bind[':logi'] = $post['logi']['usua_logi'];

		$logi = $this->query($sql,$bind);
		$logi = $logi->fetch();

		if ($logi) {
			if ($logi['usua_senh'] == $post['logi']['usua_senh']) {
				unset($logi['usua_senh']);
				$_SESSION['AUTH'] = $logi;
				return $logi;
			}else{
				return array('erro'=> true,'menssage'=>'Senha Incorreta');
			}
		}else{
			return array('erro'=> true,'menssage'=>'Usuario não encontrado');
		}
	}

	function listaQuizzes($post = ''){

		$sql = 'SELECT * from quiz ';
		
		$bind = NULL;

		if (isset( $_SESSION['AUTH']['usua_codi'])) {
			$sql .= ' WHERE quiz_usua = :usua';
			$bind[':usua'] = $bind[':usua'] = $_SESSION['AUTH']['usua_codi'];
		}

		$res = $this->query($sql,$bind);
		return $res->fetchAll(); 
	}

	function salvaQuiz($post){

		$q = $post['quiz'];

		$bind[':titu'] = $q['quiz_titu'];
		$bind[':decs'] = $q['quiz_desc'];
		$bind[':usua'] = $_SESSION['AUTH']['usua_codi'];

		if (isset($q['quiz_codi']) AND $q['quiz_codi'] != '') {

			$bind[':codi'] = $q['quiz_codi'];

			$sql = 'UPDATE quiz
					   SET quiz_titu = :titu
						 , quiz_desc = :decs
						 , quiz_date = :now()
						 , quiz_usua = :usua
					 WHERE quiz_codi = :codi;';
			
			$this->exec($sql,$bind);	

		}else{

			$sql = 'INSERT INTO 
					quiz ( quiz_titu
						 , quiz_desc
						 , quiz_date
						 , quiz_usua
						 , quiz_ativ)
				    VALUES (:titu
						 , :decs
						 , now()
						 , :usua
						 , "A");';

			$q['quiz_codi'] = $this->exec2($sql,$bind,['nome'=>'quiz','id'=>'quiz_codi']);

		}

		unset($bind);

		for ($i = 0; $i < sizeof($q['qupe']); $i++) { 

			unset($bind);

			$bind[':decs'] = $q['qupe'][$i]['qupe_desc'];
			$bind[':quiz'] = $q['quiz_codi'];

			if (isset($q['qupe'][$i]['qupe_codi']) AND $q['qupe'][$i]['qupe_codi'] != '') {

				$sql = 'UPDATE quiz_perguntas
						   SET qupe_desc = :decs
							 , qupe_quiz = :quiz							
						 WHERE qupe_codi = :qupe';

				$bind[':qupe'] = $q['qupe'][$i]['qupe_codi'];
				
	   			$this->exec($sql,$bind);
				
			}else{

				$sql = 'INSERT INTO 
				quiz_perguntas (qupe_desc
  							 , qupe_quiz
  							 , qupe_ativ)
					   VALUES( :decs
					   		 , :quiz
					   		 , "A");';

	   			$q['qupe'][$i]['qupe_codi'] = $this->exec2($sql,$bind,['nome'=>'quiz_perguntas','id'=>'qupe_codi']);

			}

			unset($bind);

			$remp[] = $q['qupe'][$i]['qupe_codi'];	

			for ($x=0; $x < sizeof($q['qupe'][$i]['resp']); $x++) { 

				unset($bind);

				if (isset($q['qupe'][$i]['resp'][$x]['resp_verd']) AND $q['qupe'][$i]['resp'][$x]['resp_verd'] != '') {
					$bind[':verd'] = $q['qupe'][$i]['resp'][$x]['resp_verd'];
				}else{
					$bind[':verd'] = 0;
				}

				$bind[':qupe'] = $q['qupe'][$i]['qupe_codi'];
				$bind[':decs'] = $q['qupe'][$i]['resp'][$x]['resp_desc'];

				if (isset($q['qupe'][$i]['resp'][$x]['resp_codi']) AND $q['qupe'][$i]['resp'][$x]['resp_codi'] != '') {

					$bind[':resp'] = $q['qupe'][$i]['resp'][$x]['resp_codi'];

					$sql = 'UPDATE respostas
							   SET resp_qupe = :qupe
							     , resp_desc = :decs
							     , resp_verd = :verd
								WHERE resp_codi = :resp;';

					$this->exec($sql,$bind); 

				}else{

					$sql = 'INSERT INTO
					     respostas (resp_qupe
					     		 , resp_desc
					     		 , resp_verd
					     		 , resp_ativ)
							VALUES (:qupe
								 , :decs
								 , :verd
								 , "A");';

					$q['qupe'][$i]['resp'][$x]['resp_codi'] = $this->exec2($sql,$bind,['nome'=>'respostas','id'=>'resp_codi']);
				}

				$remr[] = $q['qupe'][$i]['resp'][$x]['resp_codi'];

			}

			unset($bind);

			$bind[':qupe'] = $q['qupe'][$i]['qupe_codi'];
			$bind[':remr'] =  implode(',', $remr);

			$sql = 'UPDATE SET resp_ativ = "I" FROM respostas WHERE resp_codi NOT IN (:remr) AND resp_qupe = :qupe ';

			$this->exec($sql,$bind); 

		}

		unset($bind);

		$bind[':quiz'] = $q['quiz_codi'];
		$bind[':remp'] = implode(',', $remp);

		$sql = 'UPDATE SET qupe_ativ = "I" FROM quiz_perguntas WHERE qupe_codi NOT IN (:remp) AND qupe_quiz = :quiz ';

		$this->exec($sql,$bind); 

		return $this->listaQuizzes();
	
	}

	function mudaStatusQuiz($post){

		$bind[':quiz'] = $post['quiz']['quiz_codi'];
		$bind[':ativ'] = $post['quiz']['quiz_ativ'];

		$sql = 'UPDATE SET quiz_ativ = :ativ 
		 		  FROM quiz 
		 		 WHERE quiz_codi :quiz';

		return $this->exec($sql,$bind); 
	}

	function carregaQuiz($post){

		$sql = 'SELECT * FROM quiz WHERE quiz_codi = :quiz';

		$bind[':quiz'] = $post['quiz']['quiz_codi'];

		$quiz = $this->query($sql,$bind);
		$quiz = $quiz->fetch();

		$sql = 'SELECT * from quiz_perguntas WHERE qupe_quiz = :quiz AND qupe_ativ = "A"';

		$res = $this->query($sql,$bind);
		$quiz['qupe'] = $res->fetchAll();

		$sql = 'SELECT * from respostas WHERE resp_qupe = :qupe AND resp_ativ = "A"';

		for ($i=0; $i < sizeof($quiz['qupe']); $i++) { 

			unset($bind);
			$bind[':qupe'] = $quiz['qupe'][$i]['qupe_codi'];

			$res = $this->query($sql,$bind);
			$quiz['qupe'][$i]['resp'] = $res->fetchAll();

		}


		return $quiz;
	}

	function cadatraCliente($post){

		$bind[':mail'] = $post['clie']['clie_mail'];
		$sql = 'SELECT * FROM clientes WHERE clie_mail = :mail';

		$clie = $this->query($sql,$bind);
		$clie = $clie->fetch();

		if ($clie) {
			// return $clie;
		}else{

			$bind[':nome'] = isset($post['clie']['clie_nome']) ? $post['clie']['clie_nome'] : '';

			$sql = 'INSERT INTO clientes (clie_nome , clie_mail) VALUES(:nome,:mail)';

			$clie = $post['clie'];

			$clie['clie_codi'] = $this->exec2($sql,$bind,['nome'=>'clientes','id'=>'clie_codi']);
		}

		unset($bind);

		$bind[':clie'] = $clie['clie_codi'];
		$bind[':quiz'] = $post['quiz']['quiz_codi'];

		$sql = 'INSERT INTO quiz_clintes (qucl_clie ,qucl_quiz,qucl_dini) VALUES (:clie, :quiz, now() );';

		$clie['qucl_codi'] = $this->exec2($sql,$bind,['nome' => 'quiz_clintes','id'=>'qucl_codi']);

		return $clie;
	}

	function salvaRespostaCliente($post){

		$qupe = $post['quiz']['qupe'];

		$bind[':qucl'] = $post['clie']['qucl_codi'];

		$res = array();

		$sql = 'INSERT INTO respostas_clientes (recl_qucl ,recl_resp) VALUES (:qucl, :resp);';

		for ($i=0; $i < sizeof($qupe) ; $i++) { 
			for ($x=0; $x < sizeof($qupe[$i]['resp']) ; $x++) { 
				if (isset($qupe[$i]['resp'][$x]['resp_clie']) AND $qupe[$i]['resp'][$x]['resp_clie'] == 1) {

					$bind[':resp'] = $qupe[$i]['resp'][$x]['resp_codi'];

					$res[] = $this->exec($sql,$bind);

					unset($bind[':resp']);
				}
			}
		}

		$sql = 'UPDATE quiz_clintes
				   SET qucl_dfim = now()
				 WHERE qucl_codi = :qucl ;';


		$this->exec($sql,$bind);

		return $res;
	}

	function listaRespondidos($post){

		$sql = ' SELECT clie_mail
				      , quiz_desc
				      , DATE_FORMAT(qucl_dini,"%d-%m-%Y %H:%i:%s") qucl_dini
				      , DATE_FORMAT(qucl_dfim,"%d-%m-%Y %H:%i:%s") qucl_dfim
				      , qucl_codi
				  FROM clientes
				  	 , quiz_clintes
				  	 , quiz
				  WHERE clie_codi = qucl_clie
				   AND qucl_quiz = quiz_codi';


		$r = $this->query($sql);
		$r = $r->fetchAll();

		return $r;
	}


	function carregaQuizRespostas($post){

		// $sql = 'SELECT * from quiz_clintes WHERE qucl_codi = :qucl';

		// $bind[':qucl'] = $post['qucl'];

		// $qucl = $this->query($sql,$bind);
		// $qucl = $qucl->fetch();

		// $sql = 'SELECT GROUP_CONCAT( recl_resp SEPARATOR ",") resp FROM respostas_clientes WHERE recl_qucl = :qucl';

		// $resp = $this->query($sql,$bind);
		// $resp = $resp->fetch();

		// $resp = $resp['resp'];

		// unset($bind);

		// $sql = 'SELECT * FROM quiz WHERE quiz_codi = :quiz';

		// $bind[':quiz'] = $qucl['qucl_quiz'];

		// $quiz = $this->query($sql,$bind);
		// $quiz = $quiz->fetch();

		// $bind[':resp'] = $resp;

		// $sql = 'SELECT quiz_perguntas.* 
		// 		  FROM quiz_perguntas 
		// 		     , respostas
		// 		 WHERE qupe_quiz = :quiz
		// 		   AND resp_qupe = qupe_codi
		// 		   AND resp_codi IN (:resp)';

		// $res = $this->query($sql,$bind);
		// $quiz['qupe'] = $res->fetchAll();

		// $sql = 'SELECT * FROM respostas WHERE resp_qupe = :qupe AND resp_codi IN (:resp)';

		// for ($i=0; $i < sizeof($quiz['qupe']); $i++) { 

		// 	unset($bind);

		// 	$bind[':qupe'] = $quiz['qupe'][$i]['qupe_codi'];
		// 	$bind[':resp'] = $resp;

		// 	$res = $this->query($sql,$bind);
		// 	$quiz['qupe'][$i]['resp'] = $res->fetchAll();
		// }

		$sql = 'SELECT quiz.*
					 ,
				  CONCAT(
				    "[",
				    GROUP_CONCAT(
				       \'{"qupe_desc":"\',
				      qupe_desc,
				      \'","resp":\',
				      CONCAT(\'[\', \'{"resp_desc":"\' ,resp_desc,\'","resp_verd":"\',resp_verd, \'"}]\' ),
				      \'}\' SEPARATOR ","
				    ),
				    "]"
				  ) AS qupe
				FROM
				  respostas_clientes,
				  respostas,
				  quiz_perguntas,
				  quiz
				WHERE recl_resp = resp_codi
				  AND resp_qupe = qupe_codi
				  AND quiz_codi = qupe_quiz
				  AND recl_qucl = :qucl
				GROUP BY recl_qucl';

		$bind[':qucl'] = $post['qucl'];

		$qucl = $this->query($sql,$bind);
		$qucl = $qucl->fetch();

		$qucl['qupe'] = json_decode($qucl['qupe'],1);

		// var_dump($quiz);

		return $qucl;
	}

}

?>



