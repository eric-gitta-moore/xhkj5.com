/**
 * 浏览器判断
 * $.m_borwser.safari
 */
(function($) {

    var userAgent = navigator.userAgent.toLowerCase();
    var borwser={};

    borwser.opera = userAgent.indexOf('opera') != -1 && opera.version();
    borwser.firefox = (navigator.product == 'Gecko') && userAgent.substr(userAgent.indexOf('firefox') + 8, 3);
    borwser.msie = (userAgent.indexOf('msie') != -1 && !is_opera) && userAgent.substr(userAgent.indexOf('msie') + 5, 3);
    borwser.chrome = userAgent.indexOf('chrome') != -1 && userAgent.substr(userAgent.indexOf('chrome') + 7, 3);
    borwser.safari = userAgent.indexOf('safari') != -1 && userAgent.substr(userAgent.indexOf('safari') + 7, 3);
    borwser.qq = userAgent.indexOf('qqbrowser') != -1 && userAgent.substr(userAgent.indexOf('qqbrowser') + 9, 5);
    borwser.uc = userAgent.indexOf('ucbrowser') != -1 && userAgent.substr(userAgent.indexOf('safari') + 9, 9);

    $.m_borwser = borwser;

})(jQuery);


/**
 * tab切换
 * $('#id').m_nav({})
 * @author moufer<moufer@163.com>
 */
(function($) {

    $.fn.m_nav = function() {

        var navBox = $(this).find('.atab-box-nav');
        var areaBox = $(this).find('.atab-box-area');

        init = function() {
            var count = navBox.find('a').length;
            var width = Math.round(100/count);
            navBox.find('a').each(function()
            {
                var a = $(this);
                a.css({'width':width+'%'});
                if(areaBox[0]) {
                    a.click(function()
                    {
                        a_click(a);
                    }
                    ).attr('href','javascript:');
                }
            });
            if(!areaBox[0]) return;
            areaBox.find('.atab-box-area-dispay').hide();
            var current = navBox.find('a.atab-box-nav-current');
            if(current[0]) show_area(current.data('id'));
        }

        a_click = function(a) {
            navBox.find('a').each(function() {
                if(a.data('id') == $(this).data('id')) {
                    a.addClass('atab-box-nav-current');
                } else {
                    $(this).removeClass('atab-box-nav-current');
                }
            });
            areaBox.find('div.atab-box-area-dispay').hide();
            show_area(a.data('id'));
        }

        show_area = function(id) {
            areaBox.show();
            $('#'+id).show();
        }

        init();
    }

})(jQuery);

/**
 * 抽屉式弹出层
 * new $.m_drawer('#id',{})
 * @author moufer<moufer@163.com>
 */
