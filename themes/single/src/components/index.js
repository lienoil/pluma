import upperFirst from 'lodash/upperFirst'
import camelCase from 'lodash/camelCase'

export default {
  install (Vue) {
    const requireComponent = require.context(
      // The relative path of the components folder
      '.',
      // Whether or not to look in subfolders
      true,
      // The regular expression used to match base component filenames
      /[A-Z]\w+\.(vue|js)$/
    )

    requireComponent.keys().forEach(fileName => {
      const componentConfig = requireComponent(fileName)

      const componentName = upperFirst(
        camelCase(
          fileName
            .split('/')
            .pop()
            .replace(/\.[^/.]+$/, '')
            .replace(/^\.\/(.*)\.\w+$/, '$1')
        )
      )

      Vue.component(
        componentName,
        // Look for the component options on `.default`, which will
        // exist if the component was exported with `export default`,
        // otherwise fall back to module's root.
        componentConfig.default || componentConfig
      )
    })
  }
}
