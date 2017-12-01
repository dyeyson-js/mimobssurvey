<template>
    <div>
        <savingsplan-start 
            v-if="progress === 1" 
            :nextStep="nextStep"
        /> 

        <savingsplan-participant 
            v-if="progress === 2" 
            :participant="participant"
            :getParticipant="getParticipant" 
        />    

        <savingsplan-survey 
            v-if="progress === 3" 
            :participant="participant"
            :savingsplan="savingsplan"
            :getSavingsPlan="getSavingsPlan"
        />  
    </div>
</template>

<script>
    export default {
        mounted() {
        
        },

        data() {
            return {
                progress: 1,
                participant: {},
                savingsplan: {}
            };
        },

        methods: {
            nextStep() {
                return this.progress++;
            },

            getParticipant(participant) {
                this.participant = participant;
                return this.nextStep();
            },

            getSavingsPlan(savingsplan) {
                this.savingsplan = savingsplan;
                return this.nextStep();
            }

        }
    }
</script>
