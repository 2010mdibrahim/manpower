<div id="cv_print">
        <div class="row">
            <div class="col-print-4">
                <div class="row text-center"><div class="col-sm"><img class="profile_img profile-user-img img-responsive" src="<?php echo $home.$row['photo']; ?>" alt="<?php echo $home.$row['full_name']; ?>"></div></div>
                <div class="name_div">
                    <div class="row text-center">
                        <div class="col-print-12"><h3><?php echo $row['full_name']; ?></h3></div>
                    </div>
                </div>
                <div class="phone_div">
                    <div class="row">
                        <div class="col-print-2 text-center"><i class="fa fa-phone custom_btn" aria-hidden="true"></i></div>
                        <div class="col-print-10"><h5><?php echo $row['personal_Phone']; ?></h5></div>
                    </div>
                </div>
                <div class="email_div">
                    <div class="row">
                        <div class="col-print-2 text-center"><i class="far fa-envelope custom_btn"></i></div>
                        <div class="col-print-10"><h5><?php echo $row['company_email']; ?></h5></div>
                    </div>
                </div>
                <div class="row">
                    <div class="personal_info">
                        <div class="col-print-12 ">
                            <h2 class="mb-0">About Me</h2>
                        </div>
                        <div class="col-print-12">
                        <hr>
                        </div>
                        <div class="col-print-12">
                            <p>---</p>
                        </div>
                    </div>
                </div>
                <div class="row"></div>
                <div class="row"></div>
                <div class="row"></div>
            </div>


            <div class="col-print-8 detailed_info">
                <!-- Experience -->
                <div class="row information-box">
                    <div class="col-print-12">
                        <div class="row">
                            <div class="col-print-1">
                                <div class="big_icons"><i class="fas fa-briefcase"></i></div>
                            </div>
                            <div class="col-print-11">
                                <h2>Work Experience</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-print-12"><hr></div>
                        </div>
						<?php if($employment_history->num_rows != 0){?>
							<?php while($employment_history_row = mysqli_fetch_assoc($employment_history)){?>
								<div class="row">
									<div class="col-print-4">
										<div class="row">
											<div class="col-print-12">
												<h4><?php echo $employment_history_row['designation'] ?></h4>
											</div>
											<div class="col-print-12">
												<h6> from <?php echo $employment_history_row['from_date'] ?> to <?php echo $employment_history_row['to_date'] ?></h6>
											</div>
										</div>
									</div>
									<div class="col-print-8">
										<div class="row">
											<div class="col-print-12">
												<h4 class="ml-0 pl-0"><?php echo $employment_history_row['company_name'] ?></h4>
											</div>
											<div class="col-print-12">
												<p><?php echo $employment_history_row['responsibility'] ?></p>
											</div>
										</div>
									</div>
								</div>
						<?php 	}
							} ?>
                    </div>
                </div>
                <!-- End Experience -->
                <!-- Professional Qualification -->
                <div class="row information-box">
                    <div class="col-print-12">
                        <div class="row">
                            <div class="col-print-1">
                                <div class="big_icons"><i class="fas fa-wrench"></i></div>
                            </div>
                            <div class="col-print-11">
                                <h2>Professional Training</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-print-12"><hr></div>
                        </div>
                        <div class="row">
							<?php if($professional_training->num_rows != 0){?>
								<?php while($professional_training_row = mysqli_fetch_assoc($professional_training)){?>
									<div class="col-print-4">
										<div class="row">											
											<div class="col-print-12">
												<h6><?php echo $professional_training_row['completion_year'].", duration: ".$professional_training_row['duration'] ?></h6>
											</div>
										</div>
									</div>
									<div class="col-print-8">
										<div class="row">
											<div class="col-print-12">
												<h4 class="ml-0 pl-0"><?php echo $professional_training_row['training_name'] ?></h4>
											</div>
											<div class="col-print-12">
												<h4><?php echo $professional_training_row['institution'] ?></h4>
											</div>											
											<div class="col-print-12">
												<h5><?php echo $professional_training_row['place'] ?></h5>
											</div>
										</div>
									</div>
							<?php }
							} ?>
                        </div>
                    </div>
                </div>
                <!-- End Professional Qualification -->
                <!-- Education -->
                <div class="row information-box">
                    <div class="col-print-12">
                        <div class="row">
                            <div class="col-print-1">
                                <div class="big_icons"><i class="fas fa-graduation-cap"></i></div>
                            </div>
                            <div class="col-print-11">
                                <h2>Education</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-print-12"><hr></div>
                        </div>
                        <div class="row">
							<?php if($education_qualification->num_rows != 0){?>
								<?php while($education_qualification_row = mysqli_fetch_assoc($education_qualification)){?>
									<div class="col-print-4">
										<div class="row">
											<div class="col-print-12">
												<h5><?php echo $education_qualification_row['institution'] ?></h5>
											</div>
											<div class="col-print-12">
												<h6><?php echo $education_qualification_row['passing_year'] ?></h6>
											</div>
										</div>
									</div>
									<div class="col-print-8 mb-3">
										<div class="row">
											<div class="col-print-12">
												<h4 class="ml-0 pl-0"><?php echo $education_qualification_row['degree_title'] ?></h4>
												<h6><?php echo $education_qualification_row['edu_group'] ?></h6>
												<h6><?php echo $education_qualification_row['class']; echo ($education_qualification_row['gpa'] != '') ? ': '.$education_qualification_row['gpa'] : '' ?></h6>
											</div>
										</div>
									</div>
							<?php }
							} ?>                            
                        </div>
                    </div>
                </div>
                <!-- End Education -->
            </div>
        </div>
    </div>