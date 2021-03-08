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
                    <a href="?page=" class="nav-item nav-link">Home</a>
                    <!-- <a href="?page=admin" class="nav-item nav-link">Admin</a> -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="candidateNav">Candidate</a>
                        <div class="dropdown-menu">
                            <a href="?page=newCandidate" class="dropdown-item">New Candidate</a>
                            <a href="?page=listCandidate" class="dropdown-item">Candidate List</a>
                            <!-- <div class="dropdown-divider"></div> -->
                            <!-- <a href="?page=candidateVisaList" class="dropdown-item">Candidate VISA List</a> -->
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="visaNav">Visa</a>
                        <div class="dropdown-menu">
                            <a href="?page=newVisa" class="dropdown-item">New Visa</a>
                            <a href="?page=visaList" class="dropdown-item">Visa List</a>
                            <!-- <div class="dropdown-divider"></div>
                            <a href="?page=transferVisa" class="dropdown-item">Transfer Visa</a>
                            <a href="?page=addVisaPayment" class="dropdown-item">Add Visa Payment</a> -->
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="ticketNav">Ticket</a>
                        <div class="dropdown-menu">
                            <a href="?page=newTicket" class="dropdown-item">New Ticket</a>
                            <a href="?page=listTicket" class="dropdown-item">Candidate Ticket List</a>
                            <!-- <div class="dropdown-divider"></div>
                            <a href="?page=selectTicket" class="dropdown-item">Ticket Payment</a> -->
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="expenseNav">Expense</a>
                        <div class="dropdown-menu">
                            <a href="?page=newExpense" class="dropdown-item">New Expense</a>
                            <a href="?page=expenseDetails" class="dropdown-item">Expense Detail</a>
                            <!-- <div class="dropdown-divider"></div>
                            <a href="?page=expenseHeader" class="dropdown-item">Expense Header</a> -->
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="agentNav">Agent</a>
                        <div class="dropdown-menu">
                            <a href="?page=addNewAgent" class="dropdown-item">Add New Agent</a>
                            <a href="?page=agentList" class="dropdown-item">Agent List</a>
                            <div class="dropdown-divider"></div>
                            <a href="?page=addExpenseAgent" class="dropdown-item">Add Agent Expense</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="delegateNav">Delegate</a>
                        <div class="dropdown-menu">
                            <a href="?page=addNewDelegate" class="dropdown-item">Add New Delegate</a>
                            <a href="?page=delegateList" class="dropdown-item">Delegate List</a>
                        </div>
                    </div>
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
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="manpowerNav">Manpower</a>
                        <div class="dropdown-menu">
                            <a href="?page=manpower" class="dropdown-item">Add Office</a>
                            <a href="?page=manpowerList" class="dropdown-item">Office List</a>
                        </div>
                    </div>  
                    <div class="nav-item dropdown">
                        <a href="?page=jobs" class="nav-item nav-link"  id="jobsNav">Jobs</a>
                    </div>                  
                    <a href="?page=report" class="nav-item nav-link" id="reportNav">Report</a>
                </div>
                <div class="ml-auto">
                    <a class="btn" href="includes/logout.php">Logout</a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Nav Bar End -->