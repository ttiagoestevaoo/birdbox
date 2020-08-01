<template>
       <date-picker v-model="date" lang="pt-br" range type="datetime" :input-attr="{'name':msg}" format="DD/MM/YYYY HH:mm"></date-picker>
</template>

<script>
import DatePicker from 'vue2-datepicker'
import 'vue2-datepicker/index.css';
import 'vue2-datepicker/locale/pt-br';
export default {
    props: ['msg'],
    components: {
        DatePicker
    },
    data() {
        return {
            date : ''
        }
    }
}
</script>