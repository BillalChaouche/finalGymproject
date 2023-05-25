<?php 
include dirname(__DIR__).'/lib/config.php';
?>
<side class="side">
        <img src="<?php echo BASE_URL?>/static/images/logo.png" alt="logo">
        <ul class="nav">
            <li><a href="<?php echo BASE_URL?>" class="home-link"><i class="bi bi-app"></i>
                                     <p class="home">Home</p></a></li>
            <li><a href="<?php echo BASE_URL?>/members" class="members-link"><i class="bi bi-people"></i>
                                     <p class="members">Members</p></a></li>
            <li><a  href="<?php echo BASE_URL?>/coaches" class="coaches-link"><i class="bi bi-person"></i>
                                     <p class="coaches">Coaches</p></a></li>
            <li><a href="<?php echo BASE_URL?>/products" class="products-link"><i class="bi bi-database"></i>
                                     <p class="products">Products</p></a></li>
        </ul>
        <a id="logout" href="<?php echo BASE_URL?>/logout"><i class="bi bi-box-arrow-left"></i></a>
    </side>