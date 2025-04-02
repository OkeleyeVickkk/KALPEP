<?php
$pageTitle = "Register | KALPEP";
require_once "../layouts/auth.header.view.php";
require_once "../config.php";
?>
<div class="v-page-wrapper" id="v-wrapper" v-cloak>
    <main class="v-main" id="v-page-main">
        <div class="container-xl d-flex align-items-center justify-content-center v-auth-page-wrapper">
            <div class="col-11 col-md-12 col-xl-10 mx-auto v-auth-page-wrapper-inner overflow-hidden">
                <div class="row col-12 v-auth m-0 align-items-stretch h-100">
                    <aside class="col-md-8 col-lg-6 mx-auto p-0 h-100">
                        <div class="v-main-auth">
                            <div class="v-main-auth-inner pb-5">
                                <div class="v-wrap col-12 col-sm-9 col-md-11 col-lg-9 mx-auto">
                                    <div class="pt-4">
                                        <h5 class="text-uppercase text-center v-pre-header-title">Muslim Awareness Association Job Creation 1.0 (MAJOC 1.0)</h5>
                                    </div>
                                    <header class="text-center px-0 mt-4 d-flex align-items-start justify-content-center flex-column row-gap-2 mb-4">
                                        <h3>Register</h3>
                                        <span class="v-subtext"></span>
                                    </header>
                                    <form @submit.prevent="registerUser" class="v-form">

                                        <!-- Step 1 -->
                                        <div v-if="step === 1">
                                            <!-- BVN Input -->
                                            <div class="v-form-input">
                                                <label for="bvnno" class="v-label">BVN</label>
                                                <input type="text" v-model="userAuth.bvnno" @input="validateBVN" class="form-control" id="bvnno" placeholder="Enter your BVN" required />
                                            </div>
                                            <!-- Modal for OTP -->
                                            <div id="otpModal" class="modal" v-show="showOtpModal">
                                                <div class="modal-content">
                                                    <span class="close" @click="closeOtpModal">&times;</span>
                                                    <h2>Enter OTP</h2>
                                                    <input type="text" v-model="otp" placeholder="Enter OTP" class="form-control" />
                                                    <button @click="submitOtp" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>

                                            <div class="v-form-input">
                                                <label for="nin" class="v-label">NIN</label>
                                                <input type="text" v-model="userAuth.nin" class="form-control" id="nin" placeholder="Enter your NIN" required />
                                            </div>

                                            <div class="v-form-input">
                                                <label for="phone" class="v-label">PHONE</label>
                                                <input type="text" v-model="userAuth.phone" class="form-control" id="phone" placeholder="Enter your Phone number" required />
                                            </div>
                                            <button type="button" @click="nextStep" class="v-button">Next</button>
                                        </div>

                                        <!-- Step 2 -->
                                        <div v-if="step === 2">
                                            <div class="v-form-input">
                                                <label for="first_name" class="v-label">First Name</label>
                                                <input type="text" v-model="userAuth.first_name" class="form-control" id="first_name" placeholder="Enter your first name" required />
                                            </div>
                                            <div class="v-form-input">
                                                <label for="last_name" class="v-label">Last Name</label>
                                                <input type="text" v-model="userAuth.last_name" class="form-control" id="last_name" placeholder="Enter your last name" required />
                                            </div>
                                            <div class="v-form-input">
                                                <label for="state" class="v-label">State</label>
                                                <input type="text" v-model="userAuth.state" class="form-control" id="state" placeholder="Enter your state" required />
                                            </div>
                                            <button type="button" @click="prevStep" class="v-button">Back</button>
                                            <button type="button" @click="nextStep" class="v-button">Next</button>
                                        </div>

                                        <!-- Step 3 -->
                                        <div v-if="step === 3">
                                            <div class="v-form-input">
                                                <label for="email" class="v-label">Email</label>
                                                <input type="email" v-model="userAuth.email" class="form-control" id="email" placeholder="Enter your email" required />
                                            </div>
                                            <div class="v-form-input">
                                                <label for="verify_email" class="v-label">Verify Email</label>
                                                <input type="email" v-model="userAuth.verify_email" class="form-control" id="verify_email" placeholder="Re-enter your email" required />
                                            </div>
                                            <div class="v-form-input">
                                                <label for="account_type" class="v-label">Account Type</label>
                                                <select v-model="userAuth.account_type" class="form-control" required>
                                                    <option value="">Select Account Type</option>
                                                    <option value="general account">General Account</option>
                                                    <option value="value account">Value Account</option>
                                                    <option value="value plus account">Value Plus Account</option>
                                                    <option value="corporate account">Corporate Account</option>
                                                </select>
                                            </div>
                                            <button type="button" @click="prevStep" class="v-button">Back</button>
                                            <button type="button" @click="nextStep" class="v-button">Next</button>
                                        </div>

                                        <!-- Step 4 -->
                                        <div v-if="step === 4">
                                            <div class="v-form-input">
                                                <label for="password" class="v-label">Password</label>
                                                <input type="password" v-model="userAuth.password" class="form-control" id="password" placeholder="Enter your password" required />
                                            </div>
                                            <div class="v-form-input">
                                                <label for="confirm_password" class="v-label">Confirm Password</label>
                                                <input type="password" v-model="userAuth.confirm_password" class="form-control" id="confirm_password" placeholder="Confirm your password" required />
                                            </div>
                                            <button type="button" @click="prevStep" class="v-button">Back</button>
                                            <button type="submit" @input="registerUser" class="v-button">Register</button>
                                        </div>

                                    </form>
                                    <div class="text-center v-bottom pb-3 mt-2">
                                        <span class="v-bottom-text">
                                            I have an account?
                                            <b><a href="./login.php">login here</a></b>
                                        </span>
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
</div>

