<div class="pt-3" id="myalert">
    <?php if (isset($_GET['error'])) { ?>
        <p class="text-danger rounded"><?= $_GET['error'] ?></p>
    <?php } elseif (isset($_GET['success'])) { ?>
        <p class="text-success rounded"><?= $_GET['success'] ?></p>
    <?php } ?>
</div>