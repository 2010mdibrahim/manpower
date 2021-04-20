<?php
include ('dbc.class.php');
class changeCandidateStatus extends Dbc{    
    
    public function change(){
        $conn = $this->connection();
        $today = date('Y-m-d');
        $result_completed = $conn->query("UPDATE processing set pending = 2 where processing.pending = 1 AND processing.pendingTill < '$today'");
        return $result_completed;
    }
}
?>