<!-- Vue & Axios -->
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    new Vue({
        el: "#v-wrapper",
        data: {
            step: 1,
            userAuth: {
                first_name: "",
                last_name: "",
                phone: "",
                state: "",
                email: "",
                verify_email: "",
                account_type: "",
                password: "",
                confirm_password: "",
                bvnno: "", // Changed from bvn to bvnno
                nin: ""
            },
            showOtpModal: false,
            otp: ""
        },
        methods: {
            nextStep() {
                if (this.step < 4) {
                    this.step++;
                }
            },
            prevStep() {
                if (this.step > 1) {
                    this.step--;
                }
            },
            registerUser() {
                if (this.userAuth.email !== this.userAuth.verify_email) {
                    alert("Emails do not match!");
                    return;
                }
                if (this.userAuth.password !== this.userAuth.confirm_password) {
                    alert("Passwords do not match!");
                    return;
                }

                // Create a new object with only the required fields
                const payload = {
                    first_name: this.userAuth.first_name,
                    last_name: this.userAuth.last_name,
                    phone: this.userAuth.phone,
                    state: this.userAuth.state,
                    email: this.userAuth.email,
                    account_type: this.userAuth.account_type,
                    password: this.userAuth.password,
                    nin: this.userAuth.nin
                };

                console.log("Payload being sent:", payload); // Log the payload to the console

                axios.post('<?= $base_url;?>/users/signUp', payload)
                    .then(response => {
                        console.log("Response from server:", response.data);

                        // Check if the response contains a success flag
                        if (response.status === 201) {
                            alert(response.data.message || "Registration successful!");
                            // Optionally, redirect the user to another page
                            window.location.href = "/KALPEP/auth/login.php";
                        } else {
                            // Handle server-side validation errors or failure messages
                            alert(response.data.message || "Registration failed. Please try again.");
                        }
                    })
                    .catch(error => {
                        console.error("Error during registration:", error);

                        // Handle specific HTTP errors
                        if (error.response) {
                            // Server responded with a status code outside the 2xx range
                            alert(`Error: ${error.response.data.message || "An error occurred on the server."}`);
                        } else if (error.request) {
                            // Request was made but no response was received
                            alert("No response from the server. Please check your connection.");
                        } else {
                            // Something else caused the error
                            alert("An unexpected error occurred. Please try again.");
                        }
                    });
            },
            validateBVN() {
                const bvnno = this.userAuth.bvnno; // Updated reference to bvnno

                if (bvnno.length === 11 && /^\d+$/.test(bvnno)) {
                    const payload = {
                        bvnno: bvnno
                    }; // Create payload object

                    axios.post('<?= $base_url;?>/helper/bvn', payload, {
                            headers: {
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => {
                            if (response.status === "successful") {
                                this.showOtpModal = true;
                            } else {
                                alert(response.data.message || 'BVN validation failed.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An unexpected error occurred. Please try again.');
                        });
                } else {
                    alert('Invalid BVN. It must be 11 digits.');
                }
            },
            closeOtpModal() {
                this.showOtpModal = false;
            },
            submitOtp() {
                if (this.otp) {
                    alert('OTP submitted successfully!');
                    this.showOtpModal = false;
                } else {
                    alert('Please enter the OTP.');
                }
            }
        }
    });
</script>