/*
     * Do not touch anything below
     * --------------------------------------------------
     */
    this.scoWin;
    this.API;
    this.hasTerminated = false;
    this.hasInitialized = false;
    this.optionsOpen = true;
    this.initTimeoutMax = 20000;
    this.initTimeout = 0;
    this.fullPath = document.location.href.substr(0,document.location.href.lastIndexOf('/'))
    this.parentFolder = fullPath.substr(fullPath.lastIndexOf('/')+1,fullPath.length);
    this.timeoutErrorDisplayed = false;
    this.launchWithEmbeddedParam = false;
    this.launchWithCustomApiProperty = false;
    this.storageObject;

    this.SimpleAPI = function(cookiename,api,initData)
    {
        this.api = api;
        this.initData = initData;
        this.__data = null;
        this.cookiename = cookiename;
        this.initialized = false;
        this.terminated = false;
        this.lastError = "0";
        this.lastCmd = '';

        this.logCommand=function()
        {
            Utils.log(this.lastCmd,'entry');
            var lasterr = this.api.LMSGetLastError();
            if (lasterr != '0')
            {
                var errorstr = this.api.LMSGetErrorString(lasterr);
                var diag = this.api.LMSGetDiagnostic(lasterr);
                var msg = "Error Calling: " + this.lastCmd + "<br>";
                msg += "LMSGetLastError() = " + lasterr + "<br>";
                msg += "LMSGetErrorString('" + lasterr + "') = " + errorstr + "<br>";
                msg += "LMSGetDiagnostic('" + lasterr + "') = " + diag;
                Utils.log(msg,'error');
            }
        };

        // LMSInitialize
        this.LMSInitialize=function(arg)
        {
            var success = this.api.LMSInitialize(arg);
            this.lastCmd = "LMSInitialize('" + arg + "') = " + success;
            this.logCommand();
            this.initialized = (success === 'true') ? true : false;
            if(this.initialized)
            {
                this.terminated = false;
                hasInitialized = true;
                for(var o in this.api)
                {
                    if(typeof this.api[o] != 'function')
                    {
                        this[o] = this.api[o];
                    }
                }

                this.__data = Utils.getInitAPIData(this.initData);
                for(var el in this.__data)
                {
                    loadDataIntoModel(el,this.__data[el]);
                }
            }
            return success;
        };

        // LMSFinish
        this.LMSFinish=function(arg)
        {
            var success = this.api.LMSFinish(arg);
            this.lastCmd = "LMSFinish('" + arg + "') = " + success;
            this.logCommand();
            if(success === 'true')
            {
                this.initialized = false;
                this.terminated = true;
                hasTerminated = true;
                if(this.__data['cmi.core.session_time'] && (this.__data['cmi.core.session_time'].length > 0))
                {
                    if(this.__data['cmi.core.total_time'] == null || this.__data['cmi.core.total_time'] == '')
                    {
                        this.__data['cmi.core.total_time'] = '0000:00:00.00';
                    }
                    var totalTime = Utils.addTime(this.__data['cmi.core.total_time'], this.__data['cmi.core.session_time']);
                    this.__data['cmi.core.total_time'] = totalTime;

                    var cdata = this.__data.toJSONString();
                    storageObject.persist(this.cookiename,cdata,365);

                    Utils.log('Total Time (cmi.core.total_time): '+totalTime,'info');
                }

                if(closeOnFinish)
                {
                    if(scoWin && !scoWin.closed)
                    {
                        Utils.closeSCO();
                    }
                }
            }
            return success;
        };

        // LMSGetValue
        this.LMSGetValue=function(name)
        {
            var value = unescape(this.api.LMSGetValue(name));
            this.lastCmd = "LMSGetValue('" + name + "') = " + value;
            this.logCommand();
            return value;
        };

        // LMSSetValue
        this.LMSSetValue=function(name, value)
        {
            var success = this.api.LMSSetValue(name, escape(value));
            this.lastCmd = "LMSSetValue('" + name + "','" + value + "') = " + success;
            this.logCommand();

            if(success === 'true')
            {
                this.__data[name] = value;
            }

            return success;
        };

        // LMSCommit
        this.LMSCommit=function(arg)
        {
            var success = this.api.LMSCommit(arg);
            this.lastCmd = "LMSCommit('" + arg + "') = " + success;
            this.logCommand();

            if(success === 'true')
            {
                var cdata = this.__data.toJSONString();
                storageObject.persist(this.cookiename,cdata,365);
            }

            return success;
        };

        // LMSGetErrorString
        this.LMSGetErrorString=function(arg)
        {
            var errorstr = this.api.LMSGetErrorString(arg);
            Utils.log("LMSGetErrorString('" + arg + "') = " + errorstr,'entry');
            return errorstr;
        };

        // LMSGetLastError
        this.LMSGetLastError=function()
        {
            var lasterr = this.api.LMSGetLastError();
            Utils.log("LMSGetLastError() = " + lasterr,'entry');
            return lasterr;
        };

        // LMSGetDiagnostic
        this.LMSGetDiagnostic=function(arg)
        {
            var diag = this.api.LMSGetDiagnostic(arg);
            Utils.log("LMSGetDiagnostic('" + arg + "') = " + diag,'entry');
            return diag;
        };
    };

    // Utilities
    // ----------------------------------------------------------------------------
    this.Utils = {
        getInitAPIData:function(initData)
        {
            if(storageObject.retrieve(API.cookiename) !== null && storageObject.retrieve(API.cookiename) !== undefined)
            {
                return storageObject.retrieve(API.cookiename).parseJSON();
            }
            else
            {
                return initData;
            }
        },
        dumpAPI:function()
        {
            if(API.__data)
            {
                Utils.log('<b>Dumping API object:</b> <blockquote> ' + this.formatAPIData(API.__data.toJSONString()) + '</blockquote>','info');
            }
            else
            {
                Utils.log('ERROR: API object contains no data.','error');
            }
        },

        dumpExistingAPIData:function()
        {
            if(storageObject.retrieve(cookieName) !== undefined && storageObject.retrieve(cookieName) !== null)
            {
                var existingData = storageObject.retrieve(cookieName);
                Utils.log('<b>Existing API Data (from '+storageObject.toString()+' &quot;'+cookieName+'&quot; - To be used in API during initialization):</b> <blockquote> ' + this.formatAPIData(existingData) + '</blockquote>','info');
            }
            else
            {
                Utils.log('No Existing API data found in &quot;'+cookieName+'&quot;. Will use default init data.','info');
            }
        },

        formatAPIData:function(str)
        {
            var html;
            html = this.replaceAll(str, '{"', '{<br>"');
            html = this.replaceAll(html, '"}', '"<br>}');
            html = this.replaceAll(html, '","', '",<br>"');

            return html;
        },

        replaceAll:function(text, strA, strB)
        {
            return text.replace( new RegExp(strA,"g"), strB );
        },

        addTime:function(first, second)
        {
            var sFirst = first.split(":");
            var sSecond = second.split(":");
            var cFirst = sFirst[2].split(".");
            var cSecond = sSecond[2].split(".");
            var change = 0;

            FirstCents = 0;  //Cents
            if (cFirst.length > 1) {
                FirstCents = parseInt(cFirst[1],10);
            }
            SecondCents = 0;
            if (cSecond.length > 1) {
                SecondCents = parseInt(cSecond[1],10);
            }
            var cents = FirstCents + SecondCents;
            change = Math.floor(cents / 100);
            cents = cents - (change * 100);
            if (Math.floor(cents) < 10) {
                cents = "0" + cents.toString();
            }

            var secs = parseInt(cFirst[0],10)+parseInt(cSecond[0],10)+change;  //Seconds
            change = Math.floor(secs / 60);
            secs = secs - (change * 60);
            if (Math.floor(secs) < 10) {
                secs = "0" + secs.toString();
            }

            mins = parseInt(sFirst[1],10)+parseInt(sSecond[1],10)+change;   //Minutes
            change = Math.floor(mins / 60);
            mins = mins - (change * 60);
            if (mins < 10) {
                mins = "0" + mins.toString();
            }

            hours = parseInt(sFirst[0],10)+parseInt(sSecond[0],10)+change;  //Hours
            if (hours < 10) {
                hours = "0" + hours.toString();
            }

            if (cents != '0') {
                return hours + ":" + mins + ":" + secs + '.' + cents;
            } else {
                return hours + ":" + mins + ":" + secs;
            }
        },
        openWindow:function(winURL,winName,winW,winH,winOpts)
        {
            winOptions = winOpts+",width=" + winW + ",height=" + winH;
            newWin = window.open(winURL,winName,winOptions);
            newWin.moveTo(0,0);
            newWin.focus();
            return newWin;
        },
        log:function(status,style)
        {
            var timeFix=function(time)
            {
                return (time<10) ? '0'+time : time;
            };
            var d = new Date();
            var hrs = timeFix(d.getHours());
            var min = timeFix(d.getMinutes());
            var sec = timeFix(d.getSeconds());
            var tmp = (style) ? '<div class="'+style+'">' : '<div class="entry">';
            tmp += '&gt; '+hrs+':'+min+':'+sec+' ';
            tmp += status;
            tmp += '</div>';

            $('debug').innerHTML += tmp;
            $('debug').scrollTop = $('debug').scrollHeight;
        },
        clearCookieData:function()
        {
            var cookieNameAltVal = $('cookieNameAlt').value;

            if(cookieNameAltVal.length > 0)
            {
                if(storageObject.retrieve(cookieNameAltVal))
                {
                    storageObject.remove(cookieNameAltVal);
                    Utils.log(storageObject.toString()+'"'+$('cookieNameAlt').value+'" Cleared','info');
                }
                else
                {
                    Utils.log(storageObject.toString()+'"'+$('cookieNameAlt').value+'" Not Found','error');
                }
            }
            else
            {
                if(storageObject.retrieve(cookieName))
                {
                    storageObject.remove(cookieName);
                    Utils.log(storageObject.toString()+'"'+cookieName+'" Cleared','info');
                }
                else
                {
                    Utils.log(storageObject.toString()+'"'+cookieName+'" Not Found','error');
                }
            }
        },
        genNewSessionName:function()
        {
            var d = new Date();
            var hrs = d.getHours();
            var min = d.getMinutes();
            var sec = d.getSeconds();

            if(useParentFolderAsCookieName)
            {
                var tmp = parentFolder+'_';
            }
            else
            {
                var tmp = 'SimpleAPI_Data_';
            }

            tmp += hrs+'.'+min+'.'+sec;

            $('cookieNameAlt').value = tmp;
        },
        watchWin:function()
        {
            if(scoWin && !scoWin.closed)
            {
                initTimeout += 1000;
                if(initTimeout >= initTimeoutMax)
                {
                    if(!API.initialized && !timeoutErrorDisplayed)
                    {
                        this.log('ERROR: LMSInitialize not called within 20 seconds from launching.', 'error');
                        timeoutErrorDisplayed = true;
                    }
                }

                setTimeout(function(){Utils.watchWin()},1000);
            }
            else
            {
                this.log('SCO Closed','info');
                if(!hasInitialized)
                {
                    this.log('ERROR: LMSInitialize was never called.', 'error');
                }
                if(!hasTerminated)
                {
                    this.log('ERROR: LMSFinish was never called.', 'error');
                }
            }
        },
        launchSCO:function()
        {
            // Reset the SimpleAPI
            hasTerminated = false;
            hasInitialized = false;
            API.terminated = false;
            API.initialized = false;
            initTimeout = 0;
            timeoutErrorDisplayed = false;

            var launchFileAltVal = $('launchFileAlt').value;
            var cookieNameAltVal = $('cookieNameAlt').value;

            if(launchFileAltVal.length > 0)
            {
                launchFile = launchFileAltVal;
                if(launchFileAltVal.indexOf(":") == 1)
                {
                    launchFile = "file:///"+launchFile;
                }
            }

            if(cookieNameAltVal.length > 0)
            {
                API.cookiename = cookieName = cookieNameAltVal;
            }

            if(launchWithCustomApiProperty)
            {
                try
                {
                    var key = $('customApiKey').value;
                    var val = $('customApiValue').value;
                    if(key && val)
                    {
                        API[key] = val;
                    }
                    Utils.log('Injected custom key/value into API object: '+key+'='+val,'info');
                }
                catch(e)
                {
                    Utils.log('ERROR: Cannot inject custom key/value into API object: '+key+'='+val+ '('+e+')','error');
                }
            }

            try
            {
                var w = (($('winW').value != "") && ($('winW').value > 0)) ? $('winW').value : wWidth;
                var h = (($('winH').value != "") && ($('winH').value > 0)) ? $('winH').value : wHeight;
                var embedParam = '';
                if(launchWithEmbeddedParam)
                {
                    try
                    {
                        embedParam = $('searchString').value;
                        Utils.log('Appending search string to launch file: '+$('searchString').value,'info');
                    }
                    catch(e)
                    {
                        embedParam = '';
                    }
                }
                else
                {
                    embedParam = '';
                }

                var opts = '';
                opts += (wToolbar) ? 'toolbar=yes,' : '';
                opts += (wTitlebar) ? 'titlebar=yes,' : '';
                opts += (wLocation) ? 'location=yes,' : '';
                opts += (wStatus) ? 'status=yes,' : '';
                opts += (wScrollbars) ? 'scrollbars=yes,' : '';
                opts += (wResizable) ? 'resizable=yes,' : '';
                opts += (wMenubar) ? 'menubar=yes,' : '';
                opts = opts.substring(0, opts.length-1)

                Utils.log("Launching SCO win with options: "+opts)

                scoWin = this.openWindow(launchFile+embedParam,"SCOwindow",w,h,opts);
            }
            catch (e)
            {
                Utils.log('ERROR: '+e.description, 'error');
            }

            if(scoWin !== null)
            {
                try
                {
                    Utils.log('SCO Launched','info');
                    scoWin.focus();
                    this.watchWin();
                }
                catch (e)
                {
                    Utils.log('ERROR: '+err.description,'error');
                }
            }
            else
            {
                Utils.log('ERROR: SCO windows unable to open.  Please disable any popup blockers you might have enabled and ensure the launch file path is correct.', 'error');
            }
        },
        closeSCO:function()
        {
            try
            {
                if(scoWin && !scoWin.closed)
                {
                    Utils.log('Attempting to close SCO window...','info');
                    scoWin.close();
                }
            }
            catch(e)
            {
                Utils.log('ERROR: Unable to close SCO window ('+e.description+')','error');
            }
        },
        toggleDisplay:function(elm)
        {
            $(elm).style.display = ($(elm).style.display == 'block') ? 'none' : 'block';
        },
        toggleCloseOnFinishOption:function(chkd)
        {
            closeOnFinish = chkd;
        },
        toggleEmbeddedParam:function(chkd)
        {
            launchWithEmbeddedParam = chkd;
            $('searchString').disabled = !chkd;

        },
        toggleCustomKeyValueOption:function(chkd)
        {
            launchWithCustomApiProperty = chkd;
            $('customApiKey').disabled = !chkd;
            $('customApiValue').disabled = !chkd;
        },
        toggleWindowOption:function(prop,el)
        {
            window[prop] = el.checked;
        },
        enableAllWindowOptions:function()
        {
            wToolbar = true;
            wTitlebar = true;
            wLocation = true;
            wStatus = true;
            wScrollbars = true;
            wResizable = true;
            wMenubar = true;
            $('wToolbarOption').checked = true;
            $('wTitlebarOption').checked = true;
            $('wLocationOption').checked = true;
            $('wStatusOption').checked = true;
            $('wScrollbarsOption').checked = true;
            $('wResizableOption').checked = true;
            $('wMenubarOption').checked = true;
        },
        disableAllWindowOptions:function()
        {
            wToolbar = false;
            wTitlebar = false;
            wLocation = false;
            wStatus = false;
            wScrollbars = false;
            wResizable = false;
            wMenubar = false;
            $('wToolbarOption').checked = false;
            $('wTitlebarOption').checked = false;
            $('wLocationOption').checked = false;
            $('wStatusOption').checked = false;
            $('wScrollbarsOption').checked = false;
            $('wResizableOption').checked = false;
            $('wMenubarOption').checked = false;
        },
        loadManifest:function()
        {
            var xmlDoc = null;
            var file = fullPath+"/imsmanifest.xml";

            var useManifest=function()
            {
                try
                {
                    var m = xmlDoc.getElementsByTagName("manifest")[0];

                    var orgs = xmlDoc.getElementsByTagName("organizations")[0];
                    var org = orgs.getElementsByTagName("organization")[0];
                    var orgTitle = org.getElementsByTagName("title")[0].firstChild.nodeValue;

                    var items = org.getElementsByTagName("item");
                    var item = items[0];
                    var itemTitle = item.getElementsByTagName("title")[0].firstChild.nodeValue;
                    var itemMasteryScore = item.getElementsByTagName("adlcp:masteryscore")[0].firstChild.nodeValue;
                    var itemIdentifier = item.getAttribute("identifier");
                    var itemIdentifierRef = item.getAttribute("identifierref");

                    var resources = xmlDoc.getElementsByTagName("resources")[0];
                    var resource = resources.getElementsByTagName("resource");
                    var itemResource = null;
                    for(var i=0;i<resource.length;i++)
                    {
                        var id = resource[i].getAttribute("identifier");
                        var scormtype = resource[i].getAttribute("adlcp:scormtype");
                        if(id == itemIdentifierRef && scormtype.toLowerCase() == "sco")
                        {
                            itemResource = resource[i];
                        }
                    }
                    var itemResourceHref = itemResource.getAttribute("href");

                    Utils.log('IMS Manifest: Organization Title = &quot;'+orgTitle+'&quot;','entry');
                    if(items.length > 1)
                    {
                        Utils.log('IMS Manifest: SimpleAPI detected multiple SCO references - Only the first will be launched.','entry');
                    }
                    Utils.log('IMS Manifest: First SCO Item = &quot;'+itemTitle+'&quot; (Mastery Score: '+itemMasteryScore+' / Identifier: &quot;'+itemIdentifier+'&quot;)','entry');
                    Utils.log('IMS Manifest: Resource &quot;'+itemIdentifierRef+'&quot; HREF for Item &quot;'+itemIdentifier+'&quot; = &quot;'+itemResourceHref+'&quot;');

                    var obj = {};
                    obj.id = m.getAttribute("identifier");
                    obj.orgTitle = orgTitle;
                    obj.itemTitle = itemTitle;
                    obj.itemMasteryScore = itemMasteryScore;
                    obj.itemResourceHref = itemResourceHref;

                    $('launchFileAlt').value = itemResourceHref;

                    return obj;
                }
                catch(e)
                {
                    error=e.message;
                    Utils.log('IMS Manifest: Cannot locate or parse manifest - '+error,'error');
                    return false;
                }
            };

            /* - For Webkit - Not now though...
            // Check for the various File API support.
            if (window.File && window.FileReader) {
              alert('Great success! All the File APIs are supported.');
            } else {
              alert('The File APIs are not fully supported in this browser.');
            }
            */


            try //Internet Explorer
            {
                xmlDoc=new ActiveXObject("Microsoft.XMLDOM");
                xmlDoc.async=false;
                xmlDoc.onreadystatechange = function()
                {
                    if(xmlDoc.readyState == 4)
                    {
                        useManifest();
                    }
                }
                var success = xmlDoc.load(file);
            }
            catch(e)
            {
                try //Firefox, Mozilla, Opera, etc.
                {
                    xmlDoc=document.implementation.createDocument("","",null);
                    xmlDoc.async=false;
                    xmlDoc.onload = function()
                    {
                        useManifest();
                    };
                    var success = xmlDoc.load(file);
                }
                catch(e)
                {
                    try //Google Chrome
                    {
                        var xmlhttp = new window.XMLHttpRequest();
                        xmlhttp.open("GET",file,false);
                        xmlhttp.send(null);
                        xmlDoc = xmlhttp.responseXML.documentElement;
                        //alert(success);
                    }
                    catch(e)
                    {
                        error=e.message;
                        Utils.log('IMS Manifest: Cannot locate or parse manifest - '+error,'error');

                        return false;
                    }
                }
            }
        }
    };

    // General/Global
    // ----------------------------------------------------------------------------
    this.init=function()
    {
        scoWin = null;
        var manifestObj = null;

        if(!skipManifestCheck)
        {
            var manifestObj = Utils.loadManifest();
        }

        if(!manifestObj)
        {
            if(useParentFolderAsCookieName)
            {
                cookieName = parentFolder;
            }
        }
        else
        {
            if(manifestObj.id)
            {
                cookieName = manifestObj.id;
            }

            if(manifestObj.itemResourceHref)
            {
                $('launchFileAlt').value = manifestObj.itemResourceHref;
            }
        }

        var api = new GenericAPIAdaptor();
        API = new SimpleAPI(cookieName,api,initialState);

        // test for localStorage
        if(typeof(Storage) !== "undefined")
        {
            try {
              if (('localStorage' in window) && window['localStorage'] && window.localStorage !== null)
              {
                storageObject = localStorageObject;
              }
              else
              {
                storageObject = cookieStorageObject;
              }
            } catch(e) {
              storageObject = cookieStorageObject;
            }
        }
        else
        {
            storageObject = cookieStorageObject;
        }

        $('cookieNameAlt').value = cookieName;

        $('winW').value = wWidth;
        $('winH').value = wHeight;

        $('wToolbarOption').checked = wToolbar;
        $('wTitlebarOption').checked = wTitlebar;
        $('wLocationOption').checked = wLocation;
        $('wStatusOption').checked = wStatus;
        $('wScrollbarsOption').checked = wScrollbars;
        $('wResizableOption').checked = wResizable;
        $('wMenubarOption').checked = wMenubar;

        Utils.toggleDisplay('optionSet');
        Utils.toggleDisplay('debug');

        if(closeOnFinish)
        {
            $('closeOnFinishOption').checked = true;
        }

        launchWithEmbeddedParam = $('toggleEmbeddedOption').checked;
        launchWithCustomApiProperty = $('toggleCustomKeyValueOption').checked;

        $('searchString').disabled = !launchWithEmbeddedParam;
        $('customApiKey').disabled = !launchWithCustomApiProperty;
        $('customApiValue').disabled = !launchWithCustomApiProperty;


        $('searchString').value = defaultSearchString;
        $('customApiKey').value = defaultCustomApiKey;
        $('customApiValue').value = defaultCustomApiValue;

        Utils.log('Storage type will be: '+storageObject.toString(),'info');

        Utils.dumpExistingAPIData();
    };

    this.sendSimApi=function(simAPI,title,totalToInclude,totalIncorrect,incStepNumberList)
    {
        Utils.log('Sim API Object: '+simAPI,'info');
        Utils.log('Sim Title: '+title,'info');
    };

    this.$=function(id)
    {
        var el = document.getElementById(id);
        return el;
    };

    // Cookie Object interface
    this.cookieStorageObject={
        persist:function(name,data,lifetime)
        {
            saveCookie(name,data,lifetime)
        },
        retrieve:function(name)
        {
            return readCookie(name);
        },
        remove:function(name)
        {
            deleteCookie(name);
        },
        toString:function()
        {
            return "Cookie";
        }
    };

    // LocalStorage Interface
    this.localStorageObject={
        persist: function(name,data,lifetime)
        {
            localStorage[name] = data;
        },
        retrieve:function(name)
        {
            return localStorage[name];
        },
        remove:function(name)
        {
            delete localStorage[name];
        },
        toString:function()
        {
            return "LocalStorage";
        }
    };

    window.onload=function()
    {
        this.init();
    };