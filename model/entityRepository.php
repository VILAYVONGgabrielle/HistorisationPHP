<?php

namespace model;

class EntityRepository 
{
    private $db;
    public $table1;
    public $table2;
    public $table3;


    public function getDb()
    {
        if(!$this->db)
        {
            try {
                $xml = simplexml_load_file('app/config.xml');
                    //var_dump($xml);

               $this->table1 = $xml->table1;
               $this->table2 = $xml->table2;
               $this->table3 = $xml->table3;

              try{
                  $this->db = new \PDO('mysql:host=' . $xml->host . ";dbname=" . $xml->db, $xml->user, $xml->password, [
                      \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
                      \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                  ]);

              }
              catch (\Exception $e){
                echo $e->getMessage();
            }

            }
            catch (\Exception $e){
                echo $e->getMessage();
            }
        }

        return $this->db;
    }

    ##############################
    // get les chanps 'propriete/attribut' dans la BDD
    public function getFields()
    {
        $data = $this->getDb()->query("DESC ". $this->table1);
        $r = $data->fetchAll(\PDO::FETCH_ASSOC);
        return $r;
    }
    public function getFieldsTable2()
    {
        $data = $this->getDb()->query("DESCRIBE ". $this->table2 );
        $r = $data->fetchAll(\PDO::FETCH_ASSOC);
        return $r;
    }
    public function getFieldsTable3()
    {
        $data = $this->getDb()->query("DESCRIBE ". $this->table3 );
        $r = $data->fetchAll(\PDO::FETCH_ASSOC);
        return $r;
    }


    #############################
    // 
    public function selectAllEntityRepo()
    {
        $data = $this->getDb()->query(" SELECT*FROM " . $this->table1);
        $r = $data->fetchAll(\PDO::FETCH_ASSOC);
        return $r;
    }

    #############################
    // 
    public function selectEntityRepo($id)
    {
        // SELECT *
                //FROM societes
                //INNER JOIN adresses ON societes.adresses_idadresses = adresses.idadresses
                //INNER JOIN listejuridique ON societes.idsocietes = listejuridique.societes_idsocietes
                //WHERE societes.idsocietes = 2
        $data = $this->getDb()->query(" SELECT*FROM " . $this->table1 . 
                                        " INNER JOIN " . $this->table2 . " ON " . $this->table1 .".adresses_idadresses = ". $this->table2. ".idadresses 
                                            INNER JOIN " . $this->table3 . " ON " . $this->table1 .".idsocietes = ". $this->table3. ".societes_idsocietes
                                             WHERE ". $this->table1 .".idsocietes =" . $id);
        $rq = $data->fetch(\PDO::FETCH_ASSOC);
        return $rq;
    }

    #############################
    // 
    public function selectAllLibelle()
    {
        //SELECT `libelle` FROM `listejuridique`
        $data = $this->getDb()->query(" SELECT libelle FROM ". $this->table3);
        $rq =$data->fetchAll(\PDO::FETCH_ASSOC);
        return $rq;
    }

    #############################
    // 
    public function save()
    {
        $id = isset($_GET['id'])? $_GET['id']: 'NULL';
        $post = array_keys($_POST);

        $rq = $this->getDb()->query('INSERT INTO '. $this->table1 . '(id' .($this->table1).','. implode(',', array_slice($post,0,5)). ','. ' dresses_idadresses ' .') VALUE(' . $id . ',' . "'" . implode("','", array_slice($_POST,0,5)) . "'" . 'id'.($this->table2)  .')');
        $rq1 = $this->getDb()->query('INSERT INTO '. $this->table2 . '(id' .($this->table2).','. implode(',', array_slice($post,5)). ') VALUE(' . $id . ',' . "'" . implode("','", array_slice($_POST,5)) . "'" .  ')');
    } 



}