<template>
    <div>
        <common-header>
            Money In Money Out - Personal Balance Sheet Survey
        </common-header>

        <common-content>
            <div class="row">
                <div class="col-md-12 form-group">
                    <h2 class="text-center">Well done!</h2>
                    <p class="text-center">
                        Thank you for answering the survey. To view your results, you can download it by clicking the download button below.  
                    </p> 
                </div>
                <div class="col-md-12 form-group text-center">
                    <form target="_blank" :action="downloadLink" method="POST">
                        <input type="hidden" name="_token" :value="token" />
                        <input type="hidden" name="survey_id" :value="survey.id" />
                        <input type="hidden" name="survey_type" :value="survey.survey_type" />
                        <button type="submit" class="btn btn-primary btn-lg">Download the Result</button>
                        {{ ' ' }}
                        <a :href="refreshLink" class="btn btn-default btn-lg">Retake the Survey</a>
                    </form>
                </div>
            </div>
        </common-content>
    </div>    
</template>

<script>
    export default {
        mounted() {

        },

        props: {
            survey: {
                type: Object
            },
            downloadLink: {
                type: String
            },
            refreshLink: {
                type: String
            }
        },

        computed: {
            token() {
                return document.head.querySelector('meta[name="csrf-token"]').content;
            }
        }

    }
</script>
