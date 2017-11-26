<template>
    <div>
        <common-header>
            Money In Money Out - Personal Balance Sheet Survey
        </common-header>
        
        <common-content>
            <form @submit.prevent="formSubmit" id="survey-participant-form">
                <div class="columns">
                    <div class="column is-half">
                        <h6 class="title is-6">Participant Details</h6>
                    </div>
                    <div class="column is-half">
                        <h6 class="has-text-right title is-6">Step 1 of 1</h6>
                    </div>
                </div>

                <div v-if="errors.message" class="notification is-danger">
                    {{ errors.message }}
                </div>

                <div class="columns">
                    <div class="column is-half">
                        <div class="field">
                            <label class="label">First Name *</label>
                            <div class="control">
                                <input class="input" :class="{ 'is-danger': getError('first_name') }" type="text" name="first_name" placeholder="John" v-model="credentials.first_name">
                            </div>
                            <p class="help" :class="{ 'is-danger': getError('first_name') }">{{ getError('first_name') }}</p>
                        </div>
                    </div>
                    <div class="column is-half">
                        <div class="field">
                            <label class="label">Last Name *</label>
                            <div class="control">
                                <input class="input" :class="{ 'is-danger': getError('last_name') }" type="text" name="last_name" placeholder="Smith" v-model="credentials.last_name">
                            </div>
                            <p class="help" :class="{ 'is-danger': getError('last_name') }">{{ getError('last_name') }}</p>                            
                        </div>
                    </div>
                </div>

                <div class="columns">
                    <div class="column is-half">
                        <div class="field">
                            <label class="label">Email Address *</label>
                            <div class="control">
                                <input class="input" :class="{ 'is-danger': getError('email') }" type="text" name="email" placeholder="user@company.com" v-model="credentials.email">
                            </div>
                            <p class="help" :class="{ 'is-danger': getError('email') }">{{ getError('email') }}</p>
                        </div>
                    </div>
                    <div class="column is-half">
                        <div class="field">
                            <label class="label">Mobile Number  *</label>
                            <div class="control">
                                <input class="input" :class="{ 'is-danger': getError('phone_num') }" type="text" name="phone_num" placeholder="+63 9XX XXXX" v-model="credentials.phone_num">
                            </div>
                            <p class="help" :class="{ 'is-danger': getError('phone_num') }">{{ getError('phone_num') }}</p>
                        </div>
                    </div>
                </div>

                <div class="columns">
                    <div class="column is-half">
                        <div class="field">
                            <label class="label">City *</label>
                            <div class="control">
                                <input class="input" :class="{ 'is-danger': getError('city') }" type="text" name="city" placeholder="Manila" v-model="credentials.city">
                            </div>
                            <p class="help" :class="{ 'is-danger': getError('city') }">{{ getError('city') }}</p>
                        </div>
                    </div>
                    <div class="column is-half">
                        <div class="field">
                            <label class="label">Birth Date  *</label>
                            <div class="control">
                                <datepicker 
                                    :inputClass="{ 'input': true, 'is-danger': getError('birth_date') }" 
                                    v-model="credentials.birth_date" 
                                    name="birth_date"
                                    format="MM/dd/yyyy"
                                    :disabled="date_disabled"
                                />
                            </div>
                            <p class="help" :class="{ 'is-danger': getError('birth_date') }">{{ getError('birth_date') }}</p>                            
                        </div>
                    </div>
                </div>

                <div class="columns">
                    <div class="column is-half">
                        <div class="field">
                            <label class="label">Currency *</label>
                            <div class="control">
                                <div class="select is-fullwidth" :class="{ 'is-danger': getError('currency') }">
                                    <select v-model="credentials.currency" name="currency">   
                                        <template v-for="(currency, index) in currency_options">
                                            <option :key="index" :value="currency.code">{{currency.name}} ({{currency.symbol}})</option>
                                        </template>
                                    </select>
                                </div>
                                <p class="help" :class="{ 'is-danger': getError('currency') }">{{ getError('currency') }}</p>                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="columns">
                    <div class="column">
                        <button
                            type="submit"
                            class="button is-primary is-large is-fullwidth"
                            :class="{ 'is-loading': is_loading }"
                        >
                            Continue
                        </button>
                    </div>
                </div>
            </form>
        </common-content>
    </div>    
</template>

<script>
    import Datepicker from 'vuejs-datepicker';

    export default {
        components: {
            Datepicker,
        },

        mounted() {
            console.log(Date(moment().year(), moment().month(), moment().day()));
        },

        data () {
            return {
                credentials: {
                    first_name: '',
                    last_name: '',
                    email: '',
                    phone_num: '',
                    city: '',
                    birth_date: '',
                    currency: ''
                },
                errors: {},
                is_loading: false,
                date_disabled: {
                    from: moment().toDate()
                }
            };
        },

        props: {
            nextStep: {
                type: Function
            }
        },

        computed: {
            currency_options() {  
                return survey.currencies || [];
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
                    axios.post('/survey/participant', formData)
                        .then(response => {
                            vm.is_loading = false;
                            console.log(response.data);
                        })
                        .catch(error => {
                            vm.is_loading = false;    
                            vm.errors = error.response.data;                    
                            console.log(error.response.data);
                        });
                }, 1000);
            },
        }
    }
</script>
