<template>
    <div class="container" style="color: #112233">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Todo List Items</div>
                    <div :v-if="todos.length > 0">
                        <div class="card-body" v-for="todo in todos" :key="todo.id">
                            <p>{{todo.id}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'todos',
        data(){
            return{
                todos: null
            }
        },
        created() {
            this.getTodos();
        },
        methods:{
            getTodos() {
                const token = `Bearer ${localStorage.getItem('token')}`
                axios.defaults.headers.common.Authorization = token;
                axios.get('/api/todolist')
                    .then(function (response) {
                        console.log(response.data.message.data);
                        this.todos = response.data.message.data
                    })
                    .catch(function (error) {
                        console.log(error);
                });
            }
        }
    }
</script>
