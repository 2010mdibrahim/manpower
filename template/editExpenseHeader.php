<?php
    $expenseheadId = $_POST['expenseheadId'];
    $qry = "select expenseName from expenseHeader where expenseheadId = $expenseheadId";
    $result = mysqli_query($conn,$qry);
    $expenseName = mysqli_fetch_assoc($result);
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>New Ticket</h2>
    </div>
    <form action="template/newExpenseHeaderQry.php" method="post">
        <input type="hidden" name="alter" value="update">
        <input type="hidden" value="<?php echo $expenseheadId;?>" name="expenseheadId">
        <h3 style="background-color: aliceblue; padding: 0.5%">Create new Expense Header</h3>
        <div class="form-group flex-container"">
        <br>
        <div >
            <label for="sel1">Enter Expense Header Name:</label>
            <input class="form-control" type="text" name="expenseHeader" placeholder="Enter Name" value="<?php echo $expenseName['expenseName'];?>">
        </div>
        <br>
        <input type="submit" value="submit">

    </form>
</div>