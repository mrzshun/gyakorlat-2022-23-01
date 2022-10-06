<?php
    require_once 'vendor/autoload.php';
    $faker = Faker\Factory::create();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Szerveroldali webprogamozás</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
	<h1>Hello <?php echo $faker->name(); ?></h1>
	<p>Your generated email address is <?php echo $faker->email(); ?></p>
  </body>
</html>