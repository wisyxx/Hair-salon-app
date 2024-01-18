<h1 class="page-title">Your apointments</h1>
<p class="page-description">Select your services and write your personal data</p>

<div id="app">

    <nav class="tabs">
        <button type="button" data-step="1">Services</button>
        <button type="button" data-step="2">Personal data and apointment</button>
        <button type="button" data-step="3">Apointment summary</button>
    </nav>

    <div class="section" id="step-1">
        <h2>Services</h2>
        <p class="text-center">Choose your services below</p>
        <div id="services"></div>
    </div>
    <div class="section" id="step-2">
        <h2>Your personal data and apointment</h2>
        <p class="text-center">Write your data and apointment date</p>

        <form action="" class="form">
            <div class="field">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Your name" value="<?php echo $_SESSION['name'] ?>" disabled>
            </div>
            <div class="field">
                <label for="date">Apointment date</label>
                <input type="date" name="date" id="date">
            </div>
            <div class="field">
                <label for="hour">Apointment hour</label>
                <input type="time" name="hour" id="hour">
            </div>
        </form>
    </div>
    <div class="section" id="step-3">
        <h2>Apointment summary</h2>
        <p class="text-center">Verify your apointment information</p>
    </div>

    <div class="pagination">
        <button class="button" id="previous">
            &laquo; Previous
        </button>
        <button class="button" id="next">
            Next &raquo;
        </button>
    </div>
</div>

<?php
$script = "
        <script src='build/js/app.js'></script>
    ";
?>