(function($) {

    $.m_drawer = function(selector, options, callbacks) {

        //默认配置参数
        var _d_options = {
            place:'center',                 //显示方位 left, center, right 
            width:'100%',                   //宽度
            height:'auto',                  //高度
            type:'auto-top',                //显示形式
                                            //lock-top（显示在页面顶部，不随滚动条移动）
                                            //auto-top（显示在窗口顶部，不随滚动条移动）
                                            //auto-center（显示在窗口中央，不随滚动条移动）
                                            //auto-bottom（固定显示在页面顶部，不随滚动条移动）
                                            //float-top（显示在窗口顶部浮动，随窗口浮动）
                                            //float-center（显示在窗口中央浮动，随窗口浮动）
                                            //float-bottom（显示在窗口底部浮动，随窗口浮动）
            area_class: '',                 //工作区框架样式类（可选）
            direction:'top',                //进入方向 none，top，left，right
            speed:'fast'                    //进入速度 fast,normal,slow
        }

        //默认回调函数列表
        var _d_callbacks = {
            onInit:null,
            onOpen:null,
            onClose:null,
            onSubmit:null
        }

        //当前类
        var _drawer = this;
        //工作区内容
        var _my = $(selector);
        //插件配置参数
        var _opts = $.extend({}, _d_options, options);
        //回调函数
        var _callbacks = $.extend({}, _d_callbacks, callbacks);
        //插件框架div
        var $box = $('<div></div>').addClass('drawer-box');
        //模态层
        var $pattern = $('<div></div>').addClass('drawer-pattern');
        //工作区框架
        var $area = $('<div></div>').addClass('drawer-area');
        //设置工作区框架样式类
        if(_opts.area_class) $area.addClass(_opts.area_class);

        //是否第一次打开对话框
        this.is_first_open = true;
        /*
        _opts.place = 'center'; // left,center,right
        _opts.width = 90;
        _opts.height = 'auto';
        _opts.type = 'float-top'; //lock-top,auto-top,auto-center,auto-bottom,float-top,float-center,float-bottom
        _opts.direction = 'top'; //none,top,left,right
        _opts.speed = 'slow'; //fast,normal,slow
        */

        //初始化和绑定
        var _init = {

            //UI组装
            create:function() {
                //框架层
                $box.addClass('drawer-' + _opts.place).addClass('drawer-area-'+_opts.type);
                //最大宽度
                //var maxwidth = _opts.sizeunit == 'px' ? $(document.body).width() : 100;
                var height = _opts.height=='auto' ? 'auto' : (_opts.height);
                //工作区宽度和高度
                $area.css (
                {
                    'width' : _opts.width,
                    'height' : height
                }).hide();
                //模态层设置关闭类型并隐藏
                $pattern.attr('data-type','close').hide();
            },

            //显示时位置初始化
            show:function() {
                //模态层
                $pattern.height(Math.max($(window).height(),$(document.body).height())).width($(document.body).width());
                //如果是居中显示内容，则计算left进行定位
                if(_opts.place == 'center') {
                    var left = Math.round(($(document.body).width() - $area.width()) / 2);
                    $area.css('left', left + 'px');
                }
                //对话层显示定位
                if(_opts.type == 'auto-top') {
                    $area.css('top', $(window).scrollTop() + 'px');
                } else if (_opts.type == 'auto-center') {
                    var top = 0;
                    var body_height = $(document.body).height();
                    var scrollTop = $(window).scrollTop();
                    var height = $(window).height()-$area.height();
                    //页面比窗口高
                    if(height < 0) {
                        if(scrollTop > 1) {
                            //窗口顶部到页面底部大于对话层高
                            if(body_height - scrollTop >= height) {
                                top = scrollTop;
                            } else {
                                top = body_height-$area.height();
                            }
                        }
                        if(top < 0) top = 0;
                    } else {
                        top = scrollTop + Math.round(height / 2);
                    }
                    $area.css('top', top + 'px');
                } else if (_opts.type == 'auto-bottom') {
                    var top = $(window).scrollTop() + $(window).height() - $area.height();
                    $area.css('top', top + 'px');
                } else if (_opts.type == 'lock-bottom') {
                    var top = $(document.body).height() - $area.height();
                    $area.css('top', top + 'px');
                    $(window).scrollTop(top);
                } else if (_opts.type == 'float-top') {
                    $area.css({
                        position: 'fixed',
                        top: 0
                    });
                } else if (_opts.type == 'float-center') {
                    top = Math.round(($(window).height() - $area.height()) / 2);
                    if(top < 0) top = 0;
                    $area.css({
                        position: 'fixed',
                        top : top
                    });
                } else if (_opts.type == 'float-bottom') {
                    $area.css({
                        position: 'fixed',
                        bottom : 0
                    });
                };
            },

            //隐藏时的初始化操作
            hide:function() {
            },

            //载入
            load:function() {

                //页面元素初始化
                var d = _opts.place;
                _init.create();

                //插入网页
                $box.append($pattern).append($area.append(_my.css('display','block')));
                $(document.body).append($box);

                //初始化回调
                if(_callbacks.onInit) {
                    _callbacks.onInit(_drawer, $area);
                }
                //提交按钮回调
                if(_callbacks.onSubmit) {
                    var submit = $area.find('[data-type="submit"]');
                    if(submit[0]) {
                        submit.click(function() {
                            return _callbacks.onSubmit(_drawer, $area);
                        });
                    }
                }

                //绑定事件
                _event.bind();
            }
        };

        var _animate = {
            //显示动画
            show:function() {
                var attr = {};
                var speed = _opts.direction == 'none' ? 0 : _opts.speed;
                var overflowX = $(document.body).css('overflow-x');
                $box.show();
                //显示时必要的元素位置初始化
                _init.show();

                $area.show();
                if(_opts.place=='center') {
                    //lock-top,auto-top,auto-center,auto-bottom,float-top,float-center,float-bottom
                    if( _opts.type == 'lock-top' || _opts.type == 'float-top' || _opts.type == 'auto-top') {
                        attr.top = 0;
                        if(_opts.type == 'auto-top') {
                            attr.top = $area.offset().top;
                        }
                        $area.css({top:-$area.height()});
                    } else if(_opts.type == 'float-bottom' ) {
                        attr.bottom = 0;
                        $area.css({bottom:-$area.height()});
                    } else if(_opts.type == 'auto-bottom'||_opts.type == 'lock-bottom') {
                        attr.top = $area.offset().top;
                        attr.height = $area.height();
                        $area.css({top:attr.top + $area.height(), height:0});
                    } else {
                        attr.left = $area.offset().left;
                        if(parseInt(Math.random().toString().substr(2,1))%2==1) {
                            $area.css({left:$(window).width()});
                        } else {
                            $area.css({left:-$area.width()});
                        }
                        $(document.body).css('overflow-x','hidden');
                    }
                } else {
                    attr.left = $area.offset().left;
                    if(_opts.place == 'left') {
                        $area.css({left:-$area.width()});
                    } else {
                        $area.css({left:$(window).width()});
                    }
                    $(document.body).css('overflow-x','hidden');
                }

                //执行动画
                $pattern.fadeIn(speed);
                $area.animate(
                    attr, speed, function() {
                        $(document.body).css('overflow-x', overflowX);
                });
            },
            //隐藏动画
            hide:function() {
                var attr = {};
                var speed = _opts.direction == 'none' ? 0 : _opts.speed;
                //$(document.body).css('overflow-x','hidden');
                //$(document.body).css('overflow-x','auto');
                $pattern.fadeOut('fast');
                $area.fadeOut('fast');
                $box.fadeOut('fast');
                _init.hide();
            }
        };

        //行为事件处理
        var _event = {
            //打开抽屉层
            open:function () {
                //回调函数
                if(_callbacks.onOpen) {
                    var ret = _callbacks.onOpen(_drawer,_my);
                    if(ret==false) return;
                }
                _animate.show();
            },
            //关闭
            close:function () {
                //回调函数
                if(_callbacks.onClose) {
                    var ret = _callbacks.onClose(_drawer,_my);
                    if(ret == false) return;
                }
                _animate.hide();
            },
            //绑定事件
            bind:function() {
                $pattern.click(function() {
                    _event.close();
                });

                $box.find('[data-type="close"]').click(function() {
                    _event.close();
                });
            }
        };

        //打开
        this.open = function(callback) {
            if(callback) {
                _callbacks.onOpen = callback;
            }
            _event.open();
            this.is_first_open = false;
        }

        //关闭
        this.close = function(callback) {
            if(callback) {
                _callbacks.onClose = callback;
            }
            _event.close();
        }

        //删除
        this.remove = function(callback) {
            if(callback) {
                _callbacks.onRemove = callback;
            }
            //回调函数
            if(_callbacks.onRemove) {
                var ret = _callbacks.onRemove(_drawer,$area);
                if(ret == false) return;
            }
            $box.remove();
        }

        //返回工作区对象
        this.area = function() {
            return $area;
        }

        _init.load();

    }

})(jQuery);