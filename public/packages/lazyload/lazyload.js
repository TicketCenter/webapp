/*! Lazy Load 1.9.3 - MIT license - Copyright 2010-2013 Mika Tuupola */ ! function(a, b, c, d) {
    var e = a(b);
    a.fn.lazyload = function(f) {
        function g() {
            var b = 0;
            i.each(function() {
                var c = a(this);
                if (!j.skip_invisible || c.is(":visible"))
                    if (a.abovethetop(this, j) || a.leftofbegin(this, j));
                    else if (a.belowthefold(this, j) || a.rightoffold(this, j)) {
                    if (++b > j.failure_limit) return !1
                } else c.trigger("appear"), b = 0
            })
        }
        var h, i = this,
            j = {
                threshold: 0,
                failure_limit: 0,
                event: "scroll",
                effect: "show",
                container: b,
                data_attribute: "original",
                skip_invisible: !0,
                appear: null,
                load: null,
                placeholder: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACoAAAAqCAIAAABKoV4MAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6QUY2QjA0MDQ5RTYxMTFFNEI2RDI5QkI1MTY4OUVCQjkiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6QUY2QjA0MDM5RTYxMTFFNEI2RDI5QkI1MTY4OUVCQjkiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoTWFjaW50b3NoKSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuZGlkOjAxODAxMTc0MDcyMDY4MTE4MjJBQzk4NTUwOERFNTJEIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjAxODAxMTc0MDcyMDY4MTE4MjJBQzk4NTUwOERFNTJEIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+slDA8AAACCxJREFUeNqU2Ees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"
            };
        return f && (d !== f.failurelimit && (f.failure_limit = f.failurelimit, delete f.failurelimit), d !== f.effectspeed && (f.effect_speed = f.effectspeed, delete f.effectspeed), a.extend(j, f)), h = j.container === d || j.container === b ? e : a(j.container), 0 === j.event.indexOf("scroll") && h.bind(j.event, function() {
            return g()
        }), this.each(function() {
            var b = this,
                c = a(b);
            b.loaded = !1, (c.attr("src") === d || c.attr("src") === !1) && c.is("img") && c.attr("src", j.placeholder), c.one("appear", function() {
                if (!this.loaded) {
                    if (j.appear) {
                        var d = i.length;
                        j.appear.call(b, d, j)
                    }
                    a("<img />").bind("load", function() {
                        var d = c.attr("data-" + j.data_attribute);
                        c.hide(), c.is("img") ? c.attr("src", d) : c.css("background-image", "url('" + d + "')"), c[j.effect](j.effect_speed), b.loaded = !0;
                        var e = a.grep(i, function(a) {
                            return !a.loaded
                        });
                        if (i = a(e), j.load) {
                            var f = i.length;
                            j.load.call(b, f, j)
                        }
                    }).attr("src", c.attr("data-" + j.data_attribute))
                }
            }), 0 !== j.event.indexOf("scroll") && c.bind(j.event, function() {
                b.loaded || c.trigger("appear")
            })
        }), e.bind("resize", function() {
            g()
        }), /(?:iphone|ipod|ipad).*os 5/gi.test(navigator.appVersion) && e.bind("pageshow", function(b) {
            b.originalEvent && b.originalEvent.persisted && i.each(function() {
                a(this).trigger("appear")
            })
        }), a(c).ready(function() {
            g()
        }), this
    }, a.belowthefold = function(c, f) {
        var g;
        return g = f.container === d || f.container === b ? (b.innerHeight ? b.innerHeight : e.height()) + e.scrollTop() : a(f.container).offset().top + a(f.container).height(), g <= a(c).offset().top - f.threshold
    }, a.rightoffold = function(c, f) {
        var g;
        return g = f.container === d || f.container === b ? e.width() + e.scrollLeft() : a(f.container).offset().left + a(f.container).width(), g <= a(c).offset().left - f.threshold
    }, a.abovethetop = function(c, f) {
        var g;
        return g = f.container === d || f.container === b ? e.scrollTop() : a(f.container).offset().top, g >= a(c).offset().top + f.threshold + a(c).height()
    }, a.leftofbegin = function(c, f) {
        var g;
        return g = f.container === d || f.container === b ? e.scrollLeft() : a(f.container).offset().left, g >= a(c).offset().left + f.threshold + a(c).width()
    }, a.inviewport = function(b, c) {
        return !(a.rightoffold(b, c) || a.leftofbegin(b, c) || a.belowthefold(b, c) || a.abovethetop(b, c))
    }, a.extend(a.expr[":"], {
        "below-the-fold": function(b) {
            return a.belowthefold(b, {
                threshold: 0
            })
        },
        "above-the-top": function(b) {
            return !a.belowthefold(b, {
                threshold: 0
            })
        },
        "right-of-screen": function(b) {
            return a.rightoffold(b, {
                threshold: 0
            })
        },
        "left-of-screen": function(b) {
            return !a.rightoffold(b, {
                threshold: 0
            })
        },
        "in-viewport": function(b) {
            return a.inviewport(b, {
                threshold: 0
            })
        },
        "above-the-fold": function(b) {
            return !a.belowthefold(b, {
                threshold: 0
            })
        },
        "right-of-fold": function(b) {
            return a.rightoffold(b, {
                threshold: 0
            })
        },
        "left-of-fold": function(b) {
            return !a.rightoffold(b, {
                threshold: 0
            })
        }
    })
}(jQuery, window, document);
