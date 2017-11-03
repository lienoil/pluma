window.API = {
  on (event, callback) {
    window.addEventListener(event, function (e) {
      let firstParam = e.detail.varname;
      let secondParam = (typeof e.detail.value === "undefined") ? e : e.detail.value;
      callback(firstParam, secondParam, e);
    });
  },

  setOptions(options) {
    this.options = Object.assign({
      GET: '',
      POST: '',
      _token: '',
      done: false,
      debug: false,
      timeout: 800,
    }, options);
  },

  LMSInitialize(dummyString) {
    if (this.options.debug) { console.log("[SCORMAPI]", 'initializing...') };

    return "true";
  },

  LMSGetValue(varname) {

    // let req = createRequest();
    // req.open('GET', this.options.GET+"?varname="+varname+"&_token="+this.options._token, true);
    // req.timeout = this.options.timeout;
    // req.send(null);

    var event = new CustomEvent('LMSGetValue', { detail: {varname} });
    let e = window.dispatchEvent(event);

    // if (this.options.debug) { console.log("[SCORMAPI]", 'getting...' + varname + ', ' + req.responseText) };

    // if (req.status === 200) {
    //   return req.responseText;
    // }

    // return "";
  },

  LMSSetValue(varname, value) {

    if (this.options.debug) { console.log("[SCORMAPI]", 'setting...', varname, value) };

    // let req = createRequest();
    // req.open('POST', this.options.POST+"?varname="+varname+"&_token="+this.options._token, true);
    // req.timeout = this.options.timeout;
    // req.send("value="+value);

    var event = new CustomEvent('LMSSetValue', { detail: {varname, value} });
    window.dispatchEvent(event);

    return "true";
  },

  LMSCommit(dummyString) {
    this.LMSGetValue('');

    return "true";
  },

  LMSFinish(dummyString) {
    // this.LMSGetValue('');
    this.LMSCommit('');

    var event = new CustomEvent('LMSFinish', { detail: {dummyString: dummyString} });
    window.dispatchEvent(event);

    return "true";
  },

  /**
   * SCORM RTE Functions / Error Handling
   */
  LMSGetLastError() {
    return 0;
  },

  LMSGetDiagnostic(errorCode) {
    return "something string";
  },

  LMSGetErrorString(errorCode) {
    return "error string";
  },
}

function createRequest() {

  // this is the object that we're going to (try to) create
  var request;

  // does the browser have native support for
  // the XMLHttpRequest object
  try {
    request = new XMLHttpRequest();
  }

  // it failed so it's likely to be Internet Explorer which
  // uses a different way to do this
  catch (tryIE) {

    // try to see if it's a newer version of Internet Explorer
    try {
      request = new ActiveXObject("Msxml2.XMLHTTP");
    }

    // that didn't work so ...
    catch (tryOlderIE) {

      // maybe it's an older version of Internet Explorer
      try {
        request = new ActiveXObject("Microsoft.XMLHTTP");
      }

      // even that didn't work (sigh)
      catch (failed) {
        alert("Error creating XMLHttpRequest");
      }

    }
  }

  return request;
}
