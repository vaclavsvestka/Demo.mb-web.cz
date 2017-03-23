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
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
            if($this->pdo->exec($sql)) { return true; }
        } catch (PDOException $e) {
            $err = $this->pdo->errorInfo();
            $this->pridat_do_error_log($err);
            $this->odeslat_error_email($err);
            $this->redir_error_post($e->getMessage());
            die();
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
            if($this->pdo->exec($sql)) { return true; }
        } catch (PDOException $e) {
            $err = $this->pdo->errorInfo();
            $this->pridat_do_error_log($err);
            $this->odeslat_error_email($err);
            $this->redir_error_post($e->getMessage());
            die();
        }
    }

    function deleteEntry($table,$where) {
        try {
            $sql = "delete from ".$table." where ".$where."";
            if($this->pdo->exec($sql)) { return true; }
        } catch (PDOException $e) {
            $err = $this->pdo->errorInfo();
            $this->pridat_do_error_log($err);
            $this->odeslat_error_email($err);
            $this->redir_error_post($e->getMessage());
            die();
        }
    }

    function deleteEntryBy($table, $nazev_sloupce, $hodnota_sloupce) {
        try {
            $sql = "delete from ".$table." where ".$nazev_sloupce."=".$hodnota_sloupce."";
            if($this->pdo->exec($sql)) {return true;}
        } catch (PDOException $e) {
            $err = $this->pdo->errorInfo();
            $this->pridat_do_error_log($err);
            $this->odeslat_error_email($err);
            $this->redir_error_post($e->getMessage());
            die();
        }
    }

    function deleteEntryById($table, $id) {
        try {
            $sql = "delete from ".$table." where id=".$id."";
            if($this->ladeni == 1) {
                echo $sql;
            }
            if($this->pdo->exec($sql)) {return true;}
        } catch (PDOException $e) {
            $err = $this->pdo->errorInfo();
            $this->pridat_do_error_log($err);
            $this->odeslat_error_email($err);
            $this->redir_error_post($e->getMessage());
            die();
        }
    }

    function deleteFile($from, $file) {
        try {
            $delete = $from . DIRECTORY_SEPARATOR . $file;    
            if(unlink($delete)) { return true; }
        } catch (PDOException $e) {
            $err = $this->pdo->errorInfo();
            $this->pridat_do_error_log($err);
            $this->odeslat_error_email($err);
            $this->redir_error_post($e->getMessage());
            die();
        }
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
            $query = $this->pdo->query($sql);
            if($row = $query->fetch(PDO::FETCH_ASSOC)) {
                return $row;                  
            }
        } catch (PDOException $e) {
            $err = $this->pdo->errorInfo();
            $this->pridat_do_error_log($err);
            $this->odeslat_error_email($err);
            $this->redir_error_post($e->getMessage());
            die();
        }   
    }

    // function leftJoin($cols, $from, $leftJoin, $on, $where=NULL, $groupBy=NULL, $orderBy=NULL) {
    //     try {
    //         $sql = "SELECT ";
    //         if(is_array($cols)) {
    //             $numItems = count($cols);
    //             $i=0;
    //             foreach($cols as $col) {
    //                 if(++$i === $numItems) {
    //                     $sql.= $col;
    //                 }
    //                 else {
    //                     $sql.= $col.",";
    //                 }
    //             }
    //         }
    //         else {
    //             $sql.= $cols;
    //         }
    //         $sql.= " FROM ".$from;
    //         $sql.= " LEFT JOIN ".$leftJoin;
    //         $sql.= " ON ".$on;  
    //         if($where != NULL) { $sql.= " WHERE ".$where; }
    //         if($groupBy != NULL) { $sql.= " GROUP BY ".$groupBy; }
    //         if($orderBy != NULL) { $sql.= " ORDER BY ".$orderBy; }
    //         if($this->ladeni == 1) {
    //             echo "<pre>".$sql."</pre>";
    //         }
    //         foreach($this->pdo->query($sql) as $row) { 
    //             $rows[] = $row; 
    //         }
    //     } catch (PDOException $e) {
    //         print "Error!: " . $e->getMessage();
    //         return false;
    //     }   
    //     return $rows;  
    // }
    
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
                if($query = $this->pdo->query($sql)) {
                    $row = $query->fetch(PDO::FETCH_ASSOC);
                    return $row;
                }
            }                
        } catch (PDOException $e) {
            $err = $this->pdo->errorInfo();
            $this->pridat_do_error_log($err);
            $this->odeslat_error_email($err);
            $this->redir_error_post($e->getMessage());
            die();
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
    
    public function pridat_do_error_log($err) {
        $f = str_replace("'","\'",$err[2]);
        $pathinfo.= realpath(__FILE__);
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $s = "INSERT INTO error_log VALUES ('','".date('Y-m-d')."','".date('H:i:s')."','".$err['0']."','".$err['1']."','".$f."','".$pathinfo."','".$actual_link."')";
        $this->pdo->exec($s);

    }

    public function odeslat_error_email($err) {
        // odeslani emailu spravci
        $from = WEB_EMAIL;
        $to = "vaclav.svestka@mb-web.cz";
        $subject = "Chyba na webu ".WEB_NAME;
        $message = "Byla zaznamenána chyba v systému.";
        $message.= "<br><br>";
        $message.= "<strong>Hlášení:</strong><br>";
        $message.= "Chyba ".$err[0]."<br>";
        $message.= $err[2]."<br>";
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $message.= "LINK: ".$actual_link."<br>";
        $this->send_email($from, $to, $subject, $message);
    }

    public function pridat_do_error_log_fatal($type, $message, $file, $line) {
        $f = str_replace("'","\'",$message);
        $pathinfo.= $file;
        $s = "INSERT INTO error_log VALUES ('','".date('Y-m-d')."','".date('H:i:s')."','','','".$f."','".$pathinfo."','".$line."')";
        $this->pdo->exec($s);

    }

    public function odeslat_error_email_fatal($type, $message, $file, $line) {
        // odeslani emailu spravci
        $from = WEB_EMAIL;
        $to = "vaclav.svestka@mb-web.cz";
        $subject = "Chyba na webu ".WEB_NAME;
        $message = "Byla zaznamenána chyba v systému.";
        $message.= "<br><br>";
        $message.= "<strong>Hlášení:</strong><br>";
        $message.= "Chyba ".$err[0]."<br>";
        $message.= $err[2]."<br>";
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $message.= "LINK: ".$actual_link."<br>";
        $this->send_email($from, $to, $subject, $message);
    }

    public function seznam_chyb() {
        $sql = "select * from error_log order by id desc";
        foreach($this->query($sql) as $row) {
            $chyby[$row['id']]['date'] = $row['date'];
            $chyby[$row['id']]['time'] = $row['time'];
            $chyby[$row['id']]['sqlstate'] = $row['sqlstate'];
            $chyby[$row['id']]['code'] = $row['code'];
            $chyby[$row['id']]['message'] = $row['message'];
            $chyby[$row['id']]['pathinfo'] = $row['pathinfo'];
            $chyby[$row['id']]['link'] = $row['link'];
        }
        return $chyby;
    }

    public function redir_error_post() {
        $this->tpl->display(ADMIN_PAGES.'error.tpl');
    }
}

?>