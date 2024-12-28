<?php require_once "layouts/header.view.php" ?>
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
							Good <span class="v-day ms-1" data-daytime="day">morning, be great today</span>
							<span class="d-flex align-items-center justify-content-center">
								<img src="" data-icon="day" alt="" class="img-fluid ms-1" />
							</span>
						</span>
					</header>
				</div>
				<div class="v-main-content-inner col-12 row mt-3 m-0 justify-content-between mx-auto position-relative">
					<div class="v-page-wrapper p-0">
						<table class="table table-responsive">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">First</th>
									<th scope="col">Last</th>
									<th scope="col">Handle</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th scope="row">1</th>
									<td>Mark</td>
									<td>Otto</td>
									<td>@mdo</td>
								</tr>
								<tr>
									<th scope="row">2</th>
									<td>Jacob</td>
									<td>Thornton</td>
									<td>@fat</td>
								</tr>
								<tr>
									<th scope="row">3</th>
									<td colspan="2">Larry the Bird</td>
									<td>@twitter</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</main>
	</section>
</div>
<?php require_once "layouts/footer.view.php" ?>