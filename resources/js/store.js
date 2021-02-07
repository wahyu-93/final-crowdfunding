import Vue from 'vue'
import Vuex from 'vuex'
import transaction from './stores/transaction'
import alert from './stores/alert.js'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        transaction,
        alert
    }
})