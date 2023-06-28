import * as dom from 'assets/js/lib/sweetalert2/src/utils/dom/index'

export const renderTitle = (instance, params) => {
  const title = dom.getTitle()

  dom.toggle(title, params.title || params.titleText, 'block')

  if (params.title) {
    dom.parseHtmlToContainer(params.title, title)
  }

  if (params.titleText) {
    title.innerText = params.titleText
  }

  // Custom class
  dom.applyCustomClass(title, params, 'title')
}
