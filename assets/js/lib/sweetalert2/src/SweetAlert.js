import { DismissReason } from 'assets/js/lib/sweetalert2/src/utils/DismissReason.js'
import * as staticMethods from 'assets/js/lib/sweetalert2/src/staticMethods.js'
import * as instanceMethods from 'assets/js/lib/sweetalert2/src/instanceMethods.js'
import privateProps from 'assets/js/lib/sweetalert2/src/privateProps.js'

let currentInstance

class SweetAlert {
  constructor (...args) {
    // Prevent run in Node env
    if (typeof window === 'undefined') {
      return
    }

    currentInstance = this

    const outerParams = Object.freeze(this.constructor.argsToParams(args))

    Object.defineProperties(this, {
      params: {
        value: outerParams,
        writable: false,
        enumerable: true,
        configurable: true
      }
    })

    const promise = this._main(this.params)
    privateProps.promise.set(this, promise)
  }

  // `catch` cannot be the name of a module export, so we define our thenable methods here instead
  then (onFulfilled) {
    const promise = privateProps.promise.get(this)
    return promise.then(onFulfilled)
  }

  finally (onFinally) {
    const promise = privateProps.promise.get(this)
    return promise.finally(onFinally)
  }
}

// Assign instance methods from src/instanceMethods/*.js to prototype
Object.assign(SweetAlert.prototype, instanceMethods)

// Assign static methods from src/staticMethods/*.js to constructor
Object.assign(SweetAlert, staticMethods)

// Proxy to instance methods to constructor, for now, for backwards compatibility
Object.keys(instanceMethods).forEach(key => {
  SweetAlert[key] = function (...args) {
    if (currentInstance) {
      return currentInstance[key](...args)
    }
  }
})

SweetAlert.DismissReason = DismissReason

SweetAlert.version = '11.1.7'

export default SweetAlert
