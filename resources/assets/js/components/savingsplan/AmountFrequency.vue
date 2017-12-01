<template>
    <form @submit.prevent="formSubmit">
        <div class="modal fade" tabindex="-1" role="dialog" :id="'amount-frequency-modal-' + index">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Amount and Frequency of Savings</h4>
                        <small>{{ value.goal_name || 'Short Term Goal' }}</small>
                    </div>
                    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">{{ currency.symbol || '' }}</span>
                                        <input type="number" class="form-control text-right" placeholder="0" v-model="amount"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Frequency</label>
                                    <select class="form-control" v-model="frequency">
                                        <template v-for="(frequency, index) in frequency_options">
                                            <option :key="index">{{ frequency }}</option>
                                        </template>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div v-if="frequency === 'Custom'" class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Custom Frequency</label>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <input type="number" class="form-control text-right" placeholder="0" v-model="custom_frequency.value"/>                                        
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <select class="form-control" v-model="custom_frequency.frequency">
                                                <template v-for="(frequency, index) in frequency_options">
                                                    <option :key="index">{{ frequency }}</option>
                                                </template>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </form>
</template>

<script>
    export default {
        mounted() {
            const vm = this;
            $(window).ready(() => {
                setTimeout(() => {
                    $('#amount-frequency-modal-' + vm.index).on('shown.bs.modal', function () {
                      
                    });
                }, 1000)
            });
        },

        data (){
            return {
                amount: '',
                frequency: '',
                custom_frequency: {
                    value: '',
                    frequency: ''
                }
            };
        },

        props:{
            index: {
                type: Number
            },
            value: {
                type: Object
            },
            updateValue: {
                type: Function
            },
            currency: {
                type: Object
            }
        },

        computed: {
            frequency_options() {
                return [
                    '', 'Daily', 'Weekly', 'Monthly', 'Yearly', 'Custom'
                ];
            },

            custom_frequency_options() {
                return [
                    '', 'Days', 'Weeks', 'Months', 'Years'
                ];
            }
        },

        methods: {
            formSubmit() {
                $('#amount-frequency-modal-' + this.index).modal('hide')
                return this.updateValue('when_needed', {
                    from: this.from,
                    to: this.to,
                    month: this.month
                });
            } 
        }
        
    }
</script>
