<template>
    <div>
        <mimopbs-start 
            v-if="progress === 1" 
            :nextStep="nextStep"
        /> 
        
        <mimopbs-participant 
            v-if="progress === 2" 
            :participant="participant"
            :getParticipant="getParticipant" 
        />    

        <mimopbs-mimo 
            v-if="progress === 3" 
            :participant="participant"
            :mimo="mimo"
            :getMimo="getMimo"
        />    

        <mimopbs-pbs 
            v-if="progress === 4" 
            :participant="participant"
            :pbs="pbs"
            :getBalanceSheet="getBalanceSheet"
        />

        <mimopbs-summary
            v-if="progress === 5"
            :getSurvey="getSurvey"
            :getDownloadLink="getDownloadLink"
            :getRefreshLink="getRefreshLink"
            :gotoProgress="gotoProgress"
            :participant="participant"
            :mimo="mimo"
            :pbs="pbs"
        />

        <mimopbs-result 
            v-if="progress === 6"
            :survey="survey"
            :downloadLink="downloadLink"
            :refreshLink="refreshLink"
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
                pbs: {},
                survey: {},
                downloadLink: '/',
                refreshLink: '/'
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

            getSurvey(survey) {
                this.survey = survey;
                return this.nextStep();
            },

            getDownloadLink(link) {
                return this.downloadLink = link;
            },

            getRefreshLink(link) {
                console.log(link);
                return this.refreshLink = link;
            },

            getBalanceSheet(pbs) {
                this.pbs = pbs;
                return this.nextStep();
            }
        }
    }
</script>
