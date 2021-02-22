<style>
    .container{
        height: 90vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

    }

    .card{
        margin: auto;
        padding: 1%;
        outline: none;
        border: 1px solid #9e9e9e;
        border-radius: 10px;
    }

    .text{
        outline: none;
        /* border: 1px solid black; */
        border-radius: 5px;
        padding: 0.8%;
        margin: 5px;
    }

    

    .button{
        outline:none;
        margin: 1%;
        padding: 0.5%;
        color: black;
        border: 1px solid #9e9e9e;
        border-radius: 10px;
        background-color: #fafafa;
        box-shadow: 0px 2px 2px 0 rgba(0, 0, 0, 0.2)
    }

    .button:hover{
        transform: scale(1.2,1.2);
        transition: 500ms;
    }
    
</style>


<div class="container">
    <div class="card">
        <input class="text" type="text" name="email" placeholder="Enter Email">
        <input class="text" type="password" name="password" id="password">
        <input class="button" type="submit" value="Enter">
    </div>
    
</div>