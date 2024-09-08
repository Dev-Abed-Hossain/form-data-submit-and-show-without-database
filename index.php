<?php

if (file_exists(__DIR__ . "/autoload.php")) {
    require_once __DIR__ . "/autoload.php";
};


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>


    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // get form values
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $image = $_POST["image"];
        $location = $_POST["location"];

        if (empty($name) || empty($email) || empty($phone) || empty($image) || empty($location)) {
            $msg_text = alert_msg("All fields are required.", "danger");
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $msg_text = alert_msg("Invalid Email Address", "warning");
        } else {
            $msg_text = alert_msg("Data Stable", "success");
            reset_form();
        };

        // Data store from form to json file
        $old_data = json_decode(file_get_contents("./db/team.json"), true);

        array_push($old_data, [
            "name" => $name,
            "email" => $email,
            "phone" => $phone,
            "location" => $location,
            "image" => $image,
        ]);

        file_put_contents("./db/team.json", json_encode($old_data));


    };

?>






    <div class="container">
        <div class="row justify-content-center my-4">
            <div class="col-md-4">
                <div class="card">

                    <div class="card-header">
                        <h3>User Information</h3>
                    </div>

                    <div class="card-body">

                        <div class="msg">
                            <?php echo $msg_text ?? " " ;?>
                        </div>

                        <form action="" method="POST">

                            <div class="my-1">
                                <label for="" class="my-2">Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo old("name") ;?>"
                                    id="">
                            </div>

                            <div class="my-3">
                                <label for="" class="my-2">Phone</label>
                                <input type="text" class="form-control" name="phone" value="<?php echo old("phone") ;?>"
                                    id="">
                            </div>

                            <div class="my-3">
                                <label for="" class="my-2">Email</label>
                                <input type="text" class="form-control" name="email" value="<?php echo old("email") ;?>"
                                    id="">
                            </div>

                            <div class="my-3">
                                <label for="" class="my-2">Image</label>
                                <input type="text" class="form-control" name="image" value="<?php echo old("image") ;?>"
                                    id="">
                            </div>

                            <div class="my-3">
                                <label for="" class="my-2">Location</label>
                                <input type="text" class="form-control" name="location"
                                    value="<?php echo old("location") ;?>" id="">
                            </div>

                            <div class="my-3">
                                <input type="Submit" class="form-control btn btn-primary" value="Submit">
                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>




    <div class="container my-3">
        <div class="row">
            <?php
    // Decode json data from json data
    $data_user = json_decode(file_get_contents("./db/team.json"));

foreach(array_reverse($data_user) as $team):


    ?>
            <div class="col-lg-3 my-3">
                <div class="main shadow rounded">
                    <img class="w-100 rounded" src="<?php echo $team -> image ;?>" alt="">
                    <div class="inner_item px-3 py-3">
                        <h3><?php echo $team -> name ;?></h3>
                        <h6><?php echo $team -> email ;?></h6>
                        <h6><?php echo $team -> phone;?></h6>
                        <h6><?php echo $team -> location;?></h6>
                    </div>
                </div>
            </div>
            <?php endforeach ; ?>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>