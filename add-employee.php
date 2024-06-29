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
            <div class="row">
                <div class="col-lg-12">
                    <?php include('sidebar.php'); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12">
                    <button type="button" class="btn btn-primary m-4" data-bs-toggle="modal" data-bs-target="#employeeModal">
                        Add Employee
                    </button>
                    <div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="employeeModalLabel">Add Employee</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="employee-form" method="POST">
                                            <input type="text" name="employee" id="employee" placeholder="Employee" class="form-control mb-3">
                                            <p id="check-employee"></p>
                                            <select name="sex" class="form-control mb-3">
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                            <input type="date" name="dob" placeholder="Date of Birth" class="form-control mb-3">
                                            <select name="type" class="form-control mb-3" required>
                                                <option value="" disabled selected>Select employee Type</option>
                                                <?php
                                                $conn = mysqli_connect("localhost", "root", "", "employee");
                                                $query_positions = mysqli_query($conn, "SELECT * FROM `position`");
                                                if (mysqli_num_rows($query_positions) > 0) {
                                                    while ($row = mysqli_fetch_assoc($query_positions)) {
                                                        echo "<option value='" . $row['p_id'] . "'>" . $row['position'] . "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <select name="province" id="province" class="form-control mb-3">
                                                <option selected disabled>Select Province</option>
                                                <?php
                                                  $conn = mysqli_connect("localhost", "root", "", "employee");
                                                  $query_provinces = mysqli_query($conn, "SELECT * FROM `province`");
                                                  if(mysqli_num_rows($query_provinces) > 0){
                                                    while($row = mysqli_fetch_assoc($query_provinces)){
                                                      echo "<option value='".$row['PROCODE']."'>".$row['PROVINCE']."</option>";
                                                    }
                                                  }
                                                ?>
                                            </select>
                                            <select name="district" id="district" class="form-control mb-3">
                                              <option selected disabled>Select District</option>
                                            </select>
                                            <select name="commune" id="commune" class="form-control mb-3">
                                              <option selected disabled>Select Commune</option>
                                            </select>
                                            <input type="number" name="salary" placeholder="Salary" class="form-control mb-3">
                                            <select name="status" class="form-control mb-3" required>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                            </select>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button id="save-employee" type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- edit-employee -->
                    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="employeeModalLabel">Edit Employee</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="employee-form" method="POST">
                                        <input type="hidden" name="original_employee" id="edit-id">
                                        <input type="text" name="employee" id="edit-employee" placeholder="Employee" class="form-control mb-3">
                                        <p id="check-employee"></p>
                                        <select name="sex" id="edit-sex" class="form-control mb-3">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                        <input type="date" id="edit-dob" name="dob" placeholder="Date of Birth" class="form-control mb-3">
                                        <select name="type" id="edit-type" class="form-control mb-3" required>
                                            <option value="" disabled selected>Select employee Type</option>
                                            <?php
                                            $conn = new mysqli("localhost", "root", "", "employee");
                                            $query_positions = $conn->query("SELECT * FROM `position`");
                                            if ($query_positions->num_rows > 0) {
                                                while ($row = $query_positions->fetch_assoc()) {
                                                    echo "<option value='" . $row['p_id'] . "'>" . $row['position'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <select name="province" id="edit-province" class="form-control mb-3">
                                            <option selected disabled>Select Province</option>
                                            <?php
                                            // Assuming you want the same options for the edit form
                                            $query_provinces = $conn->query("SELECT * FROM `province`");
                                            if ($query_provinces->num_rows > 0) {
                                                while ($row = $query_provinces->fetch_assoc()) {
                                                    echo "<option value='" . $row['PROCODE'] . "'>" . $row['PROVINCE'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <select name="district" id="edit-district" class="form-control mb-3">
                                            <option selected disabled>Select District</option>
                                        </select>
                                        <select name="commune" id="edit-commune" class="form-control mb-3">
                                            <option selected disabled>Select Commune</option>
                                        </select>
                                        <input type="number" name="salary" id="edit-salary" placeholder="Salary" class="form-control mb-3">
                                        <select name="status" id="edit-status" class="form-control mb-3" required>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button id="update-employee" type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table id="employee_table" class="table table-striped table-bordered table-sm">
                        <thead>
                            <tr>
                                <th class="small">No</th>
                                <th class="small">Employees</th>
                                <th class="small">Sex</th>
                                <th class="small">Date of Birth</th>
                                <th class="small">Position</th>
                                <th class="small">Province</th>
                                <th class="small">District</th>
                                <th class="small">Commune</th>
                                <th class="small">Salary</th>
                                <th class="small">Status</th>
                                <th class="small" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require('controller-employee.php');
                            $employee = new Employee1();
                            $employees = $employee->get_employee();
                            $no = 1;
                            $conn = mysqli_connect("localhost", "root", "", "employee");

                            // Fetch positions
                            $query_positions = mysqli_query($conn, "SELECT * FROM `position`");
                            $employeeTypes = [];
                            if (mysqli_num_rows($query_positions) > 0) {
                                while ($row = mysqli_fetch_assoc($query_positions)) {
                                    $employeeTypes[$row['p_id']] = $row['position'];
                                }
                            }
                        
                            // Fetch provinces
                            $query_provinces = mysqli_query($conn, "SELECT * FROM `province`");
                            $provinceTypes = [];
                            if (mysqli_num_rows($query_provinces) > 0) {
                                while ($row = mysqli_fetch_assoc($query_provinces)) {
                                    $provinceTypes[$row['PROCODE']] = $row['PROVINCE'];
                                }
                            }
                        
                            // Fetch districts
                            $query_districts = mysqli_query($conn, "SELECT * FROM `district`");
                            $districtTypes = [];
                            if (mysqli_num_rows($query_districts) > 0) {
                                while ($row = mysqli_fetch_assoc($query_districts)) {
                                    $districtTypes[$row['DCode']] = $row['DName_en'];
                                }
                            }
                        
                            // Fetch communes
                            $query_communes = mysqli_query($conn, "SELECT * FROM `commune`");
                            $communeTypes = [];
                            if (mysqli_num_rows($query_communes) > 0) {
                                while ($row = mysqli_fetch_assoc($query_communes)) {
                                    $communeTypes[$row['CCode']] = $row['CName_en'];
                                }
                            }
                        
                            // Display employees data
                            foreach ($employees as $row) {
                                $utype = isset($employeeTypes[$row['type']]) ? $employeeTypes[$row['type']] : "Unknown";
                                $ptype = isset($provinceTypes[$row['province']]) ? $provinceTypes[$row['province']] : "Unknown";
                                $dtype = isset($districtTypes[$row['district']]) ? $districtTypes[$row['district']] : "Unknown";
                                $ctype = isset($communeTypes[$row['commune']]) ? $communeTypes[$row['commune']] : "Unknown";
                                $_status = ($row['status'] == "Active") ? "Active" : "Inactive";
                            
                                echo "<tr>
                                    <td class='small'>{$no}</td>
                                    <td class='small'>{$row['employee']}</td>
                                    <td class='small'>{$row['sex']}</td>
                                    <td class='small'>{$row['dob']}</td>
                                    <td class='small'>{$utype}</td>
                                    <td class='small'>{$ptype}</td>
                                    <td class='small'>{$dtype}</td>
                                    <td class='small'>{$ctype}</td>
                                    <td class='small'>{$row['salary']}</td>
                                    <td class='small'>{$_status}</td>
                                    <td class='small'><button class='btn btn-primary btn-edit editemployee' data-id='{$row['employee']}'>Edit</button></td>
                                    <td class='small'><button class='btn btn-danger btn-delete deleteemployee' data-id='{$row['employee']}'>Delete</button></td>
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
        $("#save-employee").click(function(event) {
            event.preventDefault();
            $.ajax({
                url: "action-employee.php",
                type: "POST",
                data: $("#employee-form").serialize() + '&action=add_employee',
                success: function(response) {
                    alert(response);
                    if (response.toLowerCase().includes("success")) {
                        $("#employee-form")[0].reset();
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    }
                }
            });
        });
        $("#employee").keyup(function() {
            var employee = $(this).val().trim();
            if (employee.length > 0) {
                $.ajax({
                    url: "action-employee.php",
                    type: "POST",
                    data: {
                        employee: employee,
                        action: "check_employee"
                    },
                    success: function(response) {
                        if (response.toLowerCase().includes("available")) {
                            $("#check-employee").html(response).css("color", "green");
                            $("#save-employee").prop('disabled', false);
                        } else {
                            $("#check-employee").html(response).css("color", "red");
                            $("#save-employee").prop('disabled', true);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error checking employee availability: ' + error);
                    }
                });
            } else {
                $("#check-employee").html(""); // Clear message if no input
                $("#save-employee").prop('disabled', true);
            }
        });

        $('.btn-edit').click(function() {
        var employeeId = $(this).data('id');
        $.ajax({
            url: "action-employee.php",
            type: "POST",
            data: {
                employee: employeeId,
                action: "get_employee"
            },
            success: function(response) {
                var employee = JSON.parse(response);
                $("#edit-employee").val(employee.employee);
                $("#edit-sex").val(employee.sex);
                $("#edit-dob").val(employee.dob);
                $("#edit-type").val(employee.type);
                $("#edit-province").val(employee.province);
                $("#edit-district").val(employee.district);
                $("#edit-commune").val(employee.commune);
                $("#edit-salary").val(employee.salary);
                $("#edit-status").val(employee.status);
                $("#editEmployeeModal").modal('show');
            }
        });
        });
        $("#update-employee").click(function(event) {
            event.preventDefault();
            $.ajax({
                url: "action-employee.php",
                type: "POST",
                data: $("#employee-form").serialize() + '&action=update_employee',
                success: function(response) {
                    alert(response);
                    if (response.toLowerCase().includes("success")) {
                        $("#employee-form")[0].reset();
                        $("#editEmployeeModal").modal('hide');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                }
            });
        });
        $('.btn-delete').click(function() {
            var employeeName = $(this).data('id');
            if (confirm('Are you sure you want to delete this employee?')) {
                $.ajax({
                    url: 'action-employee.php',
                    type: 'POST',
                    data: { action: 'delete_employee', employee: employeeName },
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
        $('#province').change(function(){
            var proID = $(this).val();
            $.ajax({
                url: 'getData.php',
                method: 'POST',
                data: {proID: proID},
                success: function(data){
                    $('#district').html(data);
                }
            });
        });

        function updateDistricts(provinceSelector, districtSelector) {
            var proID = $(provinceSelector).val();
            $.ajax({
                url: 'getData.php',
                method: 'POST',
                data: {proID: proID},
                success: function(data){
                    $(districtSelector).html(data);
                }
            });
        }

        function updateCommunes(districtSelector, communeSelector) {
            var disID = $(districtSelector).val();
            $.ajax({
                url: 'getData.php',
                method: 'POST',
                data: {disID: disID},
                success: function(data){
                    $(communeSelector).html(data);
                }
            });
        }

        $('#province').change(function(){
            updateDistricts('#province', '#district');
        });

        $('#district').change(function(){
            updateCommunes('#district', '#commune');
        });

        $('#edit-province').change(function(){
            updateDistricts('#edit-province', '#edit-district');
        });

        $('#edit-district').change(function(){
            updateCommunes('#edit-district', '#edit-commune');
        });
    });
    </script>
</body>
</html>
