(function() {
    (function(jq, window, document) {
        var Plugin, defaults, pluginName;
        pluginName = "xmSlide";
        defaults = {
            width: 1000,
            height: 528,

            // add by Sivan
            responsiveWidth: 1000,
            start: 1,
            navigation: {
                active: true,
                effect: "slide"
            },
            pagination: {
                active: true,
                effect: "slide"
            },
            play: {
                active: false,
                effect: "slide",
                interval: 5000,
                auto: false,
                swap: true,
                pauseOnHover: false,
                restartDelay: 2500
            },
            effect: {
                slide: {
                    speed: 500
                },
                fade: {
                    speed: 300,
                    crossfade: true
                }
            },
            callback: {
                loaded: function() {},
                start: function() {},
                complete: function() {}
            }
        };
        Plugin = (function() {

            function Plugin(element, options) {
                this.element = element;
                this.options = jq.extend(true, {}, defaults, options);
                this._defaults = defaults;
                this._name = pluginName;
                this.init();
            }

            return Plugin;

        })();
        Plugin.prototype.init = function() {
            var jqelement, nextButton, pagination, playButton, prevButton, stopButton,
                isOnlyOne,//标识是否只有一张图片 by jsonbeta
                _this = this;
            jqelement = jq(this.element);
            isOnlyOne = (jqelement.find('img').length > 1) ? false : true;
            // console.log(jqelement.find('img').length);
            // by tianliang
            // if(isOnlyOne){
            //     // console.log(isOnlyOne);
            //     return false;
            // }
            // console.log('我不只是一张图片');
            this.data = jq.data(this);
            jq.data(this, "animating", false);
            jq.data(this, "total", jqelement.children().not(".xm-slider-navigation", jqelement).length);
            jq.data(this, "current", this.options.start - 1);
            jq.data(this, "vendorPrefix", this._getVendorPrefix());
            if (typeof TouchEvent !== "undefined") {
                jq.data(this, "touch", true);
                this.options.effect.slide.speed = this.options.effect.slide.speed / 2;
            }
            jqelement.css({
                overflow: "hidden"
            });
            jqelement.slidesContainer = jqelement.children().not(".xm-slider-navigation", jqelement).wrapAll("<div class='xm-slider-container'>", jqelement).parent().css({
                overflow: "hidden",
                position: "relative"
            });
            jq(".xm-slider-container", jqelement).wrapInner("<div class='xm-slider-control'>", jqelement).children();
            jq(".xm-slider-control", jqelement).css({
                position: "relative",
                left: 0
            });
            jq(".xm-slider-control", jqelement).children().addClass("xm-slider-slide").css({
                position: "absolute",
                top: 0,
                left: 0,
                width: "100%",
                zIndex: 0,
                display: "none",
                webkitBackfaceVisibility: "hidden"
            });
            jq.each(jq(".xm-slider-control", jqelement).children(), function(i) {
                var jqslide;
                jqslide = jq(this);
                return jqslide.attr("xm-slider-index", i);
            });
            if (this.data.touch) {
                jq(".xm-slider-control", jqelement).on("touchstart", function(e) {
                    return _this._touchstart(e);
                });
                jq(".xm-slider-control", jqelement).on("touchmove", function(e) {
                    return _this._touchmove(e);
                });
                jq(".xm-slider-control", jqelement).on("touchend", function(e) {
                    return _this._touchend(e);
                });
            }
            jqelement.fadeIn(0);

            // add by Sivan
            // 初始化：为图片增加原始地址属性 data-src-orig
            if (window.devicePixelRatio < 1.5) {
                jqelement.find('img').each(function () {
                    jq(this).attr('data-src-orig', jq(this).attr('src'));
                });
            }
            else {
                jqelement.find('img').each(function () {
                    var srcset = jq(this).attr('srcset');

                    if (srcset && srcset.split(' 2x')[0]) {
                        jq(this).attr('data-src-orig', srcset.split(' 2x')[0]).removeAttr('srcset');
                    }
                });
            }

            this.update();
            // 2014-6-16 edit By tianliang ，修复只有一张图时不显示bug
            if (this.data.touch &&  !isOnlyOne) {
                this._setuptouch();
            }
            jq(".xm-slider-control", jqelement).children(":eq(" + this.data.current + ")").eq(0).fadeIn(0, function() {
                return jq(this).css({
                    zIndex: 10
                });
            });

            //增加 isOnlyOne 条件判断 edit by jsonbeta
            if (this.options.navigation.active && !isOnlyOne) {
                prevButton = jq("<a>", {
                    "class": "xm-slider-previous xm-slider-navigation icon-slides icon-slides-prev",
                    href: "#",
                    title: "Previous",
                    text: "Previous"
                }).appendTo(jqelement);
                nextButton = jq("<a>", {
                    "class": "xm-slider-next xm-slider-navigation icon-slides icon-slides-next",
                    href: "#",
                    title: "Next",
                    text: "Next"
                }).appendTo(jqelement);
            }
            jq(".xm-slider-next", jqelement).click(function(e) {
                e.preventDefault();
                _this.stop(true);
                return _this.next(_this.options.navigation.effect);
            });
            jq(".xm-slider-previous", jqelement).click(function(e) {
                e.preventDefault();
                _this.stop(true);
                return _this.previous(_this.options.navigation.effect);
            });
            if (this.options.play.active) {
                playButton = jq("<a>", {
                    "class": "xm-slider-play xm-slider-navigation",
                    href: "#",
                    title: "Play",
                    text: "Play"
                }).appendTo(jqelement);
                stopButton = jq("<a>", {
                    "class": "xm-slider-stop xm-slider-navigation",
                    href: "#",
                    title: "Stop",
                    text: "Stop"
                }).appendTo(jqelement);
                playButton.click(function(e) {
                    e.preventDefault();
                    return _this.play(true);
                });
                stopButton.click(function(e) {
                    e.preventDefault();
                    return _this.stop(true);
                });
                if (this.options.play.swap) {
                    stopButton.css({
                        display: "none"
                    });
                }
            }
            if (this.options.pagination.active) {
                pagination = jq("<ul>", {
                    "class": "xm-slider-pagination"
                }).appendTo(jqelement);
                jq.each(new Array(this.data.total), function(i) {
                    var paginationItem, paginationLink;
                    paginationItem = jq("<li>", {
                        "class": "xm-slider-pagination-item"
                    }).appendTo(pagination);
                    paginationLink = jq("<a>", {
                        href: "#",
                        "data-xm-slider-item": i,
                        html: i + 1
                    }).appendTo(paginationItem);
                    return paginationLink.click(function(e) {
                        e.preventDefault();
                        _this.stop(true);
                        return _this.goto((jq(e.currentTarget).attr("data-xm-slider-item") * 1) + 1);
                    });

                    //如果需要鼠标HOVER小图翻页
                    /*return paginationLink.hover(function(e){
                     e.preventDefault();
                     _this.stop(true);
                     return _this.goto((jq(e.currentTarget).attr("data-xmSlide-item") * 1) + 1);
                     }, function(e){})*/
                });
            }


            //edit by jsonbeta
            /*jq(window).bind("resize", function() {
             return _this.update();
             });*/

            //edit by Sivan
            jq(window).bind("resize", function() {
                return _this.update();
            });

            this._setActive();

            //增加 isOnlyOne 条件判断 edit by jsonbeta
            if (this.options.play.auto && !isOnlyOne) {
                this.play();
            }
            return this.options.callback.loaded(this.options.start);
        };
        Plugin.prototype._setActive = function(number) {
            var jqelement, current;
            jqelement = jq(this.element);
            this.data = jq.data(this);
            current = number > -1 ? number : this.data.current;
            jq(".active", jqelement).removeClass("active");
            return jq(".xm-slider-pagination li:eq(" + current + ") a", jqelement).addClass("active");
        };
        Plugin.prototype.update = function() {
            var jqelement, height, width;
            jqelement = jq(this.element);
            // Commented by wangshishuo
            // Redundant code.
            /*
             this.data = jq.data(this);
             jq(".xm-slider-control", jqelement).children(":not(:eq(" + this.data.current + "))").css({
             display: "none",
             left: 0,
             zIndex: 0
             });
             */

            /*width = jqelement.width();
             height = (this.options.height / this.options.width) * width;
             this.options.width = width;
             this.options.height = height;*/

            //edit by jsonbeta
//      width = this.options.width;
//      height = this.options.height;

            //edit by Sivan
            width = jqelement.width();
            this.options.width = width;
            height = this.options.height;

            if (width <= this.options.responsiveWidth) {
                if (window.devicePixelRatio < 1.5) {
                    jqelement.find('img').each(function () {
                        if (jq(this).attr('data-src-r')) {
                            jq(this).attr('src', jq(this).attr('data-src-r'));
                        }
                    });
                }
                else {
                    jqelement.find('img').each(function () {
                        if (jq(this).attr('data-src-r-2x')) {
                            jq(this).attr({
                                'src': jq(this).attr('data-src-r-2x')
                            });
                        }
                        else if (jq(this).attr('data-src-r')) {
                            jq(this).attr('src', jq(this).attr('data-src-r'));
                        }
                    });
                }
            }
            if (width > this.options.responsiveWidth) {
                jqelement.find('img').each(function () {
                    jq(this).attr({
                        'src': jq(this).attr('data-src-orig')
                    });
                });
            }

            return jq(".xm-slider-control, .xm-slider-container", jqelement).css({
                width: width,
                height: height
            });
        };
        Plugin.prototype.next = function(effect) {
            var jqelement;
            jqelement = jq(this.element);
            this.data = jq.data(this);
            jq.data(this, "direction", "next");
            if (effect === void 0) {
                effect = this.options.navigation.effect;
            }
            if (effect === "fade") {
                return this._fade();
            } else {
                return this._slide();
            }
        };
        Plugin.prototype.previous = function(effect) {
            var jqelement;
            jqelement = jq(this.element);
            this.data = jq.data(this);
            jq.data(this, "direction", "previous");
            if (effect === void 0) {
                effect = this.options.navigation.effect;
            }
            if (effect === "fade") {
                return this._fade();
            } else {
                return this._slide();
            }
        };
        Plugin.prototype.goto = function(number) {
            var jqelement, effect;
            jqelement = jq(this.element);
            this.data = jq.data(this);
            if (effect === void 0) {
                effect = this.options.pagination.effect;
            }
            if (number > this.data.total) {
                number = this.data.total;
            } else if (number < 1) {
                number = 1;
            }
            if (typeof number === "number") {
                if (effect === "fade") {
                    return this._fade(number);
                } else {
                    return this._slide(number);
                }
            } else if (typeof number === "string") {
                if (number === "first") {
                    if (effect === "fade") {
                        return this._fade(0);
                    } else {
                        return this._slide(0);
                    }
                } else if (number === "last") {
                    if (effect === "fade") {
                        return this._fade(this.data.total);
                    } else {
                        return this._slide(this.data.total);
                    }
                }
            }
        };
        Plugin.prototype._setuptouch = function() {
            var jqelement, next, previous, slidesControl;
            jqelement = jq(this.element);
            this.data = jq.data(this);
            slidesControl = jq(".xm-slider-control", jqelement);
            next = this.data.current + 1;
            previous = this.data.current - 1;
            if (previous < 0) {
                previous = this.data.total - 1;
            }
            if (next > this.data.total - 1) {
                next = 0;
            }
            slidesControl.children(":eq(" + next + ")").css({
                display: "block",
                //left: this.options.width
                left: "100%"
            });
            return slidesControl.children(":eq(" + previous + ")").css({
                display: "block",
                //left: -this.options.width
                left: "-100%"
            });
        };
        Plugin.prototype._touchstart = function(e) {
            var jqelement, touches;
            jqelement = jq(this.element);
            this.data = jq.data(this);
            touches = e.originalEvent.touches[0];
            this._setuptouch();
            jq.data(this, "touchtimer", Number(new Date()));
            jq.data(this, "touchstartx", touches.pageX);
            jq.data(this, "touchstarty", touches.pageY);
            return e.stopPropagation();
        };
        Plugin.prototype._touchend = function(e) {
            var jqelement, duration, prefix, slidesControl, timing, touches, transform,
                _this = this;
            jqelement = jq(this.element);
            this.data = jq.data(this);
            touches = e.originalEvent.touches[0];
            slidesControl = jq(".xm-slider-control", jqelement);
            if (slidesControl.position().left > this.options.width * 0.5 || slidesControl.position().left > this.options.width * 0.1 && (Number(new Date()) - this.data.touchtimer < 250)) {
                jq.data(this, "direction", "previous");
                this._slide();
            } else if (slidesControl.position().left < -(this.options.width * 0.5) || slidesControl.position().left < -(this.options.width * 0.1) && (Number(new Date()) - this.data.touchtimer < 250)) {
                jq.data(this, "direction", "next");
                this._slide();
            } else {
                prefix = this.data.vendorPrefix;
                transform = prefix + "Transform";
                duration = prefix + "TransitionDuration";
                timing = prefix + "TransitionTimingFunction";
                slidesControl[0].style[transform] = "translateX(0px)";
                slidesControl[0].style[duration] = this.options.effect.slide.speed * 0.85 + "ms";
            }
            slidesControl.on("transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd", function() {
                prefix = _this.data.vendorPrefix;
                transform = prefix + "Transform";
                duration = prefix + "TransitionDuration";
                timing = prefix + "TransitionTimingFunction";
                slidesControl[0].style[transform] = "";
                slidesControl[0].style[duration] = "";
                return slidesControl[0].style[timing] = "";
            });
            return e.stopPropagation();
        };
        Plugin.prototype._touchmove = function(e) {
            var jqelement, prefix, slidesControl, touches, transform;
            jqelement = jq(this.element);
            this.data = jq.data(this);
            touches = e.originalEvent.touches[0];
            prefix = this.data.vendorPrefix;
            slidesControl = jq(".xm-slider-control", jqelement);
            transform = prefix + "Transform";
            jq.data(this, "scrolling", Math.abs(touches.pageX - this.data.touchstartx) < Math.abs(touches.pageY - this.data.touchstarty));
            if (!this.data.animating && !this.data.scrolling) {
                e.preventDefault();
                this._setuptouch();
                slidesControl[0].style[transform] = "translateX(" + (touches.pageX - this.data.touchstartx) + "px)";
            }
            return e.stopPropagation();
        };
        Plugin.prototype.play = function(next) {
            var jqelement, currentSlide, slidesContainer,
                _this = this;
            jqelement = jq(this.element);
            this.data = jq.data(this);
            if (!this.data.playInterval) {
                if (next) {
                    currentSlide = this.data.current;
                    this.data.direction = "next";
                    if (this.options.play.effect === "fade") {
                        this._fade();
                    } else {
                        this._slide();
                    }
                }
                jq.data(this, "playInterval", setInterval((function() {
                    currentSlide = _this.data.current;
                    _this.data.direction = "next";
                    if (_this.options.play.effect === "fade") {
                        return _this._fade();
                    } else {
                        return _this._slide();
                    }
                }), this.options.play.interval));
                slidesContainer = jq(/*".xmSlide-container", */jqelement);
                if (this.options.play.pauseOnHover) {
                    slidesContainer.unbind();
                    slidesContainer.bind("mouseenter", function() {
                        jq(".xm-slider-navigation", jqelement).show();
                        return _this.stop();
                    });
                    slidesContainer.bind("mouseleave", function() {
                        jq(".xm-slider-navigation", jqelement).hide();
                        //edit by jsonbeta
                        /*if (_this.options.play.restartDelay) {
                         return jq.data(_this, "restartDelay", setTimeout((function() {
                         return _this.play(true);
                         }), _this.options.play.restartDelay));
                         } else {
                         return _this.play();
                         }*/
                        return _this.play();
                    });
                }
                jq.data(this, "playing", true);
                jq(".xm-slider-play", jqelement).addClass("xm-slider-playing");
                if (this.options.play.swap) {
                    jq(".xm-slider-play", jqelement).hide();
                    return jq(".xm-slider-stop", jqelement).show();
                }
            }
        };
        Plugin.prototype.stop = function(clicked) {
            var jqelement;
            jqelement = jq(this.element);
            this.data = jq.data(this);
            clearInterval(this.data.playInterval);
            if (this.options.play.pauseOnHover && clicked) {
                jq(".xm-slider-container", jqelement).unbind();
            }
            jq.data(this, "playInterval", null);
            jq.data(this, "playing", false);
            jq(".xm-slider-play", jqelement).removeClass("xm-slider-playing");
            if (this.options.play.swap) {
                jq(".xm-slider-stop", jqelement).hide();
                return jq(".xm-slider-play", jqelement).show();
            }
        };
        Plugin.prototype._slide = function(number) {
            var jqelement, currentSlide, direction, duration, next, prefix, slidesControl, timing, transform, value,
                _this = this;
            jqelement = jq(this.element);
            this.data = jq.data(this);
            if (!this.data.animating && number !== this.data.current + 1) {
                jq.data(this, "animating", true);
                currentSlide = this.data.current;
                if (number > -1) {
                    number = number - 1;
                    value = number > currentSlide ? 1 : -1;
                    direction = number > currentSlide ? -this.options.width : this.options.width;
                    next = number;
                } else {
                    value = this.data.direction === "next" ? 1 : -1;
                    direction = this.data.direction === "next" ? -this.options.width : this.options.width;
                    next = currentSlide + value;
                }
                if (next === -1) {
                    next = this.data.total - 1;
                }
                if (next === this.data.total) {
                    next = 0;
                }
                this._setActive(next);
                slidesControl = jq(".xm-slider-control", jqelement);
                if (number > -1) {
                    slidesControl.children(":not(:eq(" + currentSlide + "))").css({
                        display: "none",
                        left: 0,
                        zIndex: 0
                    });
                }
                slidesControl.children(":eq(" + next + ")").css({
                    display: "block",
                    left: value * this.options.width,
                    zIndex: 10
                });
                this.options.callback.start(currentSlide + 1);
                if (this.data.vendorPrefix) {
                    prefix = this.data.vendorPrefix;
                    transform = prefix + "Transform";
                    duration = prefix + "TransitionDuration";
                    timing = prefix + "TransitionTimingFunction";
                    slidesControl[0].style[transform] = "translateX(" + direction + "px)";
                    slidesControl[0].style[duration] = this.options.effect.slide.speed + "ms";
                    return slidesControl.on("transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd", function() {
                        slidesControl[0].style[transform] = "";
                        slidesControl[0].style[duration] = "";
                        slidesControl.children(":eq(" + next + ")").css({
                            left: 0
                        });
                        slidesControl.children(":eq(" + currentSlide + ")").css({
                            display: "none",
                            left: 0,
                            zIndex: 0
                        });
                        jq.data(_this, "current", next);
                        jq.data(_this, "animating", false);
                        slidesControl.unbind("transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd");
                        slidesControl.children(":not(:eq(" + next + "))").css({
                            display: "none",
                            left: 0,
                            zIndex: 0
                        });
                        if (_this.data.touch) {
                            _this._setuptouch();
                        }
                        return _this.options.callback.complete(next + 1);
                    });
                } else {
                    return slidesControl.stop().animate({
                        left: direction
                    }, this.options.effect.slide.speed, (function() {
                        slidesControl.css({
                            left: 0
                        });
                        slidesControl.children(":eq(" + next + ")").css({
                            left: 0
                        });
                        return slidesControl.children(":eq(" + currentSlide + ")").css({
                            display: "none",
                            left: 0,
                            zIndex: 0
                        }, jq.data(_this, "current", next), jq.data(_this, "animating", false), _this.options.callback.complete(next + 1));
                    }));
                }
            }
        };
        Plugin.prototype._fade = function(number) {
            var jqelement, currentSlide, next, slidesControl, value,
                _this = this;
            jqelement = jq(this.element);
            this.data = jq.data(this);
            if (!this.data.animating && number !== this.data.current + 1) {
                jq.data(this, "animating", true);
                currentSlide = this.data.current;
                if (number) {
                    number = number - 1;
                    value = number > currentSlide ? 1 : -1;
                    next = number;
                } else {
                    value = this.data.direction === "next" ? 1 : -1;
                    next = currentSlide + value;
                }
                if (next === -1) {
                    next = this.data.total - 1;
                }
                if (next === this.data.total) {
                    next = 0;
                }
                this._setActive(next);
                slidesControl = jq(".xm-slider-control", jqelement);
                slidesControl.children(":eq(" + next + ")").css({
                    display: "none",
                    left: 0,
                    zIndex: 10
                });
                this.options.callback.start(currentSlide + 1);
                if (this.options.effect.fade.crossfade) {
                    slidesControl.children(":eq(" + this.data.current + ")").stop().fadeOut(this.options.effect.fade.speed);
                    return slidesControl.children(":eq(" + next + ")").stop().fadeIn(this.options.effect.fade.speed, (function() {
                        slidesControl.children(":eq(" + next + ")").css({
                            zIndex: 0
                        });
                        jq.data(_this, "animating", false);
                        jq.data(_this, "current", next);
                        return _this.options.callback.complete(next + 1);
                    }));
                } else {
                    return slidesControl.children(":eq(" + currentSlide + ")").stop().fadeOut(this.options.effect.fade.speed, (function() {
                        slidesControl.children(":eq(" + next + ")").stop().fadeIn(_this.options.effect.fade.speed, (function() {
                            return slidesControl.children(":eq(" + next + ")").css({
                                zIndex: 10
                            });
                        }));
                        jq.data(_this, "animating", false);
                        jq.data(_this, "current", next);
                        return _this.options.callback.complete(next + 1);
                    }));
                }
            }
        };
        Plugin.prototype._getVendorPrefix = function() {
            var body, i, style, transition, vendor;
            body = document.body || document.documentElement;
            style = body.style;
            transition = "transition";
            vendor = ["Moz", "Webkit", "Khtml", "O", "ms"];
            transition = transition.charAt(0).toUpperCase() + transition.substr(1);
            i = 0;
            while (i < vendor.length) {
                if (typeof style[vendor[i] + transition] === "string") {
                    return vendor[i];
                }
                i++;
            }
            return false;
        };
        return jq.fn[pluginName] = function(options) {
            return this.each(function() {
                if (!jq.data(this, "plugin_" + pluginName)) {
                    return jq.data(this, "plugin_" + pluginName, new Plugin(this, options));
                }
            });
        };
    })(jQuery, window, document);

}).call(this);

