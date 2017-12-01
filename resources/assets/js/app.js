
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

Vue.component('mimopbs', require('./components/mimopbs/SurveyIndex.vue'));
Vue.component('mimopbs-start', require('./components/mimopbs/SurveyStart.vue'));
Vue.component('mimopbs-participant', require('./components/mimopbs/SurveyParticipant.vue'));
Vue.component('mimopbs-mimo', require('./components/mimopbs/SurveyMimo.vue'));
Vue.component('mimopbs-pbs', require('./components/mimopbs/SurveyBalanceSheet.vue'));
Vue.component('mimopbs-summary', require('./components/mimopbs/SurveySummary.vue'));
Vue.component('mimopbs-result', require('./components/mimopbs/SurveyResult.vue'));

Vue.component('active-income-default', require('./components/mimopbs/mimo/ActiveIncomeDefault.vue'));
Vue.component('active-income-addon', require('./components/mimopbs/mimo/ActiveIncomeAddon.vue'));
Vue.component('passive-income-default', require('./components/mimopbs/mimo/PassiveIncomeDefault.vue'));
Vue.component('passive-income-addon', require('./components/mimopbs/mimo/PassiveIncomeAddon.vue'));
Vue.component('regular-expenses-default', require('./components/mimopbs/mimo/RegularExpensesDefault.vue'));
Vue.component('regular-expenses-addon', require('./components/mimopbs/mimo/RegularExpensesAddon.vue'));
Vue.component('occassional-expenses-addon', require('./components/mimopbs/mimo/OccassionalExpensesAddon.vue'));

Vue.component('current-asset-default', require('./components/mimopbs/pbs/CurrentAssetDefault.vue'));
Vue.component('current-asset-addon', require('./components/mimopbs/pbs/CurrentAssetAddon.vue'));
Vue.component('longterm-asset-default', require('./components/mimopbs/pbs/LongtermAssetDefault.vue'));
Vue.component('longterm-asset-addon', require('./components/mimopbs/pbs/LongtermAssetAddon.vue'));
Vue.component('current-liabilities-default', require('./components/mimopbs/pbs/CurrentLiabilitiesDefault.vue'));
Vue.component('current-liabilities-addon', require('./components/mimopbs/pbs/CurrentLiabilitiesAddon.vue'));
Vue.component('longterm-liabilities-default', require('./components/mimopbs/pbs/LongtermLiabilitiesDefault.vue'));
Vue.component('longterm-liabilities-addon', require('./components/mimopbs/pbs/LongtermLiabilitiesAddon.vue'));

Vue.component('participant-summary', require('./components/mimopbs/summary/ParticipantSummary.vue'));
Vue.component('mimo-summary', require('./components/mimopbs/summary/MimoSummary.vue'));
Vue.component('pbs-summary', require('./components/mimopbs/summary/BalanceSheetSummary.vue'));

Vue.component('savingsplan', require('./components/savingsplan/SurveyIndex.vue'));
Vue.component('savingsplan-start', require('./components/savingsplan/SurveyStart.vue'));
Vue.component('savingsplan-participant', require('./components/savingsplan/SurveyParticipant.vue'));
Vue.component('savingsplan-survey', require('./components/savingsplan/SurveySavingsPlan.vue'));

Vue.component('short-term-goal', require('./components/savingsplan/ShortTermGoal.vue'));
Vue.component('when-needed-modal', require('./components/savingsplan/WhenNeededModal.vue'));
Vue.component('amount-frequency-modal', require('./components/savingsplan/AmountFrequency.vue'));

Vue.component('common-header', require('./components/common/Header.vue'));
Vue.component('common-content', require('./components/common/Content.vue'));

const app = new Vue({
    el: '#app'
});
