<?php

    function stripAccents($str) {
        return strtr(utf8_decode($str), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
    }

    function generateName() 
    {  
        $familyNames = ["Kovács","Varga","Máriás","Horváth"];
        $givenNames = ["István","Dávid","Ádám","Lujza","Anna","Dorottya"];
        return $familyNames[array_rand($familyNames)]." ".$givenNames[array_rand($givenNames)];
    }

    function generateEmail($name)
    {
        $emailEndings = ["elte.hu","inf.elte.hu","gmail.com","freemail.hu"];
        $nameArray = explode(" ",$name);
        $simpleName = "";
        if(sizeof($nameArray) == 0)
        {
            $simpleName = "jgipsz";
        }
        elseif(sizeof($nameArray) == 1)
        {
            $simpleName = $nameArray[0];
        }
        else
        {
            $simpleName = substr($nameArray[1],0,1).$nameArray[0];
        }
        $simpleName = stripAccents(strtolower($simpleName));
        $simpleName = $simpleName."@".$emailEndings[array_rand($emailEndings)];
        return $simpleName;
    }


    $genName = generateName();
    $genEmail = generateEmail($genName);

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
	<h1>Hello <?php echo $genName; ?></h1>
	<p>Your generated email address is <?php echo $genEmail; ?></p>
  </body>
</html>