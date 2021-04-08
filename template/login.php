<style>

    .wrapper{
        background-image: linear-gradient(to right, rgba(255, 249, 196, 1), rgba(255, 224, 178, 1), rgba(255, 204, 188, 1));
    }

    .card {
        padding: 7%;
    }

    .form{
        margin: auto;
    }

    .container {
        width: 100%;
        height: 100%;
        display: absolute;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        animation-name: scaleUp;
        animation-duration: 1s;
    }

    @keyframes scaleUp {
        from { transform: translate(0px,-50px); }
        to {transform: translate(0px,0px); }
    }
</style>


<div class="container">
    <div class="card">
        <form action="template/loginPage.php" method="post" class="form">
            <div class="form-group" >
                <label for="exampleInputEmail1">Email address</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" name="email">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Password</label>
                <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Password" name="pass">
            </div>
            <div class="form-group">
                <input class="form-control" type="submit" value="Login" onclick="addToCompletedList()">
            </div>
            </div>
        </form>
    </div>
</div>
<script>
    function addToCompletedList(){
        alert('clicked');
        console.log('clicked');
        $.ajax({
            type: 'get',
            url: 'template/test_2.php',
            success: function(response){
                console.log(response);
            }
        });
    }
</script>