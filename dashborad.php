<!DOCTYPE html>
<html lang="en">
  <?php
    include('link-cdn.php');
  ?>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <?php
            include('header.php');
          ?>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3">
          <div class="row">
            <div class="col-lg-12">
              <?php
                include('sidebar.php');
              ?>
            </div>
          </div>
        </div>
        <div class="col-lg-9">
          <div class="row">
            <div class="col-lg-12">
              <h2>User</h2>
              <table id="users_table" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Type</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $conn = mysqli_connect("localhost", "root", "", "employee");
                $query = mysqli_query($conn, "SELECT * FROM `login_user` WHERE `status` = 'Active'");
                $users = [];
                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                        $users[] = $row;
                    }
                }
                $positionQuery = mysqli_query($conn, "SELECT * FROM `position`");
                $userTypes = [];
                if (mysqli_num_rows($positionQuery) > 0) {
                    while ($row = mysqli_fetch_assoc($positionQuery)) {
                        $userTypes[$row['p_id']] = $row['position'];
                    }
                }
                $no = 1;
                foreach ($users as $row) {
                    $utype = isset($userTypes[$row['type']]) ? $userTypes[$row['type']] : "Unknown";
                    $_status = $row['status'] == "Active" ? "Active" : "Inactive";
                    echo "<tr>
                            <td>{$no}</td>
                            <td>{$row['username']}</td>
                            <td>{$utype}</td>
                            <td>{$_status}</td>
                          </tr>";
                    $no++;
                  }
                ?>
                </tbody>
              </table>

              <h2>Positions</h2>
              <table id="positions_table" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Position</th>
                    <th>Description</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $query = mysqli_query($conn, "SELECT * FROM `position` WHERE `status` = 'Active'");
                  $no = 1;
                  if (mysqli_num_rows($query) > 0) {
                      while ($row = mysqli_fetch_assoc($query)) {
                          echo "<tr>
                                  <td>{$no}</td>
                                  <td>{$row['position']}</td>
                                  <td>{$row['description']}</td>
                                  <td>{$row['status']}</td>
                                </tr>";
                          $no++;
                      }
                  }
                ?>
                </tbody>
              </table>
              <h2>Employee</h2>
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
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $query = mysqli_query($conn, "SELECT * FROM `employee` WHERE `status` = 'Active'");
                    $no = 1;
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
                    if (mysqli_num_rows($query) > 0) {
                      while ($row = mysqli_fetch_assoc($query)) {
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
                          </tr>";
                        $no++;
                      }
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
          <?php
            include('footer.php');
          ?>
        </div>
      </div>
    </div>
  </body>
</html>
