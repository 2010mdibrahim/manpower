<?php
include ('database.php');
$section = $_POST['section'];
$admin = $_SESSION['email'];
$date = date('Y-m-d');
$result = $conn->query("INSERT INTO sections(sectionName, creationDate, updatedBy, updatedOn) VALUES ('$section', '$date', '$admin', '$date')");
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