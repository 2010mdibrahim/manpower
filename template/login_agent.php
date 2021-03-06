<style>

    .wrapper{
        background-image: linear-gradient(to right, rgba(77, 182, 172, 1), rgba(0, 150, 136, 1), rgba(0, 105, 92, 1));
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
    .company-logo{
        position: absolute;
    }

    @keyframes scaleUp {
        from { transform: translate(0px,-50px); }
        to {transform: translate(0px,0px); }
    }
</style>


<div class="company-logo" style="width: 100%;overflow:hidden">
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="img/company-logo.png" alt="" width="200px">
        </div>
    </div>
</div>
<div class="container">    
    <div class="card">
        <form action="template/loginPageAgent.php" method="post" class="form">
            <?php if(isset($_SESSION['agent_failed_login'])){ ?><p class="text-danger">Incorrect Credentials</p> <?php } ?>
            <div class="form-group" >
                <label for="exampleInputEmail1">Email address</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" name="email">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Password</label>
                <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Password" name="pass">
            </div>
            <div class="form-group">
                <input class="form-control" type="submit" value="Login">
            </div>
            </div>
        </form>
    </div>
</div>