<template>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-center">Participant Information</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-xs-6">Full Name</td>
                            <td class="col-xs-6">{{ participant.first_name }} {{ participant.last_name }}</td>
                        </tr>
                        <tr>
                            <td class="col-xs-6">Birth Date</td>
                            <td class="col-xs-6">{{ _momentFormat(participant.birth_date) }}</td>
                        </tr>
                        <tr>
                            <td class="col-xs-6">Email Address</td>
                            <td class="col-xs-6">{{ participant.email }}</td>
                        </tr>
                        <tr>
                            <td class="col-xs-6">Mobile Number</td>
                            <td class="col-xs-6">{{ participant.phone_num }}</td>
                        </tr>
                        <tr>
                            <td class="col-xs-6">City</td>
                            <td class="col-xs-6">{{ participant.city }}</td>
                        </tr>
                        <tr>
                            <td class="col-xs-6">Currency</td>
                            <td class="col-xs-6">{{ participant.currency }}</td>
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
           
        },

        props: {
            participant: {
                type: Object
            }
        },

        methods: {
            _momentFormat(date) {
                return moment(date).format("MM/DD/YYYY");
            },
        }
        
    }
</script>
