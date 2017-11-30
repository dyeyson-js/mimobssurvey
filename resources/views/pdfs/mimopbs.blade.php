{{--  {{ dd($data) }}  --}}

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @if(config('app.env') === "local") 
        <link href="http://localhost:8080/css/pdf.css" rel="stylesheet" >    
    @else
        <link href="{{ asset('css/pdf.css') }}" rel="stylesheet">
    @endif

    <style>
    .page-break {
        page-break-after: always;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-header">
                    <h3 class="text-center">Money In Money Out - Personal Balance Sheet Survey</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <h4>Participant Information</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-bordered table-condensed">
                    <tbody>
                        <tr>
                            <td class="col-xs-2">Name</td>
                            <td class="col-xs-4">{{ $data['full_name'] }}</td>
                            <td class="col-xs-2">Birth Date</td>
                            <td class="col-xs-4">{{ $data['birth_date'] }}</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">Email</td>
                            <td class="col-xs-4">{{ $data['email'] }}</td>
                            <td class="col-xs-2">Phone</td>
                            <td class="col-xs-4">{{ $data['phone_num'] }}</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">City</td>
                            <td class="col-xs-4">{{ $data['city'] }}</td>
                            <td class="col-xs-2">Currency</td>
                            <td class="col-xs-4">{{ $data['currency'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <h4>Personal Finance Assessment</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <table class="table table-bordered table-condensed">
                    <tbody>
                         <tr>
                            <th colspan="2" class="text-center">Adequancy of Emergency Savings</th>
                        </tr>
                        <tr>
                            <td class="col-xs-6">Cash on hand + Time deposit + Money market</td>
                            <td class="col-xs-6 text-right">{{ currency_format($data['actual_emergency_savings'], $data['currency']) }}</td>
                        </tr>
                        <tr>
                            <td class="col-xs-6">9 months’ worth of expenses</td>
                            <td class="col-xs-6 text-right">{{ currency_format($data['total_expenses'], $data['currency']) }}</td>
                        </tr>
                        <tr>
                            <td class="col-xs-6"><strong>{{ $data['emergency_savings_adequancy'] >= 0 ? "Surplus" : "Deficit" }}</strong></td>
                            <td class="col-xs-6 text-right"><strong>{{ currency_format($data['emergency_savings_adequancy'], $data['currency']) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <table class="table table-bordered table-condensed">
                    <tbody>
                        <tr>
                            <th colspan="2" class="text-center">House Budget</th>
                        </tr>
                        <tr>
                            <td class="col-xs-6">House and lot value (domicile)</td>
                            <td class="col-xs-6 text-right">{{ currency_format($data['house_and_lot'], $data['currency']) }}</td>
                        </tr>
                        <tr>
                            <td class="col-xs-6">Ideal house and lot budget – 3 years’ income</td>
                            <td class="col-xs-6 text-right">{{ currency_format($data['ideal_house_and_lot_budget'], $data['currency']) }}</td>
                        </tr>
                        <tr>
                            <td class="col-xs-6"><strong>{{ $data['house_and_lot_budget'] >= 0 ? "Overspend" : "Underspend" }}</strong></td>
                            <td class="col-xs-6 text-right"><strong>{{ currency_format($data['house_and_lot_budget'], $data['currency']) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <table class="table table-bordered table-condensed">
                    <tbody>
                        <tr>
                            <th colspan="2" class="text-center">Ideal Net Worth</th>
                        </tr>
                        <tr>
                            <td class="col-xs-6">Age</td>
                            <td class="col-xs-6 text-right">{{ $data['age'] }} year(s) old</td>
                        </tr>
                        <tr>
                            <td class="col-xs-6">Net Worth Multiplier</td>
                            <td class="col-xs-6 text-right">{{ $data['net_worth_multiplier'] }}</td>
                        </tr>
                        <tr>
                            <td class="col-xs-6">Monthly Income</td>
                            <td class="col-xs-6 text-right">{{ currency_format($data['monthly_income'], $data['currency']) }}</td>
                        </tr>
                        <tr>
                            <td class="col-xs-6"><strong>Ideal Net Worth</strong></td>
                            <td class="col-xs-6 text-right"><strong>{{ $data['ideal_net_worth'] }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <table class="table table-bordered table-condensed">
                    <tbody>
                        <tr>
                            <th colspan="2" class="text-center">Net Worth Age</th>
                        </tr>
                        <tr>
                            <td class="col-xs-6">(a) Actual Net Worth</td>
                            <td class="col-xs-6 text-right">{{ $data['actual_net_worth'] }}</td>
                        </tr>
                        <tr>
                            <td class="col-xs-6">(b) Monthly Income</td>
                            <td class="col-xs-6 text-right">{{ currency_format($data['monthly_income'], $data['currency']) }}</td>
                        </tr>
                        <tr>
                            <td class="col-xs-6">Current net worth age (a/b)</td>
                            <td class="col-xs-6 text-right">{{ $data['actual_net_worth_age'] }} year(s) old</td>                            
                        </tr>
                        <tr>
                            <td class="col-xs-6">Age</td>
                            <td class="col-xs-6 text-right">{{ $data['age'] }} year(s) old</td>
                        </tr>
                        <tr>
                            <td class="col-xs-6"><strong>Number of Years {{ $data['net_worth_age_difference'] >= 0 ? "Advanced" : "Behind" }}</strong></td>
                            <td class="col-xs-6 text-right"><strong>{{ $data['net_worth_age_difference'] }} year(s)</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <table class="table table-bordered table-condensed">
                    <tbody>
                        <tr>
                            <th colspan="2" class="text-center">Financial Life Stage</th>
                        </tr>
                        <tr>
                            <td class="col-xs-6">(a) Monthly passive income</td>
                            <td class="col-xs-6 text-right">{{ currency_format($data['passive_income'], $data['currency']) }}</td>
                        </tr>
                        <tr>
                            <td class="col-xs-6">(b) Monthly expenses</td>
                            <td class="col-xs-6 text-right">{{ currency_format($data['total_expenses'], $data['currency']) }}</td>
                        </tr>
                        <tr>
                            <td class="col-xs-6">Percentage (a/b)</td>
                            <td class="col-xs-6 text-right">{{ $data['life_stage_percentage'] }} %</td>                            
                        </tr>
                        <tr>
                            <td class="col-xs-6"><strong>Financial Life Stage</strong></td>
                            <td class="col-xs-6 text-right"><strong>{{ $data['life_stage'] }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <table class="table table-bordered table-condensed">
                    <tbody>
                        <tr>
                            <th colspan="2" class="text-center">Financial Life Age</th>
                        </tr>
                        <tr>
                            <td class="col-xs-6">(a) Current financial life stage age</td>
                            <td class="col-xs-6 text-right">{{ $data['actual_life_stage_age'] }} year(s) old</td>
                        </tr>
                        <tr>
                            <td class="col-xs-6">(b) Biological age</td>
                            <td class="col-xs-6 text-right">{{ $data['age'] }} year(s) old</td>
                        </tr>
                        <tr>
                            <td class="col-xs-6"><strong>Number of Years {{ $data['life_stage_age_difference'] >= 0 ? "Advanced" : "Behind" }}</strong></td>
                            <td class="col-xs-6 text-right"><strong>{{ $data['life_stage_age_difference'] }} year(s)</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <p class="text-center">--- Nothing Follows ---</p>
            </div>
        </div>
    </div>
</body>
</html>
