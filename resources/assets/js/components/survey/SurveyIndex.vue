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

        <survey-mimo 
            v-if="progress === 3" 
            :nextStep="nextStep"
            :participantId="id"
        />    
    </div>
</template>

<script>
    export default {
        mounted() {
        
        },

        data() {
            return {
                progress: 3,
                id: 1
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
