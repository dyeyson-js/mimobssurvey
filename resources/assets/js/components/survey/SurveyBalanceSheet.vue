<template>
    <div>
        <common-header>
            Money In Money Out - Personal Balance Sheet Survey
        </common-header>
        
        <common-content>
            <form @submit.prevent="formSubmit" id="survey-balance-sheet-form">
                <div v-if="errors.message" class="alert alert-danger">
                    {{ errors.message }}
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <fieldset>
                            <legend>Personal Balance Sheet (Step 3 of 3)</legend>
                            
                            <!-- Currenct Assets -->

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <h4 class="text-center"><strong>Current Assets</strong></h4>
                                </div>
                            </div>

                            <template v-for="(asset, index) in data.current_assets_default">
                                <current-asset-default :key="index" :index="index" :data="asset" :currency="currency" :errors="errors" />
                            </template>

                            <div class="row">
                                <div class="col-md-12">
                                    <h5><strong>Others:</strong> <a v-if="data.current_assets_addon.length < 5" role="button" class="btn btn-link" @click="addCurrentAsset"><small>Add Current Asset</small></a></h5>
                                </div>
                            </div>

                            <template v-for="(asset, index) in data.current_assets_addon">
                                <current-asset-addon :key="index" :index="index" :data="asset" :currency="currency" :errors="errors" :removeCurrentAsset="removeCurrentAsset"/>
                            </template>

                            <hr />

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <p><strong>Total Current Assets</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><strong>{{ currency.symbol }}</strong></p>
                                    <p class="pull-right"><strong>{{ total_current_assets }}</strong></p>
                                </div>
                            </div>

                            <!-- Longterm Assets -->
                            
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <h4 class="text-center"><strong>Longterm Assets</strong></h4>
                                </div>
                            </div>

                            <template v-for="(asset, index) in data.longterm_assets_default">
                                <longterm-asset-default :key="index" :index="index" :data="asset" :currency="currency" :errors="errors" />
                            </template>

                            <div class="row">
                                <div class="col-md-12">
                                    <h5><strong>Others:</strong> <a v-if="data.longterm_assets_addon.length < 5" role="button" class="btn btn-link" @click="addLongtermAsset"><small>Add Longterm Asset</small></a></h5>
                                </div>
                            </div>

                            <template v-for="(asset, index) in data.longterm_assets_addon">
                                <longterm-asset-addon :key="index" :index="index" :data="asset" :currency="currency" :errors="errors" :removeLongtermAsset="removeLongtermAsset"/>
                            </template>

                            <hr />

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <p><strong>Total Longterm Assets</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><strong>{{ currency.symbol }}</strong></p>
                                    <p class="pull-right"><strong>{{ total_longterm_assets }}</strong></p>
                                </div>
                            </div>

                            <!-- Total Assets -->

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <h4 class="text-center"><strong>Total Assets</strong></h4>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <p><strong>Total Current Assets</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><strong>{{ currency.symbol }}</strong></p>
                                    <p class="pull-right"><strong>{{ total_current_assets }}</strong></p>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <p><strong>Total Longterm Assets</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><strong>{{ currency.symbol }}</strong></p>
                                    <p class="pull-right"><strong>{{ total_longterm_assets }}</strong></p>
                                </div>
                            </div>

                            <hr />

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <p><strong>Total Assets</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><strong>{{ currency.symbol }}</strong></p>
                                    <p class="pull-right"><strong>{{ total_assets }}</strong></p>
                                </div>
                            </div>

                            <!-- Current Liabilities -->
                            
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <h4 class="text-center"><strong>Current Liabilities</strong></h4>
                                </div>
                            </div>

                            <template v-for="(liabilities, index) in data.current_liabilities_default">
                                <current-liabilities-default :key="index" :index="index" :data="liabilities" :currency="currency" :errors="errors" />
                            </template>

                            <div class="row">
                                <div class="col-md-12">
                                    <h5><strong>Others:</strong> <a v-if="data.current_liabilities_addon.length < 5" role="button" class="btn btn-link" @click="addCurrentLiabilities"><small>Add Current Liability </small></a></h5>
                                </div>
                            </div>

                            <template v-for="(liabilities, index) in data.current_liabilities_addon">
                                <current-liabilities-addon :key="index" :index="index" :data="liabilities" :currency="currency" :errors="errors" :removeCurrentLiabilities="removeCurrentLiabilities"/>
                            </template>

                            <hr />

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <p><strong>Total Current Liabilities</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><strong>{{ currency.symbol }}</strong></p>
                                    <p class="pull-right"><strong>{{ total_current_liabilities }}</strong></p>
                                </div>
                            </div>

                            <!-- Longterm Liabilities -->
                            
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <h4 class="text-center"><strong>Longterm Liabilities</strong></h4>
                                </div>
                            </div>

                            <template v-for="(liabilities, index) in data.longterm_liabilities_default">
                                <longterm-liabilities-default :key="index" :index="index" :data="liabilities" :currency="currency" :errors="errors" />
                            </template>

                            <div class="row">
                                <div class="col-md-12">
                                    <h5><strong>Others:</strong> <a v-if="data.longterm_liabilities_addon.length < 5" role="button" class="btn btn-link" @click="addLongtermLiabilities"><small>Add Longterm Liability </small></a></h5>
                                </div>
                            </div>
                            
                            <template v-for="(liabilities, index) in data.longterm_liabilities_addon">
                                <longterm-liabilities-addon :key="index" :index="index" :data="liabilities" :currency="currency" :errors="errors" :removeLongtermLiabilities="removeLongtermLiabilities"/>
                            </template>

                            <hr />

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <p><strong>Total Longterm Liabilities</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><strong>{{ currency.symbol }}</strong></p>
                                    <p class="pull-right"><strong>{{ total_longterm_liabilities }}</strong></p>
                                </div>
                            </div>

                            <!-- Total Liabilities -->

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <h4 class="text-center"><strong>Total Liabilities</strong></h4>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <p><strong>Current Liabilities</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><strong>{{ currency.symbol }}</strong></p>
                                    <p class="pull-right"><strong>{{ total_current_liabilities }}</strong></p>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <p><strong>Longterm Liabilities</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><strong>{{ currency.symbol }}</strong></p>
                                    <p class="pull-right"><strong>{{ total_longterm_liabilities }}</strong></p>
                                </div>
                            </div>

                            <hr />

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <p><strong>Total Liabilities</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><strong>{{ currency.symbol }}</strong></p>
                                    <p class="pull-right"><strong>{{ total_liabilities }}</strong></p>
                                </div>
                            </div>

                            <!-- Net Worth -->

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <h4 class="text-center"><strong>Net Worth</strong></h4>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <p><strong>Total Assets</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><strong>{{ currency.symbol }}</strong></p>
                                    <p class="pull-right"><strong>{{ total_assets }}</strong></p>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <p><strong>Total Liabilities</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><strong>{{ currency.symbol }}</strong></p>
                                    <p class="pull-right"><strong>{{ total_liabilities }}</strong></p>
                                </div>
                            </div>

                            <hr />

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <p><strong>Net Worth</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><strong>{{ currency.symbol }}</strong></p>
                                    <p class="pull-right"><strong>{{ net_worth }}</strong></p>
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
    import pbsfields from './pbs/balancesheet';

    export default {
        mounted() {
            const vm = this;
            vm.getCurrency();
            vm.data.participant_id = vm.participant.id;
        },

        data () {
            return {
                data: this.pbs.content || pbsfields,
                errors: {},
                is_loading: false,
                currency: {}
            };
        },

        computed: {     
            is_loading_button () {
                return this.is_loading ? 'Please wait' : 'Continue' ;
            },

            total_current_assets() {
                const vm = this;
                let total = 0;

                _.each(vm.data.current_assets_default, (asset, index) => {
                    total += isNaN(numeral(asset.value).value()) ? 0 : numeral(asset.value).value();
                });

                _.each(vm.data.current_assets_addon, (asset, index) => {
                    total += isNaN(numeral(asset.value).value()) ? 0 : numeral(asset.value).value();
                });
                    
                return vm.numberWithCommas(total);                
            },

            total_longterm_assets() {
                const vm = this;
                let total = 0;

                _.each(vm.data.longterm_assets_default, (asset, index) => {
                    total += isNaN(numeral(asset.value).value()) ? 0 : numeral(asset.value).value();
                });

                _.each(vm.data.longterm_assets_addon, (asset, index) => {
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

                _.each(vm.data.current_liabilities_default, (liability, index) => {
                    total += isNaN(numeral(liability.value).value()) ? 0 : numeral(liability.value).value();
                });

                _.each(vm.data.current_liabilities_addon, (liability, index) => {
                    total += isNaN(numeral(liability.value).value()) ? 0 : numeral(liability.value).value();
                });
                    
                return vm.numberWithCommas(total);                
            },

            total_longterm_liabilities() {
                const vm = this;
                let total = 0;

                _.each(vm.data.longterm_liabilities_default, (liability, index) => {
                    total += isNaN(numeral(liability.value).value()) ? 0 : numeral(liability.value).value();
                });

                _.each(vm.data.longterm_liabilities_addon, (liability, index) => {
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

        props: {
            getBalanceSheet: {
                type: Function
            },
            participant: {
                type: Object
            },
            pbs: {
                type: Object
            }
        },

        methods: {
            getCurrency() {
                const vm = this;

                return axios.post('/survey/participant/currency', { id: vm.participant.id })
                    .then(response => {
                        vm.currency = response.data;
                    });
            },

            addCurrentAsset() {
                const vm = this;
                const newCurrentAsset = {
                    label: '',
                    value: ''
                };

                return vm.data.current_assets_addon.push(newCurrentAsset);
            },  

            removeCurrentAsset(targetIndex) {
                const vm = this;                
                const updatedCurrentAssetsArray = vm.data.current_assets_addon.filter((item, index) => index !== targetIndex);
                return vm.data.current_assets_addon = updatedCurrentAssetsArray;
            },

            addLongtermAsset() {
                const vm = this;
                const newLongtermAsset = {
                    label: '',
                    value: ''
                };

                return vm.data.longterm_assets_addon.push(newLongtermAsset);
            },  

            removeLongtermAsset(targetIndex) {
                const vm = this;                
                const updatedLongtermAssetsArray = vm.data.longterm_assets_addon.filter((item, index) => index !== targetIndex);
                return vm.data.longterm_assets_addon = updatedLongtermAssetsArray;
            },

            addCurrentLiabilities() {
                const vm = this;
                const newCurrentLiabilities = {
                    label: '',
                    value: ''
                };

                return vm.data.current_liabilities_addon.push(newCurrentLiabilities);
            },  

            removeCurrentLiabilities(targetIndex) {
                const vm = this;                
                const updateCurrentLiabillitiesArrray = vm.data.current_liabilities_addon.filter((item, index) => index !== targetIndex);
                return vm.data.current_liabilities_addon = updateCurrentLiabillitiesArrray;
            },

            addLongtermLiabilities() {
                const vm = this;
                const newLongtermLiabilities = {
                    label: '',
                    value: ''
                };

                return vm.data.longterm_liabilities_addon.push(newLongtermLiabilities);
            },  

            removeLongtermLiabilities(targetIndex) {
                const vm = this;                
                const updatedLongtermLiabilitiesArray = vm.data.longterm_liabilities_addon.filter((item, index) => index !== targetIndex);
                return vm.data.longterm_liabilities_addon = updatedLongtermLiabilitiesArray;
            },

            formSubmit() {
                const vm = this;
                const formData = vm.data;
                
                vm.is_loading = true;
                vm.errors = {};

                setTimeout(() => {
                    if(vm.pbs.id) {
                        return axios.put(`/survey/balance-sheet/${vm.pbs.id}`, formData)
                        .then(response => {
                            vm.is_loading = false;
                            vm.getBalanceSheet(response.data.bs);
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

                    return axios.post('/survey/balance-sheet', formData)
                        .then(response => {
                            vm.is_loading = false;
                            vm.getBalanceSheet(response.data.bs);
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
