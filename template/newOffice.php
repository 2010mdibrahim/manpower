<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>New Visa Information</h2>
    </div>
    
    <form action="template/newOfficeQry.php" method="post">       
        <div class="form-group">            
            <div class="form-row">       
                <div class="form-group col-md-6" >
                    <label> Office Name </label>
                    <input class="form-control" type="text" name="officeName" id="officeName" placeholder="Enter Office Name">                 
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6" >
                    <label> Comment </label>
                    <input class="form-control" type="text" name="comment" placeholder="Any Comment...">                 
                </div>
            </div>
        </div>
        <div class="form-group">
            <input style="margin: auto; width: auto" class="form-control" type="submit" value="Add Office">
        </div>        
    </form>
</div>

<script>      

    $('#officeNav').addClass('active');

</script>