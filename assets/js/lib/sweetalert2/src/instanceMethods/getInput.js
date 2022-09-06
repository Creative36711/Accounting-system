import * as dom from 'assets/js/lib/sweetalert2/src/utils/dom'
import privateProps from 'assets/js/lib/sweetalert2/src/privateProps.js'

// Get input element by specified type or, if type isn't specified, by params.input
export function getInput (instance) {
  const innerParams = privateProps.innerParams.get(instance || this)
  const domCache = privateProps.domCache.get(instance || this)
  if (!domCache) {
    return null
  }
  return dom.getInput(domCache.popup, innerParams.input)
}
