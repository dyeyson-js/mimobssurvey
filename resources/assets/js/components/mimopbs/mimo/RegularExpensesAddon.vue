<template>
    <div class="row">
        <div class="col-md-12 form-group text-right">
            <a role="button" @click="removeRegularExpenses(index)"><small>Remove</small></a>
        </div>
        <div class="col-md-6">
            <div class="form-group" :class="{ 'has-error': getError(`regular_expenses_addon.${index}.label`) }">
                <input type="text" class="form-control" v-model="data.label" placeholder="Other Regular Expense"/>
                <small class="help-block">{{ getError(`regular_expenses_addon.${index}.label`) }}</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" :class="{ 'has-error': getError(`regular_expenses_addon.${index}.value`) }">
                <div class="input-group">
                    <span class="input-group-addon">{{ currency.symbol || '' }}</span>
                    <input type="number" class="form-control text-right" v-model="data.value" placeholder="0.00"/>
                </div>
                <small class="help-block">{{ getError(`regular_expenses_addon.${index}.value`) }}</small>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
           
        },

        props: {
            data: {
                type: Object
            },
            currency: {
                type: Object
            },
            index: {
                type: Number
            },
            errors: {
                type: Object,
                default: []
            },
            removeRegularExpenses: {
                type: Function
            }
        },

        methods: {
            getError(field) {
                const vm = this;
                
                return vm.errors.hasOwnProperty('errors') ? 
                    vm.errors.errors.hasOwnProperty(field) ? vm.errors.errors[field][0] : null
                    : null; 
            }
        }
        
    }
</script>
