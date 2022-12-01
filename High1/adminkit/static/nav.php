<?php

include('../../connect.php');


if (isset($_SESSION['sid'])) {
    $sid = $_SESSION['sid'];
    $select = "SELECT * FROM staff where staffid='$sid'";
    $query = mysqli_query($connection, $select);
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        $data = mysqli_fetch_array($query);
        $staffid = $data['staffid'];
        $staffname = $data['staffname'];
        $staffemail = $data['staffemail'];
        $password = $data['password'];
        $phonenumber = $data['phonenumber'];
        $address = $data['address'];
        $staffrole = $data['staffrole'];
        $staffskill = $data['staffskill'];
        $staffskills = explode(',', $staffskill);
        $staffprofile = $data['staffprofile'];
    }
}
?>

<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">


                <a id="dropdownn-toggle" class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                    <div id="div_refresh" class="position-relative">
                        <div id="div_refresh1">
                        </div>
                        <span class='count'></span>
                        <!-- <span class='indicator count'></span> -->
                        <span class='align-middle' data-feather='bell'></span>
                    </div>
                </a>


                <div id="dropdownn-menu" class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">

                </div>


            </li>


            <!-- /////////////////////////////////////////////////////////  -->

            <script>
                <?php
                include('js/allcount2.js');
                ?>
            </script>

            <!-- /////////////////////////////////////////////////////////  -->


            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <img src="<?php echo $staffprofile ?>" class="avatar img-fluid rounded me-1" alt='<?php echo $staffname ?>' /> <span class="text-dark"> <?php echo $staffname ?> </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="pages-profile.php"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                    <a class="dropdown-item" href="staffUpdate.php"><i class="align-middle me-1" data-feather="pie-chart"></i> Update Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
                    <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="staffLogin.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out align-middle me-2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>Log out
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>