jq.fn.focusShow = function () {
    var obj = jq(this);

    //幻灯切换
    var topCol = obj.find(".topCol");

    var topItem = topCol.find("a");
    var topItemLength = topItem.length;

    var topNow = 0;
    var timer;

    var points = jq("<ul></ul>");
    topCol.append(points);

    for (var i = 0; i < topItemLength; i++) {
        points.append("<li></li>")
    }
    var point = points.find("li");
    point.first().addClass("now");

    var scrollTop = function() {
        point.filter(".now").removeClass("now");
        point.eq(topNow).addClass("now");

        topItem.filter(":not(:eq(" + topNow + "))").fadeOut();
        topItem.eq(topNow).fadeIn();

        topNow++;
            if (topNow == topItemLength) {
            topNow = 0;
        }
        timer = setTimeout(scrollTop, 5000);
    }
    scrollTop();


    topCol
        .mouseenter(function () {
            points.hide();
            clearTimeout(timer);
        })
        .mouseleave(function () {
            points.show();
            timer = setTimeout(scrollTop, 2500);
        })

    //鼠标高亮
    var item = obj.find("a");

    item
        .each(function () {
            jq(this).prepend("<em></em>")
        })
        .mouseenter(function () {
            var shadow = item.not(jq(this)).find("em");
            shadow.stop().animate({opacity: 0.4}, (0.4-shadow.css("opacity"))/0.4*500)
        })
        .mouseleave(function () {
            var shadow = item.not(jq(this)).find("em");
            item.find("em").stop().animate({opacity: 0}, (shadow.css("opacity"))/0.4*500)
        })
}

