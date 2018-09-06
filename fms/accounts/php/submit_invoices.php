<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
	require '../../php/db_config.php';

	$userid = $_SESSION['userid'];
	$sessionId = $_SESSION['sessionId'];
	$classId = $_POST['classId'];
	$monthFrom = $_POST['monthFrom'];
	$monthTo = $_POST['monthTo'];
	$yearFrom = $_POST['yearFrom'];
	$yearTo = $_POST['yearTo'];
	$diffMonth = $_POST['diffMonth'];

	// Determining names of the month from and month to.
	$months = array("April", "May", "June", "July", "August", "September", "October", "November", "December", "January", "February", "March");
	$monthFromName = $months[$monthFrom - 1];
	$monthToName = $months[$monthTo - 1];


    $resultDate = $con->query("SELECT * FROM invoices WHERE CLASS_SESSION_ID = '$classId' ORDER BY DATE_ DESC LIMIT 1;");
    $lastYear = 0;
    $lastMonth = 0;
    $lastDate = '';
    if ((mysqli_num_rows($resultDate) != 0)) {
        $rowDate = $resultDate->fetch_assoc();
        $lastYear = $rowDate['YEAR_TO'];
        $lastDate = $rowDate['MONTH_TO'] . ', ' . $rowDate['YEAR_TO']; 
        $lastMonthName = $rowDate['MONTH_TO'];
        $lastMonthArr = array_keys($months, $lastMonthName);
        $lastMonth = $lastMonthArr[0] + 1;
    }

    if ((($monthFrom < $lastMonth) || ($lastMonth == 1)) || ($monthTo < $lastMonth) && ($monthTo != 1)) { ?>
        <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Duplicate entry alert!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><i class="fa fa-exclamation-circle" aria-hidden="true" style="color: #e15258;"></i> Invoice(s) already generated till <?php echo $lastDate; ?>.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#errorModal').modal('show');
        </script>
    <?php }
    else {
        if (($monthFrom != $lastMonth) && (mysqli_num_rows($resultDate) != 0)) { ?>
           <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Wrong month from alert!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><i class="fa fa-exclamation-circle" aria-hidden="true" style="color: #e15258;"></i> Invoice(s) are to be generated from <?php echo $lastDate; ?>.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#errorModal').modal('show');
        </script> 
        <?php }
        else {
        	// Static heads.
        	$resultStatic = $con->query("SELECT CLASS_SESSION_ID, fee_static_heads.STATIC_HEAD_ID, STATIC_HEAD_NAME, static_to_classes.STATIC_HEAD_AMOUNT FROM fee_static_heads, static_to_classes WHERE fee_static_heads.STATIC_HEAD_ID = static_to_classes.STATIC_HEAD_ID AND CLASS_SESSION_ID = '$classId';");
        	while ($row = $resultStatic->fetch_assoc()) {
        	    $staticHeadsArr[] = $row["STATIC_HEAD_NAME"];
        	}
        	$staticHeads = implode($staticHeadsArr, ', ');

        	// Static Head amount multiplied by the number of months.
        	$resultStaticAmount = $con->query("SELECT static_to_classes.CLASS_SESSION_ID, classes.CLASS_NAME, SUM(STATIC_HEAD_AMOUNT) FROM static_to_classes, classes, classes_in_session WHERE ((classes.CLASS_ID = classes_in_session.CLASS_ID) AND (classes_in_session.CLASS_SESSION_ID = static_to_classes.CLASS_SESSION_ID)) GROUP BY CLASS_SESSION_ID HAVING CLASS_SESSION_ID = '$classId';");
            $rowStaticAmount = $resultStaticAmount->fetch_assoc();
            $totalStaticAmount = $rowStaticAmount['SUM(STATIC_HEAD_AMOUNT)'] * $diffMonth;

            // Students.
            $resultStudent = $con->query("SELECT students.STUDENT_ID, STUDENT_NAME, SUM(FLEXIBLE_HEAD_AMOUNT) FROM students, flexible_to_students WHERE students.STUDENT_ID = flexible_to_students.STUDENT_ID AND flexible_to_students.CLASS_SESSION_ID = '$classId' GROUP BY STUDENT_ID UNION SELECT students.STUDENT_ID, STUDENT_NAME, 0 FROM students, class_wise_students WHERE students.STUDENT_ID = class_wise_students.STUDENT_ID AND students.STUDENT_ID NOT IN (SELECT STUDENT_ID FROM flexible_to_students) AND CLASS_SESSION_ID = '$classId' ORDER BY STUDENT_ID;");

            while ($row = $resultStudent->fetch_assoc()) {
        		$studentId = $row['STUDENT_ID'];
                $resultFlexible = $con->query("SELECT FLEXIBLE_HEAD_NAME, STUDENT_ID FROM flexible_to_students, fee_flexible_heads WHERE fee_flexible_heads.FLEXIBLE_HEAD_ID = flexible_to_students.FLEXIBLE_HEAD_ID AND flexible_to_students.CLASS_SESSION_ID = '$classId' AND STUDENT_ID = '$studentId';"); 
                if (mysqli_num_rows($con->query("SELECT FLEXIBLE_HEAD_NAME, STUDENT_ID FROM flexible_to_students, fee_flexible_heads WHERE fee_flexible_heads.FLEXIBLE_HEAD_ID = flexible_to_students.FLEXIBLE_HEAD_ID AND flexible_to_students.CLASS_SESSION_ID = '$classId' AND STUDENT_ID = '$studentId';")) == 0) {
                	$flexibleHeads = '-';   // No flexible heads.
                } 
                else { 
                    while ($rowFlexible = mysqli_fetch_array($resultFlexible)) {
        				$flexibleHeadsArr[] = $rowFlexible["FLEXIBLE_HEAD_NAME"];
        			} 
        			$flexibleHeads = implode($flexibleHeadsArr, ', ');
                	unset($flexibleHeadsArr);
                }

                // Flexible amount and total amount multiplied by the number of months.
                $flexibleAmount = $row['SUM(FLEXIBLE_HEAD_AMOUNT)'] * $diffMonth;
                $totalAmount = ($totalStaticAmount + $flexibleAmount);

                // Previous Dues.
                $resultDues = $con->query("SELECT * FROM invoices WHERE STUDENT_ID = '$studentId' ORDER BY DATE_ DESC LIMIT 1;");
                $rowDues = $resultDues->fetch_assoc();

                // Receipts generated.
                if (mysqli_num_rows($con->query("SELECT * FROM receipts WHERE STUDENT_ID = '$studentId' ORDER BY DATE_ DESC LIMIT 1;")) != 0) {
                	$previousDues = $rowDues['PREVIOUS_DUES'] + $rowDues['ACTUAL_AMOUNT'];
                }
                // No invoices generated.
                else if (mysqli_num_rows($con->query("SELECT * FROM invoices WHERE STUDENT_ID = '$studentId' ORDER BY DATE_ DESC LIMIT 1;")) == 0) {
                    $previousDues = 0;
                }
                // Invoices are generated but not receipts.
                else {
                	$previousDues = $rowDues['ACTUAL_AMOUNT'] + $rowDues['PREVIOUS_DUES'];
                }
                
                // Description.
                if ($previousDues == 0) {
                	$description = "No dues.";
                }
                else {
                	$description = "Remaining dues.";
                }

                // Insertion.

                $con->query("INSERT INTO invoices (CLASS_SESSION_ID, STUDENT_ID, STATIC_HEADS, FLEXIBLE_HEADS, STATIC_SPLIT_AMOUNT, FLEXIBLE_SPLIT_AMOUNT, ACTUAL_AMOUNT, PREVIOUS_DUES, MONTH_FROM, YEAR_FROM, MONTH_TO, YEAR_TO, NUMBER_OF_MONTHS, DESCRIPTION, USER_ID, STATUS) VALUES ('$classId', '$studentId', '$staticHeads', '$flexibleHeads', '$totalStaticAmount', '$flexibleAmount', '$totalAmount', '$previousDues', '$monthFromName', '$yearFrom', '$monthToName', '$yearTo', '$diffMonth', '$description', '$userid', '1');"); ?>

                <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Success alert!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><?php echo "Invoice(s) successfully generated from " . $monthFromName . ", " . $yearFrom . " to " . $monthToName . ", " . $yearTo . "!"; ?></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                	$('#successModal').modal('show');
                </script>
            <?php }   // end-of-while.
        }  // end-of-else.
    }   // end-of-else.
?>

<?php } else {
	$_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
	if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ACCOUNTS') {
		$_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're from the accounts department.";
    }
    header("Location: ../../index.php");
}
