<?error_reporting(E_ALL & ~E_NOTICE);?>
<!DOCTYPE html>
<html>
    <head>
        <title>Uhm...</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <!-- DARK THEME STYLE SHEET -->
        <link rel="stylesheet" type="text/css" href="style_dark.css" />
    </head>
    <body>
       <div class="main">
            <h1>Willkommen, Namenloser!</h1><br />
            <p>Bitte erzähle uns doch, wie du heißt!</p>
            <?php echo $test ?>
                <form action="index.php" method="post">Mein Name lautet: <?php echo $fullname ?><br />
                <input class="txt" type="text" name="name" ><br />
                <input class="txt" type="text" name="website" placeholder="http://meinewebsite.com/"><br />
                <textarea class="txt" cols="80" rows="5" name="msg"></textarea><br />
                <input class="btn" name="submit" type="submit">
            </form>
            <div class="tasks">
                <div class="note"><strong>Aufgabe #1:</strong><br /> <p>Text im Feld soll nach dem Submit neben dem "Dein Name lautet" und statt "Namenloser" auftauchen!</p></div>
               
                <div class="note"><strong>Aufgabe #2:</strong><br /> <p>Der eingegebene Name soll in eine neue Datenbank gespeichert werden, und auch daraus ausgegeben werden!</p></div>
            
                <div class="note"><strong>Aufgabe #3:</strong><br /> <p>Anständige Automatisierung der Reihenfolge dieser Aufgaben!</p></div>
            
                <div class="note"><strong>Aufgabe #2:</strong><br /> <p>Input Field um einfach neue Aufgaben hinzuzufügen, bearbeiten, löschen...!</p></div>
            </div>
        </div>
    </body>
</html>
<?php

if(!isset($_POST['submit'])) {
    echo "oh nein!";
	return;
} else {
    // MYSQL Connect
	$con = mysqli_connect("localhost","root","root","guests");
	if(mysqli_connect_errno() ) {
	    // FEHLER
        echo 'Failed connecting to DB: ', mysqli_connect_errno();
        return;
    }
	$name   = $_POST["name"];
	//$name2  = $_POST["name2"];
	$website= $_POST["website"];
	$msg    = $_POST["msg"];

	$test   = "YYYdsa";
	$fullname = $name . " " . $name2;
	// $nameError = 0;
	$websiteError = 0;
	$msgError   = 0;
	$noError    = 0;

	$errStack = array();

	// Validating
   /* if($name =="")
        $errStac['']
*/

}

$name   = $_POST["name"];
$name2  = $_POST["name2"];
$website= $_POST["website"];
$msg    = $_POST["msg"];

$fullname   = $name . " " . $name2;
$nameError  = 0;
$websiteError = 0;

$msgError   = 0;
$test       = "YYYdsa";
$noError    = 0;
//$websiteText = "";

if ($name == "") {
    $test = "<p>Wir würden gerne deinen Namen erfahren!</p>";
    $nameError = 1;
}
           
if ($website == "") {
    $websiteError = 1;
}
           
if ($msg == "") {
    $msgError = 1;
}

if ($nameError == 0) {
    echo "Dein Name lautet nun: " . $fullname . "<br />";
    $noError++;
} else {
    echo "Wir würden gerne deinen Namen erfahren!<br />";
}
           
if ($websiteError == 0) {
    echo "Deine Website ist: " . $website . "<br />";
} else {
    echo $websiteText, '<br>' ;
}
           
if ($msgError == 0) {
    echo "Deine Nachricht an uns: " . $msg . "<br />";
    $noError++;
} else {
    echo "Bitte eine Nachricht eingeben!<br />";
}
   
$insert = "INSERT INTO entries (name,website,text) VALUES ('".$name."','".$website."', '".$msg."')";
           
if ($noError > 1) {
    if ($con->query($insert) === TRUE) {
        echo "Datenbank Eintrag erstellt!<br/>";
    } else {
        echo "Error: " . $insert . "<br>" . $con->error;
    }
} else {
    echo "Die erforderlichen Felder wurden nicht ausgefüllt!<br/>";
}
           
$select = "SELECT id,name,website,text FROM entries";
$result = $con->query($select);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<br/>id: " . $row["id"]. "<br/>Name: " . $row["name"]. "<br/>Website: "  . $row["website"].
        "<br/>Nachricht: "  . $row["text"]. "<br/>Zeit: "  . $row["date"]. "<br>";
    }
} else {
    echo "<br/>0 results";
}

mysqli_close($con);
?>