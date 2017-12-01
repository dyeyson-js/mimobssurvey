<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="text-left">{{ value.goal_name || "Short Term Goal"}}</div>
                            </div>
                            <div class="col-xs-6">
                                <div class="text-right">Priority: {{ index + 1 }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Goal</label>
                                    <input type="text" class="form-control" placeholder="Buy New Clothes" :value="value.goal_name" @input="updateValue('goal_name' ,$event.target.value)"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">{{ currency.symbol || '' }}</span>
                                        <input type="number" class="form-control text-right" placeholder="0.00" :value="value.amount" @input="updateValue('amount' ,$event.target.value)"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>When Needed ?</label>  
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Year 1" readonly="true" :value="when_needed_value"/>
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" data-toggle="modal" :data-target="'#when-needed-modal-' + index">&nbsp;<i class="fa fa-pencil-square-o"></i>&nbsp;</button>
                                        </span>
                                    </div>                                                      
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Amount and Frequency of Savings</label>  
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Year 1" readonly="true" value="fadfds"/>
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" data-toggle="modal" :data-target="'#amount-frequency-modal-' + index">&nbsp;<i class="fa fa-pencil-square-o"></i>&nbsp;</button>
                                        </span>
                                    </div>                                                      
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-xs-6 text-left">
                                Change Priority:
                            </div>
                            <div class="col-xs-6 text-right">
                                <a role="button" class="text-danger">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <when-needed-modal 
            :index="index"
            :value="value"
            :update-value="updateValue"
        />
        <amount-frequency-modal
            :index="index"
            :value="value"
            :currency="currency"
            :update-value="updateValue"
        />
    </div>
</template>

<script>
    export default {
        mounted() {
           
        },

        props: {
            currency: {
                type: Object
            },
            value: {
                type: Object
            },
            index: {
                type: Number
            }
        },

        computed: {
            when_needed_value() {
                let text = '';
                text += this.value.when_needed.month !== '' ? this.value.when_needed.month + ' ' : '';
                text += this.value.when_needed.from !== '' ? 'Year ' + this.value.when_needed.from : '';
                text += this.value.when_needed.to !== '' ? ' - Year ' + this.value.when_needed.to : '';
                return text;   
            }
        },

        methods: {
            updateValue(field, value) {
                let obj = {};
                obj[field] = value;
                this.$emit('input', Object.assign(this.value, obj));
                console.log('heya');
            }
        }
    }
</script>
