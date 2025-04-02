<?php require_once "layouts/header.view.php";
require_once "../config.php";
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="v-body-wrapper" id="v-wrapper">

  <!-- header @::start -->
  <?php require_once "layouts/nav.view.php" ?>
  <!-- header @::end -->
  <section id="v-main">
    <?php require_once "layouts/sidebar.view.php" ?>
    <main class="v-main-content">
      <div class="v-main-content-inner col-lg-11 col-xl-11 mx-auto">
        <div class="p-0">
          <header class="v-page-title">
            <h3 class="v-title">Welcome <b class="user_first_name"></b></h3>
            <span class="v-subtext">
             <b> Records<span class="v-day ms-1" data-daytime="day">View</span></b>
              <span class="d-flex align-items-center justify-content-center">
                <img src="" data-icon="day" alt="" class="img-fluid ms-1" />
              </span>
            </span>
          </header>
        </div>
        <div class="card-container d-flex justify-content-between flex-wrap gap-3 mt-4">
          <!-- Card for Total Records -->
          <div class="card text-center border-0 shadow-sm" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Total Records</h5>
              <p class="card-text display-4">1,234</p>
            </div>
          </div>

          <!-- Card for Total Users -->
          <div class="card text-center border-0 shadow-sm" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Total Users</h5>
              <p class="card-text display-4">567</p>
            </div>
          </div>

          <!-- Card for Total Commissions -->
          <div class="card text-center border-0 shadow-sm" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Total Commissions</h5>
              <p class="card-text display-4">$12,345</p>
            </div>
          </div>
        </div>

        <!-- referral link -->
        <div class="text-center mt-4">
          <h4>Referral Link:</h4>
          <div class="d-inline-flex align-items-center">
            <input type="text" id="referralLink" class="form-control text-center" value="https://example.com/referral?code=12345" readonly style="width: 300px;">
            <button class="btn btn-primary ms-2" onclick="copyReferralLink()">Copy</button>
          </div>
        </div>
        <!-- graph section -->
        <div class="mt-5">
          <h4 class="text-center">Referral Reports</h4>
          <canvas id="referralChart" width="400" height="200"></canvas>
        </div>



      </div>
    </main>
  </section>
</div>
<?php require_once "layouts/footer.view.php" ?>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const ctx = document.getElementById('referralChart').getContext('2d');

    // Example data for the line graph
    const data = {
      labels: ['January', 'February', 'March', 'April', 'May', 'June'], // X-axis labels
      datasets: [{
        label: 'Referrals',
        data: [12, 19, 3, 5, 2, 3], // Y-axis data points
        borderColor: 'rgba(54, 162, 235, 1)', // Line color
        backgroundColor: 'rgba(54, 162, 235, 0.2)', // Fill color under the line
        borderWidth: 2, // Line thickness
        tension: 0.4, // Smoothness of the line (0 for straight lines)
        fill: true // Fill the area under the line
      }]
    };

    // Chart configuration for a line graph
    const config = {
      type: 'line', // Change to 'line' for a line graph
      data: data,
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: true,
            position: 'top' // Position of the legend
          }
        },
        scales: {
          x: {
            title: {
              display: true,
              text: 'Months' // X-axis title
            }
          },
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Number of Referrals' // Y-axis title
            }
          }
        }
      }
    };

    // Render the line graph
    new Chart(ctx, config);
  });

  function copyReferralLink() {
    const referralInput = document.getElementById('referralLink');
    referralInput.select();
    referralInput.setSelectionRange(0, 99999); // For mobile devices
    navigator.clipboard.writeText(referralInput.value).then(() => {
      alert('Referral link copied to clipboard!');
    }).catch(err => {
      console.error('Failed to copy referral link: ', err);
    });
  }
</script>