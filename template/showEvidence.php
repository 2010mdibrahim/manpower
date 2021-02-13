<?php
$mofaId = $_GET['mofaId'];
$qry = "select mofaEvi from mofa where mofaId = $mofaId";
$result = mysqli_query($conn,$qry);
$mofa = mysqli_fetch_assoc($result);
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Mofa Evidence</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Stamping Information</h3>
    <div>
<!--        <img src="data:image/jpeg;base64,--><?php //echo base64_encode( $mofa['mofaEvi'] ); ?><!--" />-->
<!--        <embed src="data:pdf;--><?php //echo $mofa['mofaEvi'] ; ?><!--" width="800px" height="2100px" />-->
        <iframe src="<?php echo $mofa['mofaEvi'] ; ?>"></iframe>
    </div>
</div>