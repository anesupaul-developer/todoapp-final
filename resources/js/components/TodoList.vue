<template>
    <div class="container" style="color: #112233">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Todo List Items</div>
                    <!--<div :v-if="todos.length > 0">
                        <div class="card-body" v-for="todo in todos" :key="todo.id">
                            <p>{{todo.id}}</p>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return{
                todos: null,
            }
        },
        created() {
            this.getTodos();
        },
        methods:{
            getTodos() {
                const token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTYwMzIwMzUxNCwiZXhwIjoxNjAzMjA3MTE0LCJuYmYiOjE2MDMyMDM1MTQsImp0aSI6IlRvWTNQdkVMMnpvUm5ySGQiLCJzdWIiOjgsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.P3z6QFSVQvtI9nL-SNdDfLKLQCr1YT6725CRNFI6KZE".trim().toString();
                axios.defaults.headers.common.Authorization = 'Bearer '+token;
                axios.get('/api/todolist')
                    .then(function (response) {
                        this.todos = response.data.message.data
                    })
                    .catch(function (error) {
                        console.log(error);
                });
            }
        }
    }
</script>
