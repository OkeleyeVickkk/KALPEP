<?php
session_start();
$pageTitle = "Login | KALPEP";
require_once "../layouts/auth.header.view.php";
require_once "../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <!-- Reference the index.css file -->
    <link rel="stylesheet" href="../dashboard/assets/css/index.css">
</head>
<body>
<div class="v-page-wrapper" id="v-wrapper" v-cloak>
    <main class="v-main" id="v-page-main">
        <div class="container-xl d-flex align-items-center justify-content-center v-auth-page-wrapper">
            <div class="col-11 col-md-12 col-xl-10 mx-auto v-auth-page-wrapper-inner overflow-hidden">
                <div class="row col-12 v-auth m-0 align-items-stretch h-100">
                    <aside class="col-md-8 col-lg-6 mx-auto p-0 h-100">
                        <div class="v-main-auth">
                            <div class="v-main-auth-inner">
                                <div class="v-wrap col-12 col-sm-9 col-md-11 col-lg-9 mx-auto">
                                    <div class="pt-3">
                                        <h5 class="text-uppercase text-center v-pre-header-title">KARU LGA PRO-employment project 1.0 <br />(KALPEP 1.0)</h5>
                                    </div>
                                    <header class="text-center mt-4 d-flex align-items-start justify-content-center flex-column row-gap-2 mb-4">
                                        <h3>Login</h3>
                                        <span class="v-subtext">Enter your email and password to access your account</span>
                                    </header>
                                    <form @submit.prevent="loginUser" class="v-form">
                                        <div class="v-form-input">
                                            <label for="email" class="v-label">Email</label>
                                            <div class="position-relative">
                                                <input type="email" v-model="loginData.email" class="form-control" id="email" placeholder="Enter your email" required />
                                            </div>
                                        </div>
                                        <div class="v-form-input">
                                            <label for="password" class="v-label">Password</label>
                                            <div class="position-relative">
                                                <input type="password" v-model="loginData.password" class="form-control" id="password" placeholder="Enter your password" required />
                                                <button type="button" class="password-toggle" onclick="togglePasswordVisibility()" aria-label="Toggle password visibility">
                                                    <svg id="password-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mt-2 text-center">
                                            <button type="submit" class="v-button" :disabled="loading">
                                                <span v-if="loading" class="loader"></span>
                                                <span v-else>Login</span>
                                            </button>
                                            <div class="d-flex align-items-center justify-content-end mt-1">
                                                <a href="./forgotpassword.php" class="v-forgot">Forgot password?</a>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="text-center v-bottom pb-3 mt-2">
                                        <span class="v-bottom-text">
                                            Don't have an account?
                                            <b><a href="./register.php">Register here</a></b>
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
                </div>
            </div>
        </div>
    </main>
</div>
<?php require_once "../layouts/auth.footer.view.php"; ?>

<!-- Vue & Axios -->
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    new Vue({
        el: "#v-wrapper",
        data: {
            loginData: {
                email: "",
                password: ""
            },
            loading: false
        },
        methods: {
            loginUser() {
                this.loading = true; // Show loading indicator
                const payload = {
                    email: this.loginData.email,
                    password: this.loginData.password
                };

                console.log("Login payload being sent:", payload);

                axios.post('<?= $base_url;?>/users/login', payload)
                    .then(response => {
                        console.log("Full Response from server:", response.data);

                        if (response.status === 200) {
                            alert(response.data.message || "Login successful!");

                            // Safely access mobilizer_data
                            const mobilizerData = response.data?.mobilizer_data || {};

                            // Retrieve first_name and other data
                            const firstName = response.data?.data?.first_name || 'Guest'; // Default to 'Guest' if null
                            const lastName = response.data?.data?.last_namee || '';
                            const role = response.data?.data?.role || '';
                            const state = response.data?.data?.state || '';

                            console.log("First Name:", firstName); // Debugging log
                            console.log("Last Name:", lastName);   // Debugging log
                            console.log("Role:", role);           // Debugging log
                            console.log("State:", state);         // Debugging log

                            // Store data in localStorage
                            localStorage.setItem('first_name', firstName);
                            localStorage.setItem('last_name', lastName);
                            localStorage.setItem('role', role);
                            localStorage.setItem('state', state);

                            console.log("Data stored in localStorage");

                            // Redirect to dashboard
                            window.location.href = "/KALPEP2/dashboard/index.php";
                        } else {
                            alert(response.data.message || "Login failed. Please check your credentials.");
                        }
                    })
                    .catch(error => {
                        console.error("Error during login:", error);

                        if (error.response) {
                            console.log("Error response data:", error.response.data);
                            alert(`Error: ${error.response.data.message || "An error occurred on the server."}`);
                        } else if (error.request) {
                            console.log("Error request:", error.request);
                            alert("No response from the server. Please check your connection.");
                        } else {
                            console.log("Error message:", error.message);
                            alert("An unexpected error occurred. Please try again.");
                        }
                    })
                    .finally(() => {
                        this.loading = false; // Hide loading indicator
                    });
            }
        }
    });

    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const passwordIcon = document.getElementById('password-icon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
        } else {
            passwordInput.type = 'password';
            passwordIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
        }
    }
</script>
</body>
</html>