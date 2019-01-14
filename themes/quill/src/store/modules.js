const modulesList = {}
const requireRoute = require.context(
  // The relative path of the modules folder
  '@/modules',
  // Whether or not to look in subfolders
  true,
  // The regular expression used to match base module filenames
  /store\/index\.js$/
)

requireRoute.keys().forEach(module => {
  const moduleConfig = requireRoute(module)
  const stores = moduleConfig.default._modules.root._children

  for (var key in stores) {
    var i = {}
    i[key] = stores[key]._rawModule
    Object.assign(modulesList, i)
  }
})

export const modules = modulesList
