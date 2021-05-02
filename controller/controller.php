<?php

namespace controller;

class Controller 
{
    
    private $dbEntityRhistorisation;

    public function __construct()
    {
        $this->dbEntityRhistorisation = new \model\EntityRepository;
    }

    public function handleRequest()
    {
       
        $op = isset($_GET['op']) ? $_GET['op'] : NULL;

            if($op == 'add' || $op == 'update')
            {
                $this->save($op);
            } 
            elseif($op == 'select')
            {
                $this->select();
            }
            elseif($op == 'delete')
            {
                //$this->delete();
            }
            else
            {
                $this->selectAll(); 
            }           
    }

    private function render($layout, $template, $parameters = array())
    {
        extract($parameters);

        ob_start();
        require "view/$template";
        $content = ob_get_clean();

        ob_start();
        require "view/$layout";

        return ob_end_flush();
    }

    private function redirect($url)
    {
        header("location: $url");
    }

    private function selectAll()
    { 
        $r = $this->dbEntityRhistorisation->getFields();
        //var_dump($r);
        $fields = array_splice($r,0,-1);
        //var_dump($fields);

        $r2 = $this->dbEntityRhistorisation->selectAllEntityRepo();
        //var_dump($r2);
 

        $this->render('layout.php', 'template-allListe.php', [
            'title'=>'liste des societes',
            'fields'=> $fields,
            'data'=> $r2,
            'id'=> 'id'.($this->dbEntityRhistorisation->table1),
        ]);
    }

    private function select()
    {
        $id = (isset($_GET['id'])) ? $_GET['id'] : NULL;
       // var_dump($this->dbEntityRhistorisation->selectEntityRepo($id)); exit;
       
       $r = $this->dbEntityRhistorisation->getFields();
       $field1 = array_splice($r,0,-1);

       $r = $this->dbEntityRhistorisation->getFieldsTable2();
       $field2 = array_splice($r,1);

       $r = $this->dbEntityRhistorisation->getFieldsTable3();
       $field3 = array_splice($r,1,-1);

        $this->render('layout.php', 'template-detail.php', [
            'title' => "détails sur la société: ",
            'data' => $this->dbEntityRhistorisation->selectEntityRepo($id),
            'fieldsTable1'=> $field1,
            'fieldsTable2'=> $field2,
            'fieldsTable3'=> $field3,
        ]);
    }

    private function save($op)
    {
        //var_dump($_POST);
        $title = $op;

        $id = (isset($_GET['id'])) ? $_GET['id'] : NULL;

        $values = ($op == 'update') ? $this->dbEntityRhistorisation->selectEntityRepo($id) : ' ' ;
        //echo var_dump($values);

        $libelle = $this->dbEntityRhistorisation->selectAllLibelle();
        //var_dump($libelle);exit;

        if($_POST)
        {
            $rq = $this->dbEntityRhistorisation->save();
            //$this->redirect('index.php');
        }


        $r = $this->dbEntityRhistorisation->getFields();
        $field1 = array_splice($r,1,-1);
 
        $r = $this->dbEntityRhistorisation->getFieldsTable2();
        $field2 = array_splice($r,1);
 
        $r = $this->dbEntityRhistorisation->getFieldsTable3();
        $field3 = array_splice($r,1,-1);

        $this->render('layout.php', 'template-formulaire.php', [
            'title'=> "action $title",
            'fieldsTable1'=> $field1,
            'fieldsTable2'=> $field2,
            'fieldsTable3'=> $field3,
            'values'=> $values,
            'libelle'=> $libelle,
            'op'=> $op,
        ]);

    }

}