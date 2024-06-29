<!DOCTYPE html>
<html lang="en">
<?php include('link-cdn.php'); ?>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php include('header.php'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <?php include('sidebar.php'); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="button" class="btn btn-primary m-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Add User
                        </button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="user-form" method="POST">
                                            <input type="text" name="username" id="username" placeholder="Username" class="form-control mb-3" required>
                                            <p id="check-username"></p>
                                            <input type="password" name="password" placeholder="Password" class="form-control mb-3" required>
                                            <select name="utype" class="form-select mb-3" required>
                                                <option value="" disabled selected>Select User Type</option>
                                                <?php
                                                    $conn = mysqli_connect("localhost", "root", "", "employee");
                                                    $query = mysqli_query($conn, "SELECT * FROM `position`");
                                                    if (mysqli_num_rows($query) > 0) {
                                                        while ($row = mysqli_fetch_assoc($query)) {
                                                            echo "<option value='" . $row['p_id'] . "'>" . $row['position'] . "</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <select name="status" id="status" class="form-control" required>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button id="save-user" type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title text-light" id="editModalLabel">Update User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-dark">
                                        <form method="post" name="update-form" id="update-form">
                                            <input type="hidden" name="Eid" id="edit_id">
                                            <div class="mb-3">
                                                <label for="Eusername">Username:</label>
                                                <input type="text" class="form-control" id="Eusername" name="Eusername" required readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="Epassword">Password:</label>
                                                <input type="password" class="form-control" id="Epassword" name="Epassword" required>
                                            </div>
                                            <div class="mb-3">
                                            <select name="Eutype" id="Eutype" class="form-select mb-3" required>
                                                <option value="" disabled selected>Select User Type</option>
                                                <?php
                                                    $conn = mysqli_connect("localhost", "root", "", "employee");
                                                    $query = mysqli_query($conn, "SELECT * FROM `position`");
                                                    if (mysqli_num_rows($query) > 0) {
                                                        while ($row = mysqli_fetch_assoc($query)) {
                                                            echo "<option value='" . $row['p_id'] . "'>" . $row['position'] . "</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            </div>
                                            <div class="mb-3">
                                            <select name="Estatus" id="Estatus" class="form-control" required>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="update-user">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table id="users_table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include('controller-user.php');
                                    $employee = new Employee();
                                    $users = $employee->get_users();
                                    $no = 1;
                                    $userTypes = [];
                                    $conn = mysqli_connect("localhost", "root", "", "employee");
                                    $query = mysqli_query($conn, "SELECT * FROM `position`");
                                    if (mysqli_num_rows($query) > 0) {
                                        while ($row = mysqli_fetch_assoc($query)) {
                                            $userTypes[$row['p_id']] = $row['position'];
                                        }
                                    }
                                    foreach ($users as $row) {
                                        $utype = "Unknown";
                                        if (isset($userTypes[$row['type']])) {
                                            $utype = $userTypes[$row['type']];
                                        }
                                        $_status = "";
                                        if ($row['status'] == "Active") {
                                            $_status = "Active";
                                        } else if ($row['status'] == "Inactive") {
                                            $_status = "Inactive";
                                        }
                                        echo "<tr>
                                            <td>{$no}</td>
                                            <td>{$row['username']}</td>
                                            <td>{$utype}</td>
                                            <td>{$_status}</td>
                                            <td><button class='btn btn-primary btn-edit edituser' data-id='{$row['username']}'>Edit</button></td>
                                            <td><button class='btn btn-danger btn-delete deleteuser' data-id='{$row['username']}'>Delete</button></td>
                                        </tr>";
                                        $no++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php include('footer.php'); ?>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#save-user").click(function(event) {
                event.preventDefault();
                $.ajax({
                    url: "action-user.php",
                    type: "POST",
                    data: $("#user-form").serialize() + '&action=add_user',
                    success: function(response) {
                        alert(response);
                        if (response.toLowerCase().includes("success")) {
                            $("#user-form")[0].reset();
                            $("#check-username").empty();
                            $("#save-user").prop('disabled', true);
                        }
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    }
                });
            });

            $("#username").keyup(function() {
                var username = $(this).val();
                $.ajax({
                    url: "action-user.php",
                    type: "POST",
                    data: {
                        username: username,
                        action: "check_username"
                    },
                    success: function(response) {
                        if (response.toLowerCase().includes("available")) {
                            $("#check-username").html(response).css("color", "green");
                            $("#save-user").prop('disabled', false);
                        } else {
                            $("#check-username").html(response).css("color", "red");
                            $("#save-user").prop('disabled', true);
                        }
                    }
                });
            });

            $('.edituser').click(function() {
                var username = $(this).data('id');
                $.ajax({
                    url: "action-user.php",
                    type: "POST",
                    data: {
                        username: username,
                        action: "get_user"
                    },
                    success: function(response) {
                        var user = JSON.parse(response);
                        $("#edit_id").val(user.id);
                        $("#Eusername").val(user.username);
                        $("#Epassword").val('');
                        $("#Eutype").val(user.type);
                        $("#Estatus").val(user.status);
                        $("#editModal").modal('show');
                    }
                });
            });

            $("#update-user").click(function(event) {
                event.preventDefault();
                $.ajax({
                    url: "action-user.php",
                    type: "POST",
                    data: $("#update-form").serialize() + '&action=update_user',
                    success: function(response) {
                        alert(response);
                        if (response.toLowerCase().includes("success")) {
                            setTimeout(function(){
                                location.reload();
                            }, 1000);
                        }
                    }
                });
            });

            $('.deleteuser').click(function() {
                var username = $(this).data('id');
                if (confirm("Are you sure you want to delete this user?")) {
                    $.ajax({
                        url: "action-user.php",
                        type: "POST",
                        data: {
                            username: username,
                            action: "delete_user"
                        },
                        success: function(response) {
                            alert(response);
                            setTimeout(function(){
                                location.reload();
                            }, 1000);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
