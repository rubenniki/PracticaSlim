<?php

use Slim\Http\Request;
use Slim\Http\Response;
use \app\models\model;

// Routes



$app->group('/api/', function () {
	
	

	$this->get('', function ($req, $res, $args) {
        
		$args["code"]= "200";
		$args["msg"]= "LSNote API V0.1";
		$res=$res->withJson($args,200);
		return $res;
        
    });

    $this->get('getAll', function ($req, $res, $args) {
        $model = new \app\models\model\Model();
		$pass= explode("[", json_encode($model->getAll()));
		$user=explode("]", $pass[1]);
		if(empty($user[0])){
			$args["code"]= "204";
			$args["resp"]= "No notes found!";
			$res=$res->withJson($args,300);
			return $res;
		}
		$args["code"]= "200";
		
		$args["resp"]= $user[0];

		$res=$res->withJson($args,200);
		return $res;
		
    });
	
	$this->get('getAll/{orden}', function ($req, $res, $args) {
        $model = new \app\models\model\Model();
		$pass= explode("[", json_encode($model->getAll($args['orden'])));
		$user=explode("]", $pass[1]);
		if(empty($user[0])){
			$args["code"]= "204";
			$args["resp"]= "No notes found!";
			$res=$res->withJson($args,300);
			return $res;
		}
		$args["code"]= "200";
		
		$args["resp"]= $user[0];

		$res=$res->withJson($args,200);
		return $res;
		
    });
	
	$this->get('getPublic', function ($req, $res, $args) {
        $model = new \app\models\model\Model();
		$pass= explode("[", json_encode($model->getPublic()));
		$user=explode("]", $pass[1]);
		if(empty($user[0])){
			$args["code"]= "204";
			$args["resp"]= "No notes found";
			$res=$res->withJson($args,200);
			return $res;
		}
		$args["code"]= "200";
		$args["resp"]= $user[0];
		$res=$res->withJson($args,200);
		return $res;
		
		
    });
	
    $this->get('getOne/{id}', function ($req, $res, $args) {

        $model = new \app\models\model\Model();
		$pass= explode(":", json_encode($model->GetOne($args['id'])));
		$user=explode(",", $pass[1]);
		if($user[0] == "false"){
			$args["code"]= "204";
			$args["resp"]= "No notes found";
			$res=$res->withJson($args,200);
			return $res;
		}
		$pass= explode("{", json_encode($model->GetOne($args['id'])));
		$user=explode("}", $pass[2]);
		$args["code"]= "200";
		$args["resp"]= $user[0];
		$res=$res->withJson($args,200);
		return $res;
		
            
        
    });
	
	$this->get('getAllWithTag/{tag}', function ($req, $res, $args) {

        $model = new \app\models\model\Model();
		$pass= explode(":", json_encode($model->GetAllWithTag($args['tag'])));
		$user=explode(",", $pass[1]);
		if($user[0] == "false"){
			$args["code"]= "204";
			$args["resp"]= "No notes found";
			$res=$res->withJson($args,200);
			return $res;
		}
		$pass= explode("{", json_encode($model->GetAllWithTag($args['tag'])));
		$user=explode("}", $pass[2]);
		$args["code"]= "200";
		$args["resp"]= $user[0];
		$res=$res->withJson($args,200);
		return $res;
		
            
        
    });

    $this->post('save', function ($req, $res) {
        $model = new \app\models\model\Model();

        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $model->InsertOrUpdate(
                    $req->getParsedBody()
                )
            )
        );
    });
	
	$this->post('flipPrivate/{id}', function ($req, $res, $args) {
        $model = new \app\models\model\Model();

        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode($model->flipPrivate($args['id']))
            );
    });

    $this->delete('delete/{id}', function ($req, $res, $args) {
        $model = new \app\models\model\Model();
		json_encode($model->Delete($args['id']));
       return "se ha eliminado";
    });

});


/*
 //Mostrar todos los registros
$app->get('/[{id}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $consulta = 'SELECT * FROM notes';
    try{
        $db = new \app\lib\DataBase();

        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $notas = $ejecutar->fetchAll(PDO::FETCH_OBJ);

        echo json_encode($notas);

    }catch (PDOException $e){
        echo 'Error: '.$e;
    }
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
*/
/*
//Mostrar los registros por id
$app->get('/[{id}]', function (Request $request, Response $response, array $args) {
    // Sample log message

    $id = $request->getAttribute('id');

    $consulta = 'SELECT * FROM notes WHERE id='.$id;
    try{
        $db = new \app\lib\DataBase();

        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $notas = $ejecutar->fetchAll(PDO::FETCH_OBJ);

        echo json_encode($notas);

    }catch (PDOException $e){
        echo 'Error: '.$e;
    }
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
*/

?>
