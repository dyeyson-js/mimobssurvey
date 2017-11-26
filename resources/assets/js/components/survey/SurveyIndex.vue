<template>
    <div>
        <survey-start 
            v-if="progress === 1" 
            :nextStep="nextStep"
        /> 
        <survey-participant 
            v-if="progress === 2" 
            :nextStep="nextStep"
            :getParticipantId="getParticipantId" 
        />    
    </div>
</template>

<script>
    export default {
        mounted() {
        
        },

        data() {
            return {
                progress: 2,
                id: undefined
            };
        },

        methods: {
            nextStep() {
                return this.progress++;
            },

            getParticipantId(id) {
                return this.id = id;
            }
        }
    }
</script>
