<?php
$show = $_POST['show'];
if($show == 'local'){
    $html = '<div class="row align-items-end">
                <input type="hidden" name="currancy" value="bdt">                   
                <div class="form-group col-md-5">
                    <label> Office Type </label>
                    <select class="form-control select2" id="type" name="type" onchange="getDelegateOffice(this.value, \'local\')" required>
                        <option value="">Select Type</option>
                        <option value="manpower">Manpower Office</option>
                        <option value="outside">Outside Office</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-group col-md-7">
                    <div id="getOfficeDelegate"></div>
                </div>
            </div>';
}else{
    $html = '<div class="form-group row align-items-end">
                <input type="hidden" name="currancy" value="dollar">                   
                <div class="col-sm">
                    <label> Amount in Dollar </label>
                    <input class="form-control" type="number" name="amount" id="amountDelegate" placeholder="Enter Amount in Dollar" onkeyup="calculateBDT()">
                </div>
                <div class="col-sm">
                    <label> Dollar Rate </label>
                    <input class="form-control" type="number" name="rate" id="rateDelegate" placeholder="Enter Dollar Rate" step="any" onkeyup="calculateBDT()">                 
                </div>
            </div>';
}
echo $html;
