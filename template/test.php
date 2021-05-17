<style>
.profile_img{
    height: 150px;
    width: 150px;
    border-radius: 50%;
    margin-top: 15px;
    margin-bottom: 15px;
}
.name_div{
    background-color: #424242;
    color: white;
    padding: 9px;
}
.fa, .far{
    font-size: 20px;
    margin-top: 5px;
}
.phone_div{
    background-color: rgba(0, 145, 234, 0.7);
    color: white;
    padding: 5px;
}
.email_div{
    background-color: rgba(0, 145, 234, 1);
    color: white;
    padding: 5px;
}
.personal_info{
    padding: 55px;
}
.big_icons{
    height: 38px;
    width: 38px;
    text-align: center;
    color: white;
    font-size: 25px;
    background-color: rgba(0, 145, 234, 0.7);
    border-radius: 50%;
}
.detailed_info{
    padding: 55px;
}
.information-box{
    margin-bottom: 20px;
}
/* .a4_size{
    height: 3508px;
    width: 2480px;
} */
</style>
<div class="container-fluid a4_size">
    <button onclick="print()"> print </button>
    <div id="cv_print">
        <div class="row">
            <div class="col-md-4">
                <div class="row text-center"><div class="col-sm"><img class="profile_img" src="template/test_cv.jpg" alt=""></div></div>
                <div class="name_div">
                    <div class="row text-center">
                        <div class="col-md-12"><h3>Samin Yeasaer</h3></div>
                    </div>
                    <div class="row text-center pt-0">
                        <div class="col-md-12"><h6>Software Engineer</h6></div>
                    </div>
                </div>
                <div class="phone_div">
                    <div class="row">
                        <div class="col-md-2 text-center"><i class="fa fa-phone custom_btn" aria-hidden="true"></i></div>
                        <div class="col-md-10"><h5>01731509208</h5></div>
                    </div>
                </div>
                <div class="email_div">
                    <div class="row">
                        <div class="col-md-2 text-center"><i class="far fa-envelope custom_far"></i></div>
                        <div class="col-md-10"><h5>seaum333@gmail.com</h5></div>
                    </div>
                </div>
                <div class="row">
                    <div class="personal_info">
                        <div class="col-md-12 ">
                            <h2 class="mb-0">About Me</h2>
                        </div>
                        <div class="col-md-12">
                        <hr>
                        </div>
                        <div class="col-md-12">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium natus eligendi minima dignissimos placeat dolorum, ipsum dolore, possimus a sit fugiat ratione veritatis dolorem obcaecati eius nam? Molestias, eveniet unde!</p>
                        </div>
                    </div>
                </div>
                <div class="row"></div>
                <div class="row"></div>
                <div class="row"></div>
            </div>


            <div class="col-md-8 detailed_info">
                <!-- Experience -->
                <div class="row information-box">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-1">
                                <div class="big_icons"><i class="fas fa-briefcase"></i></div>
                            </div>
                            <div class="col-md-11">
                                <h2>Work Experience</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12"><hr></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Designation</h4>
                                    </div>
                                    <div class="col-md-12">
                                        <h6>2015 - 2017</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="ml-0 pl-0">Company Name</h4>
                                    </div>
                                    <div class="col-md-12">
                                        <p>Responsibility</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Designation</h4>
                                    </div>
                                    <div class="col-md-12">
                                        <h6>2015 - 2017</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="ml-0 pl-0">Company Name</h4>
                                    </div>
                                    <div class="col-md-12">
                                        <p>Responsibility</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Experience -->
                <!-- Professional Qualification -->
                <div class="row information-box">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-1">
                                <div class="big_icons"><i class="fas fa-wrench"></i></div>
                            </div>
                            <div class="col-md-11">
                                <h2>Professional Training</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12"><hr></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Institution</h4>
                                    </div>
                                    <div class="col-md-12">
                                        <h6>2015 - 2017</h6>
                                        <h6>Duration</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="ml-0 pl-0">Qualification</h4>
                                    </div>
                                    <div class="col-md-12">
                                        <h6>Place</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Professional Qualification -->
                <!-- Education -->
                <div class="row information-box">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-1">
                                <div class="big_icons"><i class="fas fa-graduation-cap"></i></div>
                            </div>
                            <div class="col-md-11">
                                <h2>Education</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12"><hr></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Institution</h4>
                                    </div>
                                    <div class="col-md-12">
                                        <h6>2015 - 2017</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="ml-0 pl-0">Degree Title</h4>
                                        <h6>Group</h6>
                                        <h6>CGPA</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Institution</h4>
                                    </div>
                                    <div class="col-md-12">
                                        <h6>2015 - 2017</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="ml-0 pl-0">Degree Title</h4>
                                        <h6>Group</h6>
                                        <h6>CGPA</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Education -->
            </div>
        </div>
    </div>
</div>
<script>
    $("#cv_print").print({
        noPrintSelector: ".exclude",
        globalStyles: true,
        doctype: '<!doctype html>',    
    }) 
</script>