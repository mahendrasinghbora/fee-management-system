<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
    require '../../php/db_config.php';
    $classId = $_POST['classId'];
    
    $resultClass = $con->query("SELECT CLASS_NAME, CLASS_SESSION_ID FROM classes_in_session, classes WHERE classes.CLASS_ID = classes_in_session.CLASS_ID AND CLASS_SESSION_ID = '$classId';");

    $row = $resultClass->fetch_assoc();

    $resultStudent = $con->query("SELECT STUDENT_NAME, students.STUDENT_ID FROM class_wise_students, students WHERE class_wise_students.STUDENT_ID = students.STUDENT_ID AND CLASS_SESSION_ID = '$classId';");

    if (mysqli_num_rows($con->query("SELECT STUDENT_NAME, students.STUDENT_ID FROM class_wise_students, students WHERE class_wise_students.STUDENT_ID = students.STUDENT_ID AND CLASS_SESSION_ID = '$classId';")) == 0) { ?>

        <div class="modal fade" id="noStudentModal" tabindex="-1" role="dialog" aria-labelledby="noStudentModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">No students alert!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>There are no students in class <?php echo $row['CLASS_NAME']; ?>.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
        <script>        
            $(document).ready(function () {
                $('#noStudentModal').modal('show');
            });
        </script>
    <?php } 
    else if (mysqli_num_rows($con->query("SELECT * FROM invoices WHERE CLASS_SESSION_ID = '$classId' ORDER BY DATE_ DESC LIMIT 1;")) == 0) { ?>
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
                        <p>No invoices have been generated for class <?php echo $row['CLASS_NAME']; ?> till now.</p>
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
    <?php }
    else { ?>
    	<table class="table table-striped mt-3 bg-white table-bordered table-sm">
		    <caption class="lead">List of the students in the class <?php echo $row['CLASS_NAME']; ?>.</caption>
		    <thead class="thead-dark">
		        <tr>
		            <th scope="col">Student Id</th>
		            <th scope="col">Name of the Student</th>
		            <th scope="col">Pay Fee</th>
		        </tr>
		    </thead>
		    <tbody>
		    	<?php while ($rowStudent = $resultStudent->fetch_assoc()) { ?>
		        <tr>
		        	<th scoope="row"><?php echo $rowStudent['STUDENT_ID']; ?></th>
		        	<td><?php echo $rowStudent['STUDENT_NAME']; ?></td>
		        	<td><a href="../php/pay_fee_final.php?studentId=<?php echo $rowStudent['STUDENT_ID']; ?>&classId=<?php echo $classId; ?>"><i class="fa fa-credit-card" aria-hidden="true" style="color: #2C9676;"></i></a></td>
		        </tr>
		        <?php } ?>
		    </tbody>
		</table>
    <?php }?>

<?php } else {
    $_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
    if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ACCOUNTS') {
        $_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're from the accounts department.";
    }
    header("Location: ../../index.php");
}
