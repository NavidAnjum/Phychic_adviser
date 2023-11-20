<template>
    <div class="register">
        <div class="register__content-logo">
        </div>
        <div class="register__container-log">
            <form class="register__login-form">

                <label for="email" class="login-form__label login-form__label--one">Email
                    <input type="email" id="email" name="email" class="login-form__input">
                </label>

                <label for="password" class="login-form__label login-form__label--two">Password
                    <input type="password" id="password" name="password" class="login-form__input">
                </label>

                <button class="btn btn--login">Login</button>
            </form>

        </div>
        <div class="register__links">
            <p class="links__option links__option--text">Not Logged In? </p>
            <a  class="links__option links__option--create">Register</a>
        </div>
    </div>

</template>

<script>
    export default {
        name: "Login"
    }
</script>

<style scoped>

</style>
