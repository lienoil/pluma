export const errors = (response, errorBag) => {
  switch (response.status) {
    case 422:
      for (var key in response.data) {
        errorBag.add(key, response.data[key].join('\n'), 'server')
      }
      break

    default:
      errorBag = response.data
      break
  }
}

/**
 * Check HTTP Status Code
 */
export const status = (code) => {
  switch (code) {
    case 200:
      return 200

    default:
      return code
  }
}
