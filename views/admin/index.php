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
                <?php endif; ?>
            <?php endforeach; ?>
                </li>
    </ul>
</div>