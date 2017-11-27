
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

Vue.component('active-income-default', require('./components/survey/ActiveIncomeDefault.vue'));
Vue.component('active-income-addon', require('./components/survey/ActiveIncomeAddon.vue'));
Vue.component('passive-income-default', require('./components/survey/PassiveIncomeDefault.vue'));
Vue.component('passive-income-addon', require('./components/survey/PassiveIncomeAddon.vue'));
Vue.component('regular-expenses-default', require('./components/survey/RegularExpensesDefault.vue'));
Vue.component('regular-expenses-addon', require('./components/survey/RegularExpensesAddon.vue'));
Vue.component('occassional-expenses-addon', require('./components/survey/OccassionalExpensesAddon.vue'));

Vue.component('common-header', require('./components/common/Header.vue'));
Vue.component('common-content', require('./components/common/Content.vue'));

const app = new Vue({
    el: '#app'
});
