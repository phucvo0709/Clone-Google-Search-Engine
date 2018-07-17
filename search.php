<?php
include("config.php");
include("classes/SiteResultsProvider.php");
include("classes/ImageResultsProvider.php");
    if(isset($_GET["term"])){
        $term = $_GET["term"];
    }else{
        exit("please letter search > 0");
    }
    $type = isset($_GET["type"]) ? $_GET["type"] : "sites";
    $page = isset($_GET["page"]) ? $_GET["page"] : 1;
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Google</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <div class="headerContent">
                <div class="logoContainer">
                    <a href="index.php">
                        <img src="assets/images/logo.png" alt="Google Title">
                    </a>
                </div>
                <div class="searchContainer">
                    <form action="search.php" method="get">
                        <div class="searchBarContainer">
                            <input type="hidden" name="type" value="<?php echo $type; ?>">
                            <input type="text" class="searchBox" name="term" value="<?php echo $term; ?>">
                            <button class="searchButton"><img src="assets/images/icons/search.png"></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tabsContainer">
                <ul class="tabList">
                    <li class="<?php echo $type == 'sites' ? 'active' : '' ?>">
                        <a href="<?php echo "search.php?term=$term&type=sites"; ?>">
                            All
                        </a>
                    </li>
                    <li class="<?php echo $type == 'images' ? 'active' : '' ?>">
                        <a href="<?php echo "search.php?term=$term&type=images"; ?>">
                            Images
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mainResultsSection">
            <?php
                if($type == "sites"){
                    $resultsProvider = new SiteResultsProvider($con);
                    $pageLimit = 20;
                }else{
                    $resultsProvider = new ImageResultsProvider($con);
                    $pageLimit = 30;
                }

                $numResults = $resultsProvider->getNumResults($term);
                echo "<p class='resultsCount'>About $numResults results</p>";
                echo $resultsProvider->getResultsHtml($page, $pageLimit, $term);
            ?>
        </div>
        <div class="paginationContainer">
            <div class="pageButtons">
                <div class="pageNumberContainer">
                    <img src="assets/images/pageStart.png">
                </div>
                <?php
                $pagesToShow = 10; // số page hiển thị tối đa
                $pageSize = 20; //số bài trên trang
                $numPages = ceil($numResults / $pageSize); // số trang bằng làm tròn số ( số bài viết chia co số bài trên trang )
                $pageLefts = min($pagesToShow, $numPages); //số trang còn lại bằng số nhỏ nhất giữa pha để hiển thị và số trang
                $currentPage = $page - floor( $pagesToShow / 2 ); //trang hiện tại bằng $page get trừ cho làm tròn số xuống ( page hiển thị chia 2 )
                if($currentPage < 1){ //nếu page hiện tai nhỏ hơn 1 thì set page hiện tại bằng 1
                    $currentPage = 1;
                }
                if($currentPage + $pageLefts > $numPages + 1) { // nếu page hiện tại cộng với số trang còn lại nhỏ hơn tổng số trang cộng 1
                    $currentPage = $numPages + 1 - $pageLefts; // thì số trang hiện tại bằng tổng số trang + 1 - số trang còn lại
                }
                while($pageLefts != 0 && $currentPage <= $numPages) { // nếu số trang còn lại ko bằng 0 và số trang hiện tại nhỏ hơn hoặc bằng tổng số trang
                    if($currentPage == $page){
                        echo "<div class='pageNumberContainer'>
                            <img src='assets/images/pageSelected.png'>
                            <span class='pageNumber'>$currentPage</span>
                          </div>";
                    }else{
                        echo "<div class='pageNumberContainer'>
                                  <a href='search.php?term=$term&type=$type&page=$currentPage'>
                                    <img src='assets/images/page.png'>
                                    <span class='pageNumber'>$currentPage</span>
                                  </a>
                              </div>";
                    }
                    $currentPage++;
                    $pageLefts--;
                }

                ?>
                <div class="pageNumberContainer">
                    <img src="assets/images/pageEnd.png">
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>
</body>
</html>