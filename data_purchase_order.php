<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="shortcut icon" href="img/icon.jpg">

    <style>
        .navbar {
            background-color: #343334;
        }
        .nav-item {
          font-size: 14px;
        }
        body {
            background-image: url(img/wallpaper8.jpg);
            background-size: cover;
            color: white;
        }
    </style>

    <title>Data Purchase Order</title>
  </head>
  <body>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
            <div class="container">
                <img class="ml-3" src="img/truck_logo.png" alt="" href="home.php">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item text-white font-weight-bold">
                        <a class="nav-link" href="home.php">BERANDA <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown text-white font-weight-bold active">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        DATA
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-white font-weight-bold active" href="data_pegawai.php">Data Pegawai Logistik</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="data_purchase_order.php">Data Purchase Order</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="data_pelanggan.php">Data Pelanggan</a>
                        </div>
                    </li>
                    <li class="nav-item text-white font-weight-bold">
                        <a class="nav-link" href="pengiriman_input.php">PENGIRIMAN</a>
                    </li>
                    <li class="nav-item text-white font-weight-bold">
                        <a class="nav-link" href="jadwal_input.php">JADWAL</a>
                    </li>
                    <li class="nav-item dropdown text-white font-weight-bold">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        TRACKING
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item font-weight-bold" href="tracking_input.php">Input Data</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="tracking_update.php">Update Status</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="tracking_select.php">Tracking Details</a>
                        </div>
                    </li>
                    </ul>
                </div>
            </div>
        </nav>

<br><br><br><br>

<?php
$url = "https://salesapi.000webhostapp.com/api/datatransaksi.php";
$json = file_get_contents($url);
$data =  json_decode($json, true);



function jsonToTable ($data)
{
    $table = '<table>';
    foreach ($data as $key => $value) {
        $table .= '
        <tr valign="top">';
        if ( ! is_numeric($key)) {
            $table .= '
            <td><strong>'. $key .':</strong></td>
            <td>';
      $itemdata=false;
        } else {
            $table .= '
            <td colspan="2" bgcolor="#f0f0f0">';
      $itemdata=true;
        }
        if (is_object($value) || is_array($value)) {
            $table .= jsonToTable($value);
        } else {
            $table .= $value;
        }
        $table .= '</td></tr>';
    if ($itemdata){
      $table .='<tr><td bgcolor="#f0f0f0"><hr noshade size="1"></td></tr>';
    }
    }
    $table .= '</table>';
    return $table;
}

function jsonToRowTable ($data){
  foreach ($data as $key => $value){
    if ( ! is_numeric($key)) {
    } else {
      echo '<tr>';
    }
        if (is_object($value) || is_array($value)) {
            echo jsonToRowTable($value);
        } else {
      if ($value!='OK'){
        echo '<td>'.$value.'</td>';
      }
        }
    if (is_numeric($key)) {
      echo '</tr>';
    }
  }
}
?>
  

    <div class="container">
        <h1 class="display-5 font-weight-bold text-center">Data Purchase Order</h1> <br><br>
        <div class="row">
            <table class="table table-bordered  text-center">
                <thead lass="font-weight-bold">
                    <tr>
                    <th scope="col">ID Transaksi</th>
                    <th scope="col">ID Pelanggan</th>
                    <th scope="col">Nama Pelanggan</th>
                    <th scope="col">ID Barang</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php   
                        for($a=1; $a < count($data); $a++)
                        {   

                            echo "<tr>";
                            echo jsonToRowTable($data);
                            echo "</tr>";
                        

                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
