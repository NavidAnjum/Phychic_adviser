<template>
    <div class="register">
        <div class="register__content-logo">
        </div>
        <div class="register__container-log">
            <form class="register__login-form">

                <label for="email" class="login-form__label login-form__label--one">Email
                    <input type="email" v-model="email" id="email" name="email" class="login-form__input">
                </label>

                <label for="password" class="login-form__label login-form__label--two">Password
                    <input type="password" v-model="password" id="password" name="password" class="login-form__input">
                </label>

                <button type="button" class="btn btn--login" v-on:click.self="login">Login</button>
            </form>

        </div>
        <div>
            <p class="links__option links__option--text">Not Logged In? </p>
        </div>
        <div>

        <a  class="links__option links__option--create" @click="register">Register</a>
        </div>
    </div>

</template>

<script>

    export default {

        data: function () {
            return {
                email:'',
                password:'',
            }
        },
        methods: {
            register:function(event){
                this.$router.push('/register');
            },
            login: function (event) {

                let url = '/api/login';

                axios
                    .post(url, {
                        email:this.email,
                        password:this.password,
                    })

                    .then((response)=>{
                        if(response.data.data.role_id==1){
                            //seller
                             this.$router.push('/seller/dashboard');

                        }else if(response.data.data.role_id==2){
                            //user
                             this.$router.push('/dashboard');
                        }else{
                            alert("Something Wrong !")
                        }
                    })
                    .catch(error=> {
                        let error_data=error.response.data
                            alert( error.message)

                    })
            },

        }
    }
</script>

