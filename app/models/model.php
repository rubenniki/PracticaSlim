<?php

namespace app\models\model;

use app\lib\database;
use app\lib\response;

class Model{

    private $db;
    private $table = 'notes';
    private $response;

    public function __CONSTRUCT(){
        $this->db = database::conectar();
        $this->response = new Response();
    }
	
    public function getAll(){
        try{
            $result = array();

            $stm = $this->db->prepare("SELECT * FROM $this->table WHERE user= 'LSAlumne'");
            $stm->execute();

            $this->response->setResponse(true);
            $this->response->result = $stm->fetchAll();

            return $this->response;
        }
        catch(Exception $e)
        {
            $this->response->setResponse(false, $e->getMessage());
            return $this->response;
        }
    }
	
	public function getPublic(){
        try{
            $result = array();

            $stm = $this->db->prepare("SELECT * FROM $this->table WHERE private = 0");
            $stm->execute();

            $this->response->setResponse(true);
            $this->response->result = $stm->fetchAll();

            return $this->response;
        }
        catch(Exception $e)
        {
            $this->response->setResponse(false, $e->getMessage());
            return $this->response;
        }
    }

    public function GetOne($id)
    {
        try
        {
            $result = array();

            $stm = $this->db->prepare("SELECT * FROM $this->table WHERE id = ?");
            $stm->execute(array($id));

            $this->response->setResponse(true);
            $this->response->result = $stm->fetch();

            return $this->response;
        }
        catch(Exception $e)
        {
            $this->response->setResponse(false, $e->getMessage());
            return $this->response;
        }
    }
    public function InsertOrUpdate($data)
    {
        try
        {
            if(isset($data['id']))
            {
                $sql = "UPDATE $this->table SET 
                            title          = ?, 
                            content        = ?,
                            private        = ?,
                            tag1           = ?,
                            tag2           = ?,
                            tag3           = ?,
                            tag4           = ?,
                            book           = ?,
                            createData     = ?,
                            lastModificationData =?,
                            'user'           =?
                        WHERE id = ?";
                $this->db->prepare($sql)
                    ->execute(
                        array(
                            $data['title'],
                            $data['content'],
                            $data['private'],
                            $data['tag1'],
                            $data['tag2'],
                            $data['tag3'],
                            $data['tag4'],
                            $data['book'],
                            $data['createData'],
                            $data['lastModificationData'],
                            $data['id']
                        )
                    );
            }
            else
            {
                $sql = "INSERT INTO $this->table VALUES (?,?,?,?,?,?,?,?)";

                $this->db->prepare($sql)
                    ->execute(
                        array(
                            $data['title'],
                            $data['content'],
                            $data['private'],
                            $data['tag1'],
                            $data['tag2'],
                            $data['tag3'],
                            $data['tag4'],
                            $data['book'],
                            $data['createData'],
                            $data['lastModificationData'],
                            $data['id'],
                            date('Y-m-d')
                        )
                    );
            }

            $this->response->setResponse(true);
            return $this->response;
        }catch (Exception $e)
        {
            $this->response->setResponse(false, $e->getMessage());
        }
    }

    public function Delete($id)
    {
        try
        {
            $stm = $this->db
                ->prepare("DELETE FROM $this->table WHERE id = ?");

            $stm->execute(array($id));

            $this->response->setResponse(true);
            return $this->response;
        } catch (Exception $e)
        {
            $this->response->setResponse(false, $e->getMessage());
        }
    }

}

?>