jq.fn.picShow = function () {
    var obj = jq(this);
    var item = obj.find("li");

    item.eq(0).addClass("current");

    item.mouseenter(function() {
        if (!jq(this).hasClass("current")) {
            obj.find(".current").removeClass("current");
            jq(this).addClass("current");
        }
    })
}

jq.fn.slideShow = function () {
    var obj = jq(this);

    var pics = obj.find("li");
    var pic_num = pics.length;
    var pic_cur = 0;

    var timer;

    obj.append("<div class=\"toggle\"></div>");
    var toggles = obj.find(".toggle");
    for (var i = 0; i< pic_num; i++) {
        toggles.append("<a></a>");
    }

    var toggle = toggles.find("a");
    toggle.each(function() {
        jq(this).click(function() {
            pic_cur = jq(this).index();
            rollPic();
            return false
        })
    })

    var showPic = function (id) {
        toggle.filter(".current").removeClass("current");
        toggle.eq(id).addClass("current");

        pics.filter(":visible").hide();
        pics.eq(id).show();

        return false
    }

    var rollPic = function () {
        clearTimeout(timer);

        if (pic_cur >= pic_num) {
            pic_cur = 0;
        }

        showPic(pic_cur);

        pic_cur++;

        timer = setTimeout(rollPic, 5000);
    }

    if (pic_num > 0) {
        rollPic();

        obj.mouseover(function() {
            clearTimeout(timer)
        })

        obj.mouseleave(function() {
            timer = setTimeout(rollPic, 5000)
        })
    }
}

