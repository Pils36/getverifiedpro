<?php


?>
<html>
<head>
    <script type="text/javascript"
            src="https://bam.nr-data.net/1/1de1f55043?a=11964883&amp;v=1026.7a27a3e&amp;to=dl1ZR0sLVAlVEBlBC1BfUkAWF1AKRw%3D%3D&amp;rst=10910&amp;ref=http://www.semantickit.com/themes/11-responsive-dashboard-theme&amp;qt=6&amp;ap=48&amp;be=562&amp;fe=10820&amp;dc=10393&amp;perf=%7B%22timing%22:%7B%22of%22:1491401892692,%22n%22:0,%22u%22:368,%22ue%22:383,%22f%22:0,%22dn%22:0,%22dne%22:0,%22c%22:0,%22ce%22:0,%22rq%22:0,%22rp%22:0,%22rpe%22:0,%22dl%22:368,%22di%22:10381,%22ds%22:10391,%22de%22:10398,%22dc%22:10817,%22l%22:10818,%22le%22:10839%7D,%22navigation%22:%7B%7D%7D&amp;jsonp=NREUM.setToken"></script>
    <script src="https://js-agent.newrelic.com/nr-1026.min.js"></script>
    <script async="" src="//www.google-analytics.com/analytics.js"></script>
    <script type="text/javascript">window.NREUM || (NREUM = {});
        NREUM.info = {
            "beacon": "bam.nr-data.net",
            "errorBeacon": "bam.nr-data.net",
            "licenseKey": "1de1f55043",
            "applicationID": "11964883",
            "transactionName": "dl1ZR0sLVAlVEBlBC1BfUkAWF1AKRw==",
            "queueTime": 6,
            "applicationTime": 48,
            "agent": ""
        }</script>
    <script type="text/javascript">window.NREUM || (NREUM = {}), __nr_require = function (e, n, t) {
            function r(t) {
                if (!n[t]) {
                    var o = n[t] = {exports: {}};
                    e[t][0].call(o.exports, function (n) {
                        var o = e[t][1][n];
                        return r(o || n)
                    }, o, o.exports)
                }
                return n[t].exports
            }

            if ("function" == typeof __nr_require) return __nr_require;
            for (var o = 0; o < t.length; o++) r(t[o]);
            return r
        }({
            1: [function (e, n, t) {
                function r() {
                }

                function o(e, n, t) {
                    return function () {
                        return i(e, [c.now()].concat(u(arguments)), n ? null : this, t), n ? void 0 : this
                    }
                }

                var i = e("handle"), a = e(2), u = e(3), f = e("ee").get("tracer"), c = e("loader"), s = NREUM;
                "undefined" == typeof window.newrelic && (newrelic = s);
                var p = ["setPageViewName", "setCustomAttribute", "setErrorHandler", "finished", "addToTrace", "inlineHit", "addRelease"],
                    d = "api-", l = d + "ixn-";
                a(p, function (e, n) {
                    s[n] = o(d + n, !0, "api")
                }), s.addPageAction = o(d + "addPageAction", !0), s.setCurrentRouteName = o(d + "routeName", !0), n.exports = newrelic, s.interaction = function () {
                    return (new r).get()
                };
                var m = r.prototype = {
                    createTracer: function (e, n) {
                        var t = {}, r = this, o = "function" == typeof n;
                        return i(l + "tracer", [c.now(), e, t], r), function () {
                            if (f.emit((o ? "" : "no-") + "fn-start", [c.now(), r, o], t), o) try {
                                return n.apply(this, arguments)
                            } finally {
                                f.emit("fn-end", [c.now()], t)
                            }
                        }
                    }
                };
                a("setName,setAttribute,save,ignore,onEnd,getContext,end,get".split(","), function (e, n) {
                    m[n] = o(l + n)
                }), newrelic.noticeError = function (e) {
                    "string" == typeof e && (e = new Error(e)), i("err", [e, c.now()])
                }
            }, {}], 2: [function (e, n, t) {
                function r(e, n) {
                    var t = [], r = "", i = 0;
                    for (r in e) o.call(e, r) && (t[i] = n(r, e[r]), i += 1);
                    return t
                }

                var o = Object.prototype.hasOwnProperty;
                n.exports = r
            }, {}], 3: [function (e, n, t) {
                function r(e, n, t) {
                    n || (n = 0), "undefined" == typeof t && (t = e ? e.length : 0);
                    for (var r = -1, o = t - n || 0, i = Array(o < 0 ? 0 : o); ++r < o;) i[r] = e[n + r];
                    return i
                }

                n.exports = r
            }, {}], 4: [function (e, n, t) {
                n.exports = {exists: "undefined" != typeof window.performance && window.performance.timing && "undefined" != typeof window.performance.timing.navigationStart}
            }, {}], ee: [function (e, n, t) {
                function r() {
                }

                function o(e) {
                    function n(e) {
                        return e && e instanceof r ? e : e ? f(e, u, i) : i()
                    }

                    function t(t, r, o, i) {
                        if (!d.aborted || i) {
                            e && e(t, r, o);
                            for (var a = n(o), u = m(t), f = u.length, c = 0; c < f; c++) u[c].apply(a, r);
                            var p = s[y[t]];
                            return p && p.push([b, t, r, a]), a
                        }
                    }

                    function l(e, n) {
                        v[e] = m(e).concat(n)
                    }

                    function m(e) {
                        return v[e] || []
                    }

                    function w(e) {
                        return p[e] = p[e] || o(t)
                    }

                    function g(e, n) {
                        c(e, function (e, t) {
                            n = n || "feature", y[t] = n, n in s || (s[n] = [])
                        })
                    }

                    var v = {}, y = {},
                        b = {on: l, emit: t, get: w, listeners: m, context: n, buffer: g, abort: a, aborted: !1};
                    return b
                }

                function i() {
                    return new r
                }

                function a() {
                    (s.api || s.feature) && (d.aborted = !0, s = d.backlog = {})
                }

                var u = "nr@context", f = e("gos"), c = e(2), s = {}, p = {}, d = n.exports = o();
                d.backlog = s
            }, {}], gos: [function (e, n, t) {
                function r(e, n, t) {
                    if (o.call(e, n)) return e[n];
                    var r = t();
                    if (Object.defineProperty && Object.keys) try {
                        return Object.defineProperty(e, n, {value: r, writable: !0, enumerable: !1}), r
                    } catch (i) {
                    }
                    return e[n] = r, r
                }

                var o = Object.prototype.hasOwnProperty;
                n.exports = r
            }, {}], handle: [function (e, n, t) {
                function r(e, n, t, r) {
                    o.buffer([e], r), o.emit(e, n, t)
                }

                var o = e("ee").get("handle");
                n.exports = r, r.ee = o
            }, {}], id: [function (e, n, t) {
                function r(e) {
                    var n = typeof e;
                    return !e || "object" !== n && "function" !== n ? -1 : e === window ? 0 : a(e, i, function () {
                        return o++
                    })
                }

                var o = 1, i = "nr@id", a = e("gos");
                n.exports = r
            }, {}], loader: [function (e, n, t) {
                function r() {
                    if (!x++) {
                        var e = h.info = NREUM.info, n = d.getElementsByTagName("script")[0];
                        if (setTimeout(s.abort, 3e4), !(e && e.licenseKey && e.applicationID && n)) return s.abort();
                        c(y, function (n, t) {
                            e[n] || (e[n] = t)
                        }), f("mark", ["onload", a() + h.offset], null, "api");
                        var t = d.createElement("script");
                        t.src = "https://" + e.agent, n.parentNode.insertBefore(t, n)
                    }
                }

                function o() {
                    "complete" === d.readyState && i()
                }

                function i() {
                    f("mark", ["domContent", a() + h.offset], null, "api")
                }

                function a() {
                    return E.exists && performance.now ? Math.round(performance.now()) : (u = Math.max((new Date).getTime(), u)) - h.offset
                }

                var u = (new Date).getTime(), f = e("handle"), c = e(2), s = e("ee"), p = window, d = p.document,
                    l = "addEventListener", m = "attachEvent", w = p.XMLHttpRequest, g = w && w.prototype;
                NREUM.o = {
                    ST: setTimeout,
                    CT: clearTimeout,
                    XHR: w,
                    REQ: p.Request,
                    EV: p.Event,
                    PR: p.Promise,
                    MO: p.MutationObserver
                };
                var v = "" + location, y = {
                        beacon: "bam.nr-data.net",
                        errorBeacon: "bam.nr-data.net",
                        agent: "js-agent.newrelic.com/nr-1026.min.js"
                    }, b = w && g && g[l] && !/CriOS/.test(navigator.userAgent),
                    h = n.exports = {offset: u, now: a, origin: v, features: {}, xhrWrappable: b};
                e(1), d[l] ? (d[l]("DOMContentLoaded", i, !1), p[l]("load", r, !1)) : (d[m]("onreadystatechange", o), p[m]("onload", r)), f("mark", ["firstbyte", u], null, "api");
                var x = 0, E = e(4)
            }, {}]
        }, {}, ["loader"]);</script>

    <title>Semantic UI - Themes, Templates and Snippets | Semantic Kit</title>
    <meta name="description"
          content="The Semantic UI front-end framework is the new kid on the block. Check out our tools and resources to help you make the most out of it.">

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" media="all" href="/assets/application-1209be31a0283b9168b3bfef2d250c25.css">
    <script src="/assets/application-ad86ef1f3eada89330b299ead67610ce.js"></script>
    <meta name="csrf-param" content="authenticity_token">
    <meta name="csrf-token"
          content="LXy7F3luV5tC0FqJih3PtYVcp2/OHbY1UYkQL0Bg6Kj1+PxDKbfomMXAV0R/+eemAujTZ+MoYbh6BF3AHcSPAw==">

