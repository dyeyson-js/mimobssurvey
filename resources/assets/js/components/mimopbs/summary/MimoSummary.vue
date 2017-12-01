<template>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-center">Money In Money Out</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- active income -->
                        
                        <tr>
                            <td colspan="2" class="text-center">Active Income</td>
                        </tr>

                        <template v-for="(item, index) in mimo.content.active_income_default">
                            <tr :key="index">
                                <td class="col-xs-6">{{ item.label }}</td>
                                <td class="col-xs-6 text-right">{{ currency.symbol }} {{ numberWithCommas(item.value) }}</td>
                            </tr>
                        </template>

                        <template v-for="(item, index) in mimo.content.active_income_addon">
                            <tr :key="index">
                                <td class="col-xs-6">{{ item.label }}</td>
                                <td class="col-xs-6 text-right">{{ currency.symbol }} {{ numberWithCommas(item.value) }}</td>
                            </tr>
                        </template>
                        
                        <tr>
                            <td class="col-xs-6"><strong>TOTAL ACTIVE INCOME</strong></td>
                            <td class="col-xs-6 text-right"><strong>{{ currency.symbol }} {{ total_active_income }}</strong></td>
                        </tr>

                        <!-- passive income -->

                        <tr>
                            <td colspan="2" class="text-center">Passive Income</td>
                        </tr>

                        <template v-for="(item, index) in mimo.content.passive_income_default">
                            <tr :key="index">
                                <td class="col-xs-6">{{ item.label }}</td>
                                <td class="col-xs-6 text-right">{{ currency.symbol }} {{ numberWithCommas(item.value) }}</td>
                            </tr>
                        </template>

                        <template v-for="(item, index) in mimo.content.passive_income_addon">
                            <tr :key="index">
                                <td class="col-xs-6">{{ item.label }}</td>
                                <td class="col-xs-6 text-right">{{ currency.symbol }} {{ numberWithCommas(item.value) }}</td>
                            </tr>
                        </template>
                        
                        <tr>
                            <td class="col-xs-6"><strong>TOTAL PASSIVE INCOME</strong></td>
                            <td class="col-xs-6 text-right"><strong>{{ currency.symbol }} {{ total_passive_income }}</strong></td>
                        </tr>

                        <!-- Money In -->

                        <tr>
                            <td colspan="2" class="text-center">Money In</td>
                        </tr>

                        <tr>
                            <td class="col-xs-6">Active Income</td>
                            <td class="col-xs-6 text-right">{{ currency.symbol }} {{ total_active_income }}</td>
                        </tr>

                        <tr>
                            <td class="col-xs-6">Passive Income</td>
                            <td class="col-xs-6 text-right">{{ currency.symbol }} {{ total_passive_income }}</td>
                        </tr>

                        <tr>
                            <td class="col-xs-6"><strong>MONEY IN</strong></td>
                            <td class="col-xs-6 text-right">{{ currency.symbol }} {{ money_in }}</td>
                        </tr>

                        <!-- regular expenses -->
                        
                        <tr>
                            <td colspan="2" class="text-center">Regular Expenses</td>
                        </tr>

                        <template v-for="(item, index) in mimo.content.regular_expenses_default">
                            <tr :key="index">
                                <td class="col-xs-6">{{ item.label }}</td>
                                <td class="col-xs-6 text-right">{{ currency.symbol }} {{ numberWithCommas(item.value) }}</td>
                            </tr>
                        </template>

                        <template v-for="(item, index) in mimo.content.regular_expenses_addon">
                            <tr :key="index">
                                <td class="col-xs-6">{{ item.label }}</td>
                                <td class="col-xs-6 text-right">{{ currency.symbol }} {{ numberWithCommas(item.value) }}</td>
                            </tr>
                        </template>
                        
                        <tr>
                            <td class="col-xs-6"><strong>TOTAL REGULAR EXPENSES</strong></td>
                            <td class="col-xs-6 text-right"><strong>{{ currency.symbol }} {{ total_regular_expenses }}</strong></td>
                        </tr>

                        <!-- occassional expenses -->
                        
                        <tr>
                            <td colspan="2" class="text-center">Scheduled or Occassional Expenses</td>
                        </tr>

                        <template v-for="(item, index) in mimo.content.occassional_expenses_addon">
                            <tr :key="index">
                                <td class="col-xs-6">{{ item.label }}</td>
                                <td class="col-xs-6 text-right">{{ currency.symbol }} {{ computeOccassionalExpenses(item) }}</td>
                            </tr>
                        </template>

                        <tr>
                            <td class="col-xs-6"><strong>TOTAL OCCASSIONAL EXPENSES</strong></td>
                            <td class="col-xs-6 text-right"><strong>{{ currency.symbol }} {{ total_occassional_expenses }}</strong></td>
                        </tr>

                        <!-- Money Out -->

                        <tr>
                            <td colspan="2" class="text-center">Money Out</td>
                        </tr>

                        <tr>
                            <td class="col-xs-6">Regular Expenses</td>
                            <td class="col-xs-6 text-right">{{ currency.symbol }} {{ total_regular_expenses }}</td>
                        </tr>

                        <tr>
                            <td class="col-xs-6">Occassional Expenses</td>
                            <td class="col-xs-6 text-right">{{ currency.symbol }} {{ total_occassional_expenses }}</td>
                        </tr>

                        <tr>
                            <td class="col-xs-6"><strong>MONEY OUT</strong></td>
                            <td class="col-xs-6 text-right">{{ currency.symbol }} {{ money_out }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
           const vm = this;
           vm.getCurrency();
        },

        data () {
            return {
                currency: {}
            };
        },

        props: {
            participant: {
                type: Object
            },
            mimo: {
                type: Object
            }
        },

        computed: {
            total_active_income() {
                const vm = this;
                let total = 0;

                _.each(vm.mimo.content.active_income_default, (income, index) => {
                    total += isNaN(numeral(income.value).value()) ? 0 : numeral(income.value).value();
                });

                _.each(vm.mimo.content.active_income_addon, (income, index) => {
                    total += isNaN(numeral(income.value).value()) ? 0 : numeral(income.value).value();
                });
                    
                return vm.numberWithCommas(total);                
            },

            total_passive_income() {
                const vm = this;
                let total = 0;

                _.each(vm.mimo.content.passive_income_default, (income, index) => {
                    total += isNaN(numeral(income.value).value()) ? 0 : numeral(income.value).value();
                });

                _.each(vm.mimo.content.passive_income_addon, (income, index) => {
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

                _.each(vm.mimo.content.regular_expenses_default, (expense, index) => {
                    total += isNaN(numeral(expense.value).value()) ? 0 : numeral(expense.value).value();
                });

                _.each(vm.mimo.content.regular_expenses_addon, (expense, index) => {
                    total += isNaN(numeral(expense.value).value()) ? 0 : numeral(expense.value).value();
                });
                    
                return vm.numberWithCommas(total);
            },

            total_occassional_expenses() {
                const vm = this;
                let total = 0;

                _.each(vm.mimo.content.occassional_expenses_addon, (expense, index) => {
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

        methods: {
            getCurrency() {
                const vm = this;

                return axios.post('/api/survey/participant/currency', { id: vm.participant.id })
                    .then(response => {
                        vm.currency = response.data;
                    });
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

            numberWithCommas(x) {
                return numeral(x).format('0,0.00');
            }
        }
        
    }
</script>
