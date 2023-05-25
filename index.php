<?php 


// connect with the database
include 'lib/init.php';

// import the config file
include 'lib/config.php';

// import the connect file
include 'lib/connect.php';





// include other files

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// if the user did not login in => exit to the index page
if (!isset($_SESSION['SESSION_log'])) {
    if(strpos($_SERVER['PHP_SELF'], '/signup') !== false){
        include 'vendor/autoload.php';
        include 'src/auth/signup.inc.php';
        
        include 'view/dashboard/signup.php';
   
   
    }
    else if(strpos($_SERVER['PHP_SELF'], '/Reset') !== false){
        include 'vendor/autoload.php';
        include 'src/auth/reset.inc.php';
        include 'view/dashboard/reset.php';
   
   
    }
    else if(strpos($_SERVER['PHP_SELF'], '/reset-password') !== false){
        include 'src/auth/reset-password.inc.php';
        include 'view/dashboard/reset-password.php';
   
   
    }
    else if(strpos($_SERVER['PHP_SELF'], '/login') !== false){
        include 'src/auth/login.inc.php';
        include 'view/dashboard/login.php';
        exit();
    }
    
    else if(strpos($_SERVER['PHP_SELF'], '/link') !== false){
        include 'src/auth/link.inc.php';
        include "view/dashboard/link.php";
        exit();
     }
     else if(strpos($_SERVER['PHP_SELF'], '/profileSetup') !== false){
        include "src/profile/profileSetup.inc.php";
        include "view/dashboard/profileSetup.php";
        exit();
     }
     else{
        //include 'src/auth/login.inc.php';
        include 'view/website/main.php';
        exit();
    }

}

else {
    if (strpos($_SERVER['PHP_SELF'], '/coaches') !== false) {
        include "src/coaches/coaches.inc.php";
        include "view/dashboard/header.php";
        include "view/dashboard/side.php";
        include "view/dashboard/coaches.php";
        
        exit();
    
    } 
    else if (strpos($_SERVER['PHP_SELF'], '/coachesInc') !== false) {
        include "src/coaches/coaches.inc.php";
        exit();
    } 
    else if (strpos($_SERVER['PHP_SELF'], '/editCoach') !== false) {
        include "src/coaches/editCoach.inc.php";
        include "view/dashboard/editCoach.php";
        exit();
    }
    else if (strpos($_SERVER['PHP_SELF'], '/editCoachInc') !== false) {
        include "src/coaches/editCoach.inc.php";
        exit();
    }
    else if (strpos($_SERVER['PHP_SELF'], '/offersInc') !== false) {
        include "src/offers/offers.inc.php";
        exit();
    }
    else if(strpos($_SERVER['PHP_SELF'], '/editOffer') !== false){
        include "src/offers/editOffer.inc.php";
        include "view/dashboard/editOffer.php";
        exit();
     }
     
    else if(strpos($_SERVER['PHP_SELF'], '/members') !== false){
       include "lib/mail.php";
       include "src/members/members.inc.php";
       include "src/offers/offers.inc.php";
       include "view/dashboard/header.php";
       include "view/dashboard/side.php";
       include "view/dashboard/members.php";
       exit();
    }
    else if(strpos($_SERVER['PHP_SELF'], '/membersInc') !== false){
        include "lib/mail.php";
        include "src/members/members.inc.php";
        exit();
     }
     
     
     
     
     else if(strpos($_SERVER['PHP_SELF'], '/logout') !== false){
        include "src/logout.php";
        exit();
     }
     else if(strpos($_SERVER['PHP_SELF'], '/homeInc') !== false){
        include 'src/home/home.inc.php';
        exit();
     }
     else if(strpos($_SERVER['PHP_SELF'], '/home') !== false){
        include 'src/home/home.inc.php';
        include  'src/home/statisitic.inc.php';
        include "view/dashboard/header.php";
        include 'view/dashboard/home.php';
        include "view/dashboard/side.php";
        exit();
     }
     else if(strpos($_SERVER['PHP_SELF'], '/editProfile') !== false){
        include 'view/dashboard/editProfile.php';
        exit();
     }
     else if(strpos($_SERVER['PHP_SELF'], '/products') !== false){
        include 'src/product/products.inc.php';
        include "view/dashboard/header.php";
        include "view/dashboard/side.php";
        include 'view/dashboard/products.php';
        exit();
     }
     else if(strpos($_SERVER['PHP_SELF'], '/addProduct') !== false){
        include 'src/product/addproduct.php';
        exit();
     }
     else if(strpos($_SERVER['PHP_SELF'], '/productEdit') !== false){
        include 'src/product/products.inc.php';
        include 'src/product/stocks.php';
        include 'view/dashboard/product_edit.php';
        exit();
     }
     else if(strpos($_SERVER['PHP_SELF'], '/productE') !== false){
        include 'src/product/editproduct.php';
        exit();
     }
     else if(strpos($_SERVER['PHP_SELF'], '/deleteProduct') !== false){
        include 'src/product/deleteproduct.php';
        exit();
     }
     else if(strpos($_SERVER['PHP_SELF'], '/deleteStock') !== false){
        include 'src/product/deleteStock.php';
        exit();
     }
     else if(strpos($_SERVER['PHP_SELF'], '/editStock') !== false){
        include 'src/product/editStock.php';
        exit();
     }
     else if(strpos($_SERVER['PHP_SELF'], '/addStock') !== false){
        include 'src/product/addStock.php';
        exit();
     }
     
     
    
    else {
        include  'src/home/statisitic.inc.php';
        include 'src/home/home.inc.php';
        include "view/dashboard/header.php";
        include "view/dashboard/side.php";
        include 'view/dashboard/home.php';
        exit();
    }
}

?>


