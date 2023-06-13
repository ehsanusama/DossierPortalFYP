<style>
    table tr,
    th,
    td {
        padding: 6px;
    }

    .input {
        width: 200px;
        height: 20px;
        background-color: white;
        border: none;
        border-bottom: 1px solid black;
        outline: none;
    }

    .header tr {
        padding: 0;
        margin: 0;
    }

    .header td {
        margin: 0;
        padding: 0;
    }

    .earning th {
        border: 1px solid black;
    }

    .earning td {
        border-left: 1px solid black;
        border-right: 1px solid black;
        border-bottom: none;
    }
</style>

<?php
if (isset($_REQUEST['emp_id'])) {
    @$fetchEmployeeData = fetchRecord($dbc, "users", "user_id", $_REQUEST['emp_id']);
    $fetchEmployeeMetaData = (array) json_decode($fetchEmployeeData['user_extra']);
}
$days = date('t', strtotime($_REQUEST['from']));
$pay_per_day = $fetchEmployeeMetaData['fixed_salary'] / $days;

?>
<div class="portlet light">
    <div class="portlet-body">
        <table style="width:100%">
            <tr>
                <table width="100%">
                    <tr>
                        <td style="width: 100%;"><img src="img/final_logo.png" width="200px" height="200px" alt=""> </td>
                    </tr>
                    <tr>
                        <th style="text-align:center;width: 100%;">
                            <h2>Salary Slip</h2>
                            <h4>TPWS & CGIT</h4>
                        </th>
                    </tr>
                </table>
            </tr>
            <tr>
                <table class="header" width="100%" cellspacing="0">
                    <tr>
                        <td style="width: 25%;"> <strong>Date Of Joining</strong></td>
                        <td style="width: 25%;"></td>
                        <td style="width: 25%;"><strong>Employee Name</strong></td>
                        <td style="width: 25%;"><?= strtoupper($fetchEmployeeData['user_first_name']) ?> <?= strtoupper($fetchEmployeeData['user_last_name']) ?> </td>
                    </tr>
                    <tr>
                        <td style="width: 25%;"> <br><strong>Pay Period</strong></td>
                        <td style="width: 25%;"><?= date('d-M-Y', strtotime($_REQUEST['from'])) ?> - <?= date('d-M-Y', strtotime($_REQUEST['to'])) ?></td>
                        <td style="width: 25%;"><br><strong>Designation</strong></td>
                        <td style="width: 25%;"> <?= strtoupper($fetchEmployeeData['designation']) ?></td>
                    </tr>
                    <tr>
                        <td style="width: 25%;"> <br><strong>Working Days</strong></td>
                        <td style="width: 25%;"><input readonly class="input" type="number" value="<?= $days ?>" id="workdays" name="workdays"></td>
                        <td style="width: 25%;"><br><strong>Cheque No</strong></td>
                        <td style="width: 25%;"> <input class="input" type="text" id="chequeno" name="chequeno"></td>
                    </tr>
                </table>
            </tr>
            <tr>
                <table class="earning" cellspacing="0" width="100%">
                    <tr style="background-color: grey;text-align:center">
                        <th>Earnings</th>
                        <th> Amount</th>
                        <th> Deductions</th>
                        <th>Amount</th>
                    </tr>
                    <tr>
                        <td style="width: 35%;"> Total Pay </td>
                        <td style="width: 15%;"><input readonly class="input" type="number" min="1" id="total_pay" name="total_pay" value="<?= $fetchEmployeeMetaData['fixed_salary'] ?>"></td>
                        <td style="width: 35%;"> Provident Fund <br> </td>
                        <td style="width: 15%;"><input class="input" type="number" min="1" id="provident_fund" name="provident_fund" onkeyup="calculate()"> </td>

                    </tr>
                    <tr>
                        <td style="width: 35%;"> Advance Pay </td>
                        <td style="width: 15%;"><input class="input" type="number" min="1" name="advance_pay" id="advance_pay" onkeyup="calculate()"></td>
                        <td style="width: 35%;"> Professional Tax <br> </td>
                        <td style="width: 15%;"><input class="input" type="number" min="1" name="professional_tax" id="professional_tax" onkeyup="calculate()"> </td>
                    </tr>
                    <tr>
                        <td style="width: 35%;">Pay per Day </td>
                        <td style="width: 15%;"><input readonly class="input" class="input" type="text" name="pay_per_day" id="pay_per_day" value="<?= $pay_per_day ?>"></td>
                        <td style="width: 35%;"> Loan <br> </td>
                        <td style="width: 15%;"><input class="input" class="input" type="number" min="1" name="loan" id="loan" onkeyup="calculate()"> </td>
                    </tr>
                    <tr>
                        <td style="width: 35%;">Work Days </td>
                        <td style="width: 15%;"><input readonly class="input" type="number" min="1" name="workday" id="workday" value="<?= $_REQUEST['present'] ?>"></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="width: 35%;">Total Earning </td>
                        <td style="width: 15%;"><input readonly class="input" class="input" type="number" min="1" name="total_earning" id="total_earning" value="<?= $_REQUEST['present'] * $pay_per_day ?>"></td>
                        <td style="width: 35%;"> Total Deduction <br> </td>
                        <td style="width: 15%;"><input readonly class="input" class="input" type="number" min="1" name="total_deduction" id="total_deduction"> </td>
                    </tr>
                    <tr>
                        <td style="border-bottom:1px solid black"></td>
                        <td style="border-bottom:1px solid black"></td>
                        <td style="width: 35%;border-bottom:1px solid black">Net Pay </td>
                        <td style="width: 15%;border-bottom:1px solid black"><input readonly class="input" type="number" min="1" name="net_pay" id="net_pay"></td>

                    </tr>
                </table>
            </tr>
            <tr>
                <br> <br>
                <table style="width: 100%; padding: 0;margin: 0; border: 1px solod black;" border="1" cellspacing="0">
                    <tr>
                        <th style="width: 15%;"> Details</th>
                        <td style="width: 85%;"> <input name="details" id="details" style="width: 100%;height:50px;outline: 0;border: 0;"></td>
                    </tr>
                </table>
            </tr>

            <tr>
                <table style="width: 100%;">
                    <tr style="text-align: center;">
                        <td style="width:100%">
                            <h3 id="countvalue"><?= $fetchEmployeeMetaData['fixed_salary'] ?></h3>
                            <h4><?php
                                echo convertToWords(28000); // Output: One Thousand Two Hundred and Thirty Four
                                ?></h4>
                        </td>
                    </tr>
                </table>
            </tr>
            <tr>
                <table style="width: 100%; text-align: center;">
                    <tr>
                        <td style="width: 50%;"> <strong>Date :</strong> <input class="input" type="date"> </td>
                        <td style="width: 50%;"> <strong> Payment Method: </strong> <br>
                            <input type="radio" name="payment_method" id="payment_method" value="cheque">&nbsp;Cheque &nbsp;&nbsp;<input type="radio" name="payment_method" id="payment_method" value="cash">&nbsp;Cash &nbsp;&nbsp;<input type="radio" name="payment_method" id="payment_method" value="bank">&nbsp;Bank Transfer
                        </td>
                    </tr>

                    <tr>
                        <br><br>
                        <td style="width: 50%;"> <strong> Administrator Signature </strong> </td>
                        <td style="width: 50%;"> <strong> Employee Signature </strong></td>
                    </tr>
                    <tr>
                        <td style="width: 50%;"> _______________________________________ </td>
                        <td style="width: 50%;"> _______________________________________ </td>
                    </tr>
                </table>
            </tr>
            <tr>
                <table style="width: 100%">
                    <tr>
                        <td style="width: 50%;">
                            <strong>Email:</strong> info@cgit.pk<br>
                            <strong>Phone:</strong>+92 3000231671 <br>
                            <strong>Website:</strong>https://cgit.pk/<br>
                        </td>
                        <td style="width: 50%;text-align: center;">
                            <strong>Address:</strong>Main Boulevard Road, Faisal Heights 2nd Floor, <br> Opposite Chase Value near McDonald’s Satyana Road Fsd <br>
                        </td>
                    </tr>
                </table>
            </tr>
        </table>
    </div>
