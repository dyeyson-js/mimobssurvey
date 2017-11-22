
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

Vue.component('common-card', require('./components/common/Card.vue'));
Vue.component('common-card-section', require('./components/common/CardSection.vue'));
Vue.component('common-card-header', require('./components/common/CardHeader.vue'));
Vue.component('common-card-footer', require('./components/common/CardFooter.vue'));
Vue.component('common-header', require('./components/common/Header.vue'));
Vue.component('common-button', require('./components/common/Button.vue'));

Vue.component('survey', require('./components/survey/Survey.vue'));
Vue.component('survey-start', require('./components/survey/SurveyLanding.vue'));
Vue.component('survey-profile', require('./components/survey/SurveyProfile.vue'));

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});
