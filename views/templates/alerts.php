<?php foreach ($alerts as $key => $messages) : ?>
    <?php foreach ($messages as $message) : ?>
        <p class="<?php echo $key ?>">
            <?php echo $message; ?>
        </p>
    <?php endforeach; ?>
<?php endforeach; ?>