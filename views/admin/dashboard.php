<?php require_once('partials/header.php'); ?>

<body>

<?php require_once('partials/sidenav.php'); ?>
  

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-10">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-6 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Total Users</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?=number_format($usersTotal)?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-6 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Total Transactions</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6><s>N</s>
                        <?php
                          if ($historyTotal >= 1000000) {
                            echo '1M+';
                          } elseif ($historyTotal >= 100000) {
                            echo '100K+';
                          } else {
                            echo number_format($historyTotal);
                          }
                        ?>
                      </h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->


            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                  <div class="col-md-6">
                      <form action="/admin/searchuser" method="GET" class="p-4">
                          <p>search for users using email</p>
                          <input type="text" name="search" id="" placeholder="enter email address" class="form-control" required><br>
                          <button class="btn btn-primary">search</button>
                      </form>
                  </div>

                <div class="card-body">
                  <h5 class="card-title">Recently Created Accounts</h5>

                  <div class="responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">Customer Name</th>
                          <th scope="col">Customer Email</th>
                          <th scope="col">Account Balance</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                          if ($limitedUsers) :
                              foreach ($limitedUsers as $users):
                      ?>
                        <tr>
                          <td><?=$users['fname'].' '.$users['lname']?></td>
                          <td class="text-primary"><?=$users['email']?></td>
                          <td>$<?=number_format($users['actbal'])?></td>
                          <td><a href="/admin/user?id=<?=$users['id']?>" class="btn btn-primary">View</a></td>
                        </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                          <tr>
                              <td><p>No user account yet.</p></td>
                          </tr>
                      <?php endif; ?> 
                        
                      </tbody>
                    </table>
                  </div>

                </div>

              </div>
            </div><!-- End Recent Sales -->

            <!-- Top Selling -->
            <div class="col-12">
              <div class="card top-selling overflow-auto">

                  <div class="col-md-6">
                      <form action="/admin/searchtransaction" method="GET" class="p-4">
                          <p>search for transaction using reference</p>
                          <input type="text" name="search" id="" placeholder="enter transaction reference" class="form-control" required><br>
                          <button class="btn btn-primary">search</button>
                      </form>
                  </div>

                <div class="card-body pb-0">
                <h5 class="card-title">Recent Transactions</h5>

                  <div class="responsive">
                    <table class="table table-borderless">
                      <thead>
                        <tr>
                          <th scope="col">Reference</th>
                          <th scope="col">Owner</th>
                          <th scope="col">Package</th>
                          <th scope="col">Amount</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                          if ($limitedTransactions) :
                              foreach ($limitedTransactions as $transaction):
                      ?>

                        <tr>
                          <td><?=$transaction['ref']; ?></td>
                          <td><?=$transaction['fullname']; ?></td>
                          <td><?=$transaction['package']; ?></td>
                          <td><?=$transaction['amount']; ?></td>
                          <td><a href="/admin/user?id=<?=$transaction['userid']?>" class="btn btn-primary">View Owner</a></td>
                        </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                          <tr>
                              <td><p>No transaction created yet.</p></td>
                          </tr>
                      <?php endif; ?>
                        
                      </tbody>
                    </table>
                  </div>

                </div>

              </div>
            </div><!-- End Top Selling -->

          </div>
        </div><!-- End Left side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>billzhub</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://www.linkedin.com/in/chukwudi-uwakwe-24523a184/">cheese</a>
    </div>
  </footer><!-- End Footer -->

<?php require_once('partials/footer.php'); ?>