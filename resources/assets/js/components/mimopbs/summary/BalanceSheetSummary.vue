<template>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-center">Personal Balancesheet</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- current assets -->
                        
                        <tr>
                            <td colspan="2" class="text-center">Current Assets</td>
                        </tr>

                        <template v-for="(item, index) in pbs.content.current_assets_default">
                            <tr :key="index">
                                <td class="col-xs-6">{{ item.label }}</td>
                                <td class="col-xs-6 text-right">{{ currency.symbol }} {{ numberWithCommas(item.value) }}</td>
                            </tr>
                        </template>

                        <template v-for="(item, index) in pbs.content.current_assets_addon">
                            <tr :key="index">
                                <td class="col-xs-6">{{ item.label }}</td>
                                <td class="col-xs-6 text-right">{{ currency.symbol }} {{ numberWithCommas(item.value) }}</td>
                            </tr>
                        </template>
                        
                        <tr>
                            <td class="col-xs-6"><strong>TOTAL CURRENT ASSETS</strong></td>
                            <td class="col-xs-6 text-right"><strong>{{ currency.symbol }} {{ total_current_assets }}</strong></td>
                        </tr>

                        <!-- longterm assets -->

                        <tr>
                            <td colspan="2" class="text-center">Passive Income</td>
                        </tr>

                        <template v-for="(item, index) in pbs.content.longterm_assets_default">
                            <tr :key="index">
                                <td class="col-xs-6">{{ item.label }}</td>
                                <td class="col-xs-6 text-right">{{ currency.symbol }} {{ numberWithCommas(item.value) }}</td>
                            </tr>
                        </template>

                        <template v-for="(item, index) in pbs.content.longterm_assets_addon">
                            <tr :key="index">
                                <td class="col-xs-6">{{ item.label }}</td>
                                <td class="col-xs-6 text-right">{{ currency.symbol }} {{ numberWithCommas(item.value) }}</td>
                            </tr>
                        </template>
                        
                        <tr>
                            <td class="col-xs-6"><strong>TOTAL LONGTERM ASSETS</strong></td>
                            <td class="col-xs-6 text-right"><strong>{{ currency.symbol }} {{ total_longterm_assets }}</strong></td>
                        </tr>

                        <!-- Total Assets -->

                        <tr>
                            <td colspan="2" class="text-center">Total Assets</td>
                        </tr>

                        <tr>
                            <td class="col-xs-6">Current Assets</td>
                            <td class="col-xs-6 text-right">{{ currency.symbol }} {{ total_current_assets }}</td>
                        </tr>

                        <tr>
                            <td class="col-xs-6">Longterm Assets</td>
                            <td class="col-xs-6 text-right">{{ currency.symbol }} {{ total_longterm_assets }}</td>
                        </tr>

                        <tr>
                            <td class="col-xs-6"><strong>TOTAL ASSETS</strong></td>
                            <td class="col-xs-6 text-right">{{ currency.symbol }} {{ total_assets }}</td>
                        </tr>

                        <!-- Current Liabilities -->
                        
                        <tr>
                            <td colspan="2" class="text-center">Current Liabilities</td>
                        </tr>

                        <template v-for="(item, index) in pbs.content.current_liabilities_default">
                            <tr :key="index">
                                <td class="col-xs-6">{{ item.label }}</td>
                                <td class="col-xs-6 text-right">{{ currency.symbol }} {{ numberWithCommas(item.value) }}</td>
                            </tr>
                        </template>

                        <template v-for="(item, index) in pbs.content.current_liabilities_addon">
                            <tr :key="index">
                                <td class="col-xs-6">{{ item.label }}</td>
                                <td class="col-xs-6 text-right">{{ currency.symbol }} {{ numberWithCommas(item.value) }}</td>
                            </tr>
                        </template>
                        
                        <tr>
                            <td class="col-xs-6"><strong>TOTAL CURRENT LIABILITIES</strong></td>
                            <td class="col-xs-6 text-right"><strong>{{ currency.symbol }} {{ total_current_liabilities }}</strong></td>
                        </tr>

                        <!-- Longterm Liabilities -->
                        
                        <tr>
                            <td colspan="2" class="text-center">Longterm Liabilities</td>
                        </tr>

                        <template v-for="(item, index) in pbs.content.longterm_liabilities_default">
                            <tr :key="index">
                                <td class="col-xs-6">{{ item.label }}</td>
                                <td class="col-xs-6 text-right">{{ currency.symbol }} {{ numberWithCommas(item.value) }}</td>
                            </tr>
                        </template>

                        <template v-for="(item, index) in pbs.content.longterm_liabilities_addon">
                            <tr :key="index">
                                <td class="col-xs-6">{{ item.label }}</td>
                                <td class="col-xs-6 text-right">{{ currency.symbol }} {{ numberWithCommas(item.value) }}</td>
                            </tr>
                        </template>
                        
                        <tr>
                            <td class="col-xs-6"><strong>TOTAL LONGTERM LIABILITIES</strong></td>
                            <td class="col-xs-6 text-right"><strong>{{ currency.symbol }} {{ total_longterm_liabilities }}</strong></td>
                        </tr>

                        <!-- Total Liabilities -->

                        <tr>
                            <td colspan="2" class="text-center">Total Liabilities</td>
                        </tr>

                        <tr>
                            <td class="col-xs-6">Current Liabilities</td>
                            <td class="col-xs-6 text-right">{{ currency.symbol }} {{ total_current_liabilities }}</td>
                        </tr>

                        <tr>
                            <td class="col-xs-6">Longterm Liabilities</td>
                            <td class="col-xs-6 text-right">{{ currency.symbol }} {{ total_longterm_liabilities }}</td>
                        </tr>

                        <tr>
                            <td class="col-xs-6"><strong>TOTAL LIABILITIES</strong></td>
                            <td class="col-xs-6 text-right">{{ currency.symbol }} {{ total_liabilities }}</td>
                        </tr>

                        <!-- Net Worth -->

                        <tr>
                            <td colspan="2" class="text-center">Net Worth</td>
                        </tr>

                        <tr>
                            <td class="col-xs-6">Total Assets</td>
                            <td class="col-xs-6 text-right">{{ currency.symbol }} {{ total_assets }}</td>
                        </tr>

                        <tr>
                            <td class="col-xs-6">Total Liabilities</td>
                            <td class="col-xs-6 text-right">{{ currency.symbol }} {{ total_liabilities }}</td>
                        </tr>

                        <tr>
                            <td class="col-xs-6"><strong>NET WORTH</strong></td>
                            <td class="col-xs-6 text-right">{{ currency.symbol }} {{ net_worth }}</td>
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
            pbs: {
                type: Object
            }
        },

        computed: {
            total_current_assets() {
                const vm = this;
                let total = 0;

                _.each(vm.pbs.content.current_assets_default, (asset, index) => {
                    total += isNaN(numeral(asset.value).value()) ? 0 : numeral(asset.value).value();
                });

                _.each(vm.pbs.content.current_assets_addon, (asset, index) => {
                    total += isNaN(numeral(asset.value).value()) ? 0 : numeral(asset.value).value();
                });
                    
                return vm.numberWithCommas(total);                
            },

            total_longterm_assets() {
                const vm = this;
                let total = 0;

                _.each(vm.pbs.content.longterm_assets_default, (asset, index) => {
                    total += isNaN(numeral(asset.value).value()) ? 0 : numeral(asset.value).value();
                });

                _.each(vm.pbs.content.longterm_assets_addon, (asset, index) => {
                    total += isNaN(numeral(asset.value).value()) ? 0 : numeral(asset.value).value();
                });
                    
                return vm.numberWithCommas(total);                
            },

            total_assets() {
                const vm = this;
                let total = numeral(vm.total_current_assets).value() + numeral(vm.total_longterm_assets).value();                
                return vm.numberWithCommas(total);
            },

            total_current_liabilities() {
                const vm = this;
                let total = 0;

                _.each(vm.pbs.content.current_liabilities_default, (liability, index) => {
                    total += isNaN(numeral(liability.value).value()) ? 0 : numeral(liability.value).value();
                });

                _.each(vm.pbs.content.current_liabilities_addon, (liability, index) => {
                    total += isNaN(numeral(liability.value).value()) ? 0 : numeral(liability.value).value();
                });
                    
                return vm.numberWithCommas(total);                
            },

            total_longterm_liabilities() {
                const vm = this;
                let total = 0;

                _.each(vm.pbs.content.longterm_liabilities_default, (liability, index) => {
                    total += isNaN(numeral(liability.value).value()) ? 0 : numeral(liability.value).value();
                });

                _.each(vm.pbs.content.longterm_liabilities_addon, (liability, index) => {
                    total += isNaN(numeral(liability.value).value()) ? 0 : numeral(liability.value).value();
                });
                    
                return vm.numberWithCommas(total);                
            },

            total_liabilities() {
                const vm = this;
                let total = numeral(vm.total_current_liabilities).value() + numeral(vm.total_longterm_liabilities).value();                
                return vm.numberWithCommas(total);
            },

            net_worth() {
                const vm = this;
                let total = numeral(vm.total_assets).value() - numeral(vm.total_liabilities).value();                
                return vm.numberWithCommas(total);
            },
        },

        methods: {
            getCurrency() {
                const vm = this;

                return axios.post('/survey/participant/currency', { id: vm.participant.id })
                    .then(response => {
                        vm.currency = response.data;
                    });
            },

            numberWithCommas(x) {
                return numeral(x).format('0,0.00');
            }
        }
        
    }
</script>
