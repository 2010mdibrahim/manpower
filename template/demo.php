<button onload="notifi()">demo</button>
<table>
<?php 
    $i = 0;
    echo "  <script>function showNotification() {
                icon = 'image-url';";
    while($i<5){
        // $ticketDate = new Datetime($ticket['flightDate']);
        // $today = new Datetime(date('Y-m-d'));
        // $dateDiff = $ticketDate->diff($today);
        echo "  var body = 'Message to be displayed'; 
                var notification = new Notification('Title', { body, icon });";
        $i++;
    }
    echo "  } </script>";
?>
</table>

<script>
function demo(){
    let permission = Notification.permission;
    if(permission === 'granted'){
        showNotification();
    }
}

window.onload = showNotification();

// function showNotification() {
//    var title = "JavaScript Jeep";
//    icon = "image-url";
//    var body = "Message to be displayed";
//    var notification = new Notification('Title', { body, icon });
//    notification.onclick = () => { 
//           notification.close();
//           window.parent.focus();
//    }
// }

function requestAndShowPermission() {
   Notification.requestPermission(function (permission) {
      if (permission === "granted") {
        alert('permission');;
      }
   });
}
</script>