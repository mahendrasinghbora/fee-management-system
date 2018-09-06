<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ADMIN')) {
	require '../../php/db_config.php';

	$sessionId = $_POST['sessionId'];
	$result = $con->query("SELECT * FROM classes WHERE CLASS_ID NOT IN (SELECT CLASS_ID FROM classes_in_session WHERE SESSION_ID = '$sessionId');");

	if (mysqli_num_rows($con->query("SELECT * FROM classes WHERE CLASS_ID NOT IN (SELECT CLASS_ID FROM classes_in_session WHERE SESSION_ID='$sessionId');")) == 0) { ?>
        <div class="modal fade" id="noClassesModal" tabindex="-1" role="dialog" aria-labelledby="noClassesModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">No classes left to add alert!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>There are no classes left to add to the session <?php echo $sessionId; ?>.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <script>        
            $(document).ready(function () {
                $('#noClassesModal').modal('show');
            });
        </script>

    <?php } else { ?>
        <label for="classId">Select Class</label>
        <select class="form-control" id="classId" name="classId">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <option value="<?php echo $row["CLASS_ID"]; ?>"><?php echo $row["CLASS_NAME"]; ?></option>
            <?php } ?>
        </select>
<?php } ?>

<?php } else {
	$_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
	if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ADMIN') {
		$_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're an admin.";
    }
    header("Location: ../index.php");
}