jq.fn.initBbsNav = function () {
//    var bbsToggle = bbsNav.find(".bbsToggle");

//    bbsToggle.click(function() {
//        jq(this).parent(".bbsNav").addClass("bbsNav_show");
//        return
//    })
    jq(this).each(function() {
        var bbsNav = jq(this);
        var showFlag = 0;
        var bbsToggle = bbsNav.prev("a");

        var bbsNavHide = function() {
            if (showFlag == 0) {
                bbsNav.removeClass("bbsNav_show");
            }
        }

        bbsToggle
            .mouseover(function () {
                jq(this).next(".bbsNav").addClass("bbsNav_show");
                showFlag = 1;
            })
            .mouseleave(function () {
                showFlag = 0;
                setTimeout(bbsNavHide, 100);
            })

        bbsNav
            .mouseover(function () {
                showFlag = 1;
            })
            .mouseleave(function () {
                showFlag = 0;
                bbsNavHide();
            })
    })
}

jq.fn.searchBar = function () {
    var obj = jq(this);
    var str = obj.find("#indexTxtSearch");

    obj.click(function(e) {
        if (obj.hasClass("fold")) {
            obj.removeClass("fold");
            e.stopPropagation();
            return false
        }
    })

    str
        .keydown(function(e){
            if(e.keyCode == 13){
                iSearch.post();
            }
        })
}



jq(document).ready(function () {
    jq(".bbsNav").initBbsNav();
    jq(".focus").focusShow();
//    jq(".picShow").picShow();
    jq("#picShow").slideShow();
    jq(".search").searchBar();
    jq("#xm_store").slideShow();

    jq("#J_homeSlider").xmSlide({
        width: 960,
        height: 350,
        navigation: {
            effect: "fade"
        },
        effect: {
            fade: {
                speed: 400
            }
        },
        play: {
            effect: "fade",
            interval: 5000,
            auto: true,
            pauseOnHover: true,
            restartDelay: 2500
        }
    });
})
