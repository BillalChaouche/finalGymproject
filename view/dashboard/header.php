
<section class="above">
        <div class="search">
            <button id="search-icon"><i class="bi bi-search"></i></button>
            <input type="text" placeholder="search">
        </div>
        <button id="notification"><i class="bi bi-bell"></i></button>
        <button id="settings" onclick="window.location.href='<?php echo BASE_URL ?>/editProfile?id=<?php echo $_SESSION['SESSION_ID'];?>'"><i class="bi bi-gear"></i></button>
    </section>