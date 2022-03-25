<!DOCTYPE html>
<html lang="en">
<?php
include('auth-session.php');
include('head.php');
?>
<body>
<?php
    include('navbar.php');
    ?>
    <div class="contact3 py-5">
        <div class="row no-gutters">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card-shadow">
                            <img src="img/cnu.jpg" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="contact-box ml-3">
                            <h1 class="font-weight-light mt-1">Feedback/Query</h1>
                            <form class="mt-3">
                                <div class="row">
                                    <div class="col-lg-10">
                                        <div class="form-group mt-2">
                                            <input class="form-control" type="text" placeholder="name">
                                        </div>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="form-group mt-2">
                                            <input class="form-control" type="email" placeholder="email address">
                                        </div>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="form-group mt-2">
                                            <input class="form-control" type="text" placeholder="phone">
                                        </div>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="form-group mt-2">
                                            <textarea class="form-control" rows="3" placeholder="message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-10">
                                        <button type="submit" class="btn btn-danger-gradiant mt-3 text-black bg-success border-0 px-3 py-2"><span> SUBMIT</span></button>
                                    </div>
                                    

                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <?php
    include("footer.php");
    include("scripts.php");
    ?>
</body>

</html>