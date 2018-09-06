<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
    require '../../php/db_config.php';
    $classId = $_POST['classId'];

    $result = $con->query("SELECT STUDENT_NAME, students.STUDENT_ID FROM class_wise_students, students WHERE class_wise_students.STUDENT_ID = students.STUDENT_ID AND CLASS_SESSION_ID = '$classId';");
    $resultClass = $con->query("SELECT CLASS_NAME, CLASS_SESSION_ID FROM classes_in_session, classes WHERE classes.CLASS_ID = classes_in_session.CLASS_ID AND CLASS_SESSION_ID = '$classId';");

    $row = $resultClass->fetch_assoc();
    
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

    <?php } else { ?>
        <label for="studentId">Select Student</label>
        <select class="form-control" id="studentId" name="studentId" required>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <option value="<?php echo $row["STUDENT_ID"]; ?>"><?php echo $row["STUDENT_NAME"]; ?></option>
            <?php } ?>
        </select>
        <script>        
            $(document).ready(function () {
                $("#studentId").change(function() {
                    $.ajax({
                        type: "post",
                        url: "../php/flexible_template.php",
                        data: {
                            "studentId": $("#studentId").val()
                        },
                        success: function(data) {
                            $("#flexibleTemplate").html(data);
                        }
                    });
                });
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
