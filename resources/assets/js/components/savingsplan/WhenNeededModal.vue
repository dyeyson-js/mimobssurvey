<template>
    <form @submit.prevent="formSubmit">
        <div class="modal fade" tabindex="-1" role="dialog" :id="'when-needed-modal-' + index">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">When Needed ?</h4>
                    <small>{{ value.goal_name || 'Short Term Goal' }}</small>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>From</label>
                                <div class="input-group">
                                    <span class="input-group-addon">Year</span>
                                    <input type="number" class="form-control" placeholder="0" v-model="from"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>To</label>
                                <div class="input-group">
                                    <span class="input-group-addon">Year</span>
                                    <input type="number" class="form-control" placeholder="0" v-model="to"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Month</label>
                                <select class="form-control" v-model="month">
                                    <template v-for="(month, index) in month_options">
                                        <option :key="index">{{ month }}</option>
                                    </template>
                                </select>
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
                    $('#when-needed-modal-' + vm.index).on('shown.bs.modal', function () {
                        vm.from = vm.value.when_needed.from;
                        vm.to = vm.value.when_needed.to;
                        vm.month = vm.value.when_needed.month;
                    });
                }, 1000)
            });
        },

        data (){
            return {
                from: '',
                to: '',
                month: ''
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
            }
        },

        computed: {
            month_options() {
                return [
                    '', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
                ];
            }
        },

        methods: {
            formSubmit() {
                $('#when-needed-modal-' + this.index).modal('hide')
                return this.updateValue('when_needed', {
                    from: this.from,
                    to: this.to,
                    month: this.month
                });
            } 
        }
        
    }
</script>
