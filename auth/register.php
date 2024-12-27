<?php
    $pageTitle = "Register | KALPEP";
    require_once "../layouts/auth.header.view.php";
?>
    <div class="v-page-wrapper" id="v-wrapper" v-cloak>
    	<!-- main @::body -->
    	<main class="v-main" id="v-page-main">
    		<div class="container-xl d-flex align-items-center justify-content-center v-auth-page-wrapper">
    			<div class="col-11 col-md-12 col-xl-10 mx-auto v-auth-page-wrapper-inner overflow-hidden">
    				<div class="row col-12 v-auth m-0 align-items-stretch h-100">
    					<aside class="col-md-8 col-lg-6 mx-auto p-0 h-100">
    						<div class="v-main-auth">
    							<div class="v-main-auth-inner pb-5">
    								<div class="v-wrap col-12 col-sm-9 col-md-11 col-lg-9 mx-auto">
    									<div class="pt-4">
    										<h5 class="text-uppercase text-center v-pre-header-title">KARU LGA PRO-employment project 1.0 <br />(KALPEP 1.0)</h5>
    									</div>
    									<header class="text-center px-0 mt-4 d-flex align-items-start justify-content-center flex-column row-gap-2 mb-4">
    										<h3>Register</h3>
    										<span class="v-subtext"></span>
    									</header>
    									<form action="" class="v-form">
    										<!-- <div class="v-form-input">
    											<label for="fullname" class="v-label">Fullname</label>
    											<div class="position-relative">
    												<input type="text" v-model="userAuth.fullname" class="form-control" id="fullname" placeholder="Enter your fullname" />
    											</div>
    										</div> -->
    										<div class="v-form-input">
    											<label for="email" class="v-label">Email</label>
    											<div class="position-relative">
    												<input type="text" v-model="userAuth.email" class="form-control" id="email" placeholder="Enter your email" />
    											</div>
    										</div>
    										<div class="v-form-input">
    											<label for="phone" class="v-label">Phone</label>
    											<div class="position-relative">
    												<input
    													type="text"
    													v-model="userAuth.phone"
    													inputmode="numeric"
    													class="form-control"
    													id="phone"
    													placeholder="Enter your phone number (e.g 0801234...)" />
    											</div>
    										</div>
    										<div class="v-form-input">
    											<label for="password" class="v-label">Password</label>
    											<div class="position-relative">
    												<input
    													type="password"
    													spellcheck="false"
    													autocomplete="off"
    													v-model="userAuth.password"
    													class="form-control"
    													id="password"
    													placeholder="Enter your password" />
    												<button type="button" class="v-show-hide-password">
    													<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
    														<g fill="none" stroke="currentColor" stroke-width="1.5">
    															<path
    																d="M3.275 15.296C2.425 14.192 2 13.639 2 12c0-1.64.425-2.191 1.275-3.296C4.972 6.5 7.818 4 12 4c4.182 0 7.028 2.5 8.725 4.704C21.575 9.81 22 10.361 22 12c0 1.64-.425 2.191-1.275 3.296C19.028 17.5 16.182 20 12 20c-4.182 0-7.028-2.5-8.725-4.704Z" />
    															<path d="M15 12a3 3 0 1 1-6 0a3 3 0 0 1 6 0Z" />
    														</g>
    													</svg>
    												</button>
    											</div>
    										</div>
    										<div class="mt-2 text-center">
    											<button type="submit" @click.prevent="registerUser" class="v-button" :disabled="loading.btn">
    												<span v-if="loading.btn" class="loader"></span>
    												<span v-else>Create account</span>
    											</button>
    										</div>
    									</form>
    									<div class="text-center v-bottom pb-3 mt-2">
    										<span class="v-bottom-text">
    											Already have an account?
    											<b><a href="./login.php">Login here</a></b>
    										</span>
    									</div>
    									<div class="d-flex flex-column row-gap-1 mt-3">
    										<h6 class="text-danger">Powered by:</h6>
    										<div class="d-flex align-items-center justify-content-start gap-4">
    											<div class="v-logo-wrapper pt-0" style="--max-w: 7rem">
    												<img src="../assets/media/logos/enetworks-main-logo.png" alt="" class="img-fluid" />
    											</div>
    											<div class="v-logo-wrapper pt-0" style="--max-w: 5rem">
    												<img src="../assets/media/images/coat-of-arms.jpg" alt="" class="img-fluid" />
    											</div>
    										</div>
    									</div>
    								</div>
    							</div>
    						</div>
    					</aside>
    					<aside class="col-lg-6 h-100 p-0 d-none d-lg-block overflow-hidden" role="presentation">
    						<section class="splide h-100">
    							<div class="splide__track h-100">
    								<div class="splide__list h-100">
    									<li class="splide__slide">
    										<figure class="v-image-container">
    											<img src="../assets/media/images/karu-lga.jpg" alt="" class="img-fluid" />
    										</figure>
    									</li>
    									<li class="splide__slide">
    										<figure class="v-image-container">
    											<img src="../assets/media/images/african-team-working-call.webp" alt="" class="img-fluid" />
    										</figure>
    									</li>
    									<li class="splide__slide">
    										<figure class="v-image-container">
    											<img src="../assets/media/images/team-young-african-people.webp" alt="" class="img-fluid" />
    										</figure>
    									</li>
    									<li class="splide__slide">
    										<figure class="v-image-container">
    											<img src="../assets/media/images/typing.jpg" alt="" class="img-fluid" />
    										</figure>
    									</li>
    								</div>
    							</div>
    						</section>
    					</aside>
    				</div>
    			</div>
    		</div>
    	</main>
    	<!-- main @::end -->
    </div>
<?php require_once "../layouts/auth.footer.view.php";?>