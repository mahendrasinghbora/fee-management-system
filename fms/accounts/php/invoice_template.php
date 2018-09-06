<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
    require '../../php/db_config.php';
    $classId = $_POST['classId'];
    
    $resultClass = $con->query("SELECT CLASS_NAME from classes, classes_in_session WHERE classes.CLASS_ID = classes_in_session.CLASS_ID AND CLASS_SESSION_ID = '$classId';");
    $row = mysqli_fetch_array($resultClass);
    $className = $row["CLASS_NAME"];
        
    $resultStatic = $con->query("SELECT CLASS_SESSION_ID, fee_static_heads.STATIC_HEAD_ID, STATIC_HEAD_NAME, static_to_classes.STATIC_HEAD_AMOUNT FROM fee_static_heads, static_to_classes WHERE fee_static_heads.STATIC_HEAD_ID = static_to_classes.STATIC_HEAD_ID AND CLASS_SESSION_ID = '$classId';"); 

    if (mysqli_num_rows($con->query("SELECT CLASS_SESSION_ID, fee_static_heads.STATIC_HEAD_ID, STATIC_HEAD_NAME, static_to_classes.STATIC_HEAD_AMOUNT FROM fee_static_heads, static_to_classes WHERE fee_static_heads.STATIC_HEAD_ID = static_to_classes.STATIC_HEAD_ID AND CLASS_SESSION_ID = '$classId';")) == 0) { ?>

        <div class="modal fade" id="noStaticModal" tabindex="-1" role="dialog" aria-labelledby="noStaticModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">No static heads alert!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>There are no static heads associated with class <?php echo $className; ?>.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
        <script>        
            $(document).ready(function () {
                $('#noStaticModal').modal('show');
                $("#invoiceTemplate").removeClass('bg-white');
            });
        </script>
    <?php } else { ?>
            <script>
                $("#invoiceTemplate").addClass('bg-white');
            </script>
            <h3 class="form-banner" style="background-color: #fff; color: #000; font-family: 'Alegreya Sans', Verdana, Tahoma, sans-serif; font-style: normal; font-size: 20px;">Static heads applied on class <?php echo $className; ?>: </h3>
            <?php
            $bannerColor = array('background-color: #596D82;', 'background-color: #53bbb4;', 'background-color: #717CBF;', 'background-color: #e15258;');
            $i = 0;   // Color index.
            while ($row = $resultStatic->fetch_assoc()) { 
                if ($i == 4) {
                    $i = 0;   // Resetting the index.
                } ?>
                <h3 class="form-banner mx-1" style="<?php echo $bannerColor[$i++]; ?> border-radius: 8px; padding: 15px; font-size: 20px;"><?php echo $row['STATIC_HEAD_NAME'] .' (<i class="fa fa-inr fa-lg" aria-hidden="true"></i>' . $row['STATIC_HEAD_AMOUNT'] . ')'; ?></h3>
            <?php }   // end-of-loop. ?>
            <?php 
            $resultFlexible = $con->query("SELECT students.STUDENT_ID, STUDENT_NAME, SUM(FLEXIBLE_HEAD_AMOUNT) FROM students, flexible_to_students WHERE students.STUDENT_ID = flexible_to_students.STUDENT_ID AND flexible_to_students.CLASS_SESSION_ID = '$classId' GROUP BY STUDENT_ID;");

            if (mysqli_num_rows($con->query("SELECT students.STUDENT_ID, STUDENT_NAME, SUM(FLEXIBLE_HEAD_AMOUNT) FROM students, flexible_to_students WHERE students.STUDENT_ID = flexible_to_students.STUDENT_ID AND flexible_to_students.CLASS_SESSION_ID = '$classId' GROUP BY STUDENT_ID;")) == 0) { ?>

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
                                <p>There are no students in class <?php echo $className; ?>.</p>
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
            <?php } ?>

    <?php }   // end-of-false-block. ?>

<?php } else {
    $_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
    if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ACCOUNTS') {
        $_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're from the accounts department.";
    }
    header("Location: ../../index.php");
}
