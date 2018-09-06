<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
    require '../../php/db_config.php';
    $classId = $_POST['classId'];

    $resultStudent = $con->query("SELECT students.STUDENT_ID, STUDENT_NAME, SUM(FLEXIBLE_HEAD_AMOUNT) FROM students, flexible_to_students WHERE students.STUDENT_ID = flexible_to_students.STUDENT_ID AND flexible_to_students.CLASS_SESSION_ID = '$classId' GROUP BY STUDENT_ID UNION SELECT students.STUDENT_ID, STUDENT_NAME, 0 FROM students, class_wise_students WHERE students.STUDENT_ID = class_wise_students.STUDENT_ID AND students.STUDENT_ID NOT IN (SELECT STUDENT_ID FROM flexible_to_students) AND CLASS_SESSION_ID = '$classId' ORDER BY STUDENT_ID;");

    $resultStatic = $con->query("SELECT static_to_classes.CLASS_SESSION_ID, classes.CLASS_NAME, SUM(STATIC_HEAD_AMOUNT) FROM static_to_classes, classes, classes_in_session WHERE ((classes.CLASS_ID = classes_in_session.CLASS_ID) AND (classes_in_session.CLASS_SESSION_ID = static_to_classes.CLASS_SESSION_ID)) GROUP BY CLASS_SESSION_ID HAVING CLASS_SESSION_ID = '$classId';");
    $rowStatic = $resultStatic->fetch_assoc();
    $totalStaticAmount = $rowStatic['SUM(STATIC_HEAD_AMOUNT)'];

    if (mysqli_num_rows($con->query("SELECT students.STUDENT_ID, STUDENT_NAME, SUM(FLEXIBLE_HEAD_AMOUNT) FROM students, flexible_to_students WHERE students.STUDENT_ID = flexible_to_students.STUDENT_ID AND flexible_to_students.CLASS_SESSION_ID = '$classId' GROUP BY STUDENT_ID;")) != 0) { ?>
    	<button class="btn btn-success btn-block" style="font-size: 20px;" id="generateInvoices"><i class="fa fa-print fa-lg" aria-hidden="true"></i> Generate Invoice(s)</button>
    	<!-- durationModal -->
		<div class="modal fade" id="durationModal" tabindex="-1" role="dialog" aria-labelledby="durationModal" aria-hidden="true">
		    <div class="modal-dialog" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h5 class="modal-title" id="modalLabel">Wrong duration alert!</h5>
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		                </button>
		            </div>
		            <div class="modal-body">
		                <p>Please, select a valid time duration.</p>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		            </div>
		        </div>
		    </div>
		</div><!-- /durationModal -->
    	<script>
    		$("#generateInvoices").click(function() {
    			var $monthFrom = parseInt($("#monthFrom").val());
    			var $monthTo = parseInt($("#monthTo").val());
    			var $yearFrom = parseInt($("#yearFrom").val());
    			var $yearTo = parseInt($("#yearTo").val());
    			if ($yearFrom == $yearTo) {
    				if (($monthTo < $monthFrom) && ($monthTo == 1)) {
    					var $diffMonth = 12 - Math.abs($monthTo - $monthFrom);	
    				}
    				else if ($monthTo >= $monthFrom) {
    					var $diffMonth = Math.abs($monthTo - $monthFrom);
    				}
    			}
    			else if ($yearFrom < $yearTo) {
    				if ($monthTo == 1){
    					var $diffMonth = 12 - Math.abs($monthTo - $monthFrom);
    				}
    				else {
    					var $diffMonth = Math.abs($monthTo - $monthFrom);
    				}
    			}
    			if ((typeof $diffMonth === 'undefined') || ($diffMonth == 0)) {
    				$('#durationModal').modal('show');
    			}
    			else {
    				$.ajax({
						type: "post",
						url: "../php/submit_invoices.php",
						data: {
							"classId": $("#classId").val(),
							"monthFrom": $monthFrom,
							"monthTo": $monthTo,
							"yearFrom": $yearFrom,
							"yearTo": $yearTo,
							"diffMonth": $diffMonth
						},
						success: function(data) {
							$("#invoiceTemplate").html(data);
						}
					});
    			}
			});	
    	</script>
		<table class="table table-striped mt-3 bg-white table-bordered table-sm">
		    <caption class="lead">Students and their monthly fee amounts (in <i class="fa fa-inr" aria-hidden="true"></i>).</caption>
		    <thead class="thead-dark">
		        <tr>
		            <th scope="col">Student ID</th>
		            <th scope="col">Name of the Student</th>
		            <th scope="col">Flexible Heads</th>
		            <th scope="col">Flexible Amount</th>
		            <th scope="col">Static Amount</th>
		            <th scope="col">Total Amount</th>
		            <th scope="col">Previous Dues</th>
		        </tr>
		    </thead>
		    <tbody>
		        <?php while ($row = $resultStudent->fetch_assoc()) { ?>
		        	<tr>
		                <th scope="row"><?php echo $row['STUDENT_ID']; ?></th>
		                <td><?php echo $row['STUDENT_NAME']; ?></td>
		                <?php
		                $studentId = $row['STUDENT_ID']; 
		                $resultFlexible = $con->query("SELECT FLEXIBLE_HEAD_NAME, STUDENT_ID FROM flexible_to_students, fee_flexible_heads WHERE fee_flexible_heads.FLEXIBLE_HEAD_ID = flexible_to_students.FLEXIBLE_HEAD_ID AND flexible_to_students.CLASS_SESSION_ID = '$classId' AND STUDENT_ID = '$studentId';"); 
		                if (mysqli_num_rows($con->query("SELECT FLEXIBLE_HEAD_NAME, STUDENT_ID FROM flexible_to_students, fee_flexible_heads WHERE fee_flexible_heads.FLEXIBLE_HEAD_ID = flexible_to_students.FLEXIBLE_HEAD_ID AND flexible_to_students.CLASS_SESSION_ID = '$classId' AND STUDENT_ID = '$studentId';")) == 0) { ?>
		                	<td>-</td>
		                <?php } else { 
			                while ($rowFlexible = mysqli_fetch_array($resultFlexible)) {
			    				$flexibleHeadsArr[] = $rowFlexible["FLEXIBLE_HEAD_NAME"];
							} 
							$flexibleHeads = implode($flexibleHeadsArr, ', ');
							?>
		                <td><?php echo $flexibleHeads; unset($flexibleHeadsArr); ?></td>
		                <?php }   //end-of-else. ?>
		                <td><?php echo $row['SUM(FLEXIBLE_HEAD_AMOUNT)']; ?></td>
		                <td><?php echo $totalStaticAmount; ?></td>
		                <td><?php echo $totalStaticAmount + $row['SUM(FLEXIBLE_HEAD_AMOUNT)']; ?></td>
		                <?php
		                $resultDues = $con->query("SELECT * FROM invoices WHERE STUDENT_ID = '$studentId' ORDER BY DATE_ DESC LIMIT 1;");
		                if (mysqli_num_rows($con->query("SELECT * FROM invoices WHERE STUDENT_ID = '$studentId' ORDER BY DATE_ DESC LIMIT 1;")) != 0) {
		                	$rowDues = $resultDues->fetch_assoc();
		                	$previousDues = $rowDues['PREVIOUS_DUES'];
		                }
		                else {
		                	$previousDues = 0;
		                }
		                ?>
		                <td><?php echo $previousDues; ?></td>
		            </tr>
		        <?php } ?>
		    </tbody>
		</table>
	<?php } ?>

<?php } else {
    $_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
    if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ACCOUNTS') {
        $_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're from the accounts department.";
    }
    header("Location: ../../index.php");
}
