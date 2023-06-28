import { isVisible } from 'assets/js/lib/sweetalert2/src/utils/dom/domUtils.js'
import { getInputValue } from 'assets/js/lib/sweetalert2/src/utils/dom/inputUtils.js'
import { getDenyButton, getValidationMessage } from 'assets/js/lib/sweetalert2/src/utils/dom/getters.js'
import { asPromise } from 'assets/js/lib/sweetalert2/src/utils/utils.js'
import { showLoading } from 'assets/js/lib/sweetalert2/src/staticMethods/showLoading.js'
import { DismissReason } from 'assets/js/lib/sweetalert2/src/utils/DismissReason.js'
import privateProps from 'assets/js/lib/sweetalert2/src/privateProps.js'

export const handleConfirmButtonClick = (instance) => {
  const innerParams = privateProps.innerParams.get(instance)
  instance.disableButtons()
  if (innerParams.input) {
    handleConfirmOrDenyWithInput(instance, 'confirm')
  } else {
    confirm(instance, true)
  }
}

export const handleDenyButtonClick = (instance) => {
  const innerParams = privateProps.innerParams.get(instance)
  instance.disableButtons()
  if (innerParams.returnInputValueOnDeny) {
    handleConfirmOrDenyWithInput(instance, 'deny')
  } else {
    deny(instance, false)
  }
}

export const handleCancelButtonClick = (instance, dismissWith) => {
  instance.disableButtons()
  dismissWith(DismissReason.cancel)
}

const handleConfirmOrDenyWithInput = (instance, type /* 'confirm' | 'deny' */) => {
  const innerParams = privateProps.innerParams.get(instance)
  const inputValue = getInputValue(instance, innerParams)
  if (innerParams.inputValidator) {
    handleInputValidator(instance, inputValue, type)
  } else if (!instance.getInput().checkValidity()) {
    instance.enableButtons()
    instance.showValidationMessage(innerParams.validationMessage)
  } else if (type === 'deny') {
    deny(instance, inputValue)
  } else {
    confirm(instance, inputValue)
  }
}

const handleInputValidator = (instance, inputValue, type /* 'confirm' | 'deny' */) => {
  const innerParams = privateProps.innerParams.get(instance)
  instance.disableInput()
  const validationPromise = Promise.resolve().then(() => asPromise(
    innerParams.inputValidator(inputValue, innerParams.validationMessage))
  )
  validationPromise.then(
    (validationMessage) => {
      instance.enableButtons()
      instance.enableInput()
      if (validationMessage) {
        instance.showValidationMessage(validationMessage)
      } else if (type === 'deny') {
        deny(instance, inputValue)
      } else {
        confirm(instance, inputValue)
      }
    }
  )
}

const deny = (instance, value) => {
  const innerParams = privateProps.innerParams.get(instance || this)

  if (innerParams.showLoaderOnDeny) {
    showLoading(getDenyButton())
  }

  if (innerParams.preDeny) {
    const preDenyPromise = Promise.resolve().then(() => asPromise(
      innerParams.preDeny(value, innerParams.validationMessage))
    )
    preDenyPromise.then(
      (preDenyValue) => {
        if (preDenyValue === false) {
          instance.hideLoading()
        } else {
          instance.closePopup({ isDenied: true, value: typeof preDenyValue === 'undefined' ? value : preDenyValue })
        }
      }
    )
  } else {
    instance.closePopup({ isDenied: true, value })
  }
}

const succeedWith = (instance, value) => {
  instance.closePopup({ isConfirmed: true, value })
}

const confirm = (instance, value) => {
  const innerParams = privateProps.innerParams.get(instance || this)

  if (innerParams.showLoaderOnConfirm) {
    showLoading()
  }

  if (innerParams.preConfirm) {
    instance.resetValidationMessage()
    const preConfirmPromise = Promise.resolve().then(() => asPromise(
      innerParams.preConfirm(value, innerParams.validationMessage))
    )
    preConfirmPromise.then(
      (preConfirmValue) => {
        if (isVisible(getValidationMessage()) || preConfirmValue === false) {
          instance.hideLoading()
        } else {
          succeedWith(instance, typeof preConfirmValue === 'undefined' ? value : preConfirmValue)
        }
      }
    )
  } else {
    succeedWith(instance, value)
  }
}
