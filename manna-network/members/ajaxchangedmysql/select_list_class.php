<?php
    class SelectList
    {
        protected $conn;

            public function __construct()
            {
                $this->DbConnect();
            }

            protected function DbConnect()
            {
  //              include "db_config.php";
               include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
                $this->conn = mysql_connect($host,$username,$password) OR die("Unable to connect to the database");
                mysql_select_db($database,$this->conn) OR die("can not select the database $db");
                return TRUE;
            }

            public function ShowCategory()
            {
                $sql = "SELECT * FROM categories_regional2 WHERE `parent` = 1";
                $res = mysql_query($sql,$this->conn);
                $category = '<option value="0">choose...</option>';
                while($row = mysql_fetch_array($res))
                {
                    $category .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
                return $category;
            }

            public function ShowType()
            {
echo 'in func post = ';
print_r($_POST);
                $sql = "SELECT * FROM categories_regional2 WHERE `parent`=$_POST[id]";
echo $sql;
                $res = mysql_query($sql,$this->conn);
                $type = '<option value="0">choose...</option>';
                while($row = mysql_fetch_array($res))
                {
                    $type .= '<option value="' . $row['id_type'] . '">' . $row['name'] . '</option>';
                }
                return $type;
            }
            public function ShowThird()
            {
                $sql = "SELECT * FROM thirdtable WHERE id_type=$_POST[id2]";
                $res = mysql_query($sql,$this->conn);
                $third = '<option value="0">choose...</option>';
                while($row = mysql_fetch_array($res))
                {
                    $third .= '<option value="' . $row['id_third'] . '">' . $row['name'] . '</option>';
                }
            }
    }

    $opt = new SelectList();
    ?>
  
