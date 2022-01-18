<?php 
    class database{
        public $que;
        private $servername='localhost';
        private $username='root';
        private $password='';
        private $dbname='properties_trial';
        private $result=array();
        private $mysqli='';

        public function __construct(){
            $this->mysqli = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        }

        public function insert($table,$para=array()){
            $table_columns = implode(',', array_keys($para));
            $table_value = implode("','", $para);

            $sql="INSERT INTO $table($table_columns) VALUES('$table_value')";

            $result = $this->mysqli->query($sql);

            return $result;
        }

        public $sql;


        public function select($table,$rows="*",$where = null){
            if ($where != null) {
                $sql="SELECT $rows FROM $table WHERE $where";
            }else{
                $sql="SELECT $rows FROM $table";
            }

            $this->sql = $result = $this->mysqli->query($sql);

        }

        public function selectWithLimit($table,$rows="*",$where = null, $offset = null, $limit = null){
            if ($where != null) {
                $sql="SELECT $rows FROM $table WHERE $where LIMIT $offset, $limit";
            }else{
                $sql="SELECT $rows FROM $table LIMIT $offset, $limit";
            }

            $this->sql = $result = $this->mysqli->query($sql);
            
        }

        public function __destruct(){
            $this->mysqli->close();
        }
    }
?>