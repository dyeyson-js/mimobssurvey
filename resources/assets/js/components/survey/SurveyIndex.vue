<template>
    <div>
        <survey-start 
            v-if="progress === 1" 
            :nextStep="nextStep"
        /> 
        
        <survey-participant 
            v-if="progress === 2" 
            :participant="participant"
            :getParticipant="getParticipant" 
        />    

        <survey-mimo 
            v-if="progress === 3" 
            :participant="participant"
            :mimo="mimo"
            :getMimo="getMimo"
        />    

        <survey-pbs 
            v-if="progress === 4" 
            :participant="participant"
            :pbs="pbs"
            :getBalanceSheet="getBalanceSheet"
        />

        <survey-summary
            v-if="progress === 5"
            :nextStep="nextStep"
            :gotoProgress="gotoProgress"
            :participant="participant"
            :mimo="mimo"
            :pbs="pbs"
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
                mimo: {},
                pbs: {}
            };
        },

        methods: {
            nextStep() {
                return this.progress++;
            },

            gotoProgress(progress = null) {
                return this.progress = progress;
            },

            getParticipant(participant) {
                this.participant = participant;
                return this.nextStep();
            },

            getMimo(mimo) {
                this.mimo = mimo;
                return this.nextStep();
            },

            getBalanceSheet(pbs) {
                this.pbs = pbs;
                return this.nextStep();
            }
        }
    }
</script>
