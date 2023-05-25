<?php
function getStatistics($conn,$value,$id_owner) {
  $statistics = array();

  // Get new members count
  $new_members_query = "SELECT COUNT(*) FROM members WHERE id_owner=$id_owner && registration_date >= DATE_SUB(NOW(), INTERVAL '".$value."' DAY)";
  $new_members_result = mysqli_query($conn, $new_members_query);
  $new_members_count = mysqli_fetch_array($new_members_result)[0];
  $statistics['new members'] = $new_members_count;

  // Get new coaches count
  $new_coaches_query = "SELECT COUNT(*) FROM coach join gym_to_coach using(id_coach) WHERE id_owner=$id_owner && registration_date >= DATE_SUB(NOW(), INTERVAL '".$value."' DAY)";
  $new_coaches_result = mysqli_query($conn, $new_coaches_query);
  $new_coaches_count = mysqli_fetch_array($new_coaches_result)[0];
  $statistics['new coaches'] = $new_coaches_count;

  // Get total funds
  $total_funds_query = "SELECT SUM(price) FROM member_to_free join members using(identity_mem) where id_owner=$id_owner";
  $total_funds_result = mysqli_query($conn, $total_funds_query);
  $total_funds_free = mysqli_fetch_array($total_funds_result)[0];

  $price_of_offers_query = "SELECT SUM(price_off) FROM member_to_offers JOIN offers USING(id_off) JOIN members USING(identity_mem) WHERE members.id_owner=$id_owner";
  $price_of_offers_result = mysqli_query($conn, $price_of_offers_query);
  $price_of_offers = mysqli_fetch_array($price_of_offers_result)[0];

  $total_funds = $total_funds_free + $price_of_offers;
  $statistics['total funds'] = $total_funds;

  // Get best offer
  $best_offer_query = "SELECT name_off FROM offers WHERE id_off IN (SELECT id_off FROM member_to_offers) GROUP BY name_off ORDER BY COUNT(*) DESC LIMIT 1";
  $best_offer_result = mysqli_query($conn, $best_offer_query);
  $best_offer_name = mysqli_fetch_array($best_offer_result)[0];
  $statistics['best offers'] = $best_offer_name;

  return $statistics;
}
//the printing function for statistics 
function printStatistics($statistics) {
    
  foreach ($statistics as $key => $value) {
    echo '<div id="statistics1" class="' . $key . '">';
    echo '<h3>' .$key. '</h3>';
    if($value > 0){
    echo '<p style="color: rgb(140, 244, 140);">+' . $value . '</p>';
    }
    else if($key == 'best offers'){
      if($value){
        echo '<p style="color: rgb(140, 244, 140);">' . $value . '</p>';
      }
      else{
      echo '<p>-</p>';
      }
    }
    else{
      echo '<p style="color:balck;">0</p>';
    }
    echo '</div>';
  }

}


?>