<?php
include ('database.php');
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Employee", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
$alter = $_POST['alter'];
$sectionId = $_POST['sectionId'];
$admin = $_SESSION['email'];
$date = date('Y-m-d');
if($alter == 'update'){
    $section = $_POST['section'];
    $result = $conn->query("UPDATE sections set sectionName = '$section', updatedBy = '$admin', updatedOn = '$date' where sectionId = $sectionId");
}else{
    $result = $conn->query("DELETE from sections where sectionId = $sectionId");
    if($result){
        echo '<script>window.location.href = "../index.php?page=addSections"</script>';
    }
}
$result = $conn->query("SELECT * from sections order by creationDate desc");
$html = '<table id="dataTableSeaum" class="table table-bordered table-hover"  style="width:100%">
            <thead>
            <tr>
                <th>Section</th>
                <th>Creation Date</th> 
                <th>Edit</th>
            </tr>
            </thead>
            <div id="tableContent">';
while($sections = mysqli_fetch_assoc($result)){
$html  .=   '<tr>
                <td>'.$sections['sectionName'].'</td>
                <td>'.$sections['creationDate'].'</td>
                <td>
                    <div class="row">
                        <div class="col-md-2">                                        
                        <button type="submit" data-toggle="modal" data-target="#editSection" class="btn btn-primary btn-sm" value="'.$sections['sectionId']."_".$sections['sectionName'].'" onclick="editSectionVal(this.value)">Edit</></button>
                        </div>
                        <div class="col-md-2">
                            <form onsubmit="editSection()">
                                <input type="hidden" name="alter" value="delete">
                                <input type="hidden" value="'.$sections['sectionId'].'" name="sectionId">
                                <button type="submit" class="btn btn-danger btn-sm" name="sectionDate">Delete</></button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>';
 }
 $html .=   '</div>
            <tfoot>
            <tr hidden>
                <th>Section</th>
                <th>Creation Date</th> 
                <th>Edit</th>
            </tr>
            </tfoot>
        </table>';
echo $html;