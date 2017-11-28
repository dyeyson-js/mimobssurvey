<template>
    <div>
        <common-header>
            Money In Money Out - Personal Balance Sheet Survey
        </common-header>
        
        <common-content>
            <form id="survey-summary-form">
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

        computed: {     
            
        },

        props: {
            nextStep: {
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
            }
        }
        
    }
</script>
