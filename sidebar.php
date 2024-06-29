<!DOCTYPE html>
<html lang="en">
  <?php
    // include('connection.php');
  ?>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
              <div class="list-group list-group-flush mx-3 mt-4">
                <a href="dashborad.php" class="list-group-item list-group-item-action py-2 ripple">
                  <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span>
                </a>
                <a href="add-user.php" class="list-group-item list-group-item-action py-2 ripple">
                  <i class="fas fa-chart-area fa-fw me-3"></i><span>User</span>
                </a>
                <a href="add-position.php" class="list-group-item list-group-item-action py-2 ripple"
                  ><i class="fas fa-lock fa-fw me-3"></i><span>Postion</span></a
                >
                <a href="add-employee.php" class="list-group-item list-group-item-action py-2 ripple"
                  ><i class="fas fa-chart-line fa-fw me-3"></i><span>Employee</span></a
                >
                <a href="#" class="list-group-item list-group-item-action py-2 ripple">
                  <i class="fas fa-chart-pie fa-fw me-3"></i><span>about</span>
                </a>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </body>
</html>