<template>
    <div class="container" style="color: #112233">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registration</div>

                    <div class="card-body">
                        <form v-on:submit.prevent="submitForm">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="name">Name</label>
                                    <input autocomplete="off" name="name" type="text" class="form-control" id="name" placeholder="Joe Doe" v-model="form.name">
                                </div>

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
                                <button type="submit" class="form-control btn btn-primary">REGISTER</button>
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
        data(){
            return{
                form: {
                    name: '',
                    email: '',
                    password: ''
                },
                response: {}
            }
        },
        methods:{
            submitForm(){
                axios.post('/api/auth/register', this.form)
                .then(function (response) {
                    this.response = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        }
    }
</script>
