<template>
    <div>
        <survey-start 
            v-if="progress === 1" 
            :nextStep="nextStep" 
        /> 
        <survey-participant 
            v-if="progress === 2" 
            :nextStep="nextStep" 
        />    
    </div>
</template>

<script>
    export default {
        mounted() {
        
        },

        data() {
            return {
                progress: 2
            };
        },

        methods: {
            nextStep() {
                return this.progress++;
            }
        }
    }
</script>
