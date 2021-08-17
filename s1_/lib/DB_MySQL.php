<?php
ignore_user_abort();
class DB_MySQL{
	var $con;
	function connect($host='',$user='',$pass='',$db='') {
		$this->con = mysqli_connect($host, $user, $pass);
		mysqli_select_db($this->con, $db);
	}

	function query($query){
		return $this->con->query($query);
	}

	

	function numrows($query){
		return $this->con->query($query)->num_rows;

	}

	function fetch($result,$fetchmode=""){
			if(isset($fetchmode)){
				return $result->fetch_assoc();
			}else{
				return $result->mysql_fetch_array();
            }
    }

    function fetch_a($result){
    	return $result->mysql_fetch_array();
    }

    function affectedrows(){
    	return @$this->con->affected_rows;
    }

    function getlastid(){
    	return @$this->con->insert_id;
    }

    function real_escape_string($result){
    	return mysqli_real_escape_string($this->con, $result);
    }
}
?>