<?php require_once('partials/header.php'); ?>
<body>

    <?php require_once('partials/sidenav.php'); ?>  

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>User Dashboard</h1>
      <nav>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
          </ol>
      </nav>
    </div>

    <!-- End Page Title -->

    <section class="section dashboard pt-5">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-md-12 pt-4">
          <div class="row">

            <div class="col-sm-6 pt-2">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="p-3">
                      <h6><a href="index.html" class="text-decoration-none text-dark fs-5">Account Balance</a></h6>
                      <span class="text-muted small pt-2 ps-1">Visit your Dashboard</span>

                    </div>
                  </div>
                </div>

              </div>
            </div>


            <!-- Customers Card -->
            <div class="col-md-6 pt-2">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="p-3">
                      <h6><a href="history.html" class="text-decoration-none text-dark fs-5">Total Transaction</a></h6>
                      <span class="text-muted small pt-2 ps-1">Check Your Transaction History</span>

                    </div>
                  </div>

                </div>
              </div>

            </div>
            <!-- End Customers Card -->

            <div class="col-md-4 pt-3">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-phone"></i>
                    </div>
                    <div class="p-3">
                      <h6><a href="/airtime" class="text-decoration-none text-dark fs-5">Buy Airtime</a></h6>
                      <span class="text-muted small pt-2 ps-1">MTN, Glo, Airtel, 9Mobile</span>

                    </div>
                  </div>

                </div>
              </div>

            </div>

            <div class="col-md-4 pt-3">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="fa fa-coins"></i>
                    </div>
                    <div class="p-3">
                      <h6><a href="/mtndata" class="text-decoration-none text-dark fs-5">Buy Data</a></h6>
                      <span class="text-muted small pt-2 ps-1">MTN, Glo, Airtel, 9Mobile</span>

                    </div>
                  </div>

                </div>
              </div>

            </div>

            <div class="col-md-4 pt-3">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-tv"></i>
                    </div>
                    <div class="p-3">
                      <h6><a href="/dstv" class="text-decoration-none text-dark fs-5">CableTv</a></h6>
                      <span class="text-muted small pt-2 ps-1">Startimes, DsTv, GoTv</span>

                    </div>
                  </div>

                </div>
              </div>

            </div>

            <div class="col-md-4 pt-3">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="fa fa-bolt"></i>
                    </div>
                    <div class="p-3">
                      <h6><a href="/electricity" class="text-decoration-none text-dark fs-5">Electricity Bills</a></h6>
                      <span class="text-muted small pt-2 ps-1">Pay for elctctricity</span>

                    </div>
                  </div>

                </div>
              </div>

            </div>

            <div class="col-md-4 pt-3">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="fa fa-cash-register"></i>
                    </div>
                    <div class="p-3">
                      <h6><a href="/deposit" class="text-decoration-none text-dark fs-5">Deposit</a></h6>
                      <span class="text-muted small pt-2 ps-1">Deposit money</span>

                    </div>
                  </div>

                </div>
              </div>

            </div>

            <div class="col-md-4 pt-3">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-whatsapp"></i>
                    </div>
                    <div class="p-3">
                      <h6><a href="https://chat.whatsapp.com/Ifm4oFji0XF9OvcIiKFrGm"
                          class="text-decoration-none text-dark fs-5">Whatsapp</a></h6>
                      <span class="text-muted small pt-2 ps-1">Join our community</span>

                    </div>
                  </div>

                </div>
              </div>

            </div>

            <!-- End Left side columns -->



          </div>
    </section>

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