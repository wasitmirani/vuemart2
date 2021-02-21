require("./bootstrap");

window.Vue = require("vue");
import _ from "lodash";
import router from "./router";
import { BootstrapVue, BootstrapVueIcons } from "bootstrap-vue";
import Swal from "sweetalert2";
import VueLetterAvatar from "vue-letter-avatar";
import "bootstrap-vue/dist/bootstrap-vue.css";
import Multiselect from "vue-multiselect";
import Vuesax from "vuesax";
import Element from "element-ui";
import moment from "moment";

import "vuesax/dist/vuesax.css"; //Vuesax styles
Vue.use(Vuesax, {
    // options here
});

window.Swal = Swal;
Vue.use(Element);
Vue.use(BootstrapVue);
Vue.use(moment);



Vue.use(BootstrapVueIcons);

Vue.use(VueLetterAvatar);
import VueFileAgentStyles from "vue-file-agent/dist/vue-file-agent.css";

import VueApexCharts from 'vue-apexcharts'
Vue.use(VueApexCharts)

Vue.component('apexchart', VueApexCharts)
    // register globally
Vue.component("multiselect", Multiselect);
Vue.component("pagination", require("laravel-vue-pagination"));
//Global Filter
Vue.filter("timeformat", function(value) {
    if (value) {
        return moment
            .utc(String(value))
            .local()
            .fromNow();
    }
});
Vue.filter("categoryImg", function(value) {
    if (value) {
        return window.location.origin + "/admin/img/categories/" + value;
    }
});

Vue.filter("categoryStatus", function(value) {
    switch (value) {
        case 1:
            return "<span class='badge badge-pill badge-light-success mr-1'>Active </span>";
            break;
        case 0:
            return "<span class='badge badge-pill badge-light-danger mr-1'>Disable </span>";
            break;

        default:
            return "<span class='badge badge-pill badge-light-danger mr-1'>Disable </span>";
            break;
    }
});

Vue.filter("isUnitStock", function(value) {
    if (value > 9) {
        return (
            "<span class='text-success mr-1'><small>InStock</small> " +
            value +
            " </span>"
        );
    }
    if (value >= 1 && value <= 9) {
        return (
            "<span class='text-warning mr-1'><small>warning</small> " +
            value +
            " </span>"
        );
    }
    if (value < 1) {
        return (
            "<span class='text-danger mr-1'><small>OutStock</small> " +
            value +
            " </span>"
        );
    }
});
Vue.filter("isfeatured", function(value) {
    switch (value) {
        case 1:
            return "<span class='badge badge-pill badge-light-success mr-1'>Featured </span>";
            break;
        case 0:
            return "<span class='badge badge-pill badge-light-warning mr-1'>unfeatured </span>";
            break;

        default:
            return "<span class='badge badge-pill badge-light-warning mr-1'>unfeatured </span>";
            break;
    }
});
Vue.filter("orderStatus", function(value) {
    switch (value) {
        case 2:
            return "<span class='badge badge-pill badge-light-success mr-1'>Accepted </span>";
            break;
        case 1:
            return "<span class='badge badge-pill badge-light-warning mr-1'>Pending </span>";
            break;
        case 0:
            return "<span class='badge badge-pill badge-light-danger mr-1'>Cancel </span>";
            break;

        default:
            return "<span class='badge badge-pill badge-light-warning mr-1'>Pending </span>";
            break;
    }
});

Vue.directive('can', function(el, binding, vnode) {

    if (Permissions.indexOf(binding.value) !== -1) {
        return vnode.elm.hidden = false;
    } else {
        return vnode.elm.hidden = true;
    }
})
Vue.prototype.$base_url = window.location.origin;
Vue.prototype.$hostapi_url = window.location.origin + "/api";
Vue.prototype.$config = { headers: { Authorization: `Bearer ` + authUser.api_token } };
// Vue.prototype.$config = "";
const app = new Vue({
    el: "#app",
    router
});