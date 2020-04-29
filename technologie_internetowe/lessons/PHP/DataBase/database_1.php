<?php
require_once './connect.php';
require_once 'Functions/scripts.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title>DataBase</title>
</head>
<body>
<h3 class="display-4">Table user</h3>
<form action="Functions/add.php">
    <div class="form-group">
        <div class="row p-1 m-1">
            <input type="text" class="form form-control m-1" name="name" placeholder="Imie"/>
            <input type="text" class="form form-control m-1" name="surname" placeholder="Nazwisko"/>
            <input type="date" class="form form-control m-1" name="birthday" placeholder="Data urodzenia"/>
            <select class="browser-default custom-select m-1" name="city">
                <option selected>Wybierz miasto</option>
                <?php
                $sql = "SELECT * FROM city";
                if ($result = mysqli_query($conn, $sql)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo <<<LIST
                            <option value="$row[id]">$row[city]</option>
LIST;
                    }
                }
                ?>
            </select>
            <input type="submit" class="btn btn-outline-primary m-1" value="Dodaj zapis"/>
        </div>
    </div>
</form>
<table class="table table-striped table-hover p-1 m-2">
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Imie</th>
        <th scope="col">Nazwisko</th>
        <th scope="col">Data urodzenia</th>
        <th scope="col">Miasto</th>
        <th scope="col">Controls</th>
    </tr>
    <?php

    $sql = "SELECT u.id, u.name, u.surname, u.birthday, c.city FROM user u inner join city c on u.cityId = c.id";
    if ($result = mysqli_query($conn, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $year = getYear($row['birthday']);
            echo <<< TABLE
            <tr>
                <td>$row[id]</td>
                <td>$row[name]</td>
                <td>$row[surname]</td>
                <td>$row[birthday]</td>
                <td>$row[city]</td>
                <td><a href="delete.php?id=$row[id]">Delete</a></td>
            </tr>
TABLE;
        }
    }
    ?>
</table>
</body>
</html>
