import * as dom from 'assets/js/lib/sweetalert2/src/utils/dom'
import { warn } from 'assets/js/lib/sweetalert2/src/utils/utils.js'
import sweetAlert from 'assets/js/lib/sweetalert2/sweetalert2'
import privateProps from 'assets/js/lib/sweetalert2/src/privateProps.js'

/**
 * Updates popup parameters.
 */
export function update (params) {
  const popup = dom.getPopup()
  const innerParams = privateProps.innerParams.get(this)

  if (!popup || dom.hasClass(popup, innerParams.hideClass.popup)) {
    return warn(`You're trying to update the closed or closing popup, that won't work. Use the update() method in preConfirm parameter or show a new popup.`)
  }

  const validUpdatableParams = {}

  // assign valid params from `params` to `defaults`
  Object.keys(params).forEach(param => {
    if (sweetAlert.isUpdatableParameter(param)) {
      validUpdatableParams[param] = params[param]
    } else {
      warn(`Invalid parameter to update: "${param}". Updatable params are listed here: https://github.com/sweetalert2/sweetalert2/blob/master/src/utils/params.js\n\nIf you think this parameter should be updatable, request it here: https://github.com/sweetalert2/sweetalert2/issues/new?template=02_feature_request.md`)
    }
  })

  const updatedParams = Object.assign({}, innerParams, validUpdatableParams)

  dom.render(this, updatedParams)

  privateProps.innerParams.set(this, updatedParams)
  Object.defineProperties(this, {
    params: {
      value: Object.assign({}, this.params, params),
      writable: false,
      enumerable: true
    }
  })
}
