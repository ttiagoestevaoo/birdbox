<template>
    <div class="flex items-center mr-8">
        <button v-for="(color, theme) in themes"
          class="rounded-full w-4 h-4  border mr-2 focus:outline-none " 
        :class="[{ 'border-accent': selectedTheme == theme} ,color]" 
        @click="selectedTheme= theme">
        
        </button>
        
    </div>
</template>

<script>
    export default {
        data() {
            return {
                themes : {
                    'theme-light' : 'bg-white',
                    'theme-dark' : 'bg-black',
                },
                selectedTheme : 'theme-light'
            }
        },
        watch : {
            selectedTheme(){
                document.body.className = document.body.className.replace(/theme-\w+/, this.selectedTheme);
            }
        }
    }
</script>
