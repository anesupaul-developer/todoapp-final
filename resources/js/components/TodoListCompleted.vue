<template>
  <div class="container" style="color: #112233">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Todo List Items Completed</div>

                    <div class="card-body">
                        I'm an todolist completed component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log('Component mounted. {{ Auth::user()->name }}')
    }
}
</script>