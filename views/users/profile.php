<?php require_once('partials/header.php'); ?>
<body>

    <?php require_once('partials/sidenav.php'); ?> 

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Edit Profile</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="col-12 mt-5">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">USER INFORMATION</h5>
                    <!-- Multi Columns Form -->
                    <form action="/editprofile" method="POST" class="row g-3">
                        <?php require_once('partials/alert.php'); ?>
                        <div class="col-md-6">
                            <label for="inputName5" class="form-label">Username</label>
                            <input type="text" class="form-control" id="inputName5" value="<?=$_SESSION['user']['uname']?>" name="userName" required>
                            <input type="hidden" name="id" value="<?=$_SESSION['user']['id']?>" id="">
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail5" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="inputEmail5" value="<?=$_SESSION['user']['email']?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword5" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="inputNumber5" value="<?=$_SESSION['user']['phone']?>" name="phone" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword5" class="form-label">First name</label>
                            <input type="text" class="form-control" id="inputFirstName5" value="<?=$_SESSION['user']['fname']?>" name="firstName" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword5" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="inputLastName5" value="<?=$_SESSION['user']['lname']?>" name="lastName" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary col-12">Update Account</button>
                        </div>
                    </form><!-- End Multi Columns Form -->

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Set New Password
            </div>
            <div class="card-body">
                <h5 class="card-title">USER INFORMATION</h5>
                <!-- Multi Columns Form -->
                <form action="/changepassword" method="POST" class="row g-3">
                    <div class="col-md-6">
                        <label for="inputPassword5" class="form-label">Old Password</label>
                        <input type="password" class="form-control" id="inputPassword5" name="cpassword" required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword5" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="inputPassword5" required name="npassword">
                        <input type="hidden" name="id" value="<?=$_SESSION['user']['id']?>" id="">
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword5" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="inputPassword5" required name="cnpassword">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary col-12">Update Password</button>
                    </div>
                </form><!-- End Multi Columns Form -->

            </div>
        </div>
        </main><!-- End #main -->


<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright. All Rights Reserved
    </div>
    <div class="credits text-center p-3">
        Designed by <a href="https://www.linkedin.com/in/chukwudi-uwakwe-24523a184/">cheese</a>
    </div>

<?php require_once('partials/footer.php'); ?>