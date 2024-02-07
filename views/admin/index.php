<h1>Admin panel</h1>

<?php

include_once __DIR__ . '/../templates/bar.php';

?>

<h2>Search apointments</h2>
<div class="search">
    <form class="form">
        <div class="field">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" value="<?php echo $date ?>">
        </div>
    </form>
</div>

<?php if (count($apointments) === 0) : ?>
    <p class="error">No apointments for the selected date</p>
<?php endif; ?>

<div class="apointments-admin">
    <ul class="apointments">
        <?php
        $apointmentId = '';
        foreach ($apointments as $key => $apointment) :
        ?>
            <?php
            if ($apointmentId !== $apointment->id) :
                $total = 0;
            ?>
                <li class="apointment">
                    <p>ID: <span><?php echo $apointment->id ?></span></p>
                    <p>Hour: <span><?php echo $apointment->hour ?></span></p>
                    <p>Client: <span><?php echo $apointment->client ?></span></p>
                    <p>Email: <span><?php echo $apointment->email ?></span></p>
                    <p>Phone: <span><?php echo $apointment->phone ?></span></p>
                    <h3>Services</h3>
                    <?php $apointmentId = $apointment->id ?>
                <?php
            endif;
            $total += $apointment->price
                ?>
                <p class="service"><?php echo $apointment->service ?></p>
                <?php
                $actual = $apointment->id;
                $next = $apointments[$key + 1]->id ?? 0;

                if (isLast($actual, $next)) :
                ?>
                    <p class="total">Total: <?php echo $total ?>€</p>

                    <form action="/api/delete" method="POST">
                        <input type="hidden" name="id" value="<?php echo $apointment->id ?>">
                        <input class="delete-button" type="submit" value="Delete">
                    </form>
                <?php endif; ?>
            <?php endforeach; ?>
                </li>
    </ul>
</div>

<?php $script = '<script src="build/js/search.js"></script>'; ?>