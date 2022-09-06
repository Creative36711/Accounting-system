import { getPopup } from 'assets/js/lib/sweetalert2/src/utils/dom/getters.js'
import { renderActions } from 'assets/js/lib/sweetalert2/src/utils/dom/renderers/renderActions.js'
import { renderContainer } from 'assets/js/lib/sweetalert2/src/utils/dom/renderers/renderContainer.js'
import { renderContent } from 'assets/js/lib/sweetalert2/src/utils/dom/renderers/renderContent.js'
import { renderFooter } from 'assets/js/lib/sweetalert2/src/utils/dom/renderers/renderFooter.js'
import { renderCloseButton } from 'assets/js/lib/sweetalert2/src/utils/dom/renderers/renderCloseButton.js'
import { renderIcon } from 'assets/js/lib/sweetalert2/src/utils/dom/renderers/renderIcon.js'
import { renderImage } from 'assets/js/lib/sweetalert2/src/utils/dom/renderers/renderImage.js'
import { renderProgressSteps } from 'assets/js/lib/sweetalert2/src/utils/dom/renderers/renderProgressSteps.js'
import { renderTitle } from 'assets/js/lib/sweetalert2/src/utils/dom/renderers/renderTitle.js'
import { renderPopup } from 'assets/js/lib/sweetalert2/src/utils/dom/renderers/renderPopup.js'

export const render = (instance, params) => {
  renderPopup(instance, params)
  renderContainer(instance, params)

  renderProgressSteps(instance, params)
  renderIcon(instance, params)
  renderImage(instance, params)
  renderTitle(instance, params)
  renderCloseButton(instance, params)

  renderContent(instance, params)
  renderActions(instance, params)
  renderFooter(instance, params)

  if (typeof params.didRender === 'function') {
    params.didRender(getPopup())
  }
}
