<template>
    <div>
        <common-header>
            Money In Money Out - Personal Balance Sheet Survey
        </common-header>
        
        <common-content>
            <form @submit.prevent="formSubmit" id="survey-participant-form">
                <div v-if="errors.message" class="alert alert-danger">
                    {{ errors.message }}
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <fieldset>
                            <legend>Participant Details (Step 1 of 3)</legend>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" :class="{ 'has-error': getError('first_name') }">
                                        <label for="first_name">First Name *</label>
                                        <input class="form-control" id="first_name" type="text" name="first_name" placeholder="John" v-model="credentials.first_name">
                                        <small class="help-block">{{ getError('first_name') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" :class="{ 'has-error': getError('last_name') }">
                                        <label for="last_name">Last Name *</label>
                                        <input class="form-control" id="last_name" type="text" name="last_name" placeholder="Smith" v-model="credentials.last_name">
                                        <small class="help-block">{{ getError('last_name') }}</small>                            
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" :class="{ 'has-error': getError('email') }">
                                        <label for="email">Email Address *</label>
                                        <input class="form-control" id="email" type="text" name="email" placeholder="user@company.com" v-model="credentials.email">
                                        <small class="help-block">{{ getError('email') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" :class="{ 'has-error': getError('phone_num') }">
                                        <label for="phone_num">Mobile Number  *</label>
                                        <input class="form-control" id="phone_num" type="text" name="phone_num" placeholder="+63 9XX XXXX" v-model="credentials.phone_num">
                                        <small class="help-block">{{ getError('phone_num') }}</small>
                                    </div>
                                </div>
                            </div>
                
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" :class="{ 'has-error': getError('city') }">
                                        <label for="city">City *</label>
                                        <input class="form-control" id="city" type="text" name="city" placeholder="Manila" v-model="credentials.city">
                                        <small class="help-block">{{ getError('city') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" :class="{ 'has-error': getError('birth_date') }">
                                        <label for="birth_date">Birth Date  *</label>
                                        <input autocomplete="false" class="form-control" id="birth_date" type="text" name="birth_date" placeholder="mm/dd/yyyy" v-model="credentials.birth_date" /> 
                                        <small class="help-block">{{ getError('birth_date') }}</small>                            
                                    </div>
                                </div>
                            </div>
                
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" :class="{ 'has-error': getError('currency') }">
                                        <label for="currency">Currency *</label>
                                        <select class="form-control" id="currency" name="currency" v-model="credentials.currency">   
                                            <template v-for="(currency, index) in currency_options">
                                                <option :key="index" :value="currency.code">{{currency.name}} ({{currency.symbol}})</option>
                                            </template>
                                        </select>
                                        <small class="help-block">{{ getError('currency') }}</small>                                
                                    </div>
                                </div>
                            </div>

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
            $(window).ready(() => {
                setTimeout(() => {
                    $("#birth_date").datepicker({
                        format: 'mm/dd/yyyy',
                        endDate: moment().format(),
                        clearBtn: true,
                        autoclose: true
                    })
                    .on('changeDate', (e) => {
                        vm.credentials.birth_date = e.target.value;
                    });
                }, 1000);
            });
        },

        data () {
            return {
                credentials: {
                    first_name: this.participant.first_name || '',
                    last_name: this.participant.last_name || '',
                    email: this.participant.email || '',
                    phone_num: this.participant.phone_num || '',
                    city: this.participant.city || '',
                    birth_date: moment(this.participant.birth_date).format('MM/DD/YYYY') || '',
                    currency: this.participant.currency || ''
                },
                errors: {},
                is_loading: false,
            };
        },

        props: {
            getParticipant: {
                type: Function
            },
            participant: {
                type: Object
            }
        },

        computed: {
            currency_options() {  
                return survey.currencies || [];
            },
            
            is_loading_button () {
                return this.is_loading ? 'Please wait' : 'Continue' ;
            }
        },

        methods: {
            getError(field) {
                const vm = this;
                
                return vm.errors.hasOwnProperty('errors') ? 
                    vm.errors.errors.hasOwnProperty(field) ? vm.errors.errors[field][0] : null
                    : null; 
            },

            formSubmit() {
                const vm = this;
                const formData = $("#survey-participant-form").serialize();
                
                vm.is_loading = true;
                vm.errors = {};

                setTimeout(() => {
                    if(vm.participant.id) {
                        return axios.put(`/api/survey/participant/${vm.participant.id}`, formData)
                        .then(response => {
                            vm.is_loading = false;
                            vm.getParticipant(response.data.participant);
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

                    return axios.post('/api/survey/participant', formData)
                        .then(response => {
                            vm.is_loading = false;
                            vm.getParticipant(response.data.participant);
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
        }
    }
</script>