</head>
<body class="themes">
<div class="sticky-footer-wrapper">

    <div class="ui tiered nav menu">
        <div class="container">
            <a class="item logo" href="/">
                <b>Semantic</b> Kit
            </a> <a class="item" href="/semantic-ui-themes">Themes</a>
            <a class="item" href="/semantic-ui-snippets">Snippets</a>
            <div class="ui dropdown item">
                <a href="#">Expo</a>
                <div class="menu">
                    <a class="item" href="/expos">View Gallery</a>
                    <a class="item" href="/expos/new">Submit a Site</a>
                </div>
            </div>
            <div class="right menu">
                <div class="ui item"><a href="/signin">Sign In</a></div>
                <div class="ui item"><a href="/users/new">Sign Up</a></div>
            </div>
        </div>
    </div>
    <div class="subheader">
        <div class="container">
            <div class="right-content">
                <div class="ui inverted basic icon buttons" style="margin-top: 17px;">
                    <a class="ui button tooltip" data-content="Preview this Theme" target="_blank"
                       href="/themes/11-responsive-dashboard-theme/preview">
                        <i class="expand icon"></i>
                    </a> <a class="ui button tooltip" data-content="Sign in to Favorite" href="/signin">
                        <i class="star icon"></i>
                    </a> <a class="ui button tooltip" data-content="Create a theme" href="/themes/new">
                        <i class="plus icon"></i>
                    </a></div>

            </div>

            <h2 class="ui header inverted">
                Responsive Dashboard Theme

                <div class="sub header">
                    <div class="ui breadcrumb">
                        <a class="section" href="/semantic-ui-themes">Themes</a>
                        <i class="right chevron icon divider" style="color: #fff;"></i>
                        <a href="/categories/admin-dashboard">Admin / Dashboard</a>
                        <i class="right chevron icon divider" style="color: #fff;"></i>
                        <span class="section">Responsive Dashboard Theme</span>
                    </div>

                </div>
            </h2>
        </div>
    </div>

    <div class="container">


        <hr class="ui divider hidden">

        <div class="ui grid">
            <div class="eleven wide column">
                <div class="ui segment image-frame">
                    <img src="https://wrapsemanticprod.s3.amazonaws.com/uploads/theme/image/11/Screen_Shot_2015-12-26_at_4.21.15_PM.png"
                         alt="Screen shot 2015 12 26 at 4.21.15 pm" width="100%">
                </div>

                <div class="item-descript">
                    <h3 class="ui dividing header">Description</h3>
                    <p></p>
                    <p>**For a limited time we're dropping the price of this to $12.**</p>

                    <p>This theme has a minimal, clean design based off of Square's dashboard. It features multiple
                        templates with charts interweaved to give you an idea of what's possible. Please see the
                        comments in dashboard.html for more information. A reminder: you'll have to also change paths in
                        icon.min.css and semantic.min.css for things like fonts depending on your file structure.</p>
                    <p></p>
                </div>

            </div>

            <div class="five wide column">
                <div class="column">
                    <a class="ui huge blue icon labeled fluid button bottom-20" target="_blank"
                       href="/themes/11-responsive-dashboard-theme/preview">
                        <i class="share icon"></i>
                        live preview
                    </a></div>
                <div class="column" style="text-align: center;">
                    <form name="_xclick" action="https://www.paypal.com/us/cgi-bin/webscr" method="post"
                          target="_blank">
                        <input name="cmd" value="_xclick" type="hidden">
                        <input name="business" value="purchases@semantickit.com" type="hidden">
                        <input name="currency_code" value="USD" type="hidden">
                        <input name="quantity" value="1" type="hidden">
                        <input name="item_name" value="Responsive Dashboard Theme" type="hidden">
                        <input name="amount" value="12.0" type="hidden">

                        <input name="notify_url"
                               value="http://www.semantickit.com/subscriptions?count=single_tier_count&amp;guest_token=VYIY8kFlJ3M7taUPL0_8Ew&amp;id=11&amp;logged_out=true&amp;paypal=true&amp;price=12.0"
                               type="hidden">

                        <span class="ui huge green animated fade labeled fluid button buy-button">
    <div class="visible content">
      <i class="tags icon"></i>
      buy now $12
    </div>
    <div class="hidden content">
      checkout with paypal
    </div>
    <input src="https://www.paypalobjects.com/webstatic/en_US/btn/btn_buynow_pp_142x27.png" name="submit"
           alt="Make payments with PayPal - it's fast, free and secure!"
           style="opacity:0; position: absolute; top: 0; left: 0; width: 100%; height: 100%;" border="0" type="image">
  </span>
                    </form>
                </div>

                <div class="ui segment">
                    <header class="ui top attached label"><b>Application License</b></header>
                    <div class="ui list">
                        <a class="item" href="/themes/11?license=single">
                            Single
                            <div class="right floated ui tag labels">
            <span class="ui label">
              $12
            </span>
                            </div>
                        </a> <a class="item" href="/themes/11-responsive-dashboard-theme?license=multiple">
                            Multiple
                            <div class="right floated ui tag labels">
            <span class="ui label">
              $600
            </span>
                            </div>
                        </a> <a class="item" href="/themes/11-responsive-dashboard-theme?license=extended">
                            Extended
                            <div class="right floated ui tag labels">
            <span class="ui label">
              $1,500
            </span>
                            </div>
                        </a></div>
                </div>

                <table class="ui table segment">
                    <thead>
                    <tr>
                        <th colspan="2">Theme Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Category</td>
                        <td>
                            <a href="/categories/admin-dashboard">Admin / Dashboard</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Compatibility</td>
                        <td>
                            Chrome<br>
                            Safari<br>
                            Firefox<br>
                            IE10<br>
                        </td>
                    </tr>
                    <tr>
                        <td>Preprocessor</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Tags</td>
                        <td><a href="/tags/admin">admin</a>, <a href="/tags/admin%20template">admin template</a>, <a
                                    href="/tags/lightweight%20admin">lightweight admin</a>, <a
                                    href="/tags/responsive%20dashboard">responsive dashboard</a>, <a
                                    href="/tags/square">square</a></td>
                    </tr>
                    <tr>
                        <td>Released</td>
                        <td>over 1 year ago</td>
                    </tr>
                    <tr>
                        <td>Author</td>
                        <td><a href="/users/travisvalentine">travisvalentine</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="push"></div>
