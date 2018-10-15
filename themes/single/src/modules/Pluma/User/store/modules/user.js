import { api } from '../../api'
import { USER_STORE, USER_STORED } from './actions'
import axios from 'axios'

const state = { status: '', data: null }

const getters = {
  getStatus: state => state.status,

  data: state => state.data
}

const actions = {
  [USER_STORE]: ({commit, dispatch}, data) => {
    // const { data } = await axios.post(api.store, )
    commit(USER_STORE, data)
    return new Promise((resolve, reject) => {
      axios.post(api.store, data)
        .then((response) => {
          commit(USER_STORED, response)
          resolve(response)
        })
        .catch(err => {
          reject(err)
        })
    })
  }
}

const mutations = {
  [USER_STORE]: (state, data) => {
    state.data = data
    state.status = 'storing'
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
