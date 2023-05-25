
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/static/css/members.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/static/css/notification.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/static/css/side.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/static/css/header.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/static/css/addMember.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/static/css/addOffer.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>members</title>
</head>
<body>
    
    <!-- this is the form for adding offer -->
    <form class="form-add-offer">
        <button id="exit"><i class="bi bi-x-circle"></i></button>
        <div class="title">
            <h1>Add an Offer</h1>
        </div>
        <div class="inputs">
            <div class="input-name">
                <p>Name: 
                    <div class="req"></div>
                </p>
                <input type="text" placeholder="enter the offer's name" required id="add-name" >
            </div>
            <div class="input-contact">
                <div class="input-email">
                    <p>duration: 
                        <div class="req"></div>
                    </p>
                    <input type="number" placeholder="enter the duration by days" required id="add-duration" >
                </div>
                <div class="input-phone">
                    <p>places: 
                        <div class="req"></div>
                    </p>
                    <input type="number" placeholder="enter the number of places" required id="add-places" >
                </div>
                
            </div>
            <div class="input-address">
                <p>sessions: 
                    <div class="req"></div>
                </p>
                <input type="number" placeholder="enter the number of sessions" required id="add-session" >
            </div>
            
            <div class="color-options">
                <p>theme color: </p>
                <div class="color">
                <div class="color-option">
                <input type="radio" id="gold" name="color" value="gold">
                <label for="gold" style="background: linear-gradient(90deg, rgba(255, 177, 82, 0.505) 0%, rgba(255, 251, 121, 0.671) 100%);"></label>
              </div>
              <div class="color-option">
                <input type="radio" id="green" name="color" value="green">
                <label for="green" style="background: linear-gradient(90deg, rgba(67, 255, 189, 0.505) 0%, rgba(156, 255, 230, 0.671) 100%);"></label>
              </div>
              <div class="color-option">
                <input type="radio" id="blue" name="color" value="blue">
                <label for="blue" style="background: linear-gradient(90deg, rgba(87, 205, 255, 0.505) 0%, rgba(171, 235, 255, 0.671) 100%);"></label>
              </div>
              <div class="color-option">
                <input type="radio" id="red" name="color" value="red">
                <label for="red" style="background: linear-gradient(90deg, rgba(255, 87, 87, 0.505) 0%, rgba(255, 171, 171, 0.671) 100%);"></label>
              </div>
              <div class="color-option">
                <input type="radio" id="purple" name="color" value="purple">
                <label for="purple" style="background: linear-gradient(90deg, rgba(154, 87, 255, 0.505) 0%, rgba(216, 171, 255, 0.671) 100%);"></label>
              </div>
                </div>
              

 
            </div>

            <div class="input-price">
                <p>Offer price: 
                </p>
                <input type="number" placeholder="enter the price" id="add-price" >
            </div>
        </div>
        <div class="submit">
            <input type="submit" value="Done" id="done">
        </div>
        
    </form>
    <section class="offers">
        <div class="header">
            <h1 id="offer-title">Offers</h1>
            <button  id="add"> <i class="bi bi-plus"></i></button>
            
        </div>
        <div class="body">
        <?php echo $display_offers; ?>
        </div>
    </section>
        <!-- form add member -->

    <form class="form-add-member">
        <button id="exit-member"><i class="bi bi-x-circle"></i></button>
        <div class="title">
            <h1>Add a Member</h1>
        </div>
        <div class="inputs">
            <div class="input-name">
                <p>Name: 
                    <div class="req"></div>
                </p>
                <input type="text" placeholder="enter the member name" required id="add-name-member" >
            </div>
            <div class="input-contact">
                <div class="input-email">
                    <p>Email: 
                        <div class="req"></div>
                    </p>
                    <input type="email" placeholder="enter member's email" required id="add-email-member" >
                </div>
                <div class="input-phone">
                    
                </div>
                
            </div>
            <div class="input-offer">
                <p>Offer:</p>
            <select>
                <option data-id="none">free</option>
                <?php echo $member_option ?>
            </select>
            </div>
            
            <div class="input-contact input-free">
                <div class="input-email">
                    <p>Session: 
                        <div class="req"></div>
                    </p>
                    <input type="number" placeholder="enter number of sessions" id="add-session-member" >
                </div>
                <div class="input-phone">
                    <p>Price: 
                        <div class="req"></div>
                    </p>
                    <input type="number" placeholder="enter the total price"  id="add-price-member" >
                </div>
                
            </div>
        </div>
        <div class="submit">
            <input type="submit" value="Done" id="done-member">
        </div>
        
    </form>
        <!-- show the member-->

    <section class="members-table">
        <div class="header">
            <h1>Members</h1>
            <div class="search-member">
            <button id="search-icon"><i class="bi bi-search"></i></button>
            <input type="text" placeholder="search by code">
        </div>
            <button  id="add-member"> <i class="bi bi-plus"></i></button>
        </div>
        <table>
            <thead>
                <tr>
                    <th> Code </th>
                    <th> Name </th>
                    <th> email </th>
                    <th> end date </th>
                    <th > offer </th>
                    <th> sessions </th>
                    <th>delete</th>
                </tr>
            </thead>
            <tbody class="show-members">
            <?php echo $display_members;
             $display_members = ''?>
            </tbody>
        </table>
    </section>
    <div class="delete-member" id="delete-m">
            <p>Are you sure you want to delete this member from your gym</p>
            <div class="choose-btn">
            <button id="cancel">cancel</button>
            <input type="submit" name="delete" value="delete" id="delete">
            </div>
            
        </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo BASE_URL?>/js/members.js"></script>
</body>
</html>