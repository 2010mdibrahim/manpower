<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>New Ticket</h2>
    </div>
    <form action="template/newExpenseHeaderQry.php" method="post">
        <h3 style="background-color: aliceblue; padding: 0.5%">Create new Expense Header</h3>
        <div class="form-group flex-container"">
        <br>
        <div >
            <label for="sel1">Enter Expense Header Name:</label>
            <input type="hidden" value="insert" name="alter">
            <input class="form-control" type="text" name="expenseHeader" placeholder="Enter Name">
        </div>
        <br>
        <input type="submit" value="submit">
</div>
</form>
</div>