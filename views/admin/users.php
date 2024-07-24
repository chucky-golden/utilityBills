<?php require_once('partials/header.php'); ?>

<body>

<?php require_once('partials/sidenav.php'); ?>
  

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Users</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Users</li>
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
                    <form action="/admin/searchuser" method="GET" class="p-4">
                        <?php require_once('partials/alert.php'); ?>
                        <p>search for users using email</p>
                        <input type="text" name="search" id="" placeholder="enter email address" class="form-control"><br>
                        <button class="btn btn-primary">search</button>
                    </form>
                </div>

                <div class="card-body">
                    <h5 class="card-title">
                        <?php if (isset($_GET['search'])) :  ?>
                            Searched Account Result
                        <?php else: ?>
                                Created Accounts
                        <?php endif ?>
                            
                    </h5>

                    <?php if (isset($_GET['search'])) :  ?>

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Customer Email</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Account Balance</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if ($users) :
                                    foreach ($users as $user):
                            ?>
                            <tr>
                                <td><?=$user['fname'].' '.$user['lname']?></td>
                                <td class="text-primary"><?=$user['email']?></td>
                                <td><?=$user['phone']?></td>
                                <td>$<?=number_format($user['actbal'])?></td>
                                <td><a href="/admin/user?id=<?=$user['id']?>" class="btn btn-primary">View</a></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td><p>No user account yet.</p></td>
                                </tr>
                            <?php endif; ?> 
                            
                            </tbody>
                        </table>

                    <?php else: ?>

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Customer Email</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Account Balance</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if ($users) :
                                    foreach ($users as $user):
                            ?>
                            <tr>
                                <td><?=$user['fname'].' '.$user['lname']?></td>
                                <td class="text-primary"><?=$user['email']?></td>
                                <td><?=$user['phone']?></td>
                                <td>$<?=number_format($user['actbal'])?></td>
                                <td><a href="/admin/user?id=<?=$user['id']?>" class="btn btn-primary">View</a></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td><p>No user account yet.</p></td>
                                </tr>
                            <?php endif; ?> 
                            
                            </tbody>
                        </table>

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
      &copy; Copyright <strong><span>YuzTech</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://www.linkedin.com/in/chukwudi-uwakwe-24523a184/">cheese</a>
    </div>
  </footer><!-- End Footer -->

<?php require_once('partials/footer.php'); ?>