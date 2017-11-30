<template>
    <div>
        <common-header>
            Money In Money Out - Personal Balance Sheet Survey
        </common-header>

        <common-content>
            <div class="row">
                <div class="col-md0-12">
                    <button 
                        class="btn btn-primary btn-block btn-lg"
                        @click="nextStep"
                    >
                        Start Survey
                    </button>
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
            nextStep: {
                type: Function
            }
        },
    }
</script>
