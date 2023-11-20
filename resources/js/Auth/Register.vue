<template>
    <div class="register">
        <div class="register__container-log">
            <form class="register__login-form">
                <label for="name" class="login-form__label login-form__label--one">Name
                    <input type="text" id="name" name="name" class="login-form__input">
                </label>

                <label for="user_name" class="login-form__label login-form__label--one">User Name
                    <input type="text" id="user_name" name="user_name" class="login-form__input">
                </label>

                <label for="email" class="login-form__label login-form__label--one">Email
                    <input type="email" id="email" name="email" class="login-form__input">
                </label>

                <label for="password" class="login-form__label login-form__label--two">Password
                    <input type="password" id="password" name="password" class="login-form__input">
                </label>

                <label for="role_id" class="login-form__label login-form__label--one">Are you a Seller or Buyer
                    <select id="role_id" name="role_id" class="login-form__input">
                        <option value="seller">Buyer</option>
                        <option value="seller">Seller</option>

                    </select>
                </label>


                <button class="btn btn--login">Sign Up</button>
            </form>

        </div>
        <div class="register__links" >
            <p class="links__option links__option--text">Already Logged In? </p>
            <a class="links__option links__option--create">Login</a>
        </div>
    </div>
</template>

<script>

    export default {

        data: function () {
            return {
                name:'',
                user_name:'',
                email:'',
                password:'',
                password_check:'',
                role_id:'',
            }
        },
        methods: {
            register: function (event) {

                let url = '/api/register';

                    axios
                        .post(url, {
                            email:this.email,
                            password:this.password,
                            first_name:this.first_name,
                            last_name:this.last_name,
                        })

                        .then((response)=>{
                            this.$note.noFurtherAction(
                                "Please confirm your mailbox to complete the registration.",
                                ()=>{
                                    this.routerTo(this.$apppath.login);
                                }
                            ).show();
                        })
                        .catch(error=> {
                            let error_data=error.response.data
                            if (typeof error_data.errors.email !== 'undefined'
                                && error_data.errors.email[0] === "validation.unique") {
                                this.$note("Already signed up using this email!")

                            } else if (typeof error_data.errors.password !== 'undefined' && error_data.errors.password[0] === "validation.min.string") {
                                this.$note.error("Password cannot be less than 8 characters!")

                            } else {
                                this.$note.error("Something went wrong:" + error.message)

                            }
                        })
                }



        }
    }
</script>
