<?php
session_start();
// Define the avatar image path
$avatarPath = "../../assets/images/avatar.png";
?>
<header id="v-header-container">
  <nav class="v-header-inner d-flex align-items-center justify-content-between">
    <a href="./index.php">
      <div class="v-logo">
        <!-- <img src="./assets/media/images/CardifyLogo.png" title="Cardify Logo" alt="" class="img-fluid" /> -->
        <h3>MAJOC1.0</h3>
      </div>
    </a>
    <div class="v-right-nav">
      <div class="position-relative">
        <button type="button" class="v-toggle-noti" data-target="v-noti-dropdown">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
              <path d="M19.4 14.9C20.2 16.4 21 17 21 17H3s3-2 3-9c0-3.3 2.7-6 6-6c.7 0 1.3.1 1.9.3M10.3 21a1.94 1.94 0 0 0 3.4 0" />
              <circle cx="18" cy="8" r="4" stroke="#12a632" fill="#12a632" />
            </g>
          </svg>
        </button>
        <div class="v-noti-dropdown v-dropdown" data-v-expanded="false" data-receiver="v-noti-dropdown">
          <header class="v-noti-header">
            <div class="v-top">
              <h6 class="v-title">Notifications</h6>
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                  <path d="M19.4 14.9C20.2 16.4 21 17 21 17H3s3-2 3-9c0-3.3 2.7-6 6-6c.7 0 1.3.1 1.9.3M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                  <circle cx="18" cy="8" r="3" />
                </g>
              </svg>
            </div>
            <div class="v-bottom">
              <button type="button" class="v-noti-toggler active" data-target="all">
                <span class="v-text">All</span>
                <div class="v-num-of-noti">3</div>
              </button>
              <button type="button" class="v-noti-toggler" data-target="security">
                <span class="v-text">Security</span>
                <div class="v-num-of-noti">1</div>
              </button>
              <button type="button" class="v-noti-toggler" data-target="activities">
                <span class="v-text">My activities</span>
                <div class="v-num-of-noti">0</div>
              </button>
            </div>
          </header>
          <div class="v-dropdown-body">
            <div class="v-notifs-container active" data-receiver="all">
              <!-- each noti @::start -->
              <div class="v-each-noti">
                <span class="v-main-noti"> You just logged in into your account. </span>
                <span class="v-datetime">20 Jan, 2023. 13:45</span>
              </div>
              <!-- each noti @::end -->
              <!-- each noti @::start -->
              <div class="v-each-noti">
                <span class="v-main-noti"> You just logged in into your account. </span>
                <span class="v-datetime">20 Jan, 2023. 13:45</span>
              </div>
              <!-- each noti @::end -->
              <!-- each noti @::start -->
              <div class="v-each-noti">
                <span class="v-main-noti"> We noticed you just logged in. If this was not you, kindly chat with our support team. </span>
                <span class="v-datetime">20 Jan, 2023. 18:45</span>
              </div>
              <!-- each noti @::end -->
              <!-- each noti @::start -->
              <div class="v-each-noti">
                <span class="v-main-noti"> We noticed you just logged in. If this was not you, kindly chat with our support team. </span>
                <span class="v-datetime">20 Jan, 2023. 18:45</span>
              </div>
              <!-- each noti @::end -->
            </div>
            <div class="v-notifs-container" data-receiver="security">
              <!-- each noti @::start -->
              <div class="v-each-noti">
                <span class="v-main-noti"> You just logged in into your account. </span>
                <span class="v-datetime">20 Jan, 2023. 13:45</span>
              </div>
              <!-- each noti @::end -->
              <!-- each noti @::start -->
              <div class="v-each-noti">
                <span class="v-main-noti"> You just logged in into your account. </span>
                <span class="v-datetime">20 Jan, 2023. 13:45</span>
              </div>
              <!-- each noti @::end -->
              <!-- each noti @::start -->
              <div class="v-each-noti">
                <span class="v-main-noti"> We noticed you just logged in. If this was not you, kindly chat with our support team. </span>
                <span class="v-datetime">20 Jan, 2023. 18:45</span>
              </div>
              <!-- each noti @::end -->
              <!-- each noti @::start -->
              <div class="v-each-noti">
                <span class="v-main-noti"> We noticed you just logged in. If this was not you, kindly chat with our support team. </span>
                <span class="v-datetime">20 Jan, 2023. 18:45</span>
              </div>
              <!-- each noti @::end -->
            </div>
            <div class="v-notifs-container" data-receiver="activities">
              <!-- each noti @::start -->
              <div class="v-each-noti">
                <span class="v-main-noti"> You bought 14$ Bitcoin </span>
                <span class="v-datetime">20 Jan, 2023. 13:45</span>
              </div>
              <!-- each noti @::end -->
              <!-- each noti @::start -->
              <div class="v-each-noti">
                <span class="v-main-noti"> You bought $30 USDT</span>
                <span class="v-datetime">20 Jan, 2023. 13:45</span>
              </div>
              <!-- each noti @::end -->
            </div>
          </div>
          <div  class="v-dropdown-footer">
            <div style="background-color:#003399;" class="d-flex align-items-center justify-content-center">
              <a href="./notification.html" class="v-see-all-noti"> View all notifications </a>
            </div>
          </div>
        </div>
      </div>
      <!-- profile name noti @::start -->
      <div class="v-right-nav-detail d-none d-sm-flex">
        <span class="v-user-name user_first_name">Loading...</span>
      </div>
    <!-- profile name noti @::end -->

      <div id="v-backdrop"></div>
    </div>
  </nav>
</header>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    // Retrieve first_name and role from localStorage
    const first_name = localStorage.getItem('first_name') || "Guest";
    const role = localStorage.getItem('role') || "Guest";




    // Update the DOM with the first_name
    const userFirstNames = document.querySelectorAll('.user_first_name');
    userFirstNames.forEach((element) => {
      element.textContent = first_name.toUpperCase();
    });

    // Update the DOM with the user role
    const userRoles = document.querySelectorAll('.user_role');
    userRoles.forEach((element) => {
      element.textContent = role.toUpperCase();
    });
  });
</script>