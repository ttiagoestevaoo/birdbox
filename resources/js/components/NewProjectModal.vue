<template>
     <modal name="new-project" classes="p-10 bg-card rounded-lg" height="auto">
        <h1 class="font-normal mb-16 text-center text-2xl">Let's Start Someting New</h1>

        <form @submit.prevent="submit">

            <div class="flex">
                <div class="flex-1 mr-4">
                    <div class="mb-4">
                        <label for="title" class="text-sm block mb-2">Title</label>
                        <input type="text" 
                            name="title" c
                            class="border border-muted-light p-2 text-xs w-full rounded" 
                            :class="errors.title ? 'border-error' : 'border-muted-light'"
                            v-model="form.title">
                        <span class="text-xs italic text-error" v-if="errors.title" v-text="errors.title[0]"></span>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="text-sm block mb-2">Description</label>
                        <textarea 
                            name="description" 
                            class="border border-muted-light p-2 text-xs w-full rounded" 
                            rows="7" 
                            :class="errors.description ? 'border-error' : 'border-muted-light'"
                            v-model="form.description">
                        </textarea>
                        <span class="text-xs italic text-error" v-if="errors.description" v-text="errors.description[0]"></span>
                    </div>
                </div>

                <div class="flex-1 mr-4">
                    <div class="mb-4">
                        <label  class="text-sm block mb-2">Need Some Tasks?</label>
                        <input 
                            type="text"  
                            class="border border-muted-light mb-2 p-2 text-xs w-full rounded" 
                            placeholder="Task 1"
                            v-for="(task, index) in form.tasks"  :key="index" 
                            v-model="task.body">
                    </div>

                    <button type="button" class="btn-blue" @click="addTask">
                        Add New Task
                    </button>
                </div>
            </div>
            <footer class="flex justify-end">
                <button type="button" class="button is-outlined mr-4" @click="$modal.hide('new-project')">Cancel</button>
                <button type="submit" class="button">Create a project</button>
            </footer>
        </form>
        
    </modal>
</template>

<script>
export default {
    data() {
        return {
            form: {
                title: '',
                description: '',
                tasks : [
                    {body: ''}
                ]
            },
            errors: {}
        }
    },
    methods: {
        addTask(){
            this.form.tasks.push({body:''});
        },
         async submit(){
            try{
                location = ( await  axios.post('/projects', this.form)).data.message ;
            }catch( error ){
                this.errors = error.response.data.errors;
            }
        }

    },

}
</script>