<!-- Contact Start -->
<div class="contact">
    <div class="container">
        <div class="section-header">
            <h2>Add New Admin</h2>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="contact-form">
                    <form action="template/addAdminQry.php" method="post">
                        <h3>Admin Information</h3>
                        <div class="form-group" style="padding: 2%">
                            <label>Admin Email</label>
                            <input type="email" class="form-control" required="required" name="adminEmail" placeholder="Enter Email"/>
                            <br>
                            <label>Give Password</label>
                            <input type="password" class="form-control" required="required" name="adminPass"/>
                        </div>
                        <div>
                            <button class="btn" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->