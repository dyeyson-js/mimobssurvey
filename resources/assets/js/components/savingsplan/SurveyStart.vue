<template>
    <div>
        <common-header>
            Savings Plan Survey
        </common-header>

        <common-content>
            <div class="row">
                <div class="col-xs-12">
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
