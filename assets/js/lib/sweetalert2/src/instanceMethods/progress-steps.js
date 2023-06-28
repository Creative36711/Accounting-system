import privateProps from 'assets/js/lib/sweetalert2/src/privateProps.js'

export function getProgressSteps () {
  const domCache = privateProps.domCache.get(this)
  return domCache.progressSteps
}
