<template>
    <div class="row">
        <div class="col-md-12 form-group text-right">
            <a role="button" @click="removeOccassionalExpenses(index)"><small>Remove</small></a>
        </div>
        <div class="col-md-4">
            <div class="form-group" :class="{ 'has-error': getError(`occassional_expenses_addon.${index}.label`) }">
                <input type="text" class="form-control" v-model="data.label" placeholder="Other Active Income"/>
                <small class="help-block">{{ getError(`occassional_expenses_addon.${index}.label`) }}</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group" :class="{ 'has-error': getError(`occassional_expenses_addon.${index}.value`) }">
                <div class="input-group">
                    <span class="input-group-addon">{{ currency.symbol || '' }}</span>
                    <input type="number" class="form-control text-right" v-model="data.value" placeholder="0.00"/>
                </div>
                <small class="help-block">{{ getError(`occassional_expenses_addon.${index}.value`) }}</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group" :class="{ 'has-error': getError(`occassional_expenses_addon.${index}.frequency`) }">
                <select class="form-control" v-model="data.frequency">   
                    <template v-for="(frequency, index) in frequencies">
                        <option :key="index" :value="frequency">{{frequency.label}}</option>
                    </template>
                </select><small class="help-block">{{ getError(`occassional_expenses_addon.${index}.frequency`) }}</small>
            </div>
        </div>
        <div class="col-md-12 form-group">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    import frequencies from './frequencies';

    export default {
        mounted() {
           
        },

        data () {
            return {
                frequencies
            };
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
            removeOccassionalExpenses: {
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
