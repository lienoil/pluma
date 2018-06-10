import { api } from '../../api'
import { USER_STORE, USER_STORED } from './actions'
import axios from 'axios'

const state = { status: '' }

const getters = {
  getStatus: state => state.status
}

const actions = {
  [USER_STORE]: ({commit, dispatch}) => {
    commit(USER_STORE)
    return new Promise((resolve, reject) => {
      axios({url: api.store, method: 'POST'})
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
