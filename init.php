<?php 

  final class init {

        function __construct() {
            $this->create();
            $this->fill();
        }


        private function create() {
            $mysqli = new mysqli("localhost", "root", "", "init");
                if ($mysqli->connect_errno) {
                    echo "Connection error to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                }
                     $mysqli->query("CREATE TABLE test (
                    id int NOT NULL AUTO_INCREMENT,
                    script_name VARCHAR(25),
                    start_time int,
                    end_time int,
                    result ENUM('normal', 'illegal', 'failed', 'success'),
                    PRIMARY KEY(id)
                ) ");        
        }

        private function fill() {

            $script_name = ['times', 'seconds', 'minute', 'hour'];
            $result = ['normal', 'illegal', 'failed', 'success'];
        
            $mysqli = new mysqli("localhost", "root", "", "init");
                if ($mysqli->connect_errno) {
                    echo "Connection error to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                }
                $mysqli->query("TRUNCATE TABLE test");
                for($i = 0; $i < 10; $i++) {
                    $script_index = rand(0, count($script_name)-1);
                    $start_time = rand(10, 50);
                    $end_time = rand($start_time + 1 , 50);
                    $result_index = rand(0, count($result)-1);
                    $mysqli->query("INSERT INTO test (script_name, start_time, end_time, result) 
                    VALUES ('".$script_name[$script_index]."', $start_time, $end_time, '".$result[$result_index]."')");
                }               
        }

        public function get() {
            $mysqli = new mysqli("localhost", "root", "", "init");
                if ($mysqli->connect_errno) {
                    echo "Connection error to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                }
              $result = $mysqli->query("SELECT * FROM test WHERE result='normal' OR result='success'");
              while($row = $result->fetch_assoc()){
                echo "<p> id: $row[id] </p>";
                echo "<p> script_name: $row[script_name] </p>";
                echo "<p> start_time: $row[start_time] </p>";
                echo "<p> end_time: $row[end_time] </p>";
                echo "<p> result: $row[result] </p>";
                echo "<hr>";
              }
        }
        
        
    }

    $create = new init();
    $create->get();
?>