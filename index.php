<?php
// Se alla fel under development.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['submit'])){

  $fileHandle = fopen("firelist_" . date("Y-m-d") . ".txt", "c+");
  $noUserInFile = TRUE;

  // Läs hela filen och leta efter rätt studerande.
  while (!feof($fileHandle)) {
    // omvandla sträng till array.
    $row = explode(",", fgets($fileHandle));

    // Jämför namn.
    if ($row[0] == $_POST['studerande']) {
      $row[1] = $_POST['status'];
      $noUserInFile = FALSE;
      $row[] = "KONTROLL";
      $row = implode($row, ",");
      fwrite($fileHandle, $row);
    }
  }

  if ($noUserInFile) {
    $string = $_POST['studerande'] . ", " . $_POST['status'] . PHP_EOL;
    fwrite($fileHandle, $string);
  }

  fclose($fileHandle);

}

?>

<form action="index.php" method="POST">
  <label>Studerande</label>
  <select name = "studerande">
    <option value="Tom">Tom</option>
    <option value="K_A">Kristian A</option>
    <option value="K_J">Kristian J</option>
    <option value="Jonatan">Jonatan</option>
  </select><br />
  <label>Närvaro</label><br />
  Inne <input type="radio" name="status" value = "Inne" />
  Ute <input type="radio" name="status" value = "Ute" /><br />
  <input type="submit" name="submit" value="Registrera närvaro">
</form>
