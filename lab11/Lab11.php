<?php
//Fill this place

//****** Hint ******
//connect database and fetch data here

$servername = "localhost:3306";
$username = "root";
$password = "090029";
$dbName = "travel";

$conn = new mysqli($servername, $username, $password, $dbName);
if ($conn->connect_error)
    echo("<script>alert('" . "连接失败: " . $conn->connect_error . "');</script>");
$queryImage = "select * from ImageDetails";
function findByCountry($country, $queryImage){
    if(!strstr($queryImage, 'where')){
        return $queryImage . " where CountryCodeISO = '$country' ";
    }else{
        return $queryImage . " && CountryCodeISO = '$country' ";
    }
}
function findByContinent($continent, $queryImage){
    if(!strstr($queryImage, 'where')){
        return $queryImage . " where ContinentCode = '$continent' ";
    }else{
        return $queryImage . " && ContinentCode = '$continent' ";
    }
}
function findByTitle($title, $queryImage){
    if(!strstr($queryImage, 'where')){
        return $queryImage . " where Title = '$title' ";
    }else{
        return $queryImage . " && Title = '$title' ";
    }
}
if(isset($_GET['continent']) && $_GET['continent'] != '0'){
    $ContinentCode = $_GET['continent'];
    $queryImage = findByContinent($ContinentCode, $queryImage);
}
if(isset($_GET['country']) && $_GET['country'] != '0') {
    $CountryCodeISO = $_GET['country'];
    $queryImage = findByCountry($CountryCodeISO, $queryImage);
}
if(isset($_GET['title']) && !$_GET['title'] == ''){
    $Title = $_GET['title'];
    $queryImage = findByTitle($Title, $queryImage);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Chapter 14</title>

      <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>-->

    <link rel="stylesheet" href="css/bootstrap.min.css" />

    <link rel="stylesheet" href="css/captions.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" />    

</head>

<body>
    <?php include 'header.inc.php'; ?>
    


    <!-- Page Content -->
    <main class="container">
        <div class="panel panel-default">
          <div class="panel-heading">Filters</div>
          <div class="panel-body">
            <form action="Lab10.php" method="get" class="form-horizontal">
              <div class="form-inline">
              <select name="continent" class="form-control">
                <option value="0">Select Continent</option>
                <?php
                //Fill this place

                //****** Hint ******
                //display the list of continents
                $query = "select * from continents";
                $result = $conn->query($query);
                if(!$result)
                    echo mysqli_error($conn);
                while($row = $result->fetch_assoc()) {
                  echo '<option value=' . $row['ContinentCode'] . '>' . $row['ContinentName'] . '</option>';
                }

                ?>
              </select>     
              
              <select name="country" class="form-control">
                <option value="0">Select Country</option>
                <?php 
                //Fill this place
                $query = "select * from countries";
                $result = $conn->query($query);
                if(!$result)
                    echo mysqli_error($conn);
                while($row = $result->fetch_assoc()) {
                    echo '<option value=' . $row['ISO'] . '>' . $row['CountryName'] . '</option>';
                }

                //****** Hint ******
                /* display list of countries */ 
                ?>
              </select>    
              <input type="text"  placeholder="Search title" class="form-control" name=title>
              <button type="submit" class="btn btn-primary">Filter</button>
              </div>
            </form>

          </div>
        </div>     
                                    

		<ul class="caption-style-2">
            <?php
            
            $result = $conn->query($queryImage);
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['ImageID'];
                $path = $row['Path'];
                $title = $row['Title'];
                $description = $row['Description'];
                echo "<li>
              <a href=\"detail.php?id=$id\" class=\"img-responsive\">
                <img src=\"images/square-medium/$path\" alt=\"$title\">
                <div class=\"caption\">
                  <div class=\"blur\"></div>
                  <div class=\"caption-text\">
                    <p>$title</p>
                  </div>
                </div>
              </a>
            </li>";
            }
            //Fill this place

            //****** Hint ******
            /* use while loop to display images that meet requirements ... sample below ... replace ???? with field data
            <li>
              <a href="detail.php?id=????" class="img-responsive">
                <img src="images/square-medium/????" alt="????">
                <div class="caption">
                  <div class="blur"></div>
                  <div class="caption-text">
                    <p>????</p>
                  </div>
                </div>
              </a>
            </li>        
            */ 
            ?>
       </ul>       

      
    </main>
    
    <footer>
        <div class="container-fluid">
                    <div class="row final">
                <p>Copyright &copy; 2017 Creative Commons ShareAlike</p>
                <p><a href="#">Home</a> / <a href="#">About</a> / <a href="#">Contact</a> / <a href="#">Browse</a></p>
            </div>            
        </div>
        

    </footer>


        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>