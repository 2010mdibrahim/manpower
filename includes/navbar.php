<?php $sections = $_SESSION['sections'];?>
<!-- Nav Bar Start -->
<div class="nav-bar">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                    <a href="?page=" class="nav-item nav-link" id="home_nav">Home</a>
                    <?php if(in_array("All", $sections) || in_array("Candidate", $sections)){?>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="candidateNav">Candidate</a>
                            <div class="dropdown-menu">
                                <a href="?page=newCandidate" class="dropdown-item">New Candidate</a>
                                <a href="?page=listCandidate" class="dropdown-item">Candidate List</a>
                                <div class="dropdown-divider"></div>
                                <a href="?page=pendingListCandidate" class="dropdown-item">Pending Candidate List</a>
                                <div class="dropdown-divider"></div>
                                <a href="?page=completeListCandidate" class="dropdown-item">Completed Candidate List</a>
                                <a href="?page=returnedListCandidate" class="dropdown-item">Returned Candidate List</a>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if(in_array("All", $sections) || in_array("VISA", $sections)){?>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="visaNav">Visa</a>
                            <div class="dropdown-menu">
                                <a href="?page=newVisa" class="dropdown-item">Assign Visa</a>
                                <a href="?page=visaList" class="dropdown-item">Visa List</a>
                                <div class="dropdown-divider"></div>
                                <a href="?page=pendingVisaList" class="dropdown-item">Pending VISA List</a>
                                <div class="dropdown-divider"></div>
                                <a href="?page=completeVisaList" class="dropdown-item">Completed Visa List</a>
                                <a href="?page=returnedVisaList" class="dropdown-item">Returned Visa List</a>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if(in_array("All", $sections) || in_array("Ticket", $sections)){?>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="ticketNav">Ticket</a>
                            <div class="dropdown-menu">
                                <a href="?page=newTicket" class="dropdown-item">New Ticket</a>
                                <a href="?page=listTicket" class="dropdown-item">Candidate Ticket List</a>
                                <div class="dropdown-divider"></div>
                                <a href="?page=outsideCandidateList" class="dropdown-item">Outside Candidate List</a>
                                <a href="?page=outsideListTicket" class="dropdown-item">Outside Candidate Ticket List</a>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if(in_array("All", $sections) || in_array("Agent", $sections)){?>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="agentNav">Agent</a>
                            <div class="dropdown-menu">
                                <a href="?page=addNewAgent" class="dropdown-item">Add New Agent</a>
                                <a href="?page=agentList" class="dropdown-item">Agent List</a>
                                <div class="dropdown-divider"></div>
                                <a href="?page=addExpenseAgent" class="dropdown-item">Add Agent Expense</a>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if(in_array("All", $sections) || in_array("Pay Mode", $sections)){?>
                        <a href="?page=payMode" class="nav-item nav-link"  id="payModeNav">Pay Mode</a>                
                    <?php } ?>
                    <?php if(in_array("All", $sections) || in_array("Report", $sections)){?>
                        <a href="?page=report" class="nav-item nav-link" id="reportNav">Report</a>
                    <?php } ?>
                    <?php if(in_array("All", $sections) || in_array("Employee", $sections)){?>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="employeeNav">Employee</a>
                            <div class="dropdown-menu">
                                <a href="?page=newEmployee" class="dropdown-item">Add New Employee</a>
                                <a href="?page=employeeList" class="dropdown-item">Employee List</a>
                                <div class="dropdown-divider"></div>
                                <a href="?page=addSections" class="dropdown-item">Add Sections</a>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- <a href="?page=test" class="nav-item nav-link" id="reportNav">TEST</a> -->
                </div>
                <div class="navbar-nav ml-auto">                    
                    <?php if(in_array("All", $sections) || in_array("Delegate", $sections)){?>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="delegateNav">Delegate</a>
                            <div class="dropdown-menu">
                                <a href="?page=addNewDelegate" class="dropdown-item">Add New Delegate</a>
                                <a href="?page=delegateList" class="dropdown-item">Delegate List</a>
                                <div class="dropdown-divider"></div>
                                <a href="?page=addDelegateExpense" class="dropdown-item">Add Candidate Comission</a>
                                <div class="dropdown-divider"></div>
                                <a href="?page=delegateOfficeExpense" class="dropdown-item">Delegate Mapower-Office expense</a>
                                <a href="?page=delegateOfficeExpenseList" class="dropdown-item">Delegate Mapower-Office expense List</a>
                                <div class="dropdown-divider"></div>
                                <a href="?page=delegateAllOfficeExpense" class="dropdown-item">Add Delegate Office expense</a>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if(in_array("All", $sections) || in_array("Sponsor", $sections)){?>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="sponsorNav">Sponsor</a>
                            <div class="dropdown-menu">
                                <a href="?page=addNewSponsor" class="dropdown-item">Add New Sponsor</a>
                                <a href="?page=sponsorList" class="dropdown-item">Sponsor List</a>
                                <div class="dropdown-divider"></div>
                                <a href="?page=visaSponsor" class="dropdown-item">Add Sponsor's VISA</a>
                                <a href="?page=allVisaList" class="dropdown-item">Show all visa list</a>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if(in_array("All", $sections) || in_array("Manpower", $sections)){?>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="manpowerNav">Manpower</a>
                            <div class="dropdown-menu">
                                <a href="?page=manpower" class="dropdown-item">Add Office</a>
                                <a href="?page=manpowerList" class="dropdown-item">Office List</a>
                            </div>
                        </div>  
                    <?php } ?>
                    <?php if(in_array("All", $sections) || in_array("Office", $sections)){?>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="officeNav">Office</a>
                            <div class="dropdown-menu">
                                <a href="?page=newOffice" class="dropdown-item">Add New Office</a>
                                <a href="?page=officeList" class="dropdown-item">Office List</a>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if(in_array("All", $sections) || in_array("Jobs", $sections)){?>
                        <a href="?page=jobs" class="nav-item nav-link"  id="jobsNav">Jobs</a>
                    <?php } ?>
                </div>
                <div class="ml-auto">
                    <a class="btn" href="includes/logout.php">Logout</a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Nav Bar End -->