<?php
require_once("../require.php");
require_once("../" . INCLUDED_FILES . "config.inc.php");
require_once("../" . INCLUDED_FILES . "dbConn.php");
require_once("../" . INCLUDED_FILES . "functionsInc.php");
if (!isset($_SESSION['user-email'])) {
    goto_location(SITE_URL.'/login-register');
    exit;
}
$conn = dbconnect();
//unset($_SESSION["bill_address"]);
//unset($_SESSION["ship_address"]);
if (!$_SESSION['user-id']) {
    if (!isset($_SESSION["cart_item"])) {
        goto_location('cart.php');
    }
} else {
    if (!check_cart_exists($_SESSION['user-id'])) {
        goto_location('cart.php');
    }
}
include("../" . INC_FOLDER . "headerInc.php");

$cust_id = $_SESSION['user-id'];
$cust_bill = get_user_bill_addr($cust_id);

if (check_cust_address_par($cust_id)) {
    $_SESSION['bill_addr_exist'] = "Billing address exists";
}
?>
<main>
<div class="container arial checkout">
    <h1 style="text-align: center;" class="mb-5">Checkout</h1>
    <?php
    if (isset($_SESSION['ship_error'])) {
        ?>
        <h3 style="text-align: center; color: #EF4A35"><?php echo $_SESSION['ship_error'] ?></h3>
        <?php
        unset($_SESSION['ship_error']);
    }
    ?>
    <form method="POST" action="checkout-function.php">
        <div class="row">
        <div class="col-md-6">
            <h4 class="mb-3">Billing Address</h4>
            <div class="row">
            <div class="col-md-4">
                <label for="email">Email <strong>*</strong></label>
            </div>
            <div class="col-md-8">
                <input type="email" name="email" class="form-control" value="<?php echo $_SESSION['user-email']; ?>" readonly>
            </div>
            <div class="col-md-4">
                <label for="address">Address <strong>*</strong></label>
            </div>
            <div class="col-md-8">
                <input name="street_address" class="form-control" id="street_address" type="text" value="<?php echo check_cust_address_par($cust_id) ? $cust_bill['street_address'] : ''; ?>" required>
            </div>
            <div class="col-md-4">
                <label for="city">City <strong>*</strong></label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="city" id="city" value="<?php echo check_cust_address_par($cust_id) ? $cust_bill['city'] : ''; ?>" required>
            </div>
            <div class="col-md-4">
                <label for="city">State <strong>*</strong></label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="state" id="state" value="<?php echo check_cust_address_par($cust_id) ? $cust_bill['state'] : ''; ?>" required>
            </div>
            <div class="col-md-4">
                <label for="city">Country <strong>*</strong></label>
            </div>
            <div class="col-md-8">
                <input type="hidden" class="form-control" name="prev_country" id="prev_country" value="<?php echo check_cust_address_par($cust_id) ? $cust_bill['country'] : ''; ?>" required>
                <select id="country" name="country" class="form-control"></select>
            </div>
            <div class="col-md-4">
                <label for="zip">Zip Code <strong>*</strong></label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="zip" id="zip" value="<?php echo check_cust_address_par($cust_id) ? $cust_bill['zip'] : ''; ?>" required>
            </div>
            <div class="col-md-4">
                <label for="zip">Landmark</label>
            </div>
            <div class="col-md-8">
                <textarea class="form-control" name="landmark" id="landmark"><?php echo check_cust_address_par($cust_id) ? $cust_bill['landmark'] : ''; ?></textarea>
            </div>
            </div>
            <!--            <div class="clearfix"></div>
                        <br>
                        <div class="col-md-4">
                            <label for="zip">Order Note</label>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control" name="order_note" id="order_note"></textarea>
                        </div>-->
        </div>
        <div class="col-md-6">
            <h4 class="mb-3">Shipping Address</h4>
            <div class="d-flex align-items-center">
                <input type="checkbox" name="diff_ship" <?php if (!check_cust_addr_child($cust_id)) { ?> id="ship_check_full" <?php } else { ?> id="ship_check" <?php } ?> >
                <span>Ship to Different Address</span>
            </div>
            <div id="ship_addr" style="display: none;">

                <?php
                if (check_cust_addr_child($cust_id)) {
                    ?>
                    <div class="col-md-4">
                        <label for="address">Choose Shipping Address:</label>
                    </div>
                    <div class="col-md-8">
                        <?php
                        $ship_addr = get_user_addr_ship($cust_id);
                        ?>

                        <?php
                        foreach ($ship_addr as $addr_opt) {
                            ?>

                            <div id="all_addr_<?php echo $addr_opt['id']; ?>">
                                <input type="hidden" name="addr_id" id="addr_id_<?php echo $addr_opt['id']; ?>" value="<?php echo $addr_opt['id']; ?>">  
                                Name: <?php echo $addr_opt['name']; ?><br>
                                Phone: <?php echo $addr_opt['phone']; ?><br>
                                Address: <?php echo $addr_opt['street_address']; ?><br>
                                City: <?php echo $addr_opt['city']; ?><br>
                                State: <?php echo $addr_opt['state']; ?><br>
                                Country: <?php echo $addr_opt['country']; ?><br>
                                Zip: <?php echo $addr_opt['zip']; ?><br>
                                Landmark: <?php echo $addr_opt['landmark']; ?><br>
                                <button id="add_ship_addr" data-id="<?php echo $addr_opt['id']; ?>" class="btn form-control">Add</button>
                                <button id="del_ship_addrs" data-id="<?php echo $addr_opt['id']; ?>" class="btn form-control">Delete</button>
                                <br>
                                <br>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                    <!--                    <div class="col-md-4">
                                            <a class="btn btn-info" id="add_new_btn">Add New Address</a> 
                                        </div>
                                        <div class="clearfix"></div>
                                        <br>-->
                    <!--                    <div id="show_addr"></div>-->
                    <?php
                }
                ?>
                <div class="col-12">
                    <div id="show_addr"></div>
                </div>

            </div>
            <div id="add_new_addr" style="display: none;"> 

                
                    <a class="btn form-control" id="add_new_btn">Add New Address</a> 
                
                <div id="new_addr" style="display: none;" class="row">
                    <div class="col-md-4">
                        <label for="address">Name <strong>*</strong></label>
                    </div>
                    <div class="col-md-8">
                        <input name="ship_cust_name" class="form-control" id="street_address" type="text" value="<?php echo isset($_SESSION['ship_error']) ? $_SESSION['ship_address']['ship_cust_name'] : ''; ?>">
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-4">
                        <label for="address">Phone <strong>*</strong></label>
                    </div>
                    <div class="col-md-8">
                        <input name="ship_cust_phone" class="form-control" id="street_address" type="text" value="<?php echo isset($_SESSION['ship_error']) ? $_SESSION['ship_address']['ship_cust_phone'] : ''; ?>">
                    </div>
                    <div class="clearfix"></div>
                    <br>


                    <div class="col-md-4">
                        <label for="address">Address <strong>*</strong></label>
                    </div>
                    <div class="col-md-8">
                        <input name="ship_street_address" class="form-control" id="street_address" type="text" value="<?php echo isset($_SESSION['ship_error']) ? $_SESSION['ship_address']['ship_street_address'] : ''; ?>">
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-4">
                        <label for="city">City <strong>*</strong></label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="ship_city" id="city" value="<?php echo isset($_SESSION['ship_error']) ? $_SESSION['ship_address']['ship_city'] : ''; ?>">
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-4">
                        <label for="city">State <strong>*</strong></label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="ship_state" id="state" value="<?php echo isset($_SESSION['ship_error']) ? $_SESSION['ship_address']['ship_state'] : ''; ?>">
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-4">
                        <label for="city">Country <strong>*</strong></label>
                    </div>
                    <div class="col-md-8">
                        <input type="hidden" class="form-control" name="ship_selcountry" id="ship_selcountry" value="<?php echo isset($_SESSION['ship_error']) ? $_SESSION['ship_address']['ship_country'] : ''; ?>">
                   <select id="ship_country" name="ship_country" class="form-control"></select>
                    
                    
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-4">
                        <label for="zip">Zip Code <strong>*</strong></label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="ship_zip" id="zip" value="<?php echo isset($_SESSION['ship_error']) ? $_SESSION['ship_address']['ship_zip'] : ''; ?>">
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-4">
                        <label for="zip">Landmark</label>
                    </div>
                    <div class="col-md-8">
                        <textarea class="form-control" name="ship_landmark" id="landmark"><?php echo isset($_SESSION['ship_error']) ? $_SESSION['ship_address']['ship_landmark'] : ''; ?></textarea>
                    </div>
                    <div class="clearfix"></div>
                    <br>

                </div>

            </div>  

            <input type="submit" class="btn form-control mt-3" value="Next">

        </div>
        </div>
    </form>
</div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $("#ship_check").click(function () {
            if ($(this).is(":checked")) {
                $("#ship_addr").show();
                $("#add_new_addr").show();
            } else {
                $("#ship_addr").hide();
            }
        });
        $("#ship_check_full").click(function () {
            if ($(this).is(":checked")) {
                $("#add_new_addr").show();
                //$("#ship_addr").show();
            } else {
                $("#add_new_addr").hide();

            }
        });
        $("#add_new_btn").click(function () {

            $("#new_addr").show();
            //$("#add_new_addr").hide(); 
        });
        $("#sel_addr").click(function () {
            if ($(this).is(":checked")) {
                $("#add_new_addr").hide();
            } else {
                $("#ship_addr").show();
            }
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $(document).on('click', '#add_ship_addr', function (e) {
            e.preventDefault();
            var uid = $(this).data('id');
            var addr_id = $('#addr_id_' + uid).val();
            $.ajax({
                url: 'add-old-address.php',
                type: 'POST',
                data: 'addr_id=' + addr_id,
                dataType: 'html'
            })
                    .done(function (data) {
                        console.log(data);
//                            $('#res-coup').html(''); // blank before load.
                        $('#show_addr').html(data); // load here
                        $('#add_new_btn').hide(); // hide loader  
                        $('#add_new_addr').hide(); // hide loader 
                    })
        });
    });
</script>

<script type="text/javascript">
    $(function () {
        var country_arr = new Array("Afghanistan", "Albania", "Algeria", "American Samoa", "Angola", "Anguilla", "Antartica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Ashmore and Cartier Island", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "British Virgin Islands", "Brunei", "Bulgaria", "Burkina Faso", "Burma", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Clipperton Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo, Democratic Republic of the", "Congo, Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia", "Cuba", "Cyprus", "Czeck Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Europa Island", "Falkland Islands (Islas Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "French Guiana", "French Polynesia", "French Southern and Antarctic Lands", "Gabon", "Gambia, The", "Gaza Strip", "Georgia", "Germany", "Ghana", "Gibraltar", "Glorioso Islands", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard Island and McDonald Islands", "Holy See (Vatican City)", "Honduras", "Hong Kong", "Howland Island", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Ireland, Northern", "Israel", "Italy", "Jamaica", "Jan Mayen", "Japan", "Jarvis Island", "Jersey", "Johnston Atoll", "Jordan", "Juan de Nova Island", "Kazakhstan", "Kenya", "Kiribati", "Korea, North", "Korea, South", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Man, Isle of", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Midway Islands", "Moldova", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcaim Islands", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romainia", "Russia", "Rwanda", "Saint Helena", "Saint Kitts and Nevis", "Saint Lucia", "Saint Pierre and Miquelon", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Scotland", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and South Sandwich Islands", "Spain", "Spratly Islands", "Sri Lanka", "Sudan", "Suriname", "Svalbard", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Tobago", "Toga", "Tokelau", "Tonga", "Trinidad", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "Uruguay", "USA", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands", "Wales", "Wallis and Futuna", "West Bank", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
        var select = $("#country");
        var select2 = $("#ship_country");
        populateCountries(select, country_arr);
        populateCountries2(select2, country_arr);
        $(document).on('click', '#del_ship_addrs', function (e) {
            e.preventDefault();
            var dataid = $(this).data('id');
            var del_addr_id = $('#addr_id_' + dataid).val();

            $.ajax({
                url: 'del-old-address.php',
                type: 'POST',
                data: 'del_addr_id=' + del_addr_id,
                dataType: 'html'
            })
                    .done(function (data) {
                        console.log(data);
//                            $('#res-coup').html(''); // blank before load.
                        $('#show_addr').html(data); // load here
                        $('#all_addr_' + dataid).hide(); // hide loader  
                    })
        });
    });

    // Countries
    function populateCountries(countryElementId, arr) {
        // given the id of the <select> tag as function argument, it inserts <option> tags
        console.log(countryElementId);
        var option = '';
        option = '<option value="">' + 'Select Country' + '</option>';
        for (var i = 0; i < arr.length; i++) {
            option += '<option value="' + arr[i] + '">' + arr[i] + '</option>';
        }
        countryElementId.append(option);

        if ($("#prev_country").val() != '') {
            var selected_val = $("#prev_country").val();
            $("#country option[value='" + selected_val + "']").attr("selected", "selected");
        }
        // Assigned all countries. Now assign event listener for the states.


    }
    
    
    function populateCountries2(countryElementId2, arr2) {
        // given the id of the <select> tag as function argument, it inserts <option> tags
        console.log(countryElementId2);
        var option2 = '';
        option2 = '<option value="">' + 'Select Country' + '</option>';
        for (var i = 0; i < arr2.length; i++) {
            option2 += '<option value="' + arr2[i] + '">' + arr2[i] + '</option>';
        }
        countryElementId2.append(option2);

        if ($("#ship_selcountry").val() != '') {
            selected_val2 = $("#ship_selcountry").val();
            $("#ship_country option[value='" + selected_val2 + "']").attr("selected", "selected");
        }
        // Assigned all countries. Now assign event listener for the states.


    }
</script>
<?php
include("../" . INC_FOLDER . "footerInc.php");
?>
