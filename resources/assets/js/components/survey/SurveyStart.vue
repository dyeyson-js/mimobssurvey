<template>
    <div>
        <common-header>
            Money In Money Out - Personal Balance Sheet Survey
        </common-header>

        <common-content>
            <div class="columns">
                <div class="column">
                    <button 
                        class="button is-primary is-large is-fullwidth"
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
