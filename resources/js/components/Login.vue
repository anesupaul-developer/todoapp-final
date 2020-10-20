<template>
    <div class="container" style="color: #112233">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <form v-on:submit.prevent="submitForm">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="email">Email</label>
                                    <input autocomplete="off" name="email" type="email" class="form-control" id="email" placeholder="someone@example.com" v-model="form.email">
                                </div>  

                                <div class="form-group col-md-12">
                                    <label for="password">Password</label>
                                    <input autocomplete="off" name="password" type="password" class="form-control" id="password" placeholder="Password" v-model="form.password">
                                </div>  
                            </div>
                
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary">LOGIN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data: function() {
            return {
                response: {},
                form: {
                    email: '',
                    password: ''
                }
            }
        },
        methods:{
            submitForm(){
                axios.post('/api/auth/login', this.form)
                .then(function (response) {
                    if (response.data.status) {
                       localStorage.setItem("token", JSON.stringify(response.data.message));
                       console.log(response.data.message);
                       window.location = '/todolist';
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        }
    }
</script>
