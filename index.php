<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Assignment Currency Converter</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/starter-template/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <?php

    spl_autoload_register(function ($class_name) {
        include 'lib' . DIRECTORY_SEPARATOR . $class_name . '.php';
    });

    if (!empty($_POST['submitButton'])) {
        // validate

        $from = $_POST['from'];
        $money = Money::$from($_POST['amount']);
        $convert = new Convertor();
        $money  = $convert->convert($money, Currency::fromCode($_POST['to']));
    }
    $options = ['USD', 'EUR', 'MYR']
    ?>

    <main role="main" class="container">

        <div class="starter-template">
            <form action="index.php" method="post">
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input class="form-control" type="double" name="amount" id="amount" value="<?php echo (isset($_POST['amount']) ? $_POST['amount'] : "") ?>" />
                </div>

                <div class="form-group">
                    <label for="from">from</label>
                    <select class="form-control" name="from" id="">
                        <?php
                        foreach ($options as $option) {
                        ?>
                            <option value="<?php echo $option ?>" <?php echo (isset($_POST['from']) && $_POST['from'] === $option) ? "selected='selected'" : "" ?>><?php echo $option ?></option>";
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="to">To</label>
                    <select class="form-control" name="to" id="">
                        <?php
                        foreach ($options as $option) {
                        ?>
                            <option value="<?php echo $option ?>" <?php echo (isset($_POST['to']) && $_POST['to'] === $option) ? "selected='selected'" : "" ?>><?php echo $option ?></option>";
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <button class="btn btn-primary" type="submit" name="submitButton" value=1>Convert</button>
            </form>
            Rate: <?php echo (isset($money) ? $money : "0.0000"); ?>
        </div>
    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>