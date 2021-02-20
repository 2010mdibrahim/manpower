<?php
include ('database.php');
if(isset($_POST['agentEmail'])){
    $html = '<table id="dataTableSeaum" class="table col-12"  style="width:100%">
                <thead>
                <tr>
                    <th>Total Amount</th>
                    <th>Advance</th> 
                    <th>Advance Pay Date</th>
                    <th>Adjust</th>
                </tr>
                </thead>
                <tbody>';
    $agentEmail = $_POST['agentEmail'];
    $result = $conn->query("SELECT * from agentexpense where agentEmail='$agentEmail'"); 
    $html .= '<tr>';   
    while($expense = mysqli_fetch_assoc($result)){
        $html .= '<td>'.$expense['fullAmount'].'</td>';
        $html .= '<td>'.$expense['paidAmount'].'</td>';
        $html .= '<td>'.$expense['payDate'].'</td>';
        $html .= '<td>'.$expense['comment'].'</td>';
    }
    $html .= '</tr>'; 
    $html .= '</tbody>
                <tfoot>
                <tr hidden>
                    <th>Total Amount</th>
                    <th>Advance</th> 
                    <th>Advance Pay Date</th>
                    <th>Adjust</th>
                </tr>
                </tfoot>
            </table>';
    echo $html;
}