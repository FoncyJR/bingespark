<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('partials/head.php') ?>
    <title>bingespark Contact</title>
</head>

<body>

    <!-- Navbar -->
    <?php include('partials/navbar.php');?>

    <!--Body-->


    <!-- Wrapper container -->
    <div class="container py-4">
        <h3>Contact Form</h3>

        <form action='contact_submit.php'id="contactForm">

            <!-- Name input -->
            <div class="mb-3">
                <label class="form-label" for="name">Name</label>
                <input class="form-control" id="name" type="text" placeholder="Name" />
            </div>

            <!-- Email address input -->
            <div class="mb-3">
                <label class="form-label" for="emailAddress">Email Address</label>
                <input class="form-control" id="emailAddress" type="email" placeholder="Email Address" />
            </div>

            <!-- Message input -->
            <div class="mb-3">
                <label class="form-label" for="message">Message</label>
                <textarea class="form-control" id="message" type="text" placeholder="Message" style="height: 10rem;"></textarea>
            </div>

            <!-- Form submit button -->
            <div class="control" id="contact-submit">
                <button class="btn btn-primary btn-lg" type="submit">Submit</button>
            </div>

        </form>

    </div>


    <!--Footer-->
    <?php include('partials/footer.php');?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>