var debug = false;
window.API = {
  setOptions(options) {
    this.options = Object.assign({
      GET: '',
      POST: '',
      _token: '',
      done: false,
    }, options);
  },

  LMSInitialize(dummyString) {
    if (debug) { console.log("[LMS]", 'initializing') };

    return "true";
  },

  LMSGetValue(varname) {
    if (debug) { console.log("[LMS]", 'getting...' + varname) };
    let req = createRequest();

    req.open('GET', this.options.GET+"?varname="+varname+"&_token="+this.options._token, false);
    req.send(null);

    // console.log(req);
    if (req.status != 200) {
      return req.responseText;
    }

    return req.responseText;
  },

  LMSSetValue(varname, value) {
    if (debug) { console.log("[LMS]", 'setValue', varname, value) };

    let req = createRequest();
    req.open('POST', this.options.POST+"?varname="+varname+"&_token="+this.options._token, false);
    var params = 'value='+value;
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.setRequestHeader("Content-length", params.length);
    req.setRequestHeader("Connection", "close");
    req.send(params);

    if (req.status != 200) {
      return "false";
    }

    return "true";
  },

  LMSCommit(dummyString) {
    this.LMSGetValue('');

    return "true";
  },

  LMSFinish(dummyString) {
    // this.LMSGetValue('');
    this.LMSCommit('');

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
