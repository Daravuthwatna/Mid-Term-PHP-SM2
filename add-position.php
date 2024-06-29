<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('link-cdn.php'); ?>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php include('header.php'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <?php include('sidebar.php'); ?>
            </div>
            <div class="col-lg-9">
                <button type="button" class="btn btn-primary m-4" data-bs-toggle="modal" data-bs-target="#addPositionModal">
                    Add Position
                </button>
                <div class="modal fade" id="addPositionModal" tabindex="-1" aria-labelledby="addPositionModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addPositionModalLabel">Add Position</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="add-position-form" method="POST">
                                    <input type="text" name="position" id="position" placeholder="Position" class="form-control mb-3" required>
                                    <input type="text" name="description" placeholder="Description" class="form-control mb-3" required>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button id="save-position" type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Position Modal -->
                <div class="modal fade" id="editPositionModal" tabindex="-1" aria-labelledby="editPositionModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editPositionModalLabel">Edit Position</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="edit-position-form" method="POST">
                                    <input type="hidden" name="original_position" id="original_position">
                                    <input type="text" name="position" id="edit_position" placeholder="Position" class="form-control mb-3" required>
                                    <input type="text" name="description" id="edit_description" placeholder="Description" class="form-control mb-3" required>
                                    <select name="status" id="edit_status" class="form-control" required>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button id="update-position" type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

                <table id="users_table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Position</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include('controller-position.php');
                            $position = new Position();
                            $positions = $position->get_position();
                            $no = 1;
                            foreach ($positions as $row) {
                                $_status = $row['status'] == "Active" ? "Active" : "Inactive";
                                echo "<tr>
                                    <td>{$no}</td>
                                    <td>{$row['position']}</td>
                                    <td>{$row['description']}</td>
                                    <td>{$_status}</td>
                                    <td><button class='btn btn-primary btn-edit edit-position' data-id='{$row['position']}'>Edit</button></td>
                                    <td><button class='btn btn-danger btn-delete delete-position' data-id='{$row['position']}'>Delete</button></td>
                                </tr>";
                                $no++;
                            }
                        ?>
                    </tbody>
                </table>
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
            $("#save-position").click(function(event) {
                event.preventDefault();
                $.ajax({
                    url: "action-position.php",
                    type: "POST",
                    data: $("#add-position-form").serialize() + '&action=add_position',
                    success: function(response) {
                        alert(response);
                        if (response.toLowerCase().includes("success")) {
                            $("#add-position-form")[0].reset();
                            setTimeout(function(){
                                location.reload();
                            }, 1000);
                        }
                    }
                });
            });

            $('.edit-position').click(function() {
                var positionName = $(this).data('id');
                $.ajax({
                    url: 'action-position.php',
                    type: 'POST',
                    data: { action: 'get_position', position: positionName },
                    success: function(response) {
                        var data = JSON.parse(response);
                        $("#original_position").val(data.position);
                        $("#edit_position").val(data.position);
                        $("#edit_description").val(data.description);
                        $("#edit_status").val(data.status);
                        $("#editPositionModal").modal('show');
                    }
                });
            });

            $("#update-position").click(function(event) {
                event.preventDefault();
                $.ajax({
                    url: "action-position.php",
                    type: "POST",
                    data: $("#edit-position-form").serialize() + '&action=update_position',
                    success: function(response) {
                        alert(response);
                        if (response.toLowerCase().includes("success")) {
                            $("#edit-position-form")[0].reset();
                            $("#editPositionModal").modal('hide');
                            setTimeout(function(){
                                location.reload();
                            }, 1000);
                        }
                    }
                });
            });

            $('.btn-delete').click(function() {
                var positionName = $(this).data('id');
                if (confirm('Are you sure you want to delete this position?')) {
                    $.ajax({
                        url: 'action-position.php',
                        type: 'POST',
                        data: { action: 'delete_posi', position: positionName },
                        success: function(response) {
                            alert(response);
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            alert('Error: ' + error);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
