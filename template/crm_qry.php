<?php
include ('database.php');
$date = $_POST['date'];
$source = $_POST['source'];
$name = $conn->real_escape_string($_POST['name']);
$mob = $_POST['mob'];
$comment = $conn->real_escape_string($_POST['comment']);
$countries = $_POST['country'];
$jobs = $_POST['job'];

$result = $conn->query("INSERT INTO crm(date, source, name, mob, comment) VALUES ('$date', '$source', '$name', '$mob', '$comment')");
$get_id = mysqli_fetch_assoc($conn->query("SELECT max(id) as id  from crm"));

foreach($countries as $country){
    $result = $conn->query("INSERT INTO crm_country(country, crm_id) VALUES ('$country', ".$get_id['id'].")");
}
foreach($jobs as $job){
    $result = $conn->query("INSERT INTO crm_jobs(job, crm_id) VALUES ('$job', ".$get_id['id'].")");
    print_r(mysqli_error($conn));
}
echo "<script> window.location.href='../index.php?page=crm'</script>";