</div>
<script>
    document.getElementById('net_pay').value = document.getElementById('total_earning').value;

    function calculate() {
        var provident_fund = document.getElementById('provident_fund').value;
        var advance_pay = document.getElementById('advance_pay').value;
        var professional_tax = document.getElementById('professional_tax').value;
        var loan = document.getElementById('loan').value;
        var total_earning = document.getElementById('total_earning').value;
        var total_deduction = document.getElementById('total_deduction');
        var net_pay = document.getElementById('net_pay');
        var total = total_earning - advance_pay - provident_fund - professional_tax - loan;
        var totald = parseInt(advance_pay) + parseInt(provident_fund) + parseInt(professional_tax) + parseInt(loan);
        total_deduction.value = totald;
        net_pay.value = total;
        document.getElementById("countvalue").innerHTML = "total";
        console.log(total);

    }
</script>


<?php
function convertToWords($number)
{
    $word = "";
    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine");
    $tens = array("", "Ten", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety");
    $thousands = array("", "Thousand");

    // Get the thousands place
    $thousandsPlace = floor($number / 1000);

    // Get the hundreds place
    $hundredsPlace = $number % 1000;

    // Convert the thousands place to words
    if ($thousandsPlace > 0) {
        $word = $ones[$thousandsPlace] . " " . $thousands[1];
    }

    // Convert the hundreds place to words
    if ($hundredsPlace > 0) {
        // Get the tens and ones places
        $tensPlace = floor($hundredsPlace / 10);
        $onesPlace = $hundredsPlace % 10;

        if ($tensPlace == 1) {
            // If the number is between 10 and 19, use the teens array
            $word .= " " . $ones[$onesPlace] . "teen";
        } else {
            // Otherwise, use the tens and ones arrays
            $word .= " " . $tens[$tensPlace] . " " . $ones[$onesPlace];
        }
    }

    return trim($word);
}


?>