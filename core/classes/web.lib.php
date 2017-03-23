<?php
class web {

    var $pdo = null;
    var $tpl = null;
    var $error = null;
    var $lastId = null;
    var $ladeni = 0;
    var $uploaddir = '../photos/';

    var $dbtype = 'mysql';
    var $dbname = 'mb-web_cz_demo';
    var $charset = 'utf8';
    var $dbhost = 'localhost';
    var $dbuser = '34330_mb_web';
    var $dbpass = 'Vencamb850816';
    var $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_PERSISTENT => FALSE);

    function __construct() {
        // instantiate the pdo object
        try {
            $dsn = "{$this->dbtype}:host={$this->dbhost};dbname={$this->dbname};charset={$this->charset}";
            $this->pdo = new PDO($dsn,$this->dbuser,$this->dbpass,$this->options);
            $this->kill_connection();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        }	

        // instantiate the template object
        $this->tpl = new Web_Smarty;
    }

    function kill_connection() {
        $sql = "SHOW FULL PROCESSLIST";
        try {
            foreach($this->query($sql) as $row) {
                if(($row['Time'] > 20) && ($row['Command'] == 'Sleep')) {
                    $sql = "KILL ".$row['Id'];
                    $query = $this->pdo->exec($sql);
                }
            }
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    function setLastId() {
        $lastId = $this->pdo->lastInsertId('id');
        $this->lastId = $lastId;
    }

    function getLastId() {
        return $this->lastId;
    }

    function addEntry($table, $data) {
        try {
            $sql = "insert into ".$table." values (";
            $pocet_sloupcu = count($data);
            $i=0;
            foreach($data as $sloupec) {
                if(++$i === $pocet_sloupcu) {
                    $sql.="'".$sloupec."'";
                }
                else {
                    $sql.="'".$sloupec."', ";
                }
            }   
            $sql.= ")";
            echo $sql;
            $rh = $this->pdo->exec($sql);
            return true;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            return false;
        }
    }

    function editEntries($table, $data, $where) {
        try {
            $pocet_sloupcu = count($data);
            $i=0;
            $sql = "update ".$table." set ";
            foreach($data as $sloupec => $hodnota) {
                if(++$i === $pocet_sloupcu) {
                    $sql.= $sloupec." = '".$hodnota."' ";
                }
                else {
                    $sql.= $sloupec." = '".$hodnota."', ";
                }
            }            
            $sql.="where ".$where."";
            echo $sql;
            $rh = $this->pdo->exec($sql);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            return false;
        }
    }

    function deleteEntry($table,$where) {
        try {
            $sql = "delete from ".$table." where ".$where."";
            if($this->ladeni == 1) {
                echo "<pre>".$sql."</pre>";
            }
            $rh = $this->pdo->exec($sql);
            return true;
        } catch (PDOException $e) {
            print "Error!: ". $e->getMessage();
            return false;
        }
    }

    function deleteEntryBy($table, $nazev_sloupce, $hodnota_sloupce) {
        try {
            $sql = "delete from ".$table." where ".$nazev_sloupce."=".$hodnota_sloupce."";
            if($this->ladeni == 1) {
                echo $sql;
            }
            $rh = $this->pdo->exec($sql);
            return true;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            return false;
        }
    }

    function deleteEntryById($table, $id) {
        try {
            $sql = "delete from ".$table." where id=".$id."";
            if($this->ladeni == 1) {
                echo $sql;
            }
            $rh = $this->pdo->exec($sql);
            return true;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            return false;
        }
    }

    function deleteFile($from, $file) {
        $delete = $from . DIRECTORY_SEPARATOR . $file;    
        unlink($delete);
    }

    function getCount($from, $where) {
        $row = $this->getEntry('count(id) as pocet', $from, $where);
        return $row['pocet'];
    }

    function getCountRows($table, $where=NULL) {
        try {
            $sql = "select *,count(*) as count from ".$table."";
            if($where !=NULL) {
                $sql.= " where ".$where.""; 
            }
            $query = $this->pdo->query($sql);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['count'];
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        }
    }

    function getEntries($cols, $from, $where=NULL, $orderBy=NULL, $limit=NULL, $groupBy=NULL) {
        try {
            $sql = "select ";
            if(is_array($cols)) {
                $numItems = count($cols);
                $i=0;
                foreach($cols as $col) {
                    if(++$i === $numItems) {
                        $sql.= $col;
                    }
                    else {
                        $sql.= $col.",";
                    }
                }
            }
            else {
                $sql.= $cols;
            }
            $sql.= " from ".$from." ";
            if($where != '') {
                $sql.= "where ".$where." ";  
            }    
            if($groupBy != '') {
                $sql.= "group by ".$groupBy." ";
            }
            if($orderBy != '') {
                $sql.= "order by ".$orderBy." ";
            }
            if($limit != '') {
                $sql.= "LIMIT ".$limit." ";
            }
            if($this->ladeni == 1) {
                echo "<pre>".$sql."</pre>";
            }
            foreach($this->pdo->query($sql) as $row) { 
                $rows[] = $row; 
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            return false;
        } 	
        return $rows;  
    }  

    function getEntry($cols, $from, $where=NULL) {
        try {
            $sql = "select ";
            if(is_array($cols)) {
                $numItems = count($cols);
                $i=0;
                foreach($cols as $col) {
                    if(++$i === $numItems) {
                        $sql.= $col;
                    }
                    else {
                        $sql.= $col.",";
                    }
                }
            }
            else {
                $sql.= $cols;
            }
            $sql.= " from ".$from." ";
            if($where != '') {
                $sql.= "where ".$where." ";  
            }  
            if($this->ladeni == 1) {
                echo "<pre>".$sql."</pre>";
            }
            $query = $this->pdo->query($sql);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row;  
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            return false;
        }   
    }

    function leftJoin($cols, $from, $leftJoin, $on, $where=NULL, $groupBy=NULL, $orderBy=NULL) {
        try {
            $sql = "SELECT ";
            if(is_array($cols)) {
                $numItems = count($cols);
                $i=0;
                foreach($cols as $col) {
                    if(++$i === $numItems) {
                        $sql.= $col;
                    }
                    else {
                        $sql.= $col.",";
                    }
                }
            }
            else {
                $sql.= $cols;
            }
            $sql.= " FROM ".$from;
            $sql.= " LEFT JOIN ".$leftJoin;
            $sql.= " ON ".$on;  
            if($where != NULL) { $sql.= " WHERE ".$where; }
            if($groupBy != NULL) { $sql.= " GROUP BY ".$groupBy; }
            if($orderBy != NULL) { $sql.= " ORDER BY ".$orderBy; }
            if($this->ladeni == 1) {
                echo "<pre>".$sql."</pre>";
            }
            foreach($this->pdo->query($sql) as $row) { 
                $rows[] = $row; 
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            return false;
        }   
        return $rows;  
    }
    
    function fileUpload($where, $soubor) {
        $uploadfile = $where . basename($soubor['name']);
        $allowedExts = array("doc", "docx", "pdf", "xls", "xlsx", "txt", "jpg", "jpeg", "gif", "png", "flv");
        $temp = explode(".", $soubor['name']);
        $extension = end($temp);
        if(in_array($extension, $allowedExts)) {
            move_uploaded_file($soubor['tmp_name'], $uploadfile);
        }
    }
    
    function query($sql, $rowCount='') {
        try {
            if($this->ladeni == 1) {
                echo "<pre>".$sql."</pre>";
            }
            if ($rowCount == '') {
                foreach($this->pdo->query($sql) as $row) { 
                    $rows[] = $row; 
                }
                return $rows;
            }
            else {
                $query = $this->pdo->query($sql);
                $row = $query->fetch(PDO::FETCH_ASSOC);
                return $row;
            }                
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            return false;
        }
    }

    function send_email($from, $to, $subject, $message) {
        $headers = "From: ".strip_tags($from) . "\r\n";
        $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        mail($to, $subject, $message, $headers);
    }

    function nahrat_soubor_s_vodoznakem($cilovy_soubor, $soubor_s_vodoznakem, $cilova_cesta, $filename) {
        $handle = new upload($cilovy_soubor);
        if ($handle->uploaded) {
            $handle->image_watermark      = $soubor_s_vodoznakem;
            // $handle->image_watermark_x    = '90%';
            // $handle->image_watermark_y    = '90%';
            // $handle->image_watermark_position = 'LR';
            $handle->file_new_name_body   = $filename;
            // $handle->image_resize         = true;
            // $handle->image_x              = 100;
            // $handle->image_ratio_y        = true;
            $handle->process($cilova_cesta);
            if ($handle->processed) {
                // echo ' - soubor s vodoznakem nahran<br>';
                $handle->clean();
            } else {
                echo 'error : ' . $handle->error;
            }
        }
    }
    function nahrat_soubor_bez_vodoznaku($cilovy_soubor, $cilova_cesta, $filename) {
        $handle = new upload($cilovy_soubor);
        if ($handle->uploaded) {
            // $handle->image_watermark      = $soubor_s_vodoznakem;
            // $handle->image_watermark_x    = '90%';
            // $handle->image_watermark_y    = '90%';
            // $handle->image_watermark_position = 'LR';
            $handle->file_new_name_body   = $filename;
            // $handle->image_resize         = true;
            // $handle->image_x              = 100;
            // $handle->image_ratio_y        = true;
            $handle->process($cilova_cesta);
            if ($handle->processed) {
                // echo ' - soubor bez vodoznaku nahran<br>';
                $handle->clean();
            } else {
                echo 'error : ' . $handle->error;
            }
        }
    }

    function nice_url($str, $replace=array(), $delimiter='-') {
        if( !empty($replace) ) {
            $str = str_replace((array)$replace, ' ', $str);
        }
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

        return $clean;
    }

    public function nahrat_obrazek($obrazek) {
        if(!empty($obrazek['name'])) {
            $datum = date('YmdHi');
            $name = $obrazek['name'];
            $uploadfile = IMAGES_UPLOADS . $datum . $name;
            $allowedExts = array("jpg", "jpeg", "gif", "png");
            $temp = explode(".", $name);
            $extension = end($temp);
            if(in_array($extension, $allowedExts)) {
                move_uploaded_file($obrazek['tmp_name'], $uploadfile);
            }
            $obr = $datum . $obrazek['name'];
        }
        return $obr;
    }

    public function nahrat_soubor($soubor, $cesta) {
        if(!empty($soubor['name'])) {
            $datum = date('YmdHi');
            $name = $soubor['name'];
            $uploadfile = $cesta . $datum . $name;
            $temp = explode(".", $name);
            $extension = end($temp);
            move_uploaded_file($soubor['tmp_name'], $uploadfile);
            $obr = $datum . $soubor['name'];
        }
        return $obr;
    }
 
}

?>