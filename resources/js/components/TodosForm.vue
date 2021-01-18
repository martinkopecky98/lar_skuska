<template>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Create TODO VUE</div>

            <div class="card-body">
                <form action="./api/todos" method="POST" @submit="addTodo()">
                    <div class="form-group">
                        <input type="text" name="title" placeholder="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="body" placeholder="body" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject" placeholder="subject" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Add todo" class="btn btn-info">
                    </div>
                </form>
                
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        methods:{
            addTodo(){
                alert('pridaaavanie todo')
            }
        }
    }
</script>