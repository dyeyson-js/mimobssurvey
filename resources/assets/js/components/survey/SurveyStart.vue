<template>
    <div>
        <common-header>
            Money In Money Out - Personal Balance Sheet Survey
        </common-header>

        <common-content>
            <div class="columns">
                <div class="column">
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
