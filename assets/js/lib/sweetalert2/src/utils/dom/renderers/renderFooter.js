import * as dom from 'assets/js/lib/sweetalert2/src/utils/dom/index'

export const renderFooter = (instance, params) => {
  const footer = dom.getFooter()

  dom.toggle(footer, params.footer)

  if (params.footer) {
    dom.parseHtmlToContainer(params.footer, footer)
  }

  // Custom class
  dom.applyCustomClass(footer, params, 'footer')
}
