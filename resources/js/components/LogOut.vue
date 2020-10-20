<template>
    <div class="container">
        <p>You have been logged out</p>
    </div>
</template>

<script>
    export default {
        mounted() {
            axios.defaults.headers.common.Authorization = `Bearer ${localStorage.getItem("token")}`;
            axios.post('/api/auth/logout', this.form)
            .then(function (response) {
                window.location = '/auth/login'
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    }
</script>
