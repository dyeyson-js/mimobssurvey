<template>
    <div>
        <common-header>
            Savings Plan Survey
        </common-header>
        
        <common-content>
            <form @submit.prevent="formSubmit" id="survey-mimo-form">
                <div v-if="errors.message" class="alert alert-danger">
                    {{ errors.message }}
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <fieldset>
                            <legend>Savings Plan (Step 2 of 2)</legend>

                            <template v-for="(goal, index) in data.short_term_goal">
                                <short-term-goal 
                                    :key="index"
                                    :currency="currency"
                                    v-model="data.short_term_goal[index]"
                                    :index="index"
                                />
                            </template>


                            <!-- button -->

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

                        </fieldset>
                    </div>
                </div>
            </form>
        </common-content>
    </div>    
</template>

<script>
    export default {
        mounted() {
            const vm = this;
            vm.getCurrency();
            vm.data.participant_id = vm.participant.id;
        },

        data () {
            return {
                data: {
                    participant_id: undefined,
                    short_term_goal: [
                        {
                            goal_name: '',
                            amount: '',
                            when_needed: {
                                from: '1',
                                to: '2',
                                month: ''
                            },
                            amount_frequency: {
                                amount: '',
                                frequency: '',
                                custom_frequency: {
                                    value: '',
                                    frequency: ''
                                }
                            }

                        },
                        {
                            goal_name: 'Hello',
                            amount: '',
                            when_needed: {
                                from: '',
                                to: '',
                                month: ''
                            },
                            amount_frequency: {
                                amount: '',
                                frequency: '',
                                custom_frequency: {
                                    value: '',
                                    frequency: ''
                                }
                            }

                        }
                    ],
                },
                errors: {},
                is_loading: false,
                currency: {}
            };
        },

        computed: {     
            is_loading_button () {
                return this.is_loading ? 'Please wait' : 'Continue' ;
            },
        },

        props: {
            getSavingsPlan: {
                type: Function
            },
            participant: {
                type: Object
            },
            savingsplan: {
                type: Object
            }
        },

        methods: {
            getCurrency() {
                const vm = this;

                return axios.post('/api/survey/participant/currency', { id: vm.participant.id })
                    .then(response => {
                        vm.currency = response.data;
                    });
            },

            formSubmit() {
                const vm = this;
                const formData = vm.data;
                
                vm.is_loading = true;
                vm.errors = {};

                setTimeout(() => {
                    if(vm.mimo.id) {
                        return axios.put(`/api/survey/mimo/${vm.mimo.id}`, formData)
                            .then(response => {
                                vm.is_loading = false;
                                vm.getMimo(response.data.mimo);
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
                    }

                    return axios.post('/survey/mimo', formData)
                        .then(response => {
                            vm.is_loading = false;
                            vm.getMimo(response.data.mimo);
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
            },

            numberWithCommas(x) {
                return numeral(x).format('0,0.00');
            } 
        }
        
    }
</script>
