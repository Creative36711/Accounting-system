import globalState from 'assets/js/lib/sweetalert2/src/globalState.js'
import privateProps from 'assets/js/lib/sweetalert2/src/privateProps.js'
import privateMethods from 'assets/js/lib/sweetalert2/src/privateMethods.js'

export function _destroy () {
  const domCache = privateProps.domCache.get(this)
  const innerParams = privateProps.innerParams.get(this)

  if (!innerParams) {
    return // This instance has already been destroyed
  }

  // Check if there is another Swal closing
  if (domCache.popup && globalState.swalCloseEventFinishedCallback) {
    globalState.swalCloseEventFinishedCallback()
    delete globalState.swalCloseEventFinishedCallback
  }

  // Check if there is a swal disposal defer timer
  if (globalState.deferDisposalTimer) {
    clearTimeout(globalState.deferDisposalTimer)
    delete globalState.deferDisposalTimer
  }

  if (typeof innerParams.didDestroy === 'function') {
    innerParams.didDestroy()
  }

  disposeSwal(this)
}

const disposeSwal = (instance) => {
  // Unset this.params so GC will dispose it (#1569)
  delete instance.params
  // Unset globalState props so GC will dispose globalState (#1569)
  delete globalState.keydownHandler
  delete globalState.keydownTarget
  // Unset WeakMaps so GC will be able to dispose them (#1569)
  unsetWeakMaps(privateProps)
  unsetWeakMaps(privateMethods)
  // Unset currentInstance
  delete globalState.currentInstance
}

const unsetWeakMaps = (obj) => {
  for (const i in obj) {
    obj[i] = new WeakMap()
  }
}
