<style>
.upper-section{
    border-bottom: 5px solid #eeeeee ;
}
.left-section{
    border-right: 2px solid #eeeeee ;
}
.selected{
    background-color: #dcedc8;
}
</style>
<div class="container-fluid mt-5">
    <div class="card">
        <div class="card-header text-center"> <h4>Client Relations Management</h4> </div>
        <div class="card-body">
            <form action="template/crm_qry.php" method="post">
                <div class="row">
                    <div class="col-sm">
                        <label for="date">Date</label>
                        <input class="form-control datepicker" autocomplete="off" type="text" name="date" placeholder="Date" required>
                    </div>
                    <div class="col-sm">
                        <label for="date">Source</label>
                        <input class="form-control" type="text" name="source" placeholder="Source" required>
                    </div>
                    <div class="col-sm">
                        <label for="date">Name</label>
                        <input class="form-control" type="text" name="name" placeholder="Name" required>
                    </div>
                    <div class="col-sm">
                        <label for="date">Mobile</label>
                        <input class="form-control" type="text" name="mob" placeholder="Mobile" required>
                    </div>
                    <div class="col-sm">
                        <label for="name">Intersting Country</label>
                        <select class="form-control select2" name="country[]" multiple required>
                        <option value="">Select Country</option>
                            <option value="Afganistan">Afghanistan</option>
                            <option value="Albania">Albania</option>
                            <option value="Algeria">Algeria</option>
                            <option value="American Samoa">American Samoa</option>
                            <option value="Andorra">Andorra</option>
                            <option value="Angola">Angola</option>
                            <option value="Anguilla">Anguilla</option>
                            <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option>
                            <option value="Aruba">Aruba</option>
                            <option value="Australia">Australia</option>
                            <option value="Austria">Austria</option>
                            <option value="Azerbaijan">Azerbaijan</option>
                            <option value="Bahamas">Bahamas</option>
                            <option value="Bahrain">Bahrain</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option>
                            <option value="Benin">Benin</option>
                            <option value="Bermuda">Bermuda</option>
                            <option value="Bhutan">Bhutan</option>
                            <option value="Bolivia">Bolivia</option>
                            <option value="Bonaire">Bonaire</option>
                            <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Brazil">Brazil</option>
                            <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                            <option value="Brunei">Brunei</option>
                            <option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option>
                            <option value="Canada">Canada</option>
                            <option value="Canary Islands">Canary Islands</option>
                            <option value="Cape Verde">Cape Verde</option>
                            <option value="Cayman Islands">Cayman Islands</option>
                            <option value="Central African Republic">Central African Republic</option>
                            <option value="Chad">Chad</option>
                            <option value="Channel Islands">Channel Islands</option>
                            <option value="Chile">Chile</option>
                            <option value="China">China</option>
                            <option value="Christmas Island">Christmas Island</option>
                            <option value="Cocos Island">Cocos Island</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option>
                            <option value="Cook Islands">Cook Islands</option>
                            <option value="Costa Rica">Costa Rica</option>
                            <option value="Cote DIvoire">Cote DIvoire</option>
                            <option value="Croatia">Croatia</option>
                            <option value="Cuba">Cuba</option>
                            <option value="Curaco">Curacao</option>
                            <option value="Cyprus">Cyprus</option>
                            <option value="Czech Republic">Czech Republic</option>
                            <option value="Denmark">Denmark</option>
                            <option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option>
                            <option value="Dominican Republic">Dominican Republic</option>
                            <option value="East Timor">East Timor</option>
                            <option value="Ecuador">Ecuador</option>
                            <option value="Egypt">Egypt</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Falkland Islands">Falkland Islands</option>
                            <option value="Faroe Islands">Faroe Islands</option>
                            <option value="Fiji">Fiji</option>
                            <option value="Finland">Finland</option>
                            <option value="France">France</option>
                            <option value="French Guiana">French Guiana</option>
                            <option value="French Polynesia">French Polynesia</option>
                            <option value="French Southern Ter">French Southern Ter</option>
                            <option value="Gabon">Gabon</option>
                            <option value="Gambia">Gambia</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option>
                            <option value="Ghana">Ghana</option>
                            <option value="Gibraltar">Gibraltar</option>
                            <option value="Great Britain">Great Britain</option>
                            <option value="Greece">Greece</option>
                            <option value="Greenland">Greenland</option>
                            <option value="Grenada">Grenada</option>
                            <option value="Guadeloupe">Guadeloupe</option>
                            <option value="Guam">Guam</option>
                            <option value="Guatemala">Guatemala</option>
                            <option value="Guinea">Guinea</option>
                            <option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option>
                            <option value="Hawaii">Hawaii</option>
                            <option value="Honduras">Honduras</option>
                            <option value="Hong Kong">Hong Kong</option>
                            <option value="Hungary">Hungary</option>
                            <option value="Iceland">Iceland</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="India">India</option>
                            <option value="Iran">Iran</option>
                            <option value="Iraq">Iraq</option>
                            <option value="Ireland">Ireland</option>
                            <option value="Isle of Man">Isle of Man</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option>
                            <option value="Japan">Japan</option>
                            <option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Kiribati">Kiribati</option>
                            <option value="Korea North">Korea North</option>
                            <option value="Korea Sout">Korea South</option>
                            <option value="Kuwait">Kuwait</option>
                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Laos">Laos</option>
                            <option value="Latvia">Latvia</option>
                            <option value="Lebanon">Lebanon</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Libya">Libya</option>
                            <option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option>
                            <option value="Luxembourg">Luxembourg</option>
                            <option value="Macau">Macau</option>
                            <option value="Macedonia">Macedonia</option>
                            <option value="Madagascar">Madagascar</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option>
                            <option value="Malta">Malta</option>
                            <option value="Marshall Islands">Marshall Islands</option>
                            <option value="Martinique">Martinique</option>
                            <option value="Mauritania">Mauritania</option>
                            <option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Midway Islands">Midway Islands</option>
                            <option value="Moldova">Moldova</option>
                            <option value="Monaco">Monaco</option>
                            <option value="Mongolia">Mongolia</option>
                            <option value="Montserrat">Montserrat</option>
                            <option value="Morocco">Morocco</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Myanmar">Myanmar</option>
                            <option value="Nambia">Nambia</option>
                            <option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Netherland Antilles">Netherland Antilles</option>
                            <option value="Netherlands">Netherlands (Holland, Europe)</option>
                            <option value="Nevis">Nevis</option>
                            <option value="New Caledonia">New Caledonia</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option>
                            <option value="Nigeria">Nigeria</option>
                            <option value="Niue">Niue</option>
                            <option value="Norfolk Island">Norfolk Island</option>
                            <option value="Norway">Norway</option>
                            <option value="Oman">Oman</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Palau Island">Palau Island</option>
                            <option value="Palestine">Palestine</option>
                            <option value="Panama">Panama</option>
                            <option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option>
                            <option value="Peru">Peru</option>
                            <option value="Phillipines">Philippines</option>
                            <option value="Pitcairn Island">Pitcairn Island</option>
                            <option value="Poland">Poland</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Puerto Rico">Puerto Rico</option>
                            <option value="Qatar">Qatar</option>
                            <option value="Republic of Montenegro">Republic of Montenegro</option>
                            <option value="Republic of Serbia">Republic of Serbia</option>
                            <option value="Reunion">Reunion</option>
                            <option value="Romania">Romania</option>
                            <option value="Russia">Russia</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="St Barthelemy">St Barthelemy</option>
                            <option value="St Eustatius">St Eustatius</option>
                            <option value="St Helena">St Helena</option>
                            <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                            <option value="St Lucia">St Lucia</option>
                            <option value="St Maarten">St Maarten</option>
                            <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                            <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                            <option value="Saipan">Saipan</option>
                            <option value="Samoa">Samoa</option>
                            <option value="Samoa American">Samoa American</option>
                            <option value="San Marino">San Marino</option>
                            <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="Senegal">Senegal</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra Leone">Sierra Leone</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Slovakia">Slovakia</option>
                            <option value="Slovenia">Slovenia</option>
                            <option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="Spain">Spain</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                            <option value="Sudan">Sudan</option>
                            <option value="Suriname">Suriname</option>
                            <option value="Swaziland">Swaziland</option>
                            <option value="Sweden">Sweden</option>
                            <option value="Switzerland">Switzerland</option>
                            <option value="Syria">Syria</option>
                            <option value="Tahiti">Tahiti</option>
                            <option value="Taiwan">Taiwan</option>
                            <option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania">Tanzania</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Togo">Togo</option>
                            <option value="Tokelau">Tokelau</option>
                            <option value="Tonga">Tonga</option>
                            <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                            <option value="Tunisia">Tunisia</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option>
                            <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                            <option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Erimates">United Arab Emirates</option>
                            <option value="United States of America">United States of America</option>
                            <option value="Uraguay">Uruguay</option>
                            <option value="Uzbekistan">Uzbekistan</option>
                            <option value="Vanuatu">Vanuatu</option>
                            <option value="Vatican City State">Vatican City State</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Vietnam">Vietnam</option>
                            <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                            <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                            <option value="Wake Island">Wake Island</option>
                            <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                            <option value="Yemen">Yemen</option>
                            <option value="Zaire">Zaire</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
                        </select>
                    </div>
                    <div class="col-sm">
                        <div class="row">                        
                            <div class="col-md-8"><label for="date">Intersting Job</label></div>
                            <div class="col-md-4"><button id="add_job" type="button" class="btn btn-sm btn-primary mr-2"><span class="fa fa-plus"></span></button><button id="remove_job" type="button" class="btn btn-sm btn-danger"><span class="fa fa-minus"></span></button></div>
                        </div>
                        <div id="job_input_div">
                            <div class="form-group">
                                <input class="form-control" type="text" name="job[]" placeholder="Job" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-2">
                        <label for="date">Source Name</label>
                        <input class="form-control" type="text" name="source_name" placeholder="Source Name" required>
                    </div>
                    <div class="col-md-8">
                        <label for="date">Comment</label>
                        <textarea class="form-control" name="comment" id="comment" cols="10" rows="2" required></textarea>
                    </div>
                    <div class="col-lg-2 align-self-end">
                        <button class="btn btn-primary" style="font-size: 1rem;">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <hr class="upper-section">
        <div class="row">
            <div class="col-md-4 left-section">
                <div class="card-body">
                    <form action="template/crm_qry_edit.php" method="post">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <div class="row align-items-end">
                                <label for="date">Comment</label>
                                <textarea class="form-control" name="comment" id="edit_comment" cols="10" rows="4"></textarea>                        
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row justify-content-end">
                                <button class="btn btn-info" style="font-size: 1rem;">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <table id="dataTableSeaum" class="table table-bordered table-hover"  style="width:100%">
                        <thead>
                        <tr>
                            <th>Mobile</th>
                            <th>Name</th>
                            <th>Comment</th>
                            <th>Source</th>
                            <th>Source Name</th>
                            <th>Date</th>
                            <th>Countries</th>
                            <th>Jobs</th>
                            <th>Alter</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $result = $conn->query("SELECT * from crm order by id desc");
                        $i = 1;
                        while($crm = mysqli_fetch_assoc($result)){
                        ?>
                        <tr id="<?php echo $i++; ?>" onclick="getComment(this.id)">
                            <td><?php echo $crm['mob'];?></td>
                            <td><?php echo $crm['name'];?></td>
                            <td class="comment"><?php echo $crm['comment'];?></td>
                            <td><?php echo $crm['source'];?></td>
                            <td><?php echo $crm['source_name'];?></td>
                            <input type="hidden" class="in_table_id" value="<?php echo $crm['id'];?>">
                            <td><?php echo $crm['date'];?></td>
                            <td>
                                <?php
                                $result_country = $conn->query("SELECT * from crm_country where crm_id = ".$crm['id']);
                                print_r(mysqli_error($conn));
                                $country_string = '';
                                while($country = mysqli_fetch_assoc($result_country)){
                                    $country_string .= $country['country'].', ';
                                }
                                $country_string = rtrim($country_string, ', ');
                                echo $country_string.'.';
                                ?>
                            </td>
                            <td>
                                <?php
                                $result_country = $conn->query("SELECT * from crm_jobs where crm_id = ".$crm['id']);
                                print_r(mysqli_error($conn));
                                $job_string = '';
                                while($job = mysqli_fetch_assoc($result_country)){
                                    $job_string .= $job['job'].', ';
                                }
                                $job_string = rtrim($job_string, ', ');
                                echo $job_string.'.';
                                ?>
                            </td>
                            <td>
                                <form action="template/crm_qry_edit.php" method="post">
                                    <input type="hidden" name="alter" value="delete">
                                    <input type="hidden" name="id" value="<?php echo $crm['id']; ?>">
                                    <button class="btn btn-sm btn-danger"><span class="fa fa-close"></span></button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                        <tr hidden>
                            <th>Mobile</th>
                            <th>Name</th>
                            <th>Comment</th>
                            <th>Source</th>
                            <th>Source Name</th>
                            <th>Date</th>
                            <th>Countries</th>
                            <th>Jobs</th>
                            <th>Alter</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
</div>

<script>
    $('#crmNav').addClass('active');
    
    $('#add_job').click(function(){
        var div = document.createElement('DIV');
        div.setAttribute('class', 'form-group');
        var input = document.createElement('INPUT');
        input.setAttribute('type', 'text');
        input.setAttribute('class', 'form-control');
        input.setAttribute('placeholder', 'Job');
        input.setAttribute('name', 'job[]');
        div.appendChild(input);
        $('#job_input_div').append(div);
    });
    $('#remove_job').click(function(){
        $('#job_input_div').children().last().remove();
    });
    function getComment(id){
        $('#' + id).siblings().removeClass('selected');
        $('#' + id).addClass('selected');
        var comment = $('#' + id).find('.comment').html();
        var id = $('#' + id).find('.in_table_id').val();
        $('#edit_comment').html(comment);
        $('#id').val(id);
    }
</script>