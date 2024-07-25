<?php require_once('partials/header.php'); ?>
<body>

    <?php require_once('partials/sidenav.php'); ?> 

    <main id="main" class="main">

        <div class="pagetitle">
        <h1>Utility Bills</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Electricity Bills</li>
            </ol>
        </nav>
        </div><!-- End Page Title -->
        <div class="col-12 mt-5">

        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Electricity Payment</h5>

            <!-- Vertical Form -->
            <form class="row g-3">
                <div class="col-12">
                <label for="inputEmail4" class="form-label">Select Disco</label>
                <!-- <input type="email" class="form-control" id="inputEmail4"> -->
                <select class="form-select" aria-label="Default select example">
                    <option selected>Choose Disco</option>
                    <!-- <option value="1">Glo</option>
                    <option value="2">MTN</option>
                    <option value="3">Airtel</option>
                    <option value="4">9Mobile</option> -->
                </select>
                </div>
                <div class="col-12">
                <label for="inputPassword4" class="form-label">Select Meter Type</label>
                <!-- <input type="password" class="form-control" id="inputPassword4"> -->
                <select class="form-select" aria-label="Default select example">
                    <option selected>Meter Type</option>
                    <option value="1">Prepaid</option>
                    <option value="2">Postpaid</option>
                </select>
                </div>
                <div class="col-12">
                <label for="inputAddress" class="form-label">Meter Number</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Input Meter Number">
                </div>
                <div class="text-center">
                <button type="submit" class="btn btn-primary col-12">Verify Meter Number</button>
                </div>
            </form><!-- Vertical Form -->

            </div>
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