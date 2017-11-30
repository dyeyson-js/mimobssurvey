
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

Vue.component('survey', require('./components/survey/SurveyIndex.vue'));
Vue.component('survey-start', require('./components/survey/SurveyStart.vue'));
Vue.component('survey-participant', require('./components/survey/SurveyParticipant.vue'));
Vue.component('survey-mimo', require('./components/survey/SurveyMimo.vue'));
Vue.component('survey-pbs', require('./components/survey/SurveyBalanceSheet.vue'));
Vue.component('survey-summary', require('./components/survey/SurveySummary.vue'));
Vue.component('survey-result', require('./components/survey/SurveyResult.vue'));

Vue.component('active-income-default', require('./components/survey/mimo/ActiveIncomeDefault.vue'));
Vue.component('active-income-addon', require('./components/survey/mimo/ActiveIncomeAddon.vue'));
Vue.component('passive-income-default', require('./components/survey/mimo/PassiveIncomeDefault.vue'));
Vue.component('passive-income-addon', require('./components/survey/mimo/PassiveIncomeAddon.vue'));
Vue.component('regular-expenses-default', require('./components/survey/mimo/RegularExpensesDefault.vue'));
Vue.component('regular-expenses-addon', require('./components/survey/mimo/RegularExpensesAddon.vue'));
Vue.component('occassional-expenses-addon', require('./components/survey/mimo/OccassionalExpensesAddon.vue'));

Vue.component('current-asset-default', require('./components/survey/pbs/CurrentAssetDefault.vue'));
Vue.component('current-asset-addon', require('./components/survey/pbs/CurrentAssetAddon.vue'));
Vue.component('longterm-asset-default', require('./components/survey/pbs/LongtermAssetDefault.vue'));
Vue.component('longterm-asset-addon', require('./components/survey/pbs/LongtermAssetAddon.vue'));
Vue.component('current-liabilities-default', require('./components/survey/pbs/CurrentLiabilitiesDefault.vue'));
Vue.component('current-liabilities-addon', require('./components/survey/pbs/CurrentLiabilitiesAddon.vue'));
Vue.component('longterm-liabilities-default', require('./components/survey/pbs/LongtermLiabilitiesDefault.vue'));
Vue.component('longterm-liabilities-addon', require('./components/survey/pbs/LongtermLiabilitiesAddon.vue'));

Vue.component('participant-summary', require('./components/survey/summary/ParticipantSummary.vue'));
Vue.component('mimo-summary', require('./components/survey/summary/MimoSummary.vue'));
Vue.component('pbs-summary', require('./components/survey/summary/BalanceSheetSummary.vue'));

Vue.component('common-header', require('./components/common/Header.vue'));
Vue.component('common-content', require('./components/common/Content.vue'));

const app = new Vue({
    el: '#app'
});
