<?php require_once('partials/header.php'); ?>

<body>

<?php require_once('partials/sidenav.php'); ?>
  

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Transactions</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Transactions</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-10">
            <!-- Recent Sales -->
            <div class="card recent-sales overflow-auto">

                <div class="col-md-6">
                    <form action="/admin/searchtransaction" method="GET" class="p-4">
                        <p>search for transaction using reference</p>
                        <input type="text" name="search" id="" placeholder="enter transaction reference" class="form-control"><br>
                        <button class="btn btn-primary">search</button>
                    </form>
                </div>

                <div class="card-body pb-0">
                    <h5 class="card-title">
                        <?php if (isset($_GET['search'])) :  ?>
                            Searched Transaction Result
                        <?php else: ?>
                            Transaction History
                        <?php endif ?>
                            
                    </h5>

                    <?php if (isset($_GET['search'])) :  ?>

                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th scope="col">Reference</th>
                                <th scope="col">Owner</th>
                                <th scope="col">Package</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if ($transactions) :
                                    foreach ($transactions as $transaction):
                            ?>

                            <tr>
                                <td><?=$transaction['ref']; ?></td>
                                <td><?=$transaction['fullname']; ?></td>
                                <td><?=$transaction['package']; ?></td>                                
                                <td><?=$transaction['amount']; ?></td>
                                <td><?php 
                                    if($transaction['paid'] == 0):
                                        echo '<span class="badge bg-success">successful</span>';
                                    else:
                                        echo '<span class="badge bg-danger">failed</span>';
                                    endif;
                                ?></td>
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

                    <?php else: ?>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                <tr>
                                    <th scope="col">Reference</th>
                                    <th scope="col">Owner</th>
                                    <th scope="col">Package</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if ($transactions) :
                                        foreach ($transactions as $transaction):
                                ?>

                                <tr>
                                    <td><?=$transaction['ref']; ?></td>
                                    <td><?=$transaction['fullname']; ?></td>
                                    <td><?=$transaction['package']; ?></td>
                                    <td><?=$transaction['amount']; ?></td>
                                    <td><?php 
                                        if($transaction['paid'] == 0):
                                            echo '<span class="badge bg-success">successful</span>';
                                        else:
                                            echo '<span class="badge bg-danger">failed</span>';
                                        endif;
                                    ?></td>
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

                    <?php endif ?>


                    <div class="mt-5">
                        <ul class="pagination">
                            <?php if ($page > 1) : ?>
                                <?php if (isset($_GET['search'])) : ?>
                                    <li class="page-item"><a class="page-link" href="?search=<?=$_GET['search'] . '&page=' . ($page - 1) ?>">Previous</a></li>
                                <?php else: ?>
                                <li class="page-item"><a class="page-link" href='?page=<?= ($page - 1) ?>'>Previous</a></li>

                                <?php endif; ?>
                            <?php endif;

                            for ($i = 1; $i <= $totalPages; $i++) : ?>

                                <?php 
                                    $active = ($i == $page) ? 'active' : '';
                                    if (isset($_GET['search'])) : 
                                ?>

                                    <li class="page-item <?= $active ?>"><a class="page-link" href="?search=<?=$_GET['search'] . '&page=' . $i ?>"><?= $i ?></a></li>
                                <?php else: ?>
                                    <li class="page-item <?= $active ?>"><a class="page-link" href='?page=<?= $i ?>'><?= $i ?></a></li>
                                <?php endif; ?>
                                
                            <?php endfor;
                            if ($page < $totalPages) : ?>
                                <?php if (isset($_GET['search'])) : ?>

                                    <li class="page-item"><a class="page-link" href='?search=<?$_GET['search'] . '&page=' . ($page + 1) ?>'>Next</a></li>
                                <?php else: ?>
                                    <li class="page-item"><a class="page-link" href='?page=<?= ($page + 1) ?>'>Next</a></li>
                                    <?php endif; ?>
                            <?php endif; ?>
                        </ul> 
                    </div>

                </div>
            </div><!-- End Recent Sales -->

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