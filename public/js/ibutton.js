/*!
 * iButton JavaScript Library v0.0.1
 * https://www.ccc.tc
 *
 * Copyright by Devin Yang.
 * Released under the MIT license
 *
 * Date: 2020-04-13T21:04Z
 */
var iButton = function() {
    var debug = false;
    var unlock = false;
    var disabled_str = "";
    var countdown_prefix = "";
    var countdown_subfix = "";
    var elementList = null;
    var elm_debug_button_id = "";
    var open_status="💬";
    var close_status="🔒";
    function disabled_class(v){
        disabled_str=v;
    }
    function kernel(server_ts,elm, offset) {
            var st = new Date(); //JavaScript 目前時間
            var server_timestamp=(parseInt(st.getTime())+offset); //取得正確的Client時間與Sever相同時間
            for(var n in elm){
                if(typeof(elm[n])=="object"){
                    //console.log(elm[n]);
                    var unlock_ts=elm[n].dataset.open;
                    var lock_ts=elm[n].dataset.close;

                    console.log(); 
                    if(elm[n].id!=""){
                        var open_date="";
                        var close_date="";
                        var btn_id = elm[n].id;
                        var ibutton_opne = document.getElementById(btn_id+"_open");
                        var ibutton_close = document.getElementById(btn_id+"_close");
                        var ibutton_countdown = document.getElementById(btn_id+"_countdown");
                        var ibutton_countdown_hours = document.getElementById(btn_id+"_countdown_hours");
                        var options = {
                                year: 'numeric', month: 'numeric', day: 'numeric',
                                hour: 'numeric', minute: 'numeric', second: 'numeric',
                                hour12: false,
                                timeZone: Intl.DateTimeFormat().resolvedOptions().timeZone 
                              };
                        if(ibutton_opne){
                            open_date = new Date(parseInt(unlock_ts));
                            ibutton_opne.innerHTML= new Intl.DateTimeFormat('default',options).format(open_date);
                        }
                        if(ibutton_close){
                            close_date =new Date(parseInt(lock_ts));
                            ibutton_close.innerHTML= new Intl.DateTimeFormat('default',options).format(close_date);
                        }
                    }

                    if(unlock_ts==undefined){
                        console.log("data-open not found on elm");
                    }

                    if(lock_ts==undefined){
                        console.log("data-close not found on elm");
                    }

                    if(debug){
                        if (n == 0) {
                            console.log("ServerTime:" + new Date(parseInt(server_timestamp)))
                        }
                        if(unlock_ts==undefined){
                            console.log(elm[n]);
                        }else if (btn_id == elm_debug_button_id&&elm_debug_button_id!="") {
                            console.log("Button ID:"+btn_id);
                            console.log("UnlockTime:" + new Date(parseInt(unlock_ts))+" LockTime"+new Date(parseInt(lock_ts)));
                        }else {
                            console.log("UnlockTime:" + new Date(parseInt(unlock_ts))+" LockTime"+new Date(parseInt(lock_ts)));
                        }
                    }
                    if(!unlock){
                        if(parseInt(server_timestamp)>=parseInt(lock_ts)){
                            //close
                            if(!elm[n].classList.contains(disabled_str)&&disabled_str!=""){
                                elm[n].classList.add(disabled_str);
                            }

                        }else if(parseInt(server_timestamp)>=parseInt(unlock_ts)){
                            //open
                            if(elm[n].classList.contains(disabled_str)&&disabled_str!=""){
                                elm[n].classList.remove(disabled_str);
                            }
                        }else{
                            //close
                            if(!elm[n].classList.contains(disabled_str)&&disabled_str!=""){
                                elm[n].classList.add(disabled_str);
                            }
                        }

                    }else{
                        if(elm[n].classList.contains(disabled_str)&&disabled_str!=""){
                            elm[n].classList.remove(disabled_str);
                        }
                    }
                    //countdown timer
                    var countdown = unlock_ts - st;
                    var t = parseInt(countdown / 1000);
                    if (ibutton_countdown) {
                        if (t > 0) {
                            ibutton_countdown.innerHTML = countdown_prefix+t+countdown_subfix;
                        } else if(lock_ts >= st){
                            ibutton_countdown.innerHTML = open_status;
                        } else{
                            ibutton_countdown.innerHTML = close_status;
                        }
                    }
                    console.log(ibutton_countdown_hours);

                    if (ibutton_countdown_hours){
                        if (t > 0) {
                            itime = new Date(t * 1000).toISOString().substr(11, 8)
                            ibutton_countdown_hours.innerHTML = countdown_prefix+itime+countdown_subfix;

                        } else if(lock_ts >= st){
                            ibutton_countdown_hours.innerHTML = open_status;
                        } else{
                            ibutton_countdown_hours.innerHTML = close_status;
                        }

                    }

                }
            }
    }
    return {
        //解鎖
        unlock: function(){
            unlock=true;
            return true;
        },
        lock: function(){
            unlock=false;
            return true;
        },
        debug: function(btn_id=""){
            elm_debug_button_id=btn_id;
            debug=!debug;
            if(debug){
                return "Debug is On";
            }
                return "Debug is Off";
        },
        button: function(server_ts,disabled_str) {
            disabled_class(disabled_str);
            var curr_datetime = new Date(); //JavaScript 目前時間
            var client_dt=curr_datetime.getTime();
            var offset=server_ts-client_dt;//Server與Client的秒差
            setInterval(kernel,1000, server_ts, elementList, offset);
            return this;
        },
        q: function(elm,options={}){
            if(options.close_status) close_status=options.close_status;
            if(options.open_status) open_status=options.open_status;
            if(options.countdown_prefix) countdown_prefix=options.countdown_prefix;
            if(options.countdown_subfix) countdown_subfix=options.countdown_subfix;
            elementList = document.querySelectorAll(elm);
            return this;
        }
    };   
};