<?php require_once "layouts/header.view.php";
require_once "../config.php";
?>
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
            <h3 class="v-title">Welcome back!</h3>
            <span class="v-subtext">
              <b>Users<span class="v-day ms-1" data-daytime="day">View</span></b
              <span class="d-flex align-items-center justify-content-center">
                <img src="" data-icon="day" alt="" class="img-fluid ms-1" />
              </span>
            </span>
          </header>
        </div>
        <div class="v-main-content-inner col-12 row mt-3 m-0 justify-content-between mx-auto position-relative">
          <div class="v-page-wrapper p-0">
            <div class="bg-white border rounded-3">
              <header class="d-flex align-items-center p-3">
                <div class="v-form-input has-pad-left">
                  <span class="v-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24">
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21l-4.343-4.343m0 0A8 8 0 1 0 5.343 5.343a8 8 0 0 0 11.314 11.314" />
                    </svg>
                  </span>
                  <input type="search" name="" id="" placeholder="Enter your search" class="form-control">
                </div>
              </header>
              <div class="border-top">
                <table class="table table-responsive m-0">
                  <thead>
                    <tr>
                      <th scope="col" class="text-center">#</th>
                      <th scope="col">First</th>
                      <th scope="col">Last</th>
                      <th scope="col">Handle</th>
                      <th scope="col" class="text-end">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row" class="text-center">1</th>
                      <td>Mark</td>
                      <td>Otto</td>
                      <td>@mdo</td>
                      <td class="text-end">@mdo</td>
                    </tr>
                    <tr>
                      <th scope="row" class="text-center">2</th>
                      <td>Jacob</td>
                      <td>Thornton</td>
                      <td>@fat</td>
                      <td class="text-end">@fat</td>
                    </tr>
                    <tr>
                      <th scope="row" class="text-center">3</th>
                      <td>Larry the Bird</td>
                      <td>Larry the Bird</td>
                      <td>@twitter</td>
                      <td class="text-end">
                        <div class="dropdown d-flex align-items-center justify-content-end">
                          <button class="d-flex align-items-center justify-content-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="v-icon">
                              <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 20 20">
                                <path fill="currentColor" d="M9 15.25a1.25 1.25 0 1 1 2.5 0a1.25 1.25 0 0 1-2.5 0m0-5a1.25 1.25 0 1 1 2.5 0a1.25 1.25 0 0 1-2.5 0m0-5a1.249 1.249 0 1 1 2.5 0a1.25 1.25 0 1 1-2.5 0" />
                              </svg>
                            </span>
                          </button>
                          <ul class="dropdown-menu px-2">
                            <li class="v-dropdown-item">
                              <button type="button" class="v-dropdown-action" data-bs-toggle="modal" data-bs-target="#updateModal">Test</button>
                            </li>
                          </ul>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="d-flex align-items-center justify-content-end px-3">
                <nav aria-label="Page navigation example" class="v-pagination">
                  <ul class="pagination">
                    <li class="page-item"><button type="button" class="page-link" href="#">Previous</button></li>
                    <li class="page-item"><button type="button" class="page-link" href="#">1</button></li>
                    <li class="page-item"><button type="button" class="page-link" href="#">2</button></li>
                    <li class="page-item"><button type="button" class="page-link" href="#">3</button></li>
                    <li class="page-item"><button type="button" class="page-link" href="#">Next</button></li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </section>
</div>
<?php require_once "layouts/footer.view.php" ?>