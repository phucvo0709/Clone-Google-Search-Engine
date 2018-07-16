<?php
    if(isset($_GET["term"])){
        $term = $_GET["term"];
    }else{
        exit("please letter search > 0");
    }
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Google</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <div class="headerContent">
                <div class="logoContainer">
                    <a href="index.php">
                        <img src="https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png" alt="Google Title">
                    </a>
                </div>
                <div class="searchContainer">
                    <form action="search.php" method="get">
                        <div class="searchBarContainer">
                            <input type="text" class="searchBox" name="term">
                            <button class="searchButton"><img src="assets/images/icons/search.png"></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tabsContainer">
                <ul class="tabList">
                    <li>
                        <a href="<?php echo "search.php?term=$term&type=sites"; ?>">
                            Sites
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo "search.php?term=$term&type=images"; ?>">
                            Images
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>