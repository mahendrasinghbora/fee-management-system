<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
    require '../../php/db_config.php';

    $studentId = $_POST['studentId'];
    $classId = $_POST['classId'];

    $resultClass = $con->query("SELECT CLASS_NAME, CLASS_SESSION_ID FROM classes_in_session, classes WHERE classes.CLASS_ID = classes_in_session.CLASS_ID AND CLASS_SESSION_ID = '$classId';");
    $rowClass = $resultClass->fetch_assoc();
    $className = $rowClass['CLASS_NAME'];
    
    $resultStudent = $con->query("SELECT STUDENT_NAME, ADDRESS FROM students WHERE STUDENT_ID = '$studentId';");
    $rowStudent = $resultStudent->fetch_assoc();
    $studentName = $rowStudent['STUDENT_NAME'];
    $address = $rowStudent['ADDRESS'];

    $resultInvoice = $con->query("SELECT * FROM invoices WHERE STUDENT_ID = '$studentId' AND CLASS_SESSION_ID = '$classId' ORDER BY DATE_ DESC LIMIT 1;");

    if (mysqli_num_rows($con->query("SELECT * FROM invoices WHERE STUDENT_ID = '$studentId' AND CLASS_SESSION_ID = '$classId' ORDER BY DATE_ DESC LIMIT 1;")) == 0) { ?>
        <!-- noInvoiceModal -->
        <div class="modal fade" id="noInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="noInvoiceModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">No invoices alert!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>No invoices have been generated for <?php echo $studentName; ?> till now.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div><!-- /noInvoiceModal -->
        <script>
            $(document).ready(function () {
                $('#noInvoiceModal').modal('show');
            });
        </script>
    <?php } else {     
    $rowInvoice = $resultInvoice->fetch_assoc(); ?>
    <button class="btn btn-success btn-lg mb-3" id="printInvoice"><i class="fa fa-print fa-lg" aria-hidden="true"></i> Print Invoice</button>   
    <!-- Invoices -->
    <div class="container-fluid" id="invoice">
        <div class="row bg-white border rounded-top border-dark">
            <div class="col text-right">
                <h3><i class="fa fa-ravelry" aria-hidden="true"></i>Fee Management System</h3>
            </div>
        </div>
        <div class="row border border-dark bg-white">
            <div class="col text-center">
                <h2 class="mb-0">INVOICE</h2>
                <strong>(From <?php echo $rowInvoice['MONTH_FROM'] . ", " . $rowInvoice['YEAR_FROM']; ?> to <?php echo $rowInvoice['MONTH_TO'] . ", " . $rowInvoice['YEAR_TO']; ?>)</strong>
            </div>
        </div>
        <div class="row border border-dark bg-white">
            <div class="col-7 text-left">
                <p class="mb-0">
                    <?php echo "<strong>Invoice ID: </strong>" . $rowInvoice['INVOICE_ID']; ?><br>
                    <?php echo "<strong>To (Student ID- " . $studentId . "): </strong>" . $studentName; ?><br>
                    <?php echo "<strong>Address: </strong>" . $address; ?>
                </p>
            </div>
            <div class="col-5 text-right">
                <p class="mb-0">
                    <?php echo "<strong>Date (of generation): </strong>" . substr($rowInvoice['DATE_'], 0, 10); ?><br>
                    <?php echo "<strong>Session: </strong>". $_SESSION['sessionId']; ?><br>
                    <?php echo "<strong>Class: </strong>" . $className; ?>
                </p>
            </div>
        </div>
        <div class="row border border-dark bg-white border-bottom-0">
            <div class="col">
                <h3>Static Fee Head(s)</h3>
                <table class="table table-striped mt-3 bg-white table-sm my-0">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Static Fee Head Name</th>
                            <th scope="col" class="text-right">Amount (in <i class="fa fa-inr" aria-hidden="true"></i>)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;   // For indexing.
                        $resultStatic = $con->query("SELECT STATIC_HEAD_NAME, STATIC_HEAD_AMOUNT FROM static_to_classes, fee_static_heads, classes_in_session WHERE static_to_classes.STATIC_HEAD_ID = fee_static_heads.STATIC_HEAD_ID AND static_to_classes.CLASS_SESSION_ID = classes_in_session.CLASS_SESSION_ID AND classes_in_session.CLASS_SESSION_ID = '$classId';");
                        while ($rowStatic = $resultStatic->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <th scope="row"><?php echo $rowStatic['STATIC_HEAD_NAME']; ?></th>
                            <td class="text-right"><?php echo $rowStatic['STATIC_HEAD_AMOUNT'] . " X " . $rowInvoice['NUMBER_OF_MONTHS']; ?></td>
                        </tr>   
                        <?php } ?>
                        <tr style="border-top: 2px solid #000;">
                            <td colspan="2">Total Static Head Amount (in <i class="fa fa-inr" aria-hidden="true"></i>)</td>
                            <td class="text-right"><strong><?php echo $rowInvoice['STATIC_SPLIT_AMOUNT']; ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row border border-dark bg-white border-top-0">
            <div class="col">
                <h3>Flexible Fee Head(s)</h3>
                <table class="table table-striped mt-3 bg-white table-sm mt-0 mb-1">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Flexible Fee Head Name</th>
                            <th scope="col" class="text-right">Amount (in <i class="fa fa-inr" aria-hidden="true"></i>)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;   // For indexing.
                        $resultFlexible = $con->query("SELECT FLEXIBLE_HEAD_NAME, FLEXIBLE_HEAD_AMOUNT FROM fee_flexible_heads, flexible_to_students, students WHERE fee_flexible_heads.FLEXIBLE_HEAD_ID = flexible_to_students.FLEXIBLE_HEAD_ID AND flexible_to_students.STUDENT_ID = students.STUDENT_ID AND students.STUDENT_ID = '$studentId';");
                        while ($rowFlexible = $resultFlexible->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <th scope="row"><?php echo $rowFlexible['FLEXIBLE_HEAD_NAME']; ?></th>
                                <td class="text-right"><?php echo $rowFlexible['FLEXIBLE_HEAD_AMOUNT'] . " X " . $rowInvoice['NUMBER_OF_MONTHS']; ?></td>
                            </tr>
                        <?php } ?>  
                        <tr style="border-top: 2px solid #000;">
                            <td colspan="2">Total Flexible Head Amount (in <i class="fa fa-inr" aria-hidden="true"></i>)</td>
                            <td class="text-right"><strong><?php echo $rowInvoice['FLEXIBLE_SPLIT_AMOUNT']; ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row border border-dark bg-white">
            <div class="col text-left">
                <strong>Total Amount (in <i class="fa fa-inr" aria-hidden="true"></i>)</strong>
            </div>
            <div class="col text-right">
                <strong><?php echo $rowInvoice['ACTUAL_AMOUNT']; ?></strong>
            </div>
        </div>
        <div class="row border border-dark bg-white">
            <div class="col text-left">
                <strong>Previous Dues (in <i class="fa fa-inr" aria-hidden="true"></i>)</strong>
            </div>
            <div class="col text-right">
                <strong><?php echo $rowInvoice['PREVIOUS_DUES']; ?></strong>
            </div>
        </div>
        <div class="row border border-dark bg-white">
            <div class="col-5 text-left">
                <strong>Total Amount to be Paid (in <i class="fa fa-inr" aria-hidden="true"></i>)</strong>
            </div>
            <div class="col-7 text-right">
                <strong>
                    <?php $inWords = new NumberFormatter("en", NumberFormatter::SPELLOUT); ?>
                    <?php echo $rowInvoice['ACTUAL_AMOUNT'] + $rowInvoice['PREVIOUS_DUES'] . "  (" . ucfirst($inWords->format($rowInvoice['ACTUAL_AMOUNT'] + $rowInvoice['PREVIOUS_DUES'])) . ".)"; ?>
                </strong>
            </div>
        </div>
        <div class="row border border-dark bg-white">
            <div class="col text-right">
                <small>*This invoice has been generated for <?php echo $rowInvoice['NUMBER_OF_MONTHS']; ?> months.</small>
            </div>
        </div>
    </div><!-- /Invoices -->      
    <script>
        $("#printInvoice").click(function() {
            $('#invoice').printThis();
        });
    </script>
    <?php } ?>

<?php } else {
    $_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
    if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ACCOUNTS') {
        $_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're from the accounts department.";
    }
    header("Location: ../../index.php");
}
