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
                                    <header class="text-center px-0 mt-4 mb-4">
                                        <h3>Register</h3>
                                    </header>
                                    <form @submit.prevent="registerUser" class="v-form">
                                        <div v-if="step === 1">
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
                                            <button type="button" @click="nextStep" class="v-button">Next</button>
                                        </div>

                                        <div v-if="step === 2">
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
                                                    <option value="basic">Basic</option>
                                                    <option value="premium">Premium</option>
                                                </select>
                                            </div>
                                            <button type="button" @click="prevStep" class="v-button">Back</button>
                                            <button type="button" @click="nextStep" class="v-button">Next</button>
                                        </div>

                                        <div v-if="step === 3">
                                            <div class="v-form-input">
                                                <label for="password" class="v-label">Password</label>
                                                <input type="password" v-model="userAuth.password" class="form-control" id="password" placeholder="Enter your password" required />
                                            </div>
                                            <div class="v-form-input">
                                                <label for="confirm_password" class="v-label">Confirm Password</label>
                                                <input type="password" v-model="userAuth.confirm_password" class="form-control" id="confirm_password" placeholder="Confirm your password" required />
                                            </div>
                                            <button type="button" @click="prevStep" class="v-button">Back</button>
                                            <button type="button" @click="nextStep" class="v-button">Next</button>
                                        </div>

                                        <div v-if="step === 4">
                                            <div class="v-form-input">
                                                <label for="bvn" class="v-label">BVN</label>
                                                <input type="text" v-model="userAuth.bvn" class="form-control" id="bvn" placeholder="Enter your BVN" required />
                                            </div>
                                            <div class="v-form-input">
                                                <label for="nin" class="v-label">NIN</label>
                                                <input type="text" v-model="userAuth.nin" class="form-control" id="nin" placeholder="Enter your NIN" required />
                                            </div>
                                            <button type="button" @click="prevStep" class="v-button">Back</button>
                                            <button type="submit" class="v-button">Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    new Vue({
        el: "#v-wrapper",
        data: {
            step: 1,
            userAuth: {
                first_name: "",
                last_name: "",
                state: "",
                email: "",
                verify_email: "",
                account_type: "",
                password: "",
                confirm_password: "",
                bvn: "",
                nin: ""
            }
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
                alert("Registration successful!");
            }
        }
    });
</script>

<?php require_once "../layouts/auth.footer.view.php"; ?>
