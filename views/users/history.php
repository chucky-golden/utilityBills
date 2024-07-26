<?php require_once('partials/header.php'); ?>
<body>

    <?php require_once('partials/sidenav.php'); ?> 

    <main id="main" class="main">

        <div class="pagetitle">
        <h1>Transaction History</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Transaction History</li>
            </ol>
        </nav>
        </div>

        <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Transaction(s) History</h5>
            <?php require_once('partials/alert.php'); ?>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>REFERENCE</th>
                    <th>PACKAGE</th>
                    <th>AMOUNT</th>
                    <th>STATUS</th>
                    <th>DATE & TIME</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        if ($history) :
                            foreach ($history as $transaction):
                    ?>

                    <tr>
                        <td><?=$transaction['ref']; ?></td>
                        <td><?=$transaction['package']; ?></td>
                        <td><?=$transaction['amount']; ?></td>
                        <td><?php 
                            if($transaction['paid'] == 0):
                                echo '<span class="badge bg-success">successful</span>';
                            else:
                                echo '<span class="badge bg-danger">failed</span>';
                            endif;
                        ?></td>
                        <td><?=$transaction['createddate']; ?></td>
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