<?php
    session_start();
    include('condb.php');
?>


<?php $errors = array(); ?>

<?php if (count($errors) > 0) : ?>
    <div class="error">
        <p><?php echo $error ?></p>
    </div>
<?php endif ?>