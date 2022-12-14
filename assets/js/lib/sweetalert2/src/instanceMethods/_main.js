import defaultParams, { showWarningsForParams } from 'assets/js/lib/sweetalert2/src/utils/params.js'
import * as dom from 'assets/js/lib/sweetalert2/src/utils/dom'
import Timer from 'assets/js/lib/sweetalert2/src/utils/Timer.js'
import { callIfFunction } from 'assets/js/lib/sweetalert2/src/utils/utils.js'
import setParameters from 'assets/js/lib/sweetalert2/src/utils/setParameters.js'
import { getTemplateParams } from 'assets/js/lib/sweetalert2/src/utils/getTemplateParams.js'
import globalState from 'assets/js/lib/sweetalert2/src/globalState.js'
import { openPopup } from 'assets/js/lib/sweetalert2/src/utils/openPopup.js'
import privateProps from 'assets/js/lib/sweetalert2/src/privateProps.js'
import privateMethods from 'assets/js/lib/sweetalert2/src/privateMethods.js'
import { handleInputOptionsAndValue } from 'assets/js/lib/sweetalert2/src/utils/dom/inputUtils.js'
import { handleConfirmButtonClick, handleDenyButtonClick, handleCancelButtonClick } from 'assets/js/lib/sweetalert2/src/instanceMethods/buttons-handlers.js'
import { addKeydownHandler, setFocus } from 'assets/js/lib/sweetalert2/src/instanceMethods/keydown-handler.js'
import { handlePopupClick } from 'assets/js/lib/sweetalert2/src/instanceMethods/popup-click-handler.js'
import { DismissReason } from 'assets/js/lib/sweetalert2/src/utils/DismissReason.js'
import { unsetAriaHidden } from 'assets/js/lib/sweetalert2/src/utils/aria.js'

export function _main (userParams, mixinParams = {}) {
  showWarningsForParams(Object.assign({}, mixinParams, userParams))

  if (globalState.currentInstance) {
    globalState.currentInstance._destroy()
    if (dom.isModal()) {
      unsetAriaHidden()
    }
  }
  globalState.currentInstance = this

  const innerParams = prepareParams(userParams, mixinParams)
  setParameters(innerParams)
  Object.freeze(innerParams)

  // clear the previous timer
  if (globalState.timeout) {
    globalState.timeout.stop()
    delete globalState.timeout
  }

  // clear the restore focus timeout
  clearTimeout(globalState.restoreFocusTimeout)

  const domCache = populateDomCache(this)

  dom.render(this, innerParams)

  privateProps.innerParams.set(this, innerParams)

  return swalPromise(this, domCache, innerParams)
}

const prepareParams = (userParams, mixinParams) => {
  const templateParams = getTemplateParams(userParams)
  const params = Object.assign({}, defaultParams, mixinParams, templateParams, userParams) // precedence is described in #2131
  params.showClass = Object.assign({}, defaultParams.showClass, params.showClass)
  params.hideClass = Object.assign({}, defaultParams.hideClass, params.hideClass)
  return params
}

const swalPromise = (instance, domCache, innerParams) => {
  return new Promise((resolve) => {
    // functions to handle all closings/dismissals
    const dismissWith = (dismiss) => {
      instance.closePopup({ isDismissed: true, dismiss })
    }

    privateMethods.swalPromiseResolve.set(instance, resolve)

    domCache.confirmButton.onclick = () => handleConfirmButtonClick(instance)
    domCache.denyButton.onclick = () => handleDenyButtonClick(instance)
    domCache.cancelButton.onclick = () => handleCancelButtonClick(instance, dismissWith)

    domCache.closeButton.onclick = () => dismissWith(DismissReason.close)

    handlePopupClick(instance, domCache, dismissWith)

    addKeydownHandler(instance, globalState, innerParams, dismissWith)

    handleInputOptionsAndValue(instance, innerParams)

    openPopup(innerParams)

    setupTimer(globalState, innerParams, dismissWith)

    initFocus(domCache, innerParams)

    // Scroll container to top on open (#1247, #1946)
    setTimeout(() => {
      domCache.container.scrollTop = 0
    })
  })
}

const populateDomCache = (instance) => {
  const domCache = {
    popup: dom.getPopup(),
    container: dom.getContainer(),
    actions: dom.getActions(),
    confirmButton: dom.getConfirmButton(),
    denyButton: dom.getDenyButton(),
    cancelButton: dom.getCancelButton(),
    loader: dom.getLoader(),
    closeButton: dom.getCloseButton(),
    validationMessage: dom.getValidationMessage(),
    progressSteps: dom.getProgressSteps()
  }
  privateProps.domCache.set(instance, domCache)

  return domCache
}

const setupTimer = (globalState, innerParams, dismissWith) => {
  const timerProgressBar = dom.getTimerProgressBar()
  dom.hide(timerProgressBar)
  if (innerParams.timer) {
    globalState.timeout = new Timer(() => {
      dismissWith('timer')
      delete globalState.timeout
    }, innerParams.timer)
    if (innerParams.timerProgressBar) {
      dom.show(timerProgressBar)
      setTimeout(() => {
        if (globalState.timeout && globalState.timeout.running) { // timer can be already stopped or unset at this point
          dom.animateTimerProgressBar(innerParams.timer)
        }
      })
    }
  }
}

const initFocus = (domCache, innerParams) => {
  if (innerParams.toast) {
    return
  }

  if (!callIfFunction(innerParams.allowEnterKey)) {
    return blurActiveElement()
  }

  if (!focusButton(domCache, innerParams)) {
    setFocus(innerParams, -1, 1)
  }
}

const focusButton = (domCache, innerParams) => {
  if (innerParams.focusDeny && dom.isVisible(domCache.denyButton)) {
    domCache.denyButton.focus()
    return true
  }

  if (innerParams.focusCancel && dom.isVisible(domCache.cancelButton)) {
    domCache.cancelButton.focus()
    return true
  }

  if (innerParams.focusConfirm && dom.isVisible(domCache.confirmButton)) {
    domCache.confirmButton.focus()
    return true
  }

  return false
}

const blurActiveElement = () => {
  if (document.activeElement && typeof document.activeElement.blur === 'function') {
    document.activeElement.blur()
  }
}
