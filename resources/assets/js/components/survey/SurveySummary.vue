<template>
    <div>
        <common-header>
            Money In Money Out - Personal Balance Sheet Survey
        </common-header>
        
        <common-content>
            <form id="survey-summary-form" @submit.prevent="formSubmit">
                <input type="hidden" name="participant_id" :value="participant.id" />
                <input type="hidden" name="survey_type" value="mimopbs" />
                <div class="row">
                    <div class="col-md-12">
                        <fieldset>
                            <legend>Summary <a role="button" class="btn btn-link pull-right" @click="editAnswer(2)">Edit Answer</a></legend>
                        </fieldset>
                    </div>
                </div>

                <participant-summary 
                    :participant="participant"
                />

                <mimo-summary 
                    :participant="participant"
                    :mimo="mimo"
                />

                <pbs-summary 
                    :participant="participant"
                    :pbs="pbs"
                />

                <div class="row">
                    <div class="col-md-12">
                        <button
                            type="submit"
                            class="btn btn-primary btn-block btn-lg"
                            :disabled="is_loading"               
                        >
                            <span v-if="is_loading" class="fa fa-circle-o-notch fa-spin"></span> {{ is_loading_button }}
                        </button>
                    </div>
                </div>
            </form>
        </common-content>
    </div>    
</template>

<script>
    import mimofields from './mimo/mimo';

    export default {
        mounted() {
            const vm = this;
        },

        data() {
            return {
                errors: {},
                is_loading: false,
            };
        },

        computed: {     
            is_loading_button () {
                return this.is_loading ? 'Please wait' : 'Submit' ;
            }
        },

        props: {
            getSurvey: {
                type: Function
            },
            getDownloadLink: {
                type: Function
            },
            getRefreshLink: {
                type: Function
            },
            gotoProgress: {
                type: Function
            },
            participant: {
                type: Object
            },
            mimo: {
                type: Object
            },
            pbs: {
                type: Object
            }
        },

        methods: {
            editAnswer() {
                return this.gotoProgress(2);
            },

            formSubmit() {
                const vm = this;
                const formData = $("#survey-summary-form").serialize();

                vm.is_loading = true;
                vm.errors = {};

                setTimeout(() => {    
                    return axios.post('/api/survey', formData)
                        .then(response => {
                            vm.is_loading = false;
                            vm.getSurvey(response.data.survey);
                            vm.getDownloadLink(response.data.downloadLink);
                            vm.getRefreshLink(response.data.refreshLink);
                            $("body").scrollTop(0);
                        })
                        .catch(error => {
                            vm.is_loading = false;    
                            if (error.response) {
                                // The request was made and the server responded with a status code
                                // that falls out of the range of 2xx
                                vm.errors = error.response.data;                    
                                console.log(error.response.data);
                                console.log(error.response.status);
                                console.log(error.response.headers);
                            } else if (error.request) {
                                // The request was made but no response was received
                                // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                                // http.ClientRequest in node.js
                                console.log(error.request);
                            } else {
                                // Something happened in setting up the request that triggered an Error
                                console.log('Error', error.message);
                            }
                            $("body").scrollTop(0);
                        });
                }, 1000);
            }
        }
        
    }
</script>
