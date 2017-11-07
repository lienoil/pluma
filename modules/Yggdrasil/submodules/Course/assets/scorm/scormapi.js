window.API = {
  on (event, callback) {
    window.addEventListener(event, function (e) {
      let firstParam = (typeof e.detail.varname === "undefined") ? e.detail.cache : e.detail.varname;
      let secondParam = (typeof e.detail.value === "undefined") ? e.detail.cache : e.detail.value;
      let cache = (typeof e.detail.cache === "undefined") ? e : e.detail.cache;
      callback(firstParam, secondParam, cache);
    });
  },

  init (options) {
    this.setOptions(options);
    this.misc.debug("init(options)", 'setOptions() was called');

    this.Cache().init();
    this.misc.debug("init(options)", 'Cache().init() was called');

    this.BeforeInitialize('');
    this.misc.debug("init(options)", 'BeforeInitialize() was called');

    return this;
  },

  ended () {
    alert('ended');
  },

  setOptions(options) {
    this.done = false;

    this.options = Object.assign({
      GET: '',
      POST: '',
      _token: '',
      done: false,
      debug: false,
      timeout: 800,
    }, options);
  },

  BeforeInitialize (dummyString) {
    this.misc.debug("BeforeInitialize('')", 'is running.');

    let event = new CustomEvent('BeforeInitialize', { detail: {varname: dummyString, cache: JSON.parse(JSON.stringify(this.Cache().get()))} });

    this.misc.debug("BeforeInitialize Event", 'was created.');

    this.misc.debug("BeforeInitialize Event", 'will be dispatched.');

    return window.dispatchEvent(event);
  },

  LMSInitialize (dummyString) {
    let self = this;

    this.misc.debug("LMSInitialize", 'initializing...');

    let event = new CustomEvent('LMSInitialize', { detail: {cache: this.Cache().get()} });
    window.dispatchEvent(event);

    self.misc.style();

    window.onbeforeunload = window.API.LMSFinish;
    window.onunload = window.API.LMSFinish;

    return "true";
  },

  LMSGetValue (varname) {
    let event = new CustomEvent('LMSGetValue', { detail: {varname, value: this.Cache().get(varname), cache: this.Cache().get()} });
    let e = window.dispatchEvent(event);

    this.misc.debug("LMSGetValue", 'getting...', varname, "Result:", JSON.parse(JSON.stringify(this.Cache().get(varname))));

    return this.Cache().get(varname);
  },

  LMSSetValue (varname, value) {
    this.misc.debug("LMSSetValue", 'setting...', varname, 'with', value);

    let event = new CustomEvent('LMSSetValue', { detail: {varname, value, cache: this.cache} });
    window.dispatchEvent(event);

    return this.Cache().set(varname, value);
  },

  LMSCommit (dummyString) {
    let query = "?";
    for (varname in this.Cache().get()) {
      query += varname + "=" + this.Cache().get('varname') + "&";
    }

    let event = new CustomEvent('LMSCommit', { detail: {dummyString: dummyString, value: this.Cache().get(), cache: query} });
    window.dispatchEvent(event);

    this.misc.debug("[LMSCommit]", "-----------");
    this.misc.debug("[LMSCommit]", "was called.");
    this.misc.debug("[LMSCommit]", "-----------");

    return "true";
  },

  LMSFinish (dummyString) {
    let event = new CustomEvent('LMSFinish', { detail: {dummyString: dummyString} });
    window.dispatchEvent(event);

    if (this.done) {

      return "true";
    }

    // Commit values
    // window.API.LMSCommit('');
    this.done = true;
    window.onbeforeunload = false;

    // this.LMSGetValue('');

    return "true";
  },

  /**
   * SCORM RTE Functions / Error Handling
   */
  LMSGetLastError () {
    return 0;
  },

  LMSGetDiagnostic (errorCode) {
    return "something string";
  },

  LMSGetErrorString (errorCode) {
    return "error string";
  },


  // Cache
  Cache () {
    let self = this;

    return {
      init () {
        self.cache = new Object();
        self.cache['_token'] = self.options._token;
        self.cache['adlcp:masteryscore'] = '';
        self.cache['cmi.core._children'] = '';
        self.cache['cmi.core.credit'] = '';
        self.cache['cmi.core.entry'] = '';
        self.cache['cmi.core.exit'] = '';
        self.cache['cmi.core.lesson_location'] = '';
        self.cache['cmi.core.lesson_status'] = '';
        self.cache['cmi.core.score._children'] = '';
        self.cache['cmi.core.score.raw'] = '';
        self.cache['cmi.core.session_time'] = '';
        self.cache['cmi.core.student_id'] = '';
        self.cache['cmi.core.student_name'] = '';
        self.cache['cmi.core.total_time'] = '';
        self.cache['cmi.launch_data'] = '';
        self.cache['cmi.suspend_data'] = '';

        self.misc.debug("Cache.init()", JSON.parse(JSON.stringify(self.cache)));

        return this;
      },

      get (varname) {
        if (typeof varname === "undefined" || varname === "") return self.cache;

        self.misc.debug("Cache.get([varname])", varname, self.cache[varname]);

        return typeof self.cache[varname] === "undefined" ? "" : self.cache[varname];
      },

      set (varname, value) {
        self.cache[varname] = value;

        self.misc.debug("Cache.set(varname, value)", varname, 'with', value, "Result: ", self.cache[varname]);

        return "true";
      },

      setMultiple (array) {
        for (var i = array.length - 1; i >= 0; i--) {
          let current = array[i];
          self.cache[current.name] = current.val ? current.val : "";
        }

        self.misc.debug("Cache.setMultiple(array)", JSON.parse(JSON.stringify(self.cache)));
      },
    }
  },

  misc: {
    style () {
      let body = document.getElementsByTagName("body")[0];
      body.classList.add("lms", "lms-fullscreen");

      let interactive = document.querySelector('.interactive-content');
      let interactiveContent = interactive.contentDocument.body || interactive.contentWindow.body;
    },

    debug (...args) {
      if (window.API.options.debug) {
        let d = new Date();
        let H = window.API.misc.pad(d.getHours());
        let i = window.API.misc.pad(d.getMinutes());
        let s = window.API.misc.pad(d.getSeconds());
        let timestamp = [H, i, s].join(":");

        console.log("[SCORMAPI]"+"["+timestamp+"]", ...args);
      }
    },

    pad (num, size) {
      let s = num.toString();
      while (s.length < (size || 2)) { s = "0" + s; }
      return s;
    },
  },

  stage: {
    fullscreen (el) {
      window.API.misc.debug("You went fullscreen");

      // alert(el.requestFullScreen)
      let requestMethod = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || el.msRequestFullScreen;

      if (requestMethod) { // Native full screen.
        requestMethod.call(el);
      } else if (typeof window.ActiveXObject !== "undefined") {
        var wscript = new ActiveXObject("WScript.Shell");
        if (wscript !== null) {
            wscript.SendKeys("{F11}");
        }
      }

      if (screen.orientation && screen.orientation.lock('landscape')) {
        alert('clocked');
      }
    }
  }
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