</div><!-- end sticky footer -->

<div class="ui vertical inverted black footer segment">
    <div class="container">
        <div class="ui stackable inverted divided relaxed grid">
            <div class="three wide column">
                <h5 class="ui blue inverted header">Themes</h5>
                <div class="ui inverted link list">
                    <a class="item" href="/semantic-ui-themes">View all Themes</a>
                    <a class="item" href="/themes/new">Sell a Theme</a>
                    <a class="item" href="/sell-semantic-ui-themes">How it Works</a>
                </div>
            </div>
            <div class="three wide column">
                <h5 class="ui orange inverted header">Snippets</h5>
                <div class="ui inverted link list">
                    <a class="item" href="/snippets">View Snippets</a>
                    <a class="item" href="/snippets/new">Create a Snippet</a>
                </div>
            </div>
            <div class="three wide column">
                <h5 class="ui green inverted header">Expo</h5>
                <div class="ui inverted link list">
                    <a class="item" href="/expos">Built with Semantic</a>
                    <a class="item" href="/expos/new">Submit a Site</a>
                    <a class="item" href="/faq">FAQ</a>
                </div>
            </div>
            <div class="six wide column">
                <h3 class="ui inverted header">Semantic Kit</h3>
                <p></p>
                <p>made with <i class="heart icon"></i> in dc &amp; nyc.</p>
                <p class="terms-privacy">© 2017 |
                    <a class="terms-privacy" href="/about">About</a> |
                    <a class="terms-privacy" href="/privacy-policy">Privacy</a> |
                    <a class="terms-privacy" href="/terms">Terms</a>
                </p>
            </div>
        </div>
    </div>
</div>
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-28250229-11', 'auto');
    ga('send', 'pageview');

</script>


<div class="ui popup">
    <div class="content">Preview this Theme</div>
</div>
<div class="ui popup">
    <div class="content">Sign in to Favorite</div>
</div>
<div class="ui popup">
    <div class="content">Create a theme</div>
</div>
</body>
</html>