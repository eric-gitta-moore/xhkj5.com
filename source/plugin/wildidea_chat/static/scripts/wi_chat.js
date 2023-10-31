/**
 * Created by discuzX.
 * @author wildidea <lirongtong@hotmail.com>
 * @gitHub https://github.com/lirongtong
 * @date 2017-2-19 18:00
 */
;(function(top, win, $){
    'use strict';
    /* selector */
    var faceBtn_dom = 'add-face-btn',
        faceImg_dom = 'chat-face-images',
        footer_dom = 'chat-toolbar-footer',
        text_dom = 'chat-textarea',
        panelBody_dom = 'chat-panel-body',
        FACE_TEXT_MAX_NUM = 20,
        faceTextReg = /\[([A-Z\u4e00-\u9fa5]{1,20}?)\]/gi,
        ws, wsFlag = true, tempLatestContent,
        lastSendTime_dom = 'last-send-time',
        chatContentBody_dom = 'chat-content-body',
        sendBtn_dom = 'send-chat-btn',
        memberLoading_dom = 'chat-member-loading',
        memberId_dom = 'chat-member-id-',
        memberList_dom = 'chat-member-list',
        contentScroll, memberScroll, tempMemberList, tempAvatar,
        initTitle = document.title, titleFlashing = true,
        noContent_dom = 'no-chat-content',
        memberPanelBody_dom = 'member-panel-body',
        contentContainer_dom = 'chat-container',
        listContainer_dom = 'list-container',
        maskContainer_dom = 'mask-container',
        touchDevice = 'ontouchstart' in win;
    /* auto grow textarea */
    var autoGrowTextArea = {
        init: function(options){
            this.id = options.id;
            this.elem = document.getElementById(this.id);
            this.maxHeight = options.maxHeight;
            this.initHeight = options.initHeight;
            this.hiddenTextArea = $(this.elem).clone().get(0);
            this.hiddenTextArea.id = 'chat-hidden-textarea';
            this.hiddenTextArea.style.height = this.initHeight+'px';
            this.hiddenTextArea.style.width = this.elem.clientWidth+'px';
            $(this.hiddenTextArea).addClass('hidden-textarea');
            this.elem.parentNode.appendChild(this.hiddenTextArea);
            this.bindHandler();
        },
        handleEvent: function(e){
            var type = e.type;
            if(type == 'input'){this.adjust();}
        },
        bindHandler: function(){
            var context = this;
            $(this.elem).on('input', function(e){
                context.handleEvent(e);
            });
        },
        adjust: function(){
            this.hiddenTextArea.value = this.elem.value;
            this.hiddenTextArea.style.width = this.elem.clientWidth+'px';
            var scrollHeight = this.hiddenTextArea.scrollHeight - 2;
            if(scrollHeight > this.maxHeight){
                scrollHeight = this.maxHeight;
            }else if(scrollHeight < this.initHeight){
                scrollHeight = this.initHeight;
            }
            var oldHeight = parseInt(this.elem.style.height) || 0;
            if(oldHeight !== scrollHeight){
                $(this.elem).css({'height': scrollHeight});
                handlers.onChangeTextAreaHeight();
            }
        },
        reset: function(){
            this.hiddenTextArea.style.height = this.initHeight;
            this.hiddenTextArea.style.width = parseInt(this.elem.style.width);
        },
        getContent: function(){
            return this.elem.value;
        },
        setContent: function(value){
            this.elem.value = value;
            this.reset();
            this.adjust();
        }
    };
    /* handlers */
    var handlers = {
        /* auto */
        onChangeTextAreaHeight: function(){
            var $footer = $('#' + footer_dom), $panelBody = $('#' + panelBody_dom),
                footerHeight = $footer.height();
            $panelBody.css({bottom: footerHeight});
            commands.refreshScroll(true);
        },
        /* send */
        onClickSend: function(){
            var $btn = $('#' + sendBtn_dom);
            $btn.off(touchDevice ? 'tap' : 'click');
            $btn.on(touchDevice ? 'tap' : 'click', function(){
                var content = autoGrowTextArea.getContent();
                if(content != ''){
                    commands.sendMessage(content);
                }
            });
        },
        /* emotion */
        onClickFace: function(){
            var $face = $('#'+faceBtn_dom);
            $face.off(touchDevice ? 'tap' : 'click');
            $face.on(touchDevice ? 'tap' : 'click', function(){
                var emotion = $('#' + faceImg_dom).get(0), panel = $('#' + panelBody_dom),
                    emotionHeight = parseInt($(emotion).height()),
                    emotionDisplay = emotion.style.display,
                    panelHeight = parseInt(panel.height());
                if(emotionDisplay == '' || emotionDisplay == 'none'){
                    if(emotionHeight <= panelHeight){
                        emotion.style.display = 'block';
                    }else modal.error(LANG['emotionArea']);
                }else{
                    emotion.style.display = 'none';
                }
                handlers.onChangeTextAreaHeight();
                commands.refreshScroll(true);
            });
        },
        /* select emotion */
        onClickEmotion: function(){
            var $image = $('#'+faceImg_dom);
            $image.delegate('img', 'click', function(e){
                if(e.target && e.target.title){
                    var image = $('#'+faceImg_dom).get(0), $text = $('#'+text_dom);
                    autoGrowTextArea.setContent(autoGrowTextArea.getContent()+'['+e.target.title+']');
                    $text.focus();
                    if(EMOTION_SWITCH){
                        image.style.display = 'none';
                        handlers.onChangeTextAreaHeight();
                        commands.refreshScroll(true);
                    }
                }
            });
        },
        /* keydown */
        onKeyDownText: function(){
            var $text = $('#'+text_dom);
            $text.off('keydown');
            $text.on('keydown', function(e){
                var _this = this, content = autoGrowTextArea.getContent(),
                    selectTxt = win.getSelection();
                var useEnter = function(){
                    /* wrap Ctrl+Enter */
                    if(e.ctrlKey && e.keyCode == 13){
                        e.preventDefault();
                        autoGrowTextArea.setContent(content + '\n');
                        return false;
                    }
                    /* send */
                    if(e.keyCode == 13){
                        e.preventDefault();
                        if(content != ''){
                            commands.sendMessage(content);
                            return false;
                        }
                    }
                };
                if(e.keyCode == 8 || e.keyCode == 46){
                    /* select text */
                    if(selectTxt.toString().length > 0) return true;
                    /* delete */
                    var textObj = $(_this).get(0),
                        _start = textObj.selectionStart;
                    if(_start < 3) return true;
                    var len = content.length;
                    if(content.charAt(_start - 1) === ']' && len >= 3){
                        /* emotion */
                        var isFaceText = content.substring(len - FACE_TEXT_MAX_NUM, len),
                            otherText = content.substring(0, len - FACE_TEXT_MAX_NUM);
                        isFaceText = isFaceText.replace(faceTextReg, '@#[$1]@#');
                        var isFaceTextArr = isFaceText.split('@#'),
                            contentTextArrLen = isFaceTextArr.length;
                        if(contentTextArrLen > 1){
                            var isFaceIndex = contentTextArrLen - 2;
                            if(faceTextReg.test(isFaceTextArr[isFaceIndex])){
                                var faceWord = isFaceTextArr[isFaceIndex].replace('[', '').replace(']', ''),
                                    faceTextMatchName = EMOTION_MAP[faceWord],
                                    faceTextLen = faceWord.length + 2;
                                if(faceTextMatchName){
                                    isFaceTextArr.splice(isFaceIndex, 1);
                                    var noFaceText = '';
                                    for(var i = 0; i < contentTextArrLen - 1; i++){
                                        if(isFaceTextArr[i]){
                                            noFaceText += isFaceTextArr[i];
                                        }
                                    }
                                    autoGrowTextArea.setContent(otherText + noFaceText);
                                    textObj.setSelectionRange(_start-faceTextLen, _start-faceTextLen);
                                    return false;
                                }
                            }
                        }
                    }
                    var textTemp = content.substring(0, _start - 1);
                    if(_start < len) textTemp += content.substring(_start, len);
                    autoGrowTextArea.setContent(textTemp);
                    textObj.setSelectionRange(_start-1, _start-1);
                    return false;
                }else{
                    if(touchDevice){
                        useEnter();
                    }else{
                        if(!ENABLE_CTRL_ENTER){
                            /* Enter */
                            useEnter();
                        }else{
                            /* Ctrl+Enter */
                            if(e.ctrlKey && e.keyCode == 13){
                                e.preventDefault();
                                if(content != '') commands.sendMessage(content);
                                return false;
                            }
                            if(e.keyCode == 13){
                                e.preventDefault();
                                autoGrowTextArea.setContent(content + '\n');
                                return false;
                            }
                        }
                    }
                }
            });
        },
        /**
         * remind
         * @return {void}
         */
        onNewsTip: function(){
            var tipsHandler = setInterval(function(){
                var title = document.title;
                if(titleFlashing == true){
                    if(title.indexOf(LANG['news']) <= 0){
                        document.title = LANG['lbCN']+LANG['hasNews']+LANG['rbCN'];
                    }else{
                        document.title = LANG['lbCN']+'　　　　　'+LANG['rbCN'];
                    }
                }else{
                    document.title = initTitle;
                    clearInterval(tipsHandler);
                }
            }, 500);
        },
        /**
         * flashing
         * @return {void}
         */
        onFocusBlur: function(){
            win.onfocus = function(){
                titleFlashing = false;
            };
            win.onblur = function(){
                titleFlashing = true;
            };
            /* for IE */
            document.onfocusin = function(){
                titleFlashing = false;
            };
            document.onfocusout = function(){
                titleFlashing = true;
            };
        },
        /**
         * init
         * @return {void}
         */
        onReadyChat: function(){
            $.post(REMOTE + 'chat&act=join', {uid: UID, uname: UNAME});
            $.post(REMOTE + 'message&act=get', {}, function(response){
                if(response.status){
                    commands.listMessage(response);
                    $.post(REMOTE + 'member&act=get', {}, function(res){
                        var $loading = $('#'+memberLoading_dom), li = '',
                            $list = $('#' + memberList_dom);
                        $loading.remove();
                        tempMemberList = res.data;
                        for(var i in res.data){
                            var cur = res.data[i];
                            li += '<li class="list-item" id="'+memberId_dom+cur.uid+'">'
                                + '<a href="home.php?mod=space&uid='+cur.uid+'" target="_blank" class="avatar">'
                                + '<img src="'+SITE_URL+cur.avatar+'" class="member-face" /></a>'
                                + '<p class="chat-member-nick">'+cur.uname+'</p>';
                            if(tempLatestContent[cur.uid]){
                                li += '<p class="chat-member-message">'+($.trim(commands.parseContent(tempLatestContent[cur.uid]).replace(/(^\s*)|(\s*$)/g, '').replace(/[\r\n]/g, '').replace(/<br \/>/g, '')))+'</p>';
                            }
                            li += '</li>';
                        }
                        $list.append(li);
                        commands.refreshScroll(false);
                    }, 'json');
                }
            }, 'json');
        }
    };
    /* commands */
    var commands = {
        webSocket: function(){
            ws = new WebSocket('ws://'+HOST+':'+PORT);
            ws.onopen = function(){
                console.log(HOST+': websocket link is successful ( http://discuz.wildidea.cn ).');
                if(UID) handlers.onReadyChat();
                else{
                    $('#'+memberLoading_dom).html('<span class="color-9">'+LANG['login']+'</span>');
                    showWindow('login', 'member.php?mod=logging&action=login&mobile=no&referer='+encodeURIComponent(window.location));
                }
            };
            ws.onerror = function(){
                modal.error(LANG['wsFailed']);
                wsFlag = false;
            };
            ws.onmessage = function(e){
                var message = JSON.parse(e.data);
                if(message.uid){
                    var memberId = memberId_dom + message.uid,
                        $list = $('#' + memberList_dom);
                    if($('#' + memberId).length <= 0){
                        var li = '<li class="list-item" id="'+memberId_dom+message.uid+'">'
                            + '<a href="home.php?mod=space&uid='+message.uid+'" target="_blank" class="avatar">'
                            + '<img src="'+SITE_URL+message.avatar+'" class="member-face" /></a>'
                            + '<p class="chat-member-nick">'+message.uname+'</p>'
                            + '<p class="chat-member-message">'+($.trim(commands.parseContent(message.content).replace(/(^\s*)|(\s*$)/g, '').replace(/[\r\n]/g, '').replace(/<br \/>/g, '')))+'</p></li>';
                        $list.append(li);
                    }
                }
                commands.listMessage(message);
            };
        },
        /**
         * save
         * @param data
         * @param unique
         */
        saveMessage: function(data, unique){
            var $tip = $('#' + unique);
            $.post(REMOTE + 'message&act=save', {data: data}, function(response){
                if(response.status == 1){
                    if($tip.length > 0) $tip.empty();
                }else{
                    $tip.empty().html('<img class="chat-sending" src="'+STATIC+'/images/warning.png" title="'+response.message+'" />');
                }
            }, 'json');
        },
        /**
         * send
         * @param content
         */
        sendMessage: function(content){
            if(UID){
                if(!wsFlag){
                    modal.error(LANG['wsFailed']);
                    return ;
                }
                if(content == '') return ;
                autoGrowTextArea.setContent('');
                var message = JSON.stringify({content: content, type: 'user', uname: UNAME, uid: UID, avatar: AVATAR});
                ws.send(message);
            }else{
                modal.error(LANG['visitorBan']);
            }
        },
        /**
         * log
         * @param data
         */
        listMessage: function(data){
            if(data.type != 'handshake'){
                var content = '', $last = $('#' + lastSendTime_dom),
                    lastTime = parseInt($last.val()), date = new Date(),
                    unique = (date.getTime()).toString() + data.uid, completeTempTime = 0,
                    $content = $('#'+chatContentBody_dom), $noContent = $('#' + noContent_dom);
                if(data.type == 'user'){
                    var year = commands.formatTime(date.getFullYear()),
                        month = commands.formatTime(date.getMonth() + 1),
                        day = commands.formatTime(date.getDate()),
                        hour = commands.formatTime(date.getHours()),
                        mins = commands.formatTime(date.getMinutes());
                    completeTempTime = parseInt(year + month + day + hour + mins);
                    if(lastTime <= 0 || completeTempTime - lastTime > 1){
                        content += '<div class="chat-time"><span data-time="'+completeTempTime+'">'+hour+':'+mins+'</span></div>';
                        $last.val(completeTempTime);
                    }
                    content += commands.wrapMessage(data, unique);
                    if($noContent.length > 0) $noContent.remove();
                    $content.append(content);
                    autoGrowTextArea.reset();
                    commands.refreshScroll(true);
                    if(UID == data.uid){
                        contentScroll.scrollTo(0, contentScroll.maxScrollY, 0);
                        commands.saveMessage(data, unique);
                    }else{
                        var offsetTop = $('#' + contentContainer_dom).get(0).offsetTop,
                            scrollY = parseInt(contentScroll.maxScrollY) + offsetTop;
                        contentScroll.scrollTo(0, scrollY, 0);
                        $('#' + unique).remove();
                        handlers.onNewsTip();
                    }
                }else{
                    if(typeof data.data != 'undefined'){
                        var k = 1, len = Object.keys(data.data).length;
                        tempLatestContent = data['latest'];
                        tempAvatar = data['avatar'];
                        for(var i in data.data){
                            var cur = data.data[i];
                            if($.inArray(parseInt(i), data['times']) == -1){
                                for(var n in cur){
                                    if(n == 0){
                                        var recent = new Date(cur[n]['create_time'] * 1000),
                                            y = commands.formatTime(recent.getFullYear()),
                                            mon = commands.formatTime(recent.getMonth() + 1),
                                            d = commands.formatTime(recent.getDate()),
                                            h = commands.formatTime(recent.getHours()),
                                            m = commands.formatTime(recent.getMinutes());
                                        completeTempTime = parseInt(y + mon + d + h + m);
                                        content += '<div class="chat-time"><span data-time="'+completeTempTime+'">'+h+':'+m+'</span></div>';
                                    }
                                    content += commands.wrapMessage(cur[n], unique, true);
                                }
                            }else{
                                for(var r in cur){
                                    if(r == 0){
                                        var latest = new Date(cur[r]['create_time'] * 1000),
                                            cYear = latest.getFullYear(),
                                            cMonth = commands.formatTime(latest.getMonth() + 1),
                                            cDay = commands.formatTime(latest.getDate()),
                                            cHour = commands.formatTime(latest.getHours()),
                                            cMins = commands.formatTime(latest.getMinutes()),
                                            cSec = commands.formatTime(latest.getSeconds()),
                                            completeTime = cYear + '-' + cMonth + '-' + cDay + ' ' + cHour + ':' + cMins + ':' + cSec;
                                        completeTempTime = parseInt(cYear + cMonth + cDay + cHour + cMins);
                                        content += '<div class="chat-time"><span data-time="'+(cHour + cMins)+'">'+completeTime+'</span></div>';
                                    }
                                    content += commands.wrapMessage(cur[r], unique, true);
                                }
                            }
                            if(k == len){
                                /* last one */
                                $last.val(completeTempTime);
                            }
                            k++;
                        }
                        if(len <= 0) $content.append('<div class="no-chat-content" id="no-chat-content">'+LANG['noMsg']+'</div>');
                        $content.append(content);
                        commands.refreshScroll(true);
                        contentScroll.scrollTo(0, contentScroll.maxScrollY, 0);
                    }
                }
            }
        },
        /**
         * wrap
         * @param data
         * @param unique
         * @param init
         * @returns {string}
         */
        wrapMessage: function(data, unique, init){
            var self = '';
            if(data.uid == UID) self = 'self';
            var content = '<div class="chat-content-group '+self+'">';
            content += '<img class="chat-content-avatar" src="'+SITE_URL+(data.avatar ? data.avatar : (tempAvatar[data.uid] ? tempAvatar[data.uid] : AVATAR))+'" />';
            if(!init) content += '<div class="chat-content-tip" id="'+unique+'"><img class="chat-sending" src="'+STATIC+'/images/loading.gif" /></div>';
            self == '' ? content += '<p class="chat-nick">'+data.uname+'</p>' : '';
            var text = commands.parseContent(data.content).replace(/\n/ig, '<br />');
            commands.setLastMessage(text, data.uid);
            content += '<p class="chat-content">'+text+'</p></div>';
            return content;
        },
        /**
         * set last message
         * @param content
         * @param uid
         */
        setLastMessage: function(content, uid){
            var $member = $('#' + memberId_dom + uid),
                $message = $member.find('p.chat-member-message');
            content = $.trim(content).replace(/(^\s*)|(\s*$)/g, '').replace(/[\r\n]/g, '').replace(/<br \/>/g, '');
            if($message.length > 0){
                $message.html(content);
            }else{
                $member.append('<p class="chat-member-message">'+content+'</p>');
            }
        },
        /**
         * parse content ( emotion )
         * @param content
         * @returns {*}
         */
        parseContent: function(content){
            var contentStr = '',
                isFaceText = content.replace(faceTextReg, '@#[$1]@#');
            var isFaceTextArr = isFaceText.split('@#'),
                contentTextArrLen = isFaceTextArr.length;
            for(var i = 0; i < contentTextArrLen; i++){
                var cur = isFaceTextArr[i];
                if(cur != ''){
                    if(new RegExp(faceTextReg).test(cur)){
                        var faceWord = cur.replace('[', '').replace(']', ''),
                            faceTextMatchName = EMOTION_MAP[faceWord];
                        if(faceTextMatchName){
                            contentStr += '<img class="chat-emotion" src="'+EMOTION_PATH+'/'+faceTextMatchName+'" width="24" height="24" />';
                        }else{
                            contentStr += '['+cur+']';
                        }
                    }else{
                        contentStr += cur;
                    }
                }
            }
            if(contentStr) return contentStr;
            else return content;
        },
        /**
         * format time +0
         * @param str
         * @returns {*}
         */
        formatTime: function(str){
            if(parseInt(str) < 10)
                return '0'+str;
            else
                return ''+str;
        },
        /**
         * refresh scroll
         * @param isContent
         */
        refreshScroll: function(isContent){
            if(typeof isContent == 'undefined'){
                contentScroll = new iScroll($('#' + panelBody_dom).get(0));
                memberScroll = new iScroll($('#' + memberPanelBody_dom).get(0));
            }else{
                if(isContent){
                    /* content list */
                    if(!contentScroll) contentScroll = new iScroll($('#' + panelBody_dom).get(0));
                    contentScroll.refresh();
                }else{
                    /* member list */
                    if(!memberScroll) memberScroll = new iScroll($('#' + memberPanelBody_dom).get(0));
                    memberScroll.refresh();
                }
            }
        }
    };
    /* modal */
    var modal = {
        show: function(content, type, width, height, title, okCallback, cancelCallback, animate){
            type = type ? type : 1;
            width = width ? (isNaN(width) ? 'auto' : width+'px') : 'auto';
            height = height ? (isNaN(height) ? 'auto' : height+'px') : 'auto';
            title = (typeof title == 'boolean' || title) ? title : LANG['reminder'];
            okCallback = typeof okCallback === 'function' ? okCallback : '';
            cancelCallback = typeof cancelCallback === 'function' ? cancelCallback : '';
            animate = animate ? (isNaN(animate) ? 2 : animate) : 2;
            var index;
            if(type == 1){
                index = layer.open({
                    type: 1,
                    title: title,
                    anim: animate,
                    area: [width, height],
                    content: content,
                    success: okCallback,
                    cancel: cancelCallback
                });
            }else{
                index = layer.open({
                    type: 2,
                    anim: animate,
                    title: title,
                    content: content,
                    area: [width, height],
                    success: okCallback,
                    cancel: cancelCallback
                });
            }
            return index;
        },
        hide: function(index){
            if(index) layer.close(index);
            else layer.closeAll();
        },
        tips: function(content, icon, time, func){
            time = time ? (isNaN(time) ? 2500 : time) : 2500;
            return layer.msg(content, {
                icon: icon,
                shade: [0.6, '#000'],
                time: time
            }, function(){
                if(typeof func === 'function') func.call();
            });
        },
        success: function(content, time, func){
            modal.tips(content, 1, time, func);
        },
        error: function(content, time, func){
            modal.tips(content, 2, time, func);
        }
    };
    /* initialize */
    $(document).ready(function(){
        /* browser */
        if(!-[1,] || !!window.ActiveXObject || 'ActiveXObject' in window || !win.WebSocket){
            $('#' + contentContainer_dom).remove();
            $('#' + listContainer_dom).remove();
            $('#' + maskContainer_dom).show().parent().addClass('p0');
            return false;
        }else{
            $('#' + listContainer_dom).show().parent().removeClass('p0');
            $('#' + contentContainer_dom).show();
            $('#' + maskContainer_dom).remove();
        }
        commands.webSocket();
        /* textarea */
        autoGrowTextArea.init({
            id: text_dom,
            initHeight: 32,
            maxHeight: 80
        });
        commands.refreshScroll();
        /* handlers */
        handlers.onFocusBlur();
        handlers.onClickSend();
        handlers.onClickFace();
        handlers.onClickEmotion();
        handlers.onKeyDownText();
        handlers.onChangeTextAreaHeight();
    });
})(window.parent, window, jQuery || $);