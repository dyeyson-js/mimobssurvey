<template>
    <div>
        <common-header>
            Money In Money Out - Personal Balance Sheet Survey
        </common-header>
        
        <common-content>
            <form @submit.prevent="formSubmit" id="survey-mimo-form">
                <div v-if="errors.message" class="alert alert-danger">
                    {{ errors.message }}
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <fieldset>
                            <legend>Money In Money Out (Step 2 of 3)</legend>
                            
                            <!-- Active Income -->

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <h4 class="text-center"><strong>Active Income</strong></h4>
                                </div>
                            </div>

                            <template v-for="(income, index) in data.active_income_default">
                                <active-income-default :key="index" :index="index" :data="income" :currency="currency" :errors="errors" />
                            </template>

                            <div class="row">
                                <div class="col-md-12">
                                    <h5><strong>Others:</strong> <a v-if="data.active_income_addon.length < 5" role="button" class="btn btn-link" @click="addActiveIncome"><small>Add Active Income </small></a></h5>
                                </div>
                            </div>

                            <template v-for="(income, index) in data.active_income_addon">
                                <active-income-addon :key="index" :index="index" :data="income" :currency="currency" :errors="errors" :removeActiveIncome="removeActiveIncome"/>
                            </template>

                            <hr />

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <p><strong>Total Active Income</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><strong>{{ currency.symbol }}</strong></p>
                                    <p class="pull-right"><strong>{{ total_active_income }}</strong></p>
                                </div>
                            </div>

                            <!-- Passive Income -->
                            
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <h4 class="text-center"><strong>Passive Income</strong></h4>
                                </div>
                            </div>

                            <template v-for="(income, index) in data.passive_income_default">
                                <passive-income-default :key="index" :index="index" :data="income" :currency="currency" :errors="errors" />
                            </template>

                            <div class="row">
                                <div class="col-md-12">
                                    <h5><strong>Others:</strong> <a v-if="data.passive_income_addon.length < 5" role="button" class="btn btn-link" @click="addPassiveIncome"><small>Add Passive Income </small></a></h5>
                                </div>
                            </div>

                            <template v-for="(income, index) in data.passive_income_addon">
                                <passive-income-addon :key="index" :index="index" :data="income" :currency="currency" :errors="errors" :removePassiveIncome="removePassiveIncome"/>
                            </template>

                            <hr />

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <p><strong>Total Passive Income</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><strong>{{ currency.symbol }}</strong></p>
                                    <p class="pull-right"><strong>{{ total_passive_income }}</strong></p>
                                </div>
                            </div>

                            <!-- Money In -->

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <h4 class="text-center"><strong>Money In</strong></h4>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <p><strong>Active Income</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><strong>{{ currency.symbol }}</strong></p>
                                    <p class="pull-right"><strong>{{ total_active_income }}</strong></p>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <p><strong>Passive Income</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><strong>{{ currency.symbol }}</strong></p>
                                    <p class="pull-right"><strong>{{ total_passive_income }}</strong></p>
                                </div>
                            </div>

                            <hr />

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <p><strong>Money In</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><strong>{{ currency.symbol }}</strong></p>
                                    <p class="pull-right"><strong>{{ money_in }}</strong></p>
                                </div>
                            </div>

                            <!-- Regular Expenses -->
                            
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <h4 class="text-center"><strong>Regular Expenses</strong></h4>
                                </div>
                            </div>

                            <template v-for="(expense, index) in data.regular_expenses_default">
                                <regular-expenses-default :key="index" :index="index" :data="expense" :currency="currency" :errors="errors" />
                            </template>

                            <div class="row">
                                <div class="col-md-12">
                                    <h5><strong>Others:</strong> <a v-if="data.regular_expenses_addon.length < 5" role="button" class="btn btn-link" @click="addRegularExpenses"><small>Add Regular Expenses </small></a></h5>
                                </div>
                            </div>

                            <template v-for="(expense, index) in data.regular_expenses_addon">
                                <regular-expenses-addon :key="index" :index="index" :data="expense" :currency="currency" :errors="errors" :removeRegularExpenses="removeRegularExpenses"/>
                            </template>

                            <hr />

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <p><strong>Total Regular Expenses</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><strong>{{ currency.symbol }}</strong></p>
                                    <p class="pull-right"><strong>{{ total_regular_expenses }}</strong></p>
                                </div>
                            </div>

                            <!-- Occassional Expenses -->
                            
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <h4 class="text-center"><strong>Scheduled or Occassional Expenses</strong></h4>
                                </div>
                            </div>

                            <div class="alert alert-info">
                                <small>Occasional and scheduled expenses are expenses that you don’t incur on a regular basis such as clothing, vacations and tuition fees. Identify the occasional or scheduled expenses in the space provided for, input the corresponding expense amount and choose from the drop down menu when this is incurred – weekly, quarterly, semi-annual, annual, twice a month or every two months. The system will automatically convert this to its monthly equivalent.</small>
                            </div>

                            <template v-for="(expense, index) in data.occassional_expenses_addon">
                                <occassional-expenses-addon :key="index" :index="index" :data="expense" :currency="currency" :errors="errors" :removeOccassionalExpenses="removeOccassionalExpenses">
                                    <strong :key="index">{{currency.symbol}} {{ computeOccassionalExpenses(expense)}} / monthly equivalent</strong>
                                </occassional-expenses-addon>    
                            </template>

                            <div class="row">
                                <div class="col-md-12 form-group text-center">
                                    <a v-if="data.regular_expenses_addon.length < 8" role="button" class="btn btn-link" @click="addOccassionalExpenses"><small>Add Occassional Expenses </small></a>
                                </div>
                            </div>
                            
                            <hr />

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <p><strong>Total Occassional Expenses</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><strong>{{ currency.symbol }}</strong></p>
                                    <p class="pull-right"><strong>{{ total_occassional_expenses }}</strong></p>
                                </div>
                            </div>

                            <!-- Money Out -->

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <h4 class="text-center"><strong>Money Out</strong></h4>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <p><strong>Regular Expenses</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><strong>{{ currency.symbol }}</strong></p>
                                    <p class="pull-right"><strong>{{ total_regular_expenses }}</strong></p>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <p><strong>Occasional Expenses</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><strong>{{ currency.symbol }}</strong></p>
                                    <p class="pull-right"><strong>{{ total_occassional_expenses }}</strong></p>
                                </div>
                            </div>

                            <hr />

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <p><strong>Money Out</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><strong>{{ currency.symbol }}</strong></p>
                                    <p class="pull-right"><strong>{{ money_out }}</strong></p>
                                </div>
                            </div>

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
    import mimofields from './mimo';

    export default {
        mounted() {
            const vm = this;
            vm.getCurrency();
            vm.data.participant_id = vm.participantId;
        },

        data () {
            return {
                data: mimofields,
                errors: {},
                is_loading: false,
                currency: {}
            };
        },

        computed: {     
            is_loading_button () {
                return this.is_loading ? 'Please wait' : 'Continue' ;
            },

            total_active_income() {
                const vm = this;
                let total = 0;

                _.each(vm.data.active_income_default, (income, index) => {
                    total += isNaN(numeral(income.value).value()) ? 0 : numeral(income.value).value();
                });

                _.each(vm.data.active_income_addon, (income, index) => {
                    total += isNaN(numeral(income.value).value()) ? 0 : numeral(income.value).value();
                });
                    
                return vm.numberWithCommas(total);                
            },

            total_passive_income() {
                const vm = this;
                let total = 0;

                _.each(vm.data.passive_income_default, (income, index) => {
                    total += isNaN(numeral(income.value).value()) ? 0 : numeral(income.value).value();
                });

                _.each(vm.data.passive_income_addon, (income, index) => {
                    total += isNaN(numeral(income.value).value()) ? 0 : numeral(income.value).value();
                });
                    
                return vm.numberWithCommas(total);
            },

            money_in() {
                const vm = this;
                let total = numeral(vm.total_active_income).value() + numeral(vm.total_passive_income).value();                
                return vm.numberWithCommas(total);
            },

            total_regular_expenses() {
                const vm = this;
                let total = 0;

                _.each(vm.data.regular_expenses_default, (expense, index) => {
                    total += isNaN(numeral(expense.value).value()) ? 0 : numeral(expense.value).value();
                });

                _.each(vm.data.regular_expenses_addon, (expense, index) => {
                    total += isNaN(numeral(expense.value).value()) ? 0 : numeral(expense.value).value();
                });
                    
                return vm.numberWithCommas(total);
            },

            total_occassional_expenses() {
                const vm = this;
                let total = 0;

                _.each(vm.data.occassional_expenses_addon, (expense, index) => {
                    total += numeral(vm.computeOccassionalExpenses(expense)).value();
                    console.log(total);
                });        

                return vm.numberWithCommas(total);
            },

            money_out() {
                const vm = this;
                let total = numeral(vm.total_regular_expenses).value() + numeral(vm.total_occassional_expenses).value();                
                return vm.numberWithCommas(total);
            },
        },

        props: {
            nextStep: {
                type: Function
            },
            participantId: {
                type: Number
            }
        },

        methods: {
            getCurrency() {
                const vm = this;

                return axios.post('/survey/participant/currency', { id: vm.participantId })
                    .then(response => {
                        vm.currency = response.data;
                    });
            },

            addActiveIncome() {
                const vm = this;
                const newActiveIncome = {
                    label: '',
                    value: ''
                };

                return vm.data.active_income_addon.push(newActiveIncome);
            },

            removeActiveIncome(targetIndex) {
                const vm = this;                
                const updatedActiveIncomeArray = vm.data.active_income_addon.filter((item, index) => index !== targetIndex);
                return vm.data.active_income_addon = updatedActiveIncomeArray;
            },

            addPassiveIncome() {
                const vm = this;
                const newPassiveIncome = {
                    label: '',
                    value: ''
                };

                return vm.data.passive_income_addon.push(newPassiveIncome);
            },

            removePassiveIncome(targetIndex) {
                const vm = this;                
                const updatedPassiveIncomeArray = vm.data.passive_income_addon.filter((item, index) => index !== targetIndex);
                return vm.data.passive_income_addon = updatedPassiveIncomeArray;
            },

            addRegularExpenses() {
                const vm = this;
                const newRegularExpenses = {
                    label: '',
                    value: ''
                };

                return vm.data.regular_expenses_addon.push(newRegularExpenses);
            },

            removeRegularExpenses(targetIndex) {
                const vm = this;                
                const updatedRegularExpensesArray = vm.data.regular_expenses_addon.filter((item, index) => index !== targetIndex);
                return vm.data.regular_expenses_addon = updatedRegularExpensesArray;
            },

            computeOccassionalExpenses(expense) {
                const vm = this;
                const frequency = expense.frequency;
                let total = 0;

                if(frequency) {
                    if(!isNaN(parseFloat(expense.value))) {
                        total = frequency.operation === "*" ? 
                            parseFloat(expense.value) * frequency.base :
                                parseFloat(expense.value) !== 0 ? 
                                    parseFloat(expense.value) / frequency.base :
                                        0;
                    }
                }

                return vm.numberWithCommas(total);
            },

            addOccassionalExpenses() {
                const vm = this;
                const newOccassionalExpenses = {
                    label: '',
                    value: '',
                    frequency: {}
                };

                return vm.data.occassional_expenses_addon.push(newOccassionalExpenses);
            },

            removeOccassionalExpenses(targetIndex) {
                const vm = this;                
                const updatedOccassionalExpensesArray = vm.data.occassional_expenses_addon.filter((item, index) => index !== targetIndex);
                return vm.data.occassional_expenses_addon = updatedOccassionalExpensesArray;
            },

            formSubmit() {
                const vm = this;
                const formData = vm.data;
                
                vm.is_loading = true;
                vm.errors = {};

                setTimeout(() => {
                    axios.post('/survey/mimo', formData)
                        .then(response => {
                            vm.is_loading = false;
                            // vm.nextStep();
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
