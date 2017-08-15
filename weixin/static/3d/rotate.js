var m = !0,
    o = null,
    r = !1;

function ga(h, y, k) {
    var l = this;
    l.x = h;
    l.y = y;
    l.b = k;
    l.p = function (h, k, u) {
        l.x = h;
        l.y = k;
        l.b = u
    };
    l.toString = function () {
        return "(" + l.x + "," + l.y + "," + l.b + ")"
    };
    l.j = function (h) {
        var k = Math.sin(h),
            h = Math.cos(h),
            u = l.y,
            y = l.b;
        l.y = h * u - k * y;
        l.b = k * u + h * y
    };
    l.k = function (h) {
        var k = Math.sin(h),
            h = Math.cos(h),
            u = l.x,
            y = l.b;
        l.x = h * u + k * y;
        l.b = -k * u + h * y
    };
    l.G = function (h) {
        var k = Math.sin(h),
            h = Math.cos(h),
            u = l.x,
            y = l.y;
        l.x = h * u - k * y;
        l.y = k * u + h * y
    };
    l.ja = function () {
        return new ga(l.x, l.y, l.b)
    };
    l.length = function () {
        return Math.sqrt(l.x * l.x + l.y * l.y + l.b * l.b)
    };
    l.O = function (h) {
        return l.x * h.x + l.y * h.y + l.b * h.b
    };
    l.Z = function (h, k) {
        var u;
        u = Math.cos(k * Math.PI / 180);
        l.x = u * Math.sin(h * Math.PI / 180);
        l.y = Math.sin(k * Math.PI / 180);
        l.b = u * Math.cos(h * Math.PI / 180)
    };
    l.pa = function (h, k, u) {
        l.x = h.x * u + k.x * (1 - u);
        l.y = h.y * u + k.y * (1 - u);
        l.b = h.b * u + k.b * (1 - u)
    }
}
glMatrixArrayType = "undefined" != typeof Float32Array ? Float32Array : "undefined" != typeof WebGLFloatArray ? WebGLFloatArray : Array;

function qb(h) {
    h[0] = 1;
    h[1] = 0;
    h[2] = 0;
    h[3] = 0;
    h[4] = 0;
    h[5] = 1;
    h[6] = 0;
    h[7] = 0;
    h[8] = 0;
    h[9] = 0;
    h[10] = 1;
    h[11] = 0;
    h[12] = 0;
    h[13] = 0;
    h[14] = 0;
    h[15] = 1
}

function nc(h, y, k) {
    var l, K = k[0],
        L = k[1],
        k = k[2],
        u = Math.sqrt(K * K + L * L + k * k);
    if (u) {
        1 != u && (u = 1 / u, K *= u, L *= u, k *= u);
        var ma = Math.sin(y),
            Aa = Math.cos(y),
            $ = 1 - Aa,
            y = h[0],
            u = h[1],
            Ba = h[2],
            Ca = h[3],
            Da = h[4],
            va = h[5],
            Ea = h[6],
            Fa = h[7],
            Ga = h[8],
            Ha = h[9],
            fb = h[10],
            gb = h[11],
            wa = K * K * $ + Aa,
            Ia = L * K * $ + k * ma,
            Ja = k * K * $ - L * ma,
            Ka = K * L * $ - k * ma,
            La = L * L * $ + Aa,
            Ma = k * L * $ + K * ma,
            na = K * k * $ + L * ma,
            K = L * k * $ - K * ma,
            L = k * k * $ + Aa;
        l ? h != l && (l[12] = h[12], l[13] = h[13], l[14] = h[14], l[15] = h[15]) : l = h;
        l[0] = y * wa + Da * Ia + Ga * Ja;
        l[1] = u * wa + va * Ia + Ha * Ja;
        l[2] = Ba * wa + Ea * Ia + fb * Ja;
        l[3] = Ca * wa + Fa * Ia + gb * Ja;
        l[4] = y * Ka + Da * La + Ga * Ma;
        l[5] = u * Ka + va * La + Ha * Ma;
        l[6] = Ba * Ka + Ea * La + fb * Ma;
        l[7] = Ca * Ka + Fa * La + gb * Ma;
        l[8] = y * na + Da * K + Ga * L;
        l[9] = u * na + va * K + Ha * L;
        l[10] = Ba * na + Ea * K + fb * L;
        l[11] = Ca * na + Fa * K + gb * L
    }
}

function oc() {
    var h = "perspective",
        y = ["Webkit", "Moz", "O", "ms", "Ms"],
        k;
    k = r;
    for (k = 0; k < y.length; k++) "undefined" !== typeof document.documentElement.style[y[k] + "Perspective"] && (h = y[k] + "Perspective");
    "undefined" !== typeof document.documentElement.style[h] ? "webkitPerspective" in document.documentElement.style ? (h = document.createElement("style"), y = document.createElement("div"), k = document.head || document.getElementsByTagName("head")[0], h.textContent = "@media (-webkit-transform-3d) {#ggswhtml5{height:5px}}", k.appendChild(h), y.id = "ggswhtml5", document.documentElement.appendChild(y), k = 5 === y.offsetHeight, h.parentNode.removeChild(h), y.parentNode.removeChild(y)) : k = m : k = r;
    return k
}
function pc() {
    var h;
    if (h = !! window.WebGLRenderingContext) try {
        var y = document.createElement("canvas");
        y.width = 100;
        y.height = 100;
        var k = y.getContext("webgl");
        k || (k = y.getContext("experimental-webgl"));
        h = k ? m : r
    } catch (l) {
        h = r
    }
    return h
}

function pano2vrPlayer(h) {
    function y(a) {
        var e, c;
        c = [];
        e = a.getAttributeNode("title");
        c.title = e ? e.nodeValue.toString() : "";
        e = a.getAttributeNode("description");
        c.description = e ? e.nodeValue.toString() : "";
        e = a.getAttributeNode("author");
        c.author = e ? e.nodeValue.toString() : "";
        e = a.getAttributeNode("datetime");
        c.datetime = e ? e.nodeValue.toString() : "";
        e = a.getAttributeNode("copyright");
        c.copyright = e ? e.nodeValue.toString() : "";
        e = a.getAttributeNode("source");
        c.source = e ? e.nodeValue.toString() : "";
        e = a.getAttributeNode("info");
        c.information = e ? e.nodeValue.toString() : "";
        e = a.getAttributeNode("comment");
        c.comment = e ? e.nodeValue.toString() : "";
        e = a.getAttributeNode("latitude");
        c.latitude = e ? 1 * e.nodeValue : "0.0";
        e = a.getAttributeNode("longitude");
        c.longitude = e ? 1 * e.nodeValue : "0.0";
        if (e = a.getAttributeNode("tags")) {
            a = e.nodeValue.toString().split("|");
            for (e = 0; e < a.length; e++) "" == a[e] && (a.splice(e, 1), e--);
            c.tags = a
        } else c.tags = [];
        return c
    }
    function k(a) {
        Fb = "{" == a.charAt(0) ? a.substr(1, a.length - 2) : "";
        b.skinObj && b.skinObj.changeActiveNode && b.skinObj.changeActiveNode(a)
    }

    function l(a) {
        for (var e = 0; e < p.length; e++) if (p[e].id == a) return p[e];
        for (e = 0; e < x.length; e++) if (x[e].id == a) return x[e];
        return o
    }
    function K(a) {
        try {
            a.obj = document.createElement("img");
            a.obj.setAttribute("style", "-webkit-user-drag:none;");
            a.obj.ondragstart = function () {
                return r
            };
            if (1 == a.i || 4 == a.i) a.obj.onclick = function () {
                a.m = !a.m;
                a.obj.style.zIndex = a.m ? 80 : 0;
                a.obj.style[ia] = "all 1s ease 0s";
                a.K = m;
                a.obj.addEventListener(u(), function () {
                    a.K = r;
                    a.obj.style[ia] = "none"
                }, r);
                Gb()
            };
            a.obj.setAttribute("src", U(a.url));
            a.o && (a.obj.width = a.o);
            a.n && (a.obj.height = a.n);
            Na.push(a);
            a.obj.style.position = "absolute";
            var e = C.firstChild;
            e ? C.insertBefore(a.obj, e) : C.appendChild(a.obj)
        } catch (c) {
            X("Error addimage:" + c)
        }
    }
    function L(a) {
        try {
            a.obj = document.createElement("video");
            if (1 == a.i || 4 == a.i) a.obj.onclick = function () {
                a.m = !a.m;
                a.m ? (a.obj.style.zIndex = 80, a.obj.style[ia] = "all 1s ease 0s", b.playSound(a.id)) : (a.obj.style.zIndex = 0, a.obj.style[ia] = "all 1s ease 0s");
                a.K = m;
                a.obj.addEventListener(u(), function () {
                    a.K = r;
                    a.obj.style[ia] = "none"
                }, r);
                Gb()
            };
            2 == a.i && (a.obj.onclick = function () {
                b.playPauseSound(a.id)
            });
            var e;
            for (e = 0; e < a.url.length; e++) {
                var c;
                c = document.createElement("source");
                c.setAttribute("src", U(a.url[e]));
                a.obj.appendChild(c)
            }
            a.obj.volume = a.c * R;
            0 == a.loop && (a.obj.f = 1E7);
            1 <= a.loop && (a.obj.f = a.loop - 1);
            if ((1 == a.mode || 2 == a.mode || 3 == a.mode || 5 == a.mode) && 0 <= a.loop) a.obj.autoplay = m;
            x.push(a);
            a.obj.style.position = "absolute";
            a.o && (a.obj.width = a.o);
            a.n && (a.obj.height = a.n);
            var f = C.firstChild;
            f ? C.insertBefore(a.obj, f) : C.appendChild(a.obj);
            a.ba = m;
            a.obj.addEventListener("ended", function () {
                if (0 < this.f) return this.f--, this.currentTime = 0, this.play(), m;
                this.ba = r
            }, r)
        } catch (d) {
            X(d)
        }
    }
    function u() {
        var a, e = document.createElement("fakeelement"),
            c = {
                OTransition: "oTransitionEnd",
                MSTransition: "msTransitionEnd",
                MozTransition: "transitionend",
                WebkitTransition: "webkitTransitionEnd",
                transition: "transitionEnd"
            };
        for (a in c) if (void 0 !== e.style[a]) return c[a]
    }
    function ma(a) {
        var e = -1;
        try {
            for (var c = 0; c < p.length; c++) p[c].id == a.id && p[c].obj != o && p[c].url.join() == a.url.join() && p[c].loop == a.loop && p[c].mode == a.mode && (e = c);
            if (-1 == e) {
                for (c = 0; c < p.length; c++) if (p[c].id == a.id && p[c].obj != o) {
                    try {
                        p[c].obj.pause()
                    } catch (f) {
                        X(f)
                    }
                    try {
                        p[c].obj.parentElement.removeChild(p[c].obj), delete p[c].obj, p[c].obj = o
                    } catch (d) {
                        X(d)
                    }
                    e = c
                }
                a.obj = document.createElement("audio");
                for (c = 0; c < a.url.length; c++) {
                    var g;
                    g = document.createElement("source");
                    "" != a.url[c] && "#" != a.url[c] && (g.setAttribute("src", U(a.url[c])), a.obj.appendChild(g))
                }
                a.obj.volume = a.c * R;
                0 == a.loop && (a.obj.f = 1E7);
                1 <= a.loop && (a.obj.f = a.loop - 1);
                if ((1 == a.mode || 2 == a.mode || 3 == a.mode || 5 == a.mode) && 0 <= a.loop) a.obj.autoplay = m;
                0 <= e ? p[e] = a : p.push(a);
                0 < a.obj.childNodes.length && (b.a.appendChild(a.obj), a.obj.addEventListener("ended", function () {
                    if (0 < this.f) return this.f--, this.currentTime = 0, this.play(), m
                }, r))
            }
        } catch (h) {
            X(h)
        }
    }
    function Aa() {
        var a;
        a = document.createElement("div");
        a.innerHTML = Tc("PGRpdiBzdHlsZT0icG9zaXRpb246IHJlbGF0aXZlOyBsZWZ0OiAwcHg7IHJpZ2h0OiAwcHg7IHRvcDogNDAlOyBib3R0b206IDYwJTsgbWFyZ2luOiBhdXRvOyB3aWR0aDogMThlbTsgaGVpZ2h0OiA0ZW07IGJvcmRlcjogM3B4IHNvbGlkICM1NTU7IGJveC1zaGFkb3c6IDVweCA1cHggMTBweCAjMzMzOyBiYWNrZ3JvdW5kLWNvbG9yOiB3aGl0ZTsgZGlzcGxheTogdGFibGU7IGZvbnQtZmFtaWx5OiBWZXJkYW5hLCBBcmlhbCwgSGVsdmV0aWNhLCBzYW5zLXNlcmlmOyBmb250LXNpemU6IDEwcHQ7IG9wYWNpdHk6IDAuOTU7IGJvcmRlci1yYWRpdXM6IDE1cHg7Ij48cCBzdHlsZT0idGV4dC1hbGlnbjogY2VudGVyOyBkaXNwbGF5OiB0YWJsZS1jZWxsOyB2ZXJ0aWNhbC1hbGlnbjogbWlkZGxlOyAiPkNyZWF0ZWQgd2l0aCA8YSBocmVmPSJodHRwOi8vcGFubzJ2ci5jb20vIiB0YXJnZXQ9Il9ibGFuayI+UGFubzJWUjwvYT48L3A+PC9kaXY+JzsNCgkJ");
        a.setAttribute("style", "top:  0px;left: 0px;width: 100px;height: 100px;overflow: hidden;z-index: 5000;position:relative;");
        b.a.replaceChild(a, C);
        a.style.width = 0 + Y + Hb + A + "px";
        a.style.height = 0 + aa + Ib + z + "px";
        a.onclick = function () {
            b.a.replaceChild(C, a)
        };
        a.oncontextmenu = function () {
            b.a.replaceChild(C, a)
        }
    }
    function $() {
        var a;
        a = new ga;
        a.Z(s, q);
        for (var e = 0; e < p.length + x.length; e++) {
            var c;
            c = e < p.length ? p[e] : x[e - p.length];
            if (c.obj) {
                var b;
                b = c.pan - s;
                for (var d = c.tilt - q; - 180 > b;) b += 360;
                for (; 180 < b;) b -= 360;
                var g = c.A,
                    h = c.field;
                0 == h && (h = 0.01);
                0 > h && (h = t);
                c.P || (c.P = new ga, c.P.Z(c.pan, c.tilt));
                if (3 == c.mode) {
                    b = Math.abs(b);
                    b = b < c.g ? 0 : b - c.g;
                    var n = c.c,
                        d = Math.abs(d),
                        d = d < c.s ? 0 : d - c.s,
                        l = 1 - d / h;
                    if (Math.abs(b) > h || 0 > l) c.obj.volume = n * g * R;
                    else {
                        var k = 1 - Math.abs(b / h);
                        c.obj.volume = n * (g + (1 - g) * l * k) * R
                    }
                }
                4 == c.mode && c.wa == o && (Math.abs(b) < c.g && Math.abs(d) < c.s ? c.H || (c.H = m, c.obj.play()) : c.H = r);
                5 == c.mode && (b = 180 * Math.acos(a.O(c.P)) / Math.PI, b < c.g ? c.obj.volume = c.c * R : (b -= c.g, b < h && 0 < h ? (k = 1 - Math.abs(b / h), c.obj.volume = c.c * (g + (1 - g) * k) * R) : c.obj.volume = g * R));
                6 == c.mode && (b = 180 * Math.acos(a.O(c.P)) / Math.PI, Math.abs(b) < c.g ? c.H || (c.H = m, c.obj.play()) : c.H = r)
            }
        }
    }
    function Ba() {
        setTimeout(function () {
            b.setFullscreen(r)
        }, 10);
        setTimeout(function () {
            b.setFullscreen(r)
        }, 100)
    }
    function Ca() {
        var a = new Date;
        0 <= N && (xa ? (ba = 0.4 * (oa - hb), ca = 0.4 * (pa - ib), hb += ba, ib += ca, Jb(ba, ca)) : (ba = 0.1 * -Oa, ca = 0.1 * -Pa, Jb(0.1 * -Oa, 0.1 * -Pa)), b.update());
        jb && (b.changeFov(0.4 * (O - t)), 0.0010 > Math.abs(O - t) / t && (jb = r), b.update());
        if (Kb && (0 != ba || 0 != ca) && 0 > N) ba *= 0.9, ca *= 0.9, 0.1 > ba * ba + ca * ca ? ca = ba = 0 : (Jb(ba, ca), b.update());
        if (0 != Qa) {
            switch (Qa) {
                case 37:
                    b.changePan(1, m);
                    break;
                case 38:
                    b.changeTilt(1, m);
                    break;
                case 39:
                    b.changePan(-1, m);
                    break;
                case 40:
                    b.changeTilt(-1, m);
                    break;
                case 43:
                case 107:
                case 16:
                    b.changeFovLog(-1, m);
                    break;
                case 17:
                case 18:
                case 109:
                case 45:
                case 91:
                    b.changeFovLog(1, m)
            }
            b.update()
        }
        if (!b.isLoaded && b.hasConfig) {
            var e, c = 0;
            Ra && (b.finalPanorama(), Ra = r);
            for (e = 0; e < b.checkLoaded.length; e++) b.checkLoaded[e].complete && "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAA5JREFUeNpiYBgeACDAAADIAAE3iTbkAAAAAElFTkSuQmCC" != b.checkLoaded[e].src && c++;
            c == b.checkLoaded.length ? (rb = 1, b.isLoaded = m, b.divSkin && b.divSkin.ggLoaded && b.divSkin.ggLoaded(), sb && Sa && !Ta && (V = m)) : rb = c / (1 * b.checkLoaded.length)
        }
        for (; 360 < s;) s -= 360;
        for (; - 360 > s;) s += 360;
        if (Ta) {
            B = Lb - s;
            if (360 == Ua - Va) {
                for (; - 180 > B;) B += 360;
                for (; 180 < B;) B -= 360
            }
            J = Mb - q;
            H = Nb - t;
            e = Math.sqrt(B * B + J * J + H * H);
            if (10 * e < tb) {
                if (Ta = r, H = J = B = 0, b.onMoveComplete) b.onMoveComplete()
            } else e = e > 5 * tb ? tb / e : 0.2, B *= e, J *= e, H *= e;
            s += B;
            q += J;
            t += H;
            Ob = a.getTime();
            b.update()
        } else if (V) if (e = a.getTime() - Wa, 0 < Pb && b.U && e >= 1E3 * Pb) {
            if (1 < Xa.length) {
                e = 1E3;
                do c = Xa[Math.floor(Math.random() * Xa.length)];
                while (e-- && c == Fb);
                Wa = a.getTime();
                b.openNext("{" + c + "}")
            }
        } else J = ub * (0 - q) / 100, H = ub * (vb - t) / 100, B = 0.95 * B + 0.05 * -qa, s += B, q += J, t += H, b.update();
        else {
            if (Sa && 0 > N && a.getTime() - Ob > 1E3 * Qb && (sb && b.isLoaded || !sb)) V = m, Wa = a.getTime(), H = J = B = 0;
            if (Kb && 0 == Qa && 0 > N && (0 != B || 0 != J || 0 != H)) B *= 0.9, J *= 0.9, H *= 0.9, s += B, q += J, b.changeFovLog(H), 1.0E-4 > B * B + J * J + H * H && (H = J = B = 0), b.update()
        }
        qc && (wb ? a.getTime() - Rb >= 1E3 * rc && (wb = r) : (ya += Ya, 0 > ya && (ya = 0, Ya = -Ya, wb = m, Rb = a.getTime()), 1 < ya && (ya = 1, Ya = -Ya, wb = m, Rb = a.getTime()), b.setOverlayOpacity(ya)));
        if (0 < x.length) for (e = 0; e < x.length; e++) x[e].ba && x[e].na != x[e].obj.currentTime && (x[e].na = x[e].obj.currentTime, !x[e].ha && 0 < x[e].obj.videoHeight && (x[e].ha = x[e].obj.videoWidth / x[e].obj.videoHeight));
        if (0 < P) {
            if (2 == P) for (e = 0; e < G.length; e++) a = G[e], "poly" == a.type && a.l != a.e && (a.l > a.e ? (a.e += 0.05, a.l < a.e && (a.e = a.l)) : (a.e -= 0.05, a.l > a.e && (a.e = a.l)), b.update());
            3 == P && ja != Z && (ja > Z ? (Z += 0.05, ja < Z && (Z = ja)) : (Z -= 0.05, ja > Z && (Z = ja)), b.update())
        }
        $();
        b.dirty && (0 < b.J ? b.J-- : (b.dirty = r, b.J = 0), b.updatePanorama());
        Uc(function () {
            Ca()
        })
    }
    function Da(a) {
        b.skinObj && b.skinObj.hotspotProxyClick && b.skinObj.hotspotProxyClick(a.id);
        "" != a.url && (b.openUrl(a.url, a.target), sc(-1, -1))
    }
    function va() {
        if (b.isFullscreen && (!document.webkitIsFullScreen && !document.mozFullScreen && !document.fullScreen && b.exitFullscreen(), document.webkitIsFullScreen || document.mozFullScreen || document.fullScreen)) b.a.style.left = "0px", b.a.style.top = "0px"
    }
    function Ea() {
        Qa = 0
    }
    function Fa() {
        Qa = 0;
        E()
    }
    function Ga(a) {
        xb || (Qa = a.keyCode, E())
    }
    function Ha(a) {
        S || (a.preventDefault(), E(), Za && Za.reset())
    }
    function fb(a) {
        S || (a.preventDefault(), 1 != a.scale && (jb = m, yb *= a.scale, O = $a / Math.sqrt(yb), O > da && (O = da), O < ea && (O = ea), b.update(), E()))
    }
    function gb(a) {
        !S && b.d == b.control && (a.preventDefault(), jb = m, O = $a / Math.sqrt(a.scale), O > da && (O = da), O < ea && (O = ea), b.update(), E())
    }
    function wa(a) {
        Sb = m;
        yb = 1;
        S || (a.touches ? (b.d = a.touches.target, b.d == b.control && (a.preventDefault(), $a = t, E())) : (a.preventDefault(), $a = t, E()))
    }
    function Ia(a) {
        Za || (X("setup gesture"), Za = new MSGesture, Za.target = b.control);
        Za.va(a.ya)
    }
    function Ja() {
        S || (N = -2)
    }
    function Ka(a) {
        var e;
        if (!S) {
            0 <= N && E();
            var c = (new Date).getTime();
            e = -1;
            var f, d, g = m;
            e = Math.abs(tc - kb) + Math.abs(uc - lb);
            if (0 <= e && 20 > e) {
                a.preventDefault();
                b.d == b.control && (f = Tb(b.mouse.x, b.mouse.y));
                if (b.d) {
                    e = b.d;
                    for (d = r; e && e != b.control;) e.onclick && !d && (e.onclick(), d = m, g = r), e = e.parentNode
                }
                e = Math.abs(vc - kb) + Math.abs(wc - lb);
                if (700 > c - b.D && 0 <= e && 20 > e) {
                    a.preventDefault();
                    b.d == b.control && Ub && setTimeout(function () {
                        b.toggleFullscreen()
                    }, 1);
                    if (b.d) {
                        e = b.d;
                        for (d = r; e && e != b.control;) e.ondblclick && !d && (e.ondblclick(), d = m, g = r), e = e.parentNode
                    }
                    b.D = 0
                } else b.D = c;
                vc = kb;
                wc = lb
            }
            if (b.d) {
                a.preventDefault();
                e = b.d;
                for (d = r; e && e != b.control;) {
                    if (e.onmouseout) e.onmouseout();
                    e.onmouseup && !d && (e.onmouseup(), d = m);
                    e = e.parentNode
                }
            }
            b.d = o;
            N = -11;
            f && g && Da(f)
        }
    }
    function La(a) {
        a || (a = window.event);
        var e = a.touches,
            c = zb();
        b.mouse.x = e[0].pageX - c.x;
        b.mouse.y = e[0].pageY - c.y;
        if (!S) {
            e[0] && (kb = e[0].pageX, lb = e[0].pageY);
            if (0 <= N) {
                a.preventDefault();
                for (c = 0; c < e.length; c++) if (e[c].identifier == N) {
                    xc(e[c].pageX, e[c].pageY);
                    break
                }
                E()
            }
            2 == e.length && e[0] && e[1] && (N = -6, Sb || (yc = Math.sqrt((e[0].pageX - e[1].pageX) * (e[0].pageX - e[1].pageX) + (e[0].pageY - e[1].pageY) * (e[0].pageY - e[1].pageY)), jb = m, O = $a * Math.sqrt(zc / yc), O > da && (O = da), O < ea && (O = ea), E(), a.preventDefault()))
        }
    }
    function Ma(a) {
        a || (a = window.event);
        var e = a.touches,
            c = zb();
        b.mouse.x = e[0].pageX - c.x;
        b.mouse.y = e[0].pageY - c.y;
        if (!S) {
            if (0 > N && e[0]) {
                Vb = (new Date).getTime();
                tc = e[0].pageX;
                uc = e[0].pageY;
                kb = e[0].pageX;
                lb = e[0].pageY;
                b.d = e[0].target;
                if (e[0].target == b.control) {
                    a.preventDefault();
                    var c = e[0].pageX,
                        f = e[0].pageY;
                    Wb = c;
                    Xb = f;
                    oa = c;
                    pa = f;
                    hb = c;
                    ib = f;
                    N = e[0].identifier;
                    E()
                }
                if (b.d) {
                    c = b.d;
                    for (flag = r; c && c != b.control;) {
                        if (c.onmouseover) c.onmouseover();
                        c.onmousedown && !flag && (c.onmousedown(), flag = m);
                        c = c.parentNode
                    }
                    flag && a.preventDefault()
                }
            }
            1 < e.length && (N = -5);
            !Sb && 2 == e.length && e[0] && e[1] && (zc = Math.sqrt((e[0].pageX - e[1].pageX) * (e[0].pageX - e[1].pageX) + (e[0].pageY - e[1].pageY) * (e[0].pageY - e[1].pageY)), $a = t);
            Pa = Oa = 0
        }
    }
    function na(a) {
        if (!Yb && (a = a ? a : window.event, a.target == b.control)) {
            var e = a.detail ? -1 * a.detail : a.wheelDelta / 40;
            Ac && (e = -e);
            b.changeFovLog((0 < e ? 1 : -1) * Bc, m);
            b.update();
            a.preventDefault();
            E()
        }
    }
    function Cc(a) {
        a = a ? a : window.event;
        if (!S && 0 <= N) {
            a.preventDefault();
            N = -3;
            Pa = Oa = 0;
            var a = (new Date).getTime(),
                e = -1,
                e = Math.abs(Wb - oa) + Math.abs(Xb - pa);
            400 > a - Vb && 0 <= e && 20 > e && ((e = Tb(b.mouse.x, b.mouse.y)) && Da(e), e = Math.abs(Dc - oa) + Math.abs(Ec - pa), 700 > a - b.D && 0 <= e && 20 > e ? (Ub && setTimeout(function () {
                b.toggleFullscreen()
            }, 10), b.D = 0) : b.D = a, Dc = oa, Ec = pa);
            E()
        }
    }
    function Fc(a) {
        var a = a ? a : window.event,
            e = zb();
        document.webkitIsFullScreen || document.mozFullScreen || document.fullScreen ? (b.mouse.x = a.screenX, b.mouse.y = a.screenY) : (b.mouse.x = a.pageX - e.x, b.mouse.y = a.pageY - e.y);
        if (!S && (0 <= N && (a.preventDefault(), (a.which || 0 == a.which || 1 == a.which) && xc(a.pageX, a.pageY), E()), b.hotspot == b.emptyHotspot || "poly" == b.hotspot.type)) {
            var c = b.emptyHotspot;
            a.target == b.control && (c = Tb(b.mouse.x, b.mouse.y));
            b.hotspot != c && (b.hotspot != b.emptyHotspot && (0 < P && (b.hotspot.l = 0), b.skinObj && b.skinObj.hotspotProxyOut && b.skinObj.hotspotProxyOut(b.hotspot.id)), c ? (b.hotspot = c, b.skinObj && b.skinObj.hotspotProxyOver && b.skinObj.hotspotProxyOver(b.hotspot.id), C.style.cursor = "pointer", 0 < P && (ja = 1, b.hotspot.l = 1)) : (b.hotspot = b.emptyHotspot, C.style.cursor = "auto", 0 < P && (ja = 0)));
            sc(a.pageX - e.x, a.pageY - e.y)
        }
    }
    function sc(a, e) {
        var c = Ab;
        c.enabled && (b.hotspot != b.emptyHotspot && 0 <= a && 0 <= e && "" != b.hotspot.title ? (I.innerHTML = b.hotspot.title, I.style.color = ra(c.Y, c.X), I.style.backgroundColor = c.background ? ra(c.u, c.t) : "transparent", I.style.border = "solid " + ra(c.z, c.v) + " " + c.R + "px", I.style.borderRadius = c.Q + "px", I.style.textAlign = "center", 0 < c.width ? (I.style.left = a - c.width / 2 + Y + "px", I.style.width = c.width + "px") : (I.style.width = "auto", I.style.left = a - I.offsetWidth / 2 + Y + "px"), I.style.height = 0 < c.height ? c.height + "px" : "auto", I.style.top = e + 25 + (+aa) + "px", I.style.visibility = "inherit", I.style.overflow = "hidden") : (I.style.visibility = "hidden", I.innerHTML = ""))
    }
    function Gc(a) {
        if (!S) {
            a = a ? a : window.event;
            if ((a.which || 0 == a.which || 1 == a.which) && a.target == b.control) {
                a.preventDefault();
                var e = a.pageX,
                    a = a.pageY;
                Wb = e;
                Xb = a;
                oa = e;
                pa = a;
                hb = e;
                ib = a;
                N = 1;
                Vb = (new Date).getTime();
                E()
            }
            Pa = Oa = 0
        }
    }
    function E() {
        V && (V = r, H = J = B = 0);
        Ta && (Ta = r, H = J = B = 0);
        Ob = (new Date).getTime()
    }
    function xc(a, e) {
        Zb = a;
        $b = e;
        Oa = Zb - oa;
        Pa = $b - pa;
        xa && (oa = Zb, pa = $b, b.update())
    }
    function Jb(a, e) {
        var c = b.getVFov();
        s += a * c / z;
        q += e * c / z;
        Bb()
    }
    function Hc(a) {
        ac = g.createBuffer();
        g.bindBuffer(g.ARRAY_BUFFER, ac);
        vertices = [-1, -1, 1, 1, -1, 1, 1, 1, 1, -1, 1, 1];
        for (i = 0; 12 > i; i++) 2 > i % 3 && (vertices[i] *= a);
        g.bufferData(g.ARRAY_BUFFER, new Float32Array(vertices), g.STATIC_DRAW);
        bc = g.createBuffer();
        g.bindBuffer(g.ARRAY_BUFFER, bc);
        g.bufferData(g.ARRAY_BUFFER, new Float32Array([1, 0, 0, 0, 0, 1, 1, 1]), g.STATIC_DRAW);
        cc = g.createBuffer();
        g.bindBuffer(g.ELEMENT_ARRAY_BUFFER, cc);
        g.bufferData(g.ELEMENT_ARRAY_BUFFER, new Uint16Array([0, 1, 2, 0, 2, 3]), g.STATIC_DRAW)
    }
    function Ic() {
        var a, e;
        if (W) for (; 0 < W.length;) g.deleteTexture(W.pop());
        W = [];
        for (var c = 0; 6 > c; c++) e = g.createTexture(), e.N = o, e.M = o, e.aa = r, g.bindTexture(g.TEXTURE_2D, e), g.texImage2D(g.TEXTURE_2D, 0, g.RGB, 1, 1, 0, g.RGB, g.UNSIGNED_BYTE, o), g.texParameteri(g.TEXTURE_2D, g.TEXTURE_MIN_FILTER, g.LINEAR), g.texParameteri(g.TEXTURE_2D, g.TEXTURE_WRAP_S, g.CLAMP_TO_EDGE), g.texParameteri(g.TEXTURE_2D, g.TEXTURE_WRAP_T, g.CLAMP_TO_EDGE), sa[c] && (a = new Image, a.crossOrigin = "anonymous", a.src = U(sa[c]), e.N = a, a.addEventListener && a.addEventListener("load", dc(e), r), b.checkLoaded.push(a)), W.push(e);
        for (c = 0; 6 > c; c++) ab[c] && (a = new Image, a.crossOrigin = "anonymous", a.src = U(ab[c]), a.addEventListener ? a.addEventListener("load", dc(W[c]), r) : a.onload = dc(W[c]), W[c].M = a, b.checkLoaded.push(a));
        for (c = 0; c < x.length; c++) x[c].ua = g.createTexture(), g.bindTexture(g.TEXTURE_2D, x[c].ua), g.texImage2D(g.TEXTURE_2D, 0, g.RGB, 1, 1, 0, g.RGB, g.UNSIGNED_BYTE, o), g.texParameteri(g.TEXTURE_2D, g.TEXTURE_MIN_FILTER, g.LINEAR), g.texParameteri(g.TEXTURE_2D, g.TEXTURE_WRAP_S, g.CLAMP_TO_EDGE), g.texParameteri(g.TEXTURE_2D, g.TEXTURE_WRAP_T, g.CLAMP_TO_EDGE);
        g.bindTexture(g.TEXTURE_2D, o);

    }
    function U(a) {
        return a ? "{" == a.charAt(0) || "/" == a.charAt(0) || 0 < a.indexOf("://") ? a : mb + a : mb
    }
    function dc(a) {
        return function () {
            try {
                g.pixelStorei(g.UNPACK_FLIP_Y_WEBGL, m);
                var e = r;
                a.M != o && a.M.complete ? a.aa || (g.bindTexture(g.TEXTURE_2D, a), g.texImage2D(g.TEXTURE_2D, 0, g.RGBA, g.RGBA, g.UNSIGNED_BYTE, a.M), e = a.aa = m) : a.N != o && a.N.complete && (g.bindTexture(g.TEXTURE_2D, a), g.texImage2D(g.TEXTURE_2D, 0, g.RGBA, g.RGBA, g.UNSIGNED_BYTE, a.N), e = m);
                e && (g.texParameteri(g.TEXTURE_2D, g.TEXTURE_MAG_FILTER, g.LINEAR), g.texParameteri(g.TEXTURE_2D, g.TEXTURE_MIN_FILTER, g.LINEAR), g.texParameteri(g.TEXTURE_2D, g.TEXTURE_WRAP_S, g.CLAMP_TO_EDGE), g.texParameteri(g.TEXTURE_2D, g.TEXTURE_WRAP_T, g.CLAMP_TO_EDGE));
                g.bindTexture(g.TEXTURE_2D, o)
            } catch (c) {}
            b.update()
        }
    }
    function Gb() {
        var a = Math.round(b.S()),
            e;
        for (e = 0; e < x.length + Na.length; e++) {
            var c;
            c = e < x.length ? x[e] : Na[e - x.length];
            Jc(a);
            var f = "",
                f = f + ("translate3d(0px,0px," + a + "px) "),
                f = f + ("rotateX(" + q.toFixed(10) + "deg) "),
                f = f + ("rotateY(" + (-s).toFixed(10) + "deg) "),
                f = f + ("rotateY(" + c.pan.toFixed(10) + "deg) "),
                f = f + ("rotateX(" + (-c.tilt).toFixed(10) + "deg) "),
                d = 1E4,
                g = c.obj.videoWidth,
                h = c.obj.videoHeight;
            if (0 == g || 0 == h) g = 640, h = 480;
            0 < c.o && (g = c.o);
            0 < c.n && (h = c.n);
            0 < g && 0 < h && (c.obj.width = g + "px", c.obj.oa = h + "px", c.obj.style.width = g + "px", c.obj.style.oa = h + "px");
            0 < c.C && (d = g / (2 * Math.tan(c.C / 2 * Math.PI / 180)));
            f += "translate3d(0px,0px," + (-d).toFixed(10) + "px) ";
            f += "rotateZ(" + c.G.toFixed(10) + "deg) ";
            f += "rotateY(" + (-c.k).toFixed(10) + "deg) ";
            f += "rotateX(" + c.j.toFixed(10) + "deg) ";
            c.L && 1 != c.L && (f += "scaleY(" + c.L + ") ");
            f += "translate3d(" + -g / 2 + "px," + -h / 2 + "px,0px) ";
            c.obj.style[fa + "Origin"] = "0% 0%";
            c.m && (f = "", 1 == c.i && (d = Math.min(A / g, z / h), f += "scale(" + d + ") "), f += "translate3d(" + -g / 2 + "px," + -h / 2 + "px,0px) ");
            c.ma != f && (c.ma = f, c.obj.style[fa] = f, c.obj.style.left = Y + A / 2 + "px", c.obj.style.top = aa + z / 2 + "px", c.obj.style.visibility = "visible", c.K && c.la == c.m && (c.obj.style[ia] = "all 0.05s linear 0s"), c.la = c.m)
        }
    }
    function Bb() {
        var a, e;
        t < ea && (t = ea);
        t > da && (t = da);
        e = b.getVFov() / 2;
        a = 180 * Math.atan(A / z * Math.tan(e * Math.PI / 180)) / Math.PI;
        2 * e > ta - ua && (e = (ta - ua) / 2);
        b.setVFov(2 * e);
        90 > ta ? q + e > ta && (q = ta - e) : q > ta && (q = ta); - 90 < ua ? q - e < ua && (q = ua + e) : q < ua && (q = ua);
        if (359.99 > Ua - Va) {
            var c = 0;
            if (0 != q) {
                var f, d = z / 2;
                f = d * Math.tan(e * Math.PI / 180);
                d /= Math.tan(Math.abs(q) * Math.PI / 180);
                d -= f;
                0 < d && (c = 180 * Math.atan(1 / (d / f)) / Math.PI, c = c * (Ua - Va) / 360)
            }
            s + (a + c) > Ua && (s = Ua - (a + c), V && (qa = -qa, B = 0));
            s - (a + c) < Va && (s = Va + (a + c), V && (qa = -qa, B = 0));
            90 < q + e && (q = 90 - e); - 90 > q - e && (q = -90 + e)
        }
    }
    function Tb(a, e) {
        for (var c = -1, b = 0; b < G.length; b++) {
            var d = G[b];
            if ("poly" == d.type && d.q && 0 < d.q.length) {
                var g, h, n = r;
                for (g = 0, h = d.q.length - 1; g < d.q.length; h = g++) {
                    var l = d.q[g];
                    h = d.q[h];
                    l.r > e != h.r > e && a < (h.F - l.F) * (e - l.r) / (h.r - l.r) + l.F && (n = !n)
                }
                n && (c = b)
            }
        }
        return 0 <= c ? G[c] : r
    }
    function ra(a, e) {
        a = Number(a);
        return "rgba(" + (a >> 16 & 255) + "," + (a >> 8 & 255) + "," + (a & 255) + "," + e + ")"
    }
    function Jc(a) {
        b.qa != a && (b.qa = a, C.style[nb] = a + "px", C.style[nb + "Origin"] = Y + A / 2 + "px " + (aa + z / 2) + "px ")
    }
    function ob(a, e) {
        if (0 == a.length) return a;
        var c, b, d, g, h, n, l, k = [];
        c = e.O(a[0]) - 0;
        for (g = 0; g < a.length; g++) {
            n = g;
            l = g + 1;
            l == a.length && (l = 0);
            b = e.O(a[l]) - 0;
            if (0 <= c && 0 <= b) k.push(a[n]);
            else if (0 <= c || 0 <= b) d = b / (b - c), 0 > d && (d = 0), 1 < d && (d = 1), h = new ga, h.pa(a[n], a[l], d), 0 > c || k.push(a[n]), k.push(h);
            c = b
        }
        return k
    }
    function zb() {
        var a = {
            x: 0,
            y: 0
        }, b = F;
        if (b.offsetParent) {
            do a.x += b.offsetLeft, a.y += b.offsetTop;
            while (b = b.offsetParent)
        }
        return a
    }
    function za() {
        b.setViewerSize(b.B.offsetWidth, b.B.offsetHeight)
    }
    function X(a) {
        if (debug = document.getElementById("debug")) debug.innerHTML = a + "<br />";
        window.console && window.console.log(a)
    }
    var Ab, P, Z, ja, ec, fc, gc, hc, ic;

    function Tc(a) {
        var b = "",
            c, f, d = "",
            g, h = "",
            l = 0,
            a = a.replace(/[^A-Za-z0-9\+\/\=]/g, "");
        do c = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=".indexOf(a.charAt(l++)), f = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=".indexOf(a.charAt(l++)), g = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=".indexOf(a.charAt(l++)), h = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=".indexOf(a.charAt(l++)), c = c << 2 | f >> 4, f = (f & 15) << 4 | g >> 2, d = (g & 3) << 6 | h, b += String.fromCharCode(c), 64 != g && (b += String.fromCharCode(f)), 64 != h && (b += String.fromCharCode(d));
        while (l < a.length);
        return b
    }
    function Vc(a, b) {
        var c = this;
        c.sa = a;
        c.hotspot = b;
        c.__div = document.createElement("div");
        c.T = document.createElement("img");
        var f;
        c.T.setAttribute("src", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAcCAYAAAByDd+UAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA5xJREFUeNqclmlIVFEUx997TjrplFQW2WKBBSYtRFlpWUILSSsRZRQIBdGHCFqIoKIvQRsUFRJC9LEgaSFbMMpcWi1pLzOLsjItKms0U5t5/c/wH7nc5o2jF374xrv87z33nHOPaRsRtbFgDpgJxoD+wATfwDNQDK6CyrCr5OcbhgiGIRsUAZt4QTWoIFXgp9JfAhY7rgdBl8NeBoLDYBloA+dBOagFTcDHcVEgDgwBGWA+OAcugvXgvb5wKMGJoAAMp9BpUA96EBf/Btsf8BI8AWfAErAcpHHDZeriliY2AVwDg8AucAQ0Ag+I4XhTm2Oxz8PT46KMbTx5EZjuJDgAnAVusJUm9DhYwalFcc59sIXXIaceFkowDySBPTRPL20xm+b7zYXa+N3CPrWJ6GuwGySA40HLBHc/GywFhbS5R1lEBrZy7FQwiSaX9pmnqeAYt+KUcew7BVZw/QKTq0ocpYPVvDOXItZCk2xgDIZqL8BR8Ab0VDbr4yZOgLeIwzQx6WiQxcCt1+6sld66L4yYtFSwF4yg2dU7/cEwGW9YVkAwmycp1dzdpvgm0DcCh4kHmxWzBls0uBX4qqmZJ4KzePm1IeJLgjmlC16aDKZpp5Q168B3o6wsSwTHgU+MIUs74RSj6y1d+212HKimJlUE+tFRfJpYtOKNXWmJTASqWf2Bu/R6+4TKHOrOzG4IhptjWgHbGkZvepQ6SQK7oRuCXzjX1DJavBEX1ygfT8FgBqpfm1zRDcEKbR2bsZlkJCdXieB1ZhZ5YtqVgXIPN+m9kbY6hpdb+d9fPncJRmZmqQheZkemJmgxyxykl3XWJEkcAl7N21s7PDcl5ZJ0PAa3wVwmWtVbZafPwQ7wLozYB7ATPNJO56d/LAikP9u+66KNJS1d4IOZp7wU0hfLukUyzgwm70T2N/DOxIy/eFdqawa5DL2NEGwP5k15Ja4woz9glvcomd9NzyvkFcQo5gomaLfm5c0svnKZ2k7q7+FauvR2MJKZR3+sY5WgtvkdG6JyELGhNHMTXyGfLviRJ5Tcd4Dlhle7086Sgp8CqVxDkn4OqHaqacr5ekjy3Q/W0FRNNGmoMtamdzdxsytZC0lqXKhEgWPVVgImg2NgFT1MHOoOk3yLEtgWN5TEOYvoIFI1rGM19//2wpAD7imF7lfwENwAxaASNCj90pcLLKdC2Iyw1M9gnEplMEp5kOU1f8WwKGJm8oUr9f8JMAAVMDM6HSDa9QAAAABJRU5ErkJggg%3D%3D");
        c.T.setAttribute("style", "position: absolute;top: -14px;left: -14px;");
        c.__div.appendChild(c.T);
        f = "position:absolute;" + (M + "user-select: none;");
        c.__div.setAttribute("style", f);
        c.__div.onclick = function () {
            c.sa.openUrl(b.url, b.target)
        };
        var d = Ab;
        d.enabled && (c.text = document.createElement("div"), f = "position:absolute;" + ("left: -" + b.w / 2 + "px;"), f = f + "top:  20px;" + ("width: " + b.w + "px;"), f = 0 == b.h ? f + "height: auto;" : f + ("height: " + b.h + "px;"), b.wordwrap ? f = f + "white-space: pre-wrap;" + ("width: " + b.w + "px;") : (f = 0 == b.h ? f + "width: auto;" : f + ("width: " + b.w + "px;"), f += "white-space: nowrap;"), f += M + "transform-origin: 50% 50%;", c.text.setAttribute("style", f + "visibility: hidden;border: 1px solid #000000;background-color: #ffffff;text-align: center;overflow: hidden;padding: 0px 1px 0px 1px;"), c.text.style.color = ra(d.Y, d.X), c.text.style.backgroundColor = d.background ? ra(d.u, d.t) : "transparent", c.text.style.border = "solid " + ra(d.z, d.v) + " " + d.R + "px", c.text.style.borderRadius = d.Q + "px", c.text.style.textAlign = "center", c.text.style.width = 0 < d.width ? d.width + "px" : "auto", c.text.style.height = 0 < d.height ? d.height + "px" : "auto", c.text.style.overflow = "hidden", c.text.innerHTML = b.title, c.__div.onmouseover = function () {
            0 == b.h && (w = c.text.offsetWidth, c.text.style.left = -w / 2 + "px");
            c.text.style.visibility = "inherit"
        }, c.__div.onmouseout = function () {
            c.text.style.visibility = "hidden"
        }, c.__div.appendChild(c.text))
    }
    var b = this;
    b.transitionsDisabled = r;
    var s = 0,
        jc = 0,
        Va = 0,
        Ua = 360,
        B = 0,
        Kc = 0,
        q = 0,
        kc = 0,
        ua = -90,
        ta = 90,
        J = 0,
        t = 90,
        vb = 90,
        ea = 1,
        da = 170,
        $a = 0,
        H = 0,
        lc = 0,
        zc, yc, A = 320,
        z = 480,
        Wb = 0,
        Xb = 0,
        oa = 0,
        pa = 0,
        Dc = 0,
        Ec = 0,
        Zb = 0,
        $b = 0,
        Oa = 0,
        Pa = 0,
        N = -1,
        tc = 0,
        uc = 0,
        kb = 0,
        lb = 0,
        vc = 0,
        wc = 0,
        Vb, Kb = m,
        hb = 0,
        ib = 0,
        ba = 0,
        ca = 0,
        jb = r,
        O = 0,
        Qa = 0,
        F = o,
        ka = o,
        la = b.a = o,
        ha = o,
        C = o,
        T = o;
    b.control = o;
    b.cubeFaces = [];
    b.cubeFacesOverlay = [];
    b.checkLoaded = [];
    b.isFullscreen = r;
    b.dirty = r;
    b.J = 1;
    b.divSkin = o;
    b.isLoaded = r;
    b.hasConfig = r;
    b.startNode = "";
    b.onMoveComplete = o;
    var rb = 0,
        ab = [],
        mc = [],
        sa = [],
        pb = 1,
        bb = 1,
        Ra = r,
        Sa = r,
        Qb = 5,
        V = r,
        sb = r,
        qa = 0.4,
        ub = 0,
        Pb = 0,
        Wa, Ta = r,
        tb = 0.1,
        Lb = 0,
        Mb = 0,
        Nb, Ob;
    b.skinObj = o;
    b.userdata = {};
    b.userdata.title = "";
    b.userdata.description = "";
    b.userdata.author = "";
    b.userdata.datetime = "";
    b.userdata.copyright = "";
    b.userdata.source = "";
    b.userdata.information = "";
    b.userdata.comment = "";
    b.userdata.tags = [];
    var G = [];
    b.emptyHotspot = {
        pan: 0,
        tilt: 0,
        title: "",
        url: "",
        target: "",
        id: "",
        skinid: "",
        w: 100,
        h: 20,
        wordwrap: r,
        obj: o,
        type: "empty"
    };
    var p = [],
        x = [],
        Na = [],
        cb = [],
        Xa = [],
        R = 1,
        ya = 0,
        Ya = 0.01,
        rc = 2,
        Rb = 0,
        wb = r,
        qc = r,
        Y = 0,
        aa = 0,
        Hb = 0,
        Ib = 0,
        xb = r,
        S = r,
        Yb = r,
        xa = m,
        Ac = r,
        Bc = 1,
        Ub = m;
    P = 1;
    Z = 0;
    ja = 0;
    ec = 255;
    fc = 1;
    gc = 255;
    hc = 0.3;
    Ab = {
        enabled: m,
        width: 180,
        height: 20,
        Y: 0,
        X: 1,
        background: m,
        u: 16777215,
        t: 1,
        z: 0,
        v: 1,
        Q: 3,
        R: 1,
        wordwrap: m
    };
    ic = void 0;
    b.hotspot = b.emptyHotspot;
    var I = o;
    b.mouse = {
        x: 0,
        y: 0
    };
    var db = r,
        Cb = r,
        Lc = r,
        Mc = m,
        Sb = r,
        mb = "",
        M = "",
        ia = "transition",
        fa = "transform",
        nb = "perspective",
        g, Nc = new ga,
        Oc = new ga,
        Pc = new ga,
        Qc = new ga,
        Rc = new ga;
    b.U = r;
    var Fb = "",
        Sc = navigator.userAgent.match(/(MSIE)/g) ? m : r,
        Wc = navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? m : r,
        Uc = function () {
            var a = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame;
            return Wc || !a ? function (a) {
                window.setTimeout(a, 10)
            } : a
        }();
    b.detectBrowser = function () {
        var a = ["Webkit", "Moz", "O", "ms", "Ms"],
            b;
        M = "";
        ia = "transition";
        fa = "transform";
        nb = "perspective";
        for (b = 0; b < a.length; b++) "undefined" !== typeof document.documentElement.style[a[b] + "Transform"] && (M = "-" + a[b].toLowerCase() + "-", ia = a[b] + "Transition", fa = a[b] + "Transform", nb = a[b] + "Perspective");
        Lc = oc();
        db = pc();
        X((Lc ? "CSS 3D available" : "CSS 3D not available") + ", " + (db ? "WebGL available" : "WebGL not available"))
    };
    b.getPercentLoaded = function () {
        return rb
    };
    b.setBasePath = function (a) {
        mb = a
    };
    b.S = function () {
        return 1 * z / (2 * Math.tan(Math.PI / 180 * (b.getVFov() / 2)))
    };
    b.setViewerSize = function (a, e) {
        b.isFullscreen && (a = window.innerWidth, e = window.innerHeight);
        var c = a - Y - Hb,
            f = e - aa - Ib;
        F.style.width = c + "px";
        F.style.height = f + "px";
        F.style.left = Y + "px";
        F.style.top = aa + "px";
        if (db) try {
            ka && (ka.width = c, ka.height = f), g && (g.ga = c, g.fa = f, g.viewport(0, 0, c, f))
        } catch (d) {
            alert(d)
        }
        C.style.width = a + "px";
        C.style.height = e + "px";
        T.style.width = a + "px";
        T.style.height = e + "px";
        T.width = a;
        T.height = e;
        T.style.left = Y + "px";
        T.style.top = aa + "px";
        b.updatePanorama();
        b.divSkin && b.divSkin.ggUpdateSize && b.divSkin.ggUpdateSize(a, e)
    };
    b.setMargins = function (a, b, c, f) {
        Y = a;
        aa = b;
        Hb = c;
        Ib = f;
        za()
    };
    b.changeViewMode = function (a) {
        0 == a && (xa = r);
        1 == a && (xa = m);
        2 == a && (xa = xa ? r : m)
    };
    b.changePolygonMode = function (a, e) {
        P = 1 == e && 0 < P ? 0 : Math.round(a);
        b.update()
    };
    b.polygonMode = function () {
        return P
    };
    var Q;
    b.getVFov = function () {
        var a;
        switch (lc) {
            case 0:
                a = t / 2;
                break;
            case 1:
                a = 180 * Math.atan(z / A * Math.tan(t / 2 * Math.PI / 180)) / Math.PI;
                break;
            case 2:
                a = 180 * Math.atan(z / Math.sqrt(A * A + z * z) * Math.tan(t / 2 * Math.PI / 180)) / Math.PI;
                break;
            case 3:
                a = 4 * z / 3 > A ? t / 2 : 180 * Math.atan(4 * z / (3 * A) * Math.tan(t / 2 * Math.PI / 180)) / Math.PI
        }
        return 2 * a
    };
    b.setVFov = function (a) {
        var a = a / 2,
            b;
        switch (lc) {
            case 0:
                t = 2 * a;
                break;
            case 1:
                a = 180 * Math.atan(A / z * Math.tan(a * Math.PI / 180)) / Math.PI;
                t = 2 * a;
                break;
            case 2:
                b = Math.sqrt(A * A + z * z);
                a = 180 * Math.atan(b / z * Math.tan(a * Math.PI / 180)) / Math.PI;
                t = 2 * a;
                break;
            case 3:
                4 * z / 3 > A || (a = 180 * Math.atan(3 * A / (4 * z) * Math.tan(a * Math.PI / 180)) / Math.PI), t = 2 * a
        }
    };
    b.update = function (a) {
        b.dirty = m;
        a && (b.J = a)
    };
    b.updatePanorama = function () {
        var a = new ga(0, 0, -100),
            e = b.S(),
            c = Math.atan2(A / 2 + 1, e),
            f = Math.atan2(z / 2 + 1, e),
            d = Math.sin(c),
            h = Math.sin(f),
            c = Math.cos(c),
            f = Math.cos(f);
        Nc.p(0, 0, -1);
        Oc.p(c, 0, -d);
        Pc.p(-c, 0, -d);
        Qc.p(0, f, -h);
        Rc.p(0, -f, -h);
        for (d = 0; d < G.length; d++) {
            var h = G[d],
                l;
            "point" == h.type && (a.p(0, 0, -100), a.j(-h.tilt * Math.PI / 180), a.k(h.pan * Math.PI / 180), a.k(-s * Math.PI / 180), a.j(q * Math.PI / 180), c = r, 0.1 > a.b ? (l = -e / a.b, f = a.x * l, l *= a.y, Math.abs(f) < A / 2 + 500 && Math.abs(l) < z / 2 + 500 && (c = m)) : l = f = 0, h.obj && h.obj.__div && (h.obj.__div.style[ia] = "none", h.obj.ggUse3d ? c ? (Jc(e), h.obj.__div.style.width = "1px", h.obj.__div.style.height = "1px", hs = "", hs += "translate3d(0px,0px," + e + "px) ", hs += "rotateX(" + q.toFixed(10) + "deg) ", hs += "rotateY(" + (-s).toFixed(10) + "deg) ", hs += "rotateY(" + h.pan.toFixed(10) + "deg) ", hs += "rotateX(" + (-h.tilt).toFixed(10) + "deg) ", hs += "translate3d(0px,0px," + (-1 * h.obj.gg3dDistance).toFixed(10) + "px) ", h.obj.__div.style[fa + "Origin"] = "0% 0%", h.obj.__div.style[fa] = hs, h.obj.__div.style.left = Y + A / 2 + "px", h.obj.__div.style.top = aa + z / 2 + "px", h.obj.__div.style.visibility = "visible") : (h.obj.__div.style[fa] = "", h.obj.__div.style.visibility = "hidden") : c ? (h.obj.__div.style.left = Y + f + A / 2 + "px", h.obj.__div.style.top = aa + l + z / 2 + "px") : (h.obj.__div.style.left = "-100px", h.obj.__div.style.top = "-100px")));
            if ("poly" == h.type) {
                for (var n = [], c = 0; c < h.I.length; c++) f = h.I[c], a.p(0, 0, -100), a.j(-f.tilt * Math.PI / 180), a.k(f.pan * Math.PI / 180), a.k(-s * Math.PI / 180), a.j(q * Math.PI / 180), n.push(a.ja());
                f = n;
                f = ob(f, Nc);
                f = ob(f, Oc);
                f = ob(f, Pc);
                f = ob(f, Qc);
                n = f = ob(f, Rc);
                if (0 < n.length) for (c = 0; c < n.length; c++) a = n[c], 0.1 > a.b ? (l = -e / a.b, f = A / 2 + a.x * l, l = z / 2 + a.y * l) : l = f = 0, a.F = f, a.r = l;
                h.q = n
            }
        }
        if (T && (ic != P && (ic = P, T.style.visibility = 0 < P ? "inherit" : "hidden"), 0 < P)) {
            Q || (Q = T.getContext("2d"));
            if (Q.width != A || Q.height != z) Q.width = A, Q.height = z;
            Q.clear ? Q.clear() : Q.clearRect(0, 0, T.width, T.height);
            a = 1;
            3 == P && (a = Z);
            for (e = 0; e < G.length; e++) if (d = G[e], "poly" == d.type && (h = d.q, 2 == P && (a = d.e), Q.fillStyle = ra(d.u, d.t * a), Q.strokeStyle = ra(d.z, d.v * a), 0 < h.length)) {
                Q.beginPath();
                for (j = 0; j < h.length; j++) v = h[j], 0 == j ? Q.moveTo(v.F, v.r) : Q.lineTo(v.F, v.r);
                Q.closePath();
                Q.stroke();
                Q.fill()
            }
        }
        if (db) {
            Bb();
            if (A != F.offsetWidth || z != F.offsetHeight) A = parseInt(F.offsetWidth), z = parseInt(F.offsetHeight);
            Mc && (b.initWebGL(0), za());
            if (g) {
                g.clear(g.COLOR_BUFFER_BIT | g.DEPTH_BUFFER_BIT);
                qb(Db);
                h = b.getVFov();
                e = g.ga / g.fa;
                h = 0.1 * Math.tan(h * Math.PI / 360);
                e *= h;
                a = -e;
                d = -h;
                (f = Db) || (f = new glMatrixArrayType(16));
                c = e - a;
                n = h - d;
                f[0] = 0.2 / c;
                f[1] = 0;
                f[2] = 0;
                f[3] = 0;
                f[4] = 0;
                f[5] = 0.2 / n;
                f[6] = 0;
                f[7] = 0;
                f[8] = (e + a) / c;
                f[9] = (h + d) / n;
                f[10] = -100.1 / 99.9;
                f[11] = -1;
                f[12] = 0;
                f[13] = 0;
                f[14] = -20 / 99.9;
                f[15] = 0;
                g.uniformMatrix4fv(D.ca, r, Db);
                for (v = 0; 6 > v; v++) qb(eb), nc(eb, -q * Math.PI / 180, [1, 0, 0]), nc(eb, (180 - s) * Math.PI / 180, [0, 1, 0]), 4 > v ? nc(eb, -Math.PI / 2 * v, [0, 1, 0]) : nc(eb, Math.PI / 2 * (5 == v ? 1 : -1), [1, 0, 0]), g.bindBuffer(g.ARRAY_BUFFER, ac), g.vertexAttribPointer(D.ea, 3, g.FLOAT, r, 0, 0), g.bindBuffer(g.ARRAY_BUFFER, bc), g.vertexAttribPointer(D.da, 2, g.FLOAT, r, 0, 0), 6 <= W.length && (g.activeTexture(g.TEXTURE0), g.bindTexture(g.TEXTURE_2D, W[v]), g.bindBuffer(g.ELEMENT_ARRAY_BUFFER, cc), g.uniform1i(D.ta, 0), g.uniformMatrix4fv(D.ra, r, eb), g.uniformMatrix4fv(D.ca, r, Db), g.drawElements(g.TRIANGLES, 6, g.UNSIGNED_SHORT, 0))
            }
        } else {
            Bb();
            e = r;
            if (A != F.offsetWidth || z != F.offsetHeight) A = parseInt(F.offsetWidth), z = parseInt(F.offsetHeight), F.style[fa + "OriginX"] = A / 2 + "px", F.style[fa + "OriginY"] = z / 2 + "px", e = m;
            a = Math.round(b.S());
            if (b.V != a || e) b.V = a, F.style[nb] = a + "px";
            if (ha && la) ha.style[fa] = "translate3d(" + A / 2 + "px," + z / 2 + "px," + a + "px)", la.style[fa] = "rotateX(" + Number(q).toFixed(10) + "deg)  rotateY(" + Number(-s).toFixed(10) + "deg)";
            else for (e = 0; 6 > e; e++) if (d = b.cubeFaces[e]) h = "translate3d(" + A / 2 + "px," + z / 2 + "px," + a + "px) ", h += "rotateX(" + Number(q).toFixed(10) + "deg)  rotateY(" + Number(-s).toFixed(10) + "deg) ", d.$ && (h += d.$, d.style.transform = h)
        }
        Gb()
    };
    var D;
    b.initWebGL = function (a) {
        Mc = r;
        try {
            if (ka = a ? a : document.createElement("canvas"), ka.width = 100, ka.height = 100, F.appendChild(ka), (g = ka.getContext("webgl")) || (g = ka.getContext("experimental-webgl")), g) {
                g.ga = 500;
                g.fa = 500;
                g.clearColor(0, 0, 0, 0);
                g.enable(g.DEPTH_TEST);
                g.viewport(0, 0, 500, 500);
                g.clear(g.COLOR_BUFFER_BIT | g.DEPTH_BUFFER_BIT);
                g.enable(g.TEXTURE_2D);
                var b = g.createShader(g.FRAGMENT_SHADER);
                hs = "#ifdef GL_ES\n";
                hs += "precision highp float;\n";
                hs += "#endif\n";
                hs += "varying vec2 vTextureCoord;\n";
                hs += "uniform sampler2D uSampler;\n";
                hs += "void main(void) {\n";
                hs += "    gl_FragColor = texture2D(uSampler, vec2(vTextureCoord.s, vTextureCoord.t));\n";
                hs += "}\n";
                g.shaderSource(b, hs);
                g.compileShader(b);
                g.getShaderParameter(b, g.COMPILE_STATUS) || (alert(g.getShaderInfoLog(b)), b = o);
                var c = g.createShader(g.VERTEX_SHADER);
                hs = "attribute vec3 aVertexPosition;\n";
                hs += "attribute vec2 aTextureCoord;\n";
                hs += "uniform mat4 uMVMatrix;\n";
                hs += "uniform mat4 uPMatrix;\n";
                hs += "varying vec2 vTextureCoord;\n";
                hs += "void main(void) {\n";
                hs += "    gl_Position = uPMatrix * uMVMatrix * vec4(aVertexPosition, 1.0);\n";
                hs += "    vTextureCoord = aTextureCoord;\n";
                hs += "}\n";
                g.shaderSource(c, hs);
                g.compileShader(c);
                g.getShaderParameter(c, g.COMPILE_STATUS) || (alert(g.getShaderInfoLog(c)), c = o);
                D = g.createProgram();
                g.attachShader(D, c);
                g.attachShader(D, b);
                g.linkProgram(D);
                g.getProgramParameter(D, g.LINK_STATUS) || alert("Could not initialise shaders");
                g.useProgram(D);
                D.ea = g.getAttribLocation(D, "aVertexPosition");
                g.enableVertexAttribArray(D.ea);
                D.da = g.getAttribLocation(D, "aTextureCoord");
                g.enableVertexAttribArray(D.da);
                D.ca = g.getUniformLocation(D, "uPMatrix");
                D.ra = g.getUniformLocation(D, "uMVMatrix");
                D.ta = g.getUniformLocation(D, "uSampler");
                Hc(bb);
                Ic()
            }
        } catch (f) {
            X(f)
        }
        g ? db = m : alert("Could not initialise WebGL!")
    };
    var W = [],
        eb = new glMatrixArrayType(16),
        Db = new glMatrixArrayType(16),
        ac, bc, cc;
    b.getPan = function () {
        return s
    };
    b.getPanDest = function () {
        return Lb
    };
    b.getPanN = function () {
        for (var a = s; - 180 > a;) a += 360;
        for (; 180 < a;) a -= 360;
        return a
    };
    b.getPanNorth = function () {
        for (var a = s - Kc; - 180 > a;) a += 360;
        for (; 180 < a;) a -= 360;
        return a
    };
    b.setPan = function (a) {
        E();
        isNaN(a) || (s = Number(a));
        b.update()
    };
    b.changePan = function (a, e) {
        b.setPan(b.getPan() + a);
        e && (B = a)
    };
    b.getTilt = function () {
        return q
    };
    b.getTiltDest = function () {
        return Mb
    };
    b.setTilt = function (a) {
        E();
        isNaN(a) || (q = Number(a));
        b.update()
    };
    b.changeTilt = function (a, e) {
        b.setTilt(b.getTilt() + a);
        e && (J = a)
    };
    b.getFov = function () {
        return t
    };
    b.getFovDest = function () {
        return Nb
    };
    b.setFov = function (a) {
        E();
        if (!isNaN(a) && 0 < a && 180 > a) {
            var e = t;
            t = Number(a);
            Bb();
            e != t && b.update()
        }
    };
    b.changeFov = function (a, e) {
        b.setFov(b.getFov() + a);
        e && (H = a)
    };
    b.changeFovLog = function (a, e) {
        if (!isNaN(a)) {
            var c;
            c = a / 90 * Math.cos(t * Math.PI / 360);
            c = t * Math.exp(c);
            b.setFov(c);
            e && (H = a)
        }
    };
    b.setPanTilt = function (a, e) {
        E();
        isNaN(a) || (s = a);
        isNaN(e) || (q = e);
        b.update()
    };
    b.setPanTiltFov = function (a, e, c) {
        E();
        isNaN(a) || (s = a);
        isNaN(e) || (q = e);
        !isNaN(c) && 0 < c && 180 > c && (t = c);
        b.update()
    };
    b.setDefaultView = function () {
        b.setPanTiltFov(jc, kc, vb)
    };
    b.setLocked = function (a) {
        b.setLockedMouse(a);
        b.setLockedWheel(a);
        b.setLockedKeyboard(a)
    };
    b.setLockedMouse = function (a) {
        S = a
    };
    b.setLockedKeyboard = function (a) {
        xb = a
    };
    b.setLockedWheel = function (a) {
        Yb = a
    };
    b.moveTo = function (a, b, c, f) {
        E();
        Ta = m;
        var d = a.toString().split("/");
        1 < d.length && (a = Number(d[0]), f = b, b = Number(d[1]), 2 < d.length && (c = Number(d[2])));
        Lb = isNaN(a) ? s : a;
        Mb = isNaN(b) ? q : b;
        Nb = !isNaN(c) && 0 < c && 180 > c ? c : t;
        tb = !isNaN(f) && 0 < f ? f : 1
    };
    b.moveToDefaultView = function (a) {
        b.moveTo(jc, kc, vb, a)
    };
    b.isTouching = function () {
        return b.d != o
    };
    var Za, yb = 1;
    E();
    b.ia = function () {
        var a;
        a = C;
        b.control = a;
        Ba();
        setTimeout(function () {
            Ca()
        }, 10);
        setTimeout(function () {
            za();
            b.updatePanorama()
        }, 10);
        a.addEventListener ? (a.addEventListener("touchstart", Ma, r), a.addEventListener("touchmove", La, r), a.addEventListener("touchend", Ka, r), a.addEventListener("touchcancel", Ja, r), a.addEventListener("MSPointerDown", Ia, r), a.addEventListener("MSGestureStart", wa, r), a.addEventListener("MSGestureEnd", Ha, r), a.addEventListener("MSGestureChange", fb, r), a.addEventListener("gesturestart", wa, r), a.addEventListener("gesturechange", gb, r), a.addEventListener("gestureend", Ha, r), a.addEventListener("mousedown", Gc, r), a.addEventListener("mousemove", Fc, r), document.addEventListener("mouseup", Cc, r), a.addEventListener("mousedblclick", b.toggleFullscreen, r), a.addEventListener("mousewheel", na, r), a.addEventListener("DOMMouseScroll", na, r), document.addEventListener("keydown", Ga, r), document.addEventListener("keyup", Fa, r), window.addEventListener("orientationchange", Ba, r), window.addEventListener("resize", za, r), window.addEventListener("blur", Ea, r), b.a.addEventListener("webkitfullscreenchange", va, r), document.addEventListener("mozfullscreenchange", va, r), window.addEventListener("webkitfullscreenchange", va, r)) : a.attachEvent && (a.attachEvent("onmousedown", Gc), a.attachEvent("onmousemove", Fc), document.attachEvent("onmouseup", Cc), a.attachEvent("onmousedblclick", b.toggleFullscreen), a.attachEvent("onmousewheel", na), document.attachEvent("onkeydown", Ga), document.attachEvent("onkeyup", Fa), window.attachEvent("onresize", za), window.attachEvent("onblur", Ea));
        a.oncontextmenu = function (a) {
            void 0 === a && (a = window.event);
            return !a.ctrlKey && (a = "<<U>>", "U" != a.charAt(2)) ? (Aa(), r) : m
        }
    };
    b.addHotspotElements = function () {
        for (var a = 0; a < G.length; a++) if ("point" == G[a].type && (G[a].obj = b.skinObj && b.skinObj.addSkinHotspot ? new b.skinObj.addSkinHotspot(G[a]) : new Vc(this, G[a]), G[a].obj && G[a].obj.__div)) {
            var e = C.firstChild;
            e ? C.insertBefore(G[a].obj.__div, e) : C.appendChild(G[a].obj.__div)
        }
    };
    b.isPlaying = function (a) {
        return "_main" == a ? m : (a = l(a)) ? !a.obj.ended && !a.obj.paused : r
    };
    b.playSound = function (a, b) {
        var c = l(a);
        c && (c.obj.f = b && !isNaN(Number(b)) ? Number(b) - 1 : c.loop - 1, -1 == c.obj.f && (c.obj.f = 1E7), c.obj.play())
    };
    b.playPauseSound = function (a) {
        b.isPlaying(a) ? b.pauseSound(a) : b.playSound(a)
    };
    b.pauseSound = function (a) {
        if ("_main" == a) {
            for (a = 0; a < p.length; a++) p[a].obj.pause();
            for (a = 0; a < x.length; a++) x[a].obj.pause()
        } else(a = l(a)) && a.obj.pause()
    };
    b.stopSound = function (a) {
        if ("_main" == a) {
            for (a = 0; a < p.length; a++) p[a].obj.pause(), p[a].obj.currentTime = 0;
            for (a = 0; a < x.length; a++) x[a].obj.pause(), x[a].obj.currentTime = 0
        } else if (a = l(a)) a.obj.pause(), a.obj.currentTime = 0
    };
    b.setVolume = function (a, b) {
        var c = Number(b);
        1 < c && (c = 1);
        0 > c && (c = 0);
        if ("_main" == a) {
            R = c;
            for (c = 0; c < p.length; c++) p[c].obj.volume = p[c].c * R;
            for (c = 0; c < x.length; c++) x[c].obj.volume = x[c].c * R
        } else {
            var f = l(a);
            f && (f.c = c, f.obj.volume = c * R)
        }
    };
    b.changeVolume = function (a, b) {
        if ("_main" == a) {
            var c = R,
                c = c + Number(b);
            1 < c && (c = 1);
            0 > c && (c = 0);
            R = c;
            for (c = 0; c < p.length; c++) p[c].obj.volume = p[c].c * R
        } else {
            var f = l(a);
            f && (c = f.c, c += Number(b), 1 < c && (c = 1), 0 > c && (c = 0), f.c = c, f.obj.volume = c * R)
        }
    };
    b.removeHotspots = function () {
        for (var a; 0 < G.length;) a = G.pop(), a.obj && (C.removeChild(a.obj.__div), delete a.obj), a.obj = o
    };
    b.setFullscreen = function (a) {
        b.isFullscreen != a && (b.isFullscreen = a, b.update(100));
        if (b.isFullscreen) {
            try {
                b.a.webkitRequestFullScreen ? b.a.webkitRequestFullScreen() : b.a.mozRequestFullScreen ? b.a.mozRequestFullScreen() : b.a.requestFullScreen ? b.a.requestFullScreen() : b.a.requestFullscreen && b.a.requestFullscreen()
            } catch (e) {
                X(e)
            }
            b.a.style.position = "absolute";
            a = zb();
            b.a.style.left = window.pageXOffset - a.x + Y + "px";
            b.a.style.top = window.pageYOffset - a.y + aa + "px";
            document.body.style.overflow = "hidden";
            b.divSkin && b.divSkin.ggEnterFullscreen && b.divSkin.ggEnterFullscreen()
        } else {
            try {
                document.webkitIsFullScreen ? document.webkitCancelFullScreen() : document.mozFullScreen ? document.mozCancelFullScreen() : document.fullScreen && (document.cancelFullScreen ? document.cancelFullScreen() : document.exitFullscreen && document.exitFullscreen())
            } catch (c) {
                X(c)
            }
            b.a.style.position = "relative";
            b.a.style.left = "0px";
            b.a.style.top = "0px";
            document.body.style.overflow = "";
            b.divSkin && b.divSkin.ggExitFullscreen && b.divSkin.ggExitFullscreen()
        }
        za()
    };
    b.toggleFullscreen = function () {
        b.setFullscreen(!b.isFullscreen)
    };
    b.enterFullscreen = function () {
        b.setFullscreen(m)
    };
    b.exitFullscreen = function () {
        b.setFullscreen(r)
    };
    b.startAutorotate = function (a, b, c) {
        V = Sa = m;
        Wa = (new Date).getTime();
        a && 0 != a && (qa = a);
        b && (Qb = b);
        c && (ub = c)
    };
    b.stopAutorotate = function () {
        Sa = V = r
    };
    b.toggleAutorotate = function () {
        (V = Sa = !V) && (Wa = (new Date).getTime())
    };
    b.createLayers = function (a) {
        b.B = document.getElementById(a);
        b.B ? (b.B.innerHTML = "", b.a = document.createElement("div"), b.a.setAttribute("style", "top:  0px;left: 0px;position:relative;-ms-touch-action: none;"), b.B.appendChild(b.a), F = document.createElement("div"), a = "top:  0px;left: 0px;width:  100px;height: 100px;overflow: hidden;position:absolute;z-index: 0;" + (M + "user-select: none;"), F.setAttribute("style", a), b.a.appendChild(F), C = document.createElement("div"), a = "top:  0px;left: 0px;width:  100px;height: 100px;overflow: hidden;position:absolute;z-index: 1000;", Sc && (a += "background-image: url(data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7);"), a += M + "user-select: none;", C.setAttribute("style", a), b.a.appendChild(C), T = document.createElement("canvas"), a = "top:  0px;left: 0px;width:  100px;height: 100px;overflow: hidden;position:absolute;z-index: 900;" + (M + "user-select: none;"), T.setAttribute("style", a), b.a.appendChild(T), I = document.createElement("div"), I.setAttribute("style", "top:  0px;left: 0px;position:absolute;padding: 3px;visibility: hidden;z-index: 1100;"), I.innerHTML = " Hotspot text!", b.a.appendChild(I), b.divSkin = C) : alert("container not found!")
    };
    b.createCube = function () {
        var a;
        ha = document.createElement("div");
        a = "position:absolute;" + (M + "user-select: none;");
        a += M + "transform-style: preserve-3d;";
        ha.setAttribute("style", a + "z-Index: 100;");
        F.appendChild(ha);
        la = document.createElement("div");
        a = M + "transform-style: preserve-3d;";
        a += M + "transform-origin: 0 0;";
        a = a + "position:absolute;" + (M + "user-select: none;");
        la.setAttribute("style", a + "z-Index: 100;");
        ha.appendChild(la);
        var e, c;
        Ra = m;
        var f = 128;
        pb > f && (f = pb);
        for (c = 0; 6 > c; c++) e = document.createElement("img"), Ra ? "" != sa[c] && e.setAttribute("src", U(sa[c])) : e.setAttribute("src", U(ab[c])), a = "position:absolute;", a += "left: 0px;", a += "top: 0px;", a += "width: " + f + "px;", a += "height: " + f + "px;", a += "z-index: 100;", a += M + "transform-origin: 0 0;", a += M + "transform: ", a = 4 > c ? a + ("rotateY(" + -90 * c + "deg)") : a + ("rotateX(" + (4 == c ? -90 : 90) + "deg)"), a += " scale(" + bb + ") translate3d(" + -f / 2 + "px," + -f / 2 + "px," + -f / 2 + "px);", e.setAttribute("style", a), la.appendChild(e), b.cubeFaces.push(e), b.checkLoaded.push(e), "" != mc[c] && (e = document.createElement("img"), e.setAttribute("src", U(mc[c])), a = "position:absolute;", a += "left: 0px;", a += "top: 0px;", a += "width: " + f / 1.1 + "px;", a += "height: " + f / 1.1 + "px;", a += "z-index: 100;", a += M + "transform-origin: 0 0;", a += M + "transform: ", a = 4 > c ? a + ("rotateY(" + -90 * c + "deg)") : a + ("rotateX(" + (4 == c ? -90 : 90) + "deg)"), a += " scale(" + bb + ") translate3d(" + -f / 2.2 + "px," + -f / 2.2 + "px," + -f / 2.2 + "px);", e.setAttribute("style", a), e.style.opacity = 0, la.appendChild(e), b.cubeFacesOverlay.push(e), b.checkLoaded.push(e))
    };
    b.ka = function () {
        var a;
        la = ha = o;
        var e, c;
        Ra = m;
        var f = 128;
        pb > f && (f = pb);
        for (c = 0; 6 > c; c++) {
            e = document.createElement("img");
            Ra ? "" != sa[c] && e.setAttribute("src", U(sa[c])) : e.setAttribute("src", U(ab[c]));
            console.log(U(sa[c]))
            a = "position:absolute;";
            a += "left: 0px;";
            a += "top: 0px;";
            a += "width: " + f + "px;";
            a += "height: " + f + "px;";
            a += "z-index: 100;";
            a += M + "-transform-style: preserve-3d;";
            a += M + "transform-origin: 0 0;";
            a += M + "transform: ";
            var d;
            d = "";
            d = 4 > c ? d + ("rotateY(" + -90 * c + "deg)") : d + ("rotateX(" + (4 == c ? -90 : 90) + "deg)");
            d += " scale(" + bb + ") translate3d(" + -f / 2 + "px," + -f / 2 + "px," + -f / 2 + "px)";
            a += d + ";";
            e.$ = d;
            e.setAttribute("style", a);
            F.appendChild(e);
            b.cubeFaces.push(e);
            b.checkLoaded.push(e)
        }
    };
    b.finalPanorama = function () {
        var a;
        if (Cb) for (a = 0; 6 > a; a++) b.cubeFaces[a].setAttribute("src", U(ab[a]))
    };
    b.setOverlayOpacity = function (a) {
        var e;
        if (Cb) for (e = 0; 6 > e; e++) b.cubeFacesOverlay[e] && b.cubeFacesOverlay[e].style && (b.cubeFacesOverlay[e].style.opacity = a)
    };
    b.removePanorama = function () {
        var a;
        if (Cb) {
            for (a = 0; a < b.cubeFaces.length; a++) b.cubeFaces[a].setAttribute("src", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAA5JREFUeNpiYBgeACDAAADIAAE3iTbkAAAAAElFTkSuQmCC"), b.cubeFacesOverlay[a] && b.cubeFacesOverlay[a].setAttribute("src", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAA5JREFUeNpiYBgeACDAAADIAAE3iTbkAAAAAElFTkSuQmCC");
            ha && F.removeChild(ha);
            ha = la = o;
            b.cubeFaces = [];
            b.cubeFacesOverlay = []
        }
        if (g && W) for (; 0 < W.length;) g.deleteTexture(W.pop());
        for (a = 0; a < x.length; a++) C.removeChild(x[a].obj);
        for (a = 0; a < Na.length; a++) C.removeChild(Na[a].obj);
        var e = [];
        for (a = 0; a < p.length; a++) {
            var c = p[a];
            if (0 == c.mode || 1 == c.mode || c.xa) e.push(c);
            else {
                try {
                    c.obj.pause()
                } catch (f) {
                    X(f)
                }
                b.a.removeChild(c.obj)
            }
        }
        p = e;
        x = [];
        Na = []
    };
    b.getScreenResolution = function () {
        var a = 1,
            b = -1 != navigator.userAgent.indexOf("Mac");
        window.devicePixelRatio && b && (a = window.devicePixelRatio);
        return {
            w: screen.width * a,
            h: screen.height * a
        }
    };
    b.getMaxScreenResolution = function () {
        var a = b.getScreenResolution();
        return a.w > a.h ? a.w : a.h
    };
    b.readConfigString = function (a, e) {

        window.DOMParser ? (parser = new DOMParser, xmlDoc = parser.parseFromString(a, "text/xml")) : (xmlDoc = new ActiveXObject("Microsoft.XMLDOM"), xmlDoc.async = "false", xmlDoc.loadXML(a));
        b.readConfigXml(xmlDoc, e)
    };
    b.readConfigUrl = function (a, e, c) {
        try {
            var f;
            f = window.XMLHttpRequest ? new XMLHttpRequest : new ActiveXObject("Microsoft.XMLHTTP");
            f.open("GET", a, r);
            f.send(o);

            if (f.responseXML) {
               /* var d = a.lastIndexOf("/");
                0 <= d && (mb = a.substr(0, d + 1));
                2 <= arguments.length && e != o && (mb = e);*/
                b.readConfigString(f.responseText, c)
            } else alert("Error loading panorama XML")
        } catch (g) {
            alert("Error:" + g)
        }
    };
    var Eb = m;
    b.getCurrentNode = function () {
        return Fb
    };
    b.readConfigXml = function (a, e) {
        var c = a.firstChild;
        cb = [];
        Xa = [];
        if ("tour" == c.nodeName) {
            var f = "",
                d;
            (d = c.getAttributeNode("start")) && (f = d.nodeValue.toString());
            "" != b.startNode && (f = b.startNode, b.startNode = "");
            for (c = c.firstChild; c;) {
                d = "";
                if ("panorama" == c.nodeName && (d = c.getAttributeNode("id"))) d = d.nodeValue.toString(), "" == f && (f = d), cb[d] = c, Xa.push(d);
                c = c.nextSibling
            }
            b.W(cb[f], e);
            k("{" + f + "}");
            b.U = m
        } else b.U = r, b.W(c, e), k("")
    };
    b.W = function (a, e) {
        b.removeHotspots();
        b.hotspot = b.emptyHotspot;
        b.removePanorama();
        b.V = 0;
        for (var c = a.firstChild, f, d, h, l = 1E6; c;) {
            if ("view" == c.nodeName) {
                (d = c.getAttributeNode("fovmode")) && (lc = Number(d.nodeValue));
                d = c.getAttributeNode("pannorth");
                Kc = 1 * (d ? d.nodeValue : 0);
                for (f = c.firstChild; f;) "start" == f.nodeName && (d = f.getAttributeNode("pan"), jc = s = Number(d ? d.nodeValue : 0), d = f.getAttributeNode("tilt"), kc = q = Number(d ? d.nodeValue : 0), d = f.getAttributeNode("fov"), vb = t = Number(d ? d.nodeValue : 70)), "min" == f.nodeName && (d = f.getAttributeNode("pan"), Va = 1 * (d ? d.nodeValue : 0), d = f.getAttributeNode("tilt"), ua = 1 * (d ? d.nodeValue : -90), d = f.getAttributeNode("fov"), ea = 1 * (d ? d.nodeValue : 5), 1.0E-8 > ea && (ea = 1.0E-8)), "max" == f.nodeName && (d = f.getAttributeNode("pan"), Ua = 1 * (d ? d.nodeValue : 0), d = f.getAttributeNode("tilt"), ta = 1 * (d ? d.nodeValue : 90), d = f.getAttributeNode("fov"), da = 1 * (d ? d.nodeValue : 120), 180 <= da && (da = 179.9)), f = f.nextSibling
            }
            if ("autorotate" == c.nodeName && ((d = c.getAttributeNode("speed")) && (qa = 1 * d.nodeValue), (d = c.getAttributeNode("delay")) && (Qb = 1 * d.nodeValue), (d = c.getAttributeNode("returntohorizon")) && (ub = 1 * d.nodeValue), (d = c.getAttributeNode("nodedelay")) && (Pb = 1 * d.nodeValue), Eb && 0 != qa && (V = Sa = m, Wa = (new Date).getTime()), d = c.getAttributeNode("startloaded")))(sb = 1 == d.nodeValue) && (V = r);
            "input" == c.nodeName && (h || (h = c));
            if (h) for (f = 0; 6 > f; f++) d = h.getAttributeNode("prev" + f + "url"), sa[f] = d ? new String(d.nodeValue) : "";
            "altinput" == c.nodeName && (f = 0, (d = c.getAttributeNode("screensize")) && (f = 1 * d.nodeValue), 0 < f && f >= b.getMaxScreenResolution() && f < l && (l = f, h = c));
            "control" == c.nodeName && Eb && ((d = c.getAttributeNode("simulatemass")) && (Kb = 1 == d.nodeValue), (d = c.getAttributeNode("locked")) && (S = 1 == d.nodeValue), d && (xb = 1 == d.nodeValue), (d = c.getAttributeNode("lockedmouse")) && (S = 1 == d.nodeValue), (d = c.getAttributeNode("lockedkeyboard")) && (xb = 1 == d.nodeValue), (d = c.getAttributeNode("lockedwheel")) && (Yb = 1 == d.nodeValue), (d = c.getAttributeNode("invertwheel")) && (Ac = 1 == d.nodeValue), (d = c.getAttributeNode("speedwheel")) && (Bc = 1 * d.nodeValue), (d = c.getAttributeNode("invertcontrol")) && (xa = 1 == d.nodeValue), (d = c.getAttributeNode("dblclickfullscreen")) && (Ub = 1 == d.nodeValue));
            "overlay" == c.nodeName && ((d = c.getAttributeNode("blendspeed")) && (Ya = 1 * d.nodeValue), (d = c.getAttributeNode("auto")) && (qc = 1 == d.nodeValue), (d = c.getAttributeNode("delay")) && (rc = 1 * d.nodeValue));
            "userdata" == c.nodeName && (b.userdata = y(c));
            if ("hotspots" == c.nodeName) for (f = c.firstChild; f;) {
                if ("label" == f.nodeName) {
                    var n = Ab;
                    if (d = f.getAttributeNode("enabled")) n.enabled = 1 == d.nodeValue;
                    if (d = f.getAttributeNode("width")) n.width = 1 * d.nodeValue;
                    if (d = f.getAttributeNode("height")) n.height = 1 * d.nodeValue;
                    if (d = f.getAttributeNode("textcolor")) n.Y = 1 * d.nodeValue;
                    if (d = f.getAttributeNode("textalpha")) n.X = 1 * d.nodeValue;
                    if (d = f.getAttributeNode("background")) n.background = 1 == d.nodeValue;
                    if (d = f.getAttributeNode("backgroundalpha")) n.t = 1 * d.nodeValue;
                    if (d = f.getAttributeNode("backgroundcolor")) n.u = 1 * d.nodeValue;
                    if (d = f.getAttributeNode("border")) n.R = 1 * d.nodeValue;
                    if (d = f.getAttributeNode("bordercolor")) n.z = 1 * d.nodeValue;
                    if (d = f.getAttributeNode("borderalpha")) n.v = 1 * d.nodeValue;
                    if (d = f.getAttributeNode("borderradius")) n.Q = 1 * d.nodeValue;
                    if (d = f.getAttributeNode("wordwrap")) n.wordwrap = 1 == d.nodeValue
                }
                "polystyle" == f.nodeName && ((d = f.getAttributeNode("mode")) && (P = 1 * d.nodeValue), (d = f.getAttributeNode("bordercolor")) && (ec = 1 * d.nodeValue), (d = f.getAttributeNode("backgroundcolor")) && (gc = 1 * d.nodeValue), (d = f.getAttributeNode("borderalpha")) && (fc = 1 * d.nodeValue), (d = f.getAttributeNode("backgroundalpha")) && (hc = 1 * d.nodeValue));
                "hotspot" == f.nodeName && (n = {
                    type: "point",
                    pan: 0,
                    tilt: 0,
                    url: "",
                    target: "",
                    id: "",
                    skinid: "",
                    w: 100,
                    h: 20,
                    wordwrap: r,
                    obj: o,
                    I: o
                }, d = f.getAttributeNode("pan"), n.pan = 1 * (d ? d.nodeValue : 0), d = f.getAttributeNode("tilt"), n.tilt = 1 * (d ? d.nodeValue : 0), (d = f.getAttributeNode("url")) && (n.url = d.nodeValue.toString()), (d = f.getAttributeNode("target")) && (n.target = d.nodeValue.toString()), (d = f.getAttributeNode("title")) && (n.title = d.nodeValue.toString()), (d = f.getAttributeNode("id")) && (n.id = d.nodeValue.toString()), (d = f.getAttributeNode("skinid")) && (n.skinid = d.nodeValue.toString()), (d = c.getAttributeNode("width")) && (n.w = d.nodeValue.toString()), (d = c.getAttributeNode("height")) && (n.h = d.nodeValue.toString()), (d = c.getAttributeNode("wordwrap")) && (n.wordwrap = 1 == d.nodeValue), G.push(n));
                if ("polyhotspot" == f.nodeName) {
                    n = {
                        type: "poly",
                        url: "",
                        target: "",
                        id: "",
                        skinid: "",
                        w: 100,
                        h: 20,
                        wordwrap: r,
                        obj: o,
                        I: o,
                        e: 0,
                        l: 0
                    };
                    (d = f.getAttributeNode("url")) && (n.url = d.nodeValue.toString());
                    (d = f.getAttributeNode("target")) && (n.target = d.nodeValue.toString());
                    (d = f.getAttributeNode("title")) && (n.title = d.nodeValue.toString());
                    (d = f.getAttributeNode("id")) && (n.id = d.nodeValue.toString());
                    n.z = ec;
                    n.u = gc;
                    n.v = fc;
                    n.t = hc;
                    if (d = f.getAttributeNode("bordercolor")) n.z = 1 * d.nodeValue;
                    if (d = f.getAttributeNode("backgroundcolor")) n.u = 1 * d.nodeValue;
                    if (d = f.getAttributeNode("borderalpha")) n.v = 1 * d.nodeValue;
                    if (d = f.getAttributeNode("backgroundalpha")) n.t = 1 * d.nodeValue;
                    n.I = [];
                    for (var k = f.firstChild; k;) {
                        if ("vertex" == k.nodeName) {
                            var p = {
                                pan: 0,
                                tilt: 0
                            };
                            d = k.getAttributeNode("pan");
                            p.pan = 1 * (d ? d.nodeValue : 0);
                            d = k.getAttributeNode("tilt");
                            p.tilt = 1 * (d ? d.nodeValue : 0);
                            n.I.push(p)
                        }
                        k = k.nextSibling
                    }
                    G.push(n)
                }
                f = f.nextSibling
            }
            if ("sounds" == c.nodeName || "media" == c.nodeName) for (f = c.firstChild; f;) {
                if ("sound" == f.nodeName) {
                    k = {
                        id: "",
                        url: "",
                        loop: 0,
                        c: 1,
                        A: 0,
                        mode: 1,
                        field: 10,
                        pan: 0,
                        tilt: 0,
                        g: 0,
                        s: 0,
                        url: []
                    };
                    if (d = f.getAttributeNode("id")) k.id = d.nodeValue.toString();
                    (d = f.getAttributeNode("url")) && k.url.push(d.nodeValue.toString());
                    if (d = f.getAttributeNode("level")) k.c = Number(d.nodeValue);
                    if (d = f.getAttributeNode("loop")) k.loop = Number(d.nodeValue);
                    if (d = f.getAttributeNode("mode")) k.mode = Number(d.nodeValue);
                    if (d = f.getAttributeNode("field")) k.field = Number(d.nodeValue);
                    if (d = f.getAttributeNode("ambientlevel")) k.A = Number(d.nodeValue);
                    if (d = f.getAttributeNode("pan")) k.pan = Number(d.nodeValue);
                    if (d = f.getAttributeNode("tilt")) k.tilt = Number(d.nodeValue);
                    if (d = f.getAttributeNode("pansize")) k.g = Number(d.nodeValue);
                    if (d = f.getAttributeNode("tiltsize")) k.s = Number(d.nodeValue);
                    for (n = f.firstChild; n;) "source" == n.nodeName && (d = n.getAttributeNode("url")) && k.url.push(d.nodeValue.toString()), n = n.nextSibling;
                    ma(k)
                }
                if ("video" == f.nodeName) {
                    k = {
                        id: "",
                        url: "",
                        loop: 0,
                        c: 1,
                        A: 0,
                        mode: 1,
                        field: 10,
                        pan: 0,
                        tilt: 0,
                        g: 0,
                        s: 0,
                        j: 0,
                        k: 0,
                        G: 0,
                        C: 50,
                        i: 0,
                        url: []
                    };
                    if (d = f.getAttributeNode("id")) k.id = d.nodeValue.toString();
                    (d = f.getAttributeNode("url")) && k.url.push(d.nodeValue.toString());
                    if (d = f.getAttributeNode("level")) k.c = Number(d.nodeValue);
                    if (d = f.getAttributeNode("loop")) k.loop = Number(d.nodeValue);
                    if (d = f.getAttributeNode("mode")) k.mode = Number(d.nodeValue);
                    if (d = f.getAttributeNode("field")) k.field = Number(d.nodeValue);
                    if (d = f.getAttributeNode("ambientlevel")) k.A = Number(d.nodeValue);
                    if (d = f.getAttributeNode("pan")) k.pan = Number(d.nodeValue);
                    if (d = f.getAttributeNode("tilt")) k.tilt = Number(d.nodeValue);
                    if (d = f.getAttributeNode("pansize")) k.g = Number(d.nodeValue);
                    if (d = f.getAttributeNode("tiltsize")) k.s = Number(d.nodeValue);
                    if (d = f.getAttributeNode("rotx")) k.j = Number(d.nodeValue);
                    if (d = f.getAttributeNode("roty")) k.k = Number(d.nodeValue);
                    if (d = f.getAttributeNode("rotz")) k.G = Number(d.nodeValue);
                    if (d = f.getAttributeNode("fov")) k.C = Number(d.nodeValue);
                    if (d = f.getAttributeNode("width")) k.o = Number(d.nodeValue);
                    if (d = f.getAttributeNode("height")) k.n = Number(d.nodeValue);
                    d = f.getAttributeNode("stretch");
                    k.L = d ? Number(d.nodeValue) : 1;
                    if (d = f.getAttributeNode("clickmode")) k.i = Number(d.nodeValue);
                    for (n = f.firstChild; n;) "source" == n.nodeName && (d = n.getAttributeNode("url")) && k.url.push(d.nodeValue.toString()), n = n.nextSibling;
                    L(k)
                }
                if ("image" == f.nodeName) {
                    k = {
                        id: "",
                        url: "",
                        loop: 0,
                        c: 1,
                        A: 0,
                        mode: 1,
                        field: 10,
                        pan: 0,
                        tilt: 0,
                        g: 0,
                        s: 0,
                        j: 0,
                        k: 0,
                        G: 0,
                        C: 50,
                        i: 0
                    };
                    if (d = f.getAttributeNode("id")) k.id = d.nodeValue.toString();
                    if (d = f.getAttributeNode("url")) k.url = d.nodeValue.toString();
                    if (d = f.getAttributeNode("pan")) k.pan = Number(d.nodeValue);
                    if (d = f.getAttributeNode("tilt")) k.tilt = Number(d.nodeValue);
                    if (d = f.getAttributeNode("rotx")) k.j = Number(d.nodeValue);
                    if (d = f.getAttributeNode("roty")) k.k = Number(d.nodeValue);
                    if (d = f.getAttributeNode("rotz")) k.G = Number(d.nodeValue);
                    if (d = f.getAttributeNode("fov")) k.C = Number(d.nodeValue);
                    if (d = f.getAttributeNode("width")) k.o = Number(d.nodeValue);
                    if (d = f.getAttributeNode("height")) k.n = Number(d.nodeValue);
                    d = f.getAttributeNode("stretch");
                    k.L = d ? Number(d.nodeValue) : 1;
                    if (d = f.getAttributeNode("clickmode")) k.i = Number(d.nodeValue);
                    for (n = f.firstChild; n;) {
                        if ("source" == n.nodeName && (d = n.getAttributeNode("url"))) k.url = d.nodeValue.toString();
                        n = n.nextSibling
                    }
                    K(k)
                }
                f = f.nextSibling
            }
            c = c.nextSibling
        }
        e && "" != e && (c = e.toString().split("/"), 0 < c.length && b.setPan(Number(c[0])), 1 < c.length && b.setTilt(Number(c[1])), 2 < c.length && b.setFov(Number(c[2])));
        if (h) {
            for (f = 0; 6 > f; f++)(d = h.getAttributeNode("tile" + f + "url")) && (ab[f] = new String(d.nodeValue)), d = h.getAttributeNode("tile" + f + "url1"), mc[f] = d ? new String(d.nodeValue) : "";
            for (f = 0; 6 > f; f++)(d = h.getAttributeNode("prev" + f + "url")) && (sa[f] = new String(d.nodeValue));
            (d = h.getAttributeNode("tilesize")) && (pb = 1 * d.nodeValue);
            (d = h.getAttributeNode("tilescale")) && (bb = 1 * d.nodeValue)
        }
        db ? g && (Hc(bb), Ic()) : (Cb = m, Sc ? b.ka() : b.createCube(), b.V = 0);
        b.addHotspotElements();
        b.update();
        Eb && b.divSkin && b.divSkin.ggViewerInit && b.divSkin.ggViewerInit();
        Eb = r;
        b.hasConfig = m;
        za()
    };
    b.openUrl = function (a, e) {
        0 < a.length && (".xml" == a.substr(a.length - 4) || ".swf" == a.substr(a.length - 4) || "{" == a.charAt(0) ? b.openNext(U(a), e) : window.open(U(a), e))
    };
    b.openNext = function (a, e) {
        b.isLoaded = r;
        b.hasConfig = r;
        b.checkLoaded = [];
        rb = 0;
        b.divSkin && b.divSkin.ggReLoaded && b.divSkin.ggReLoaded();
        b.skinObj && b.skinObj.hotspotProxyOut && b.skinObj.hotspotProxyOut(b.hotspot.id);
        ".swf" == a.substr(a.length - 4) && (a = a.substr(0, a.length - 4) + ".xml");
        var c = "";
        e && (c = e.toString());
        c = c.replace("$cur", s + "/" + q + "/" + t);
        c = c.replace("$ap", s);
        c = c.replace("$an", b.getPanNorth());
        c = c.replace("$at", q);
        c = c.replace("$af", t);
        if ("" != c) {
            var f = c.split("/");
            3 < f.length && "" != f[3] && (b.startNode = f[3])
        }
        if ("{" == a.charAt(0)) if (f = a.substr(1, a.length - 2), cb[f]) b.W(cb[f], c), k(a);
        else {
            X("invalid node id: " + f);
            return
        } else b.readConfigUrl(a, o, c);
        E();
        b.update(5)
    };
    b.getNodeIds = function () {
        return Xa.slice(0)
    };
    b.getNodeUserdata = function (a) {
        if (!a) return b.userdata;
        if (a = cb[a]) for (a = a.firstChild; a;) {
            if ("userdata" == a.nodeName) return y(a);
            a = a.nextSibling
        }
        return []
    };
    b.getNodeLatLng = function (a) {
        var a = b.getNodeUserdata(a),
            e = [];
        "" != a.latitude && 0 != a.latitude && 0 != a.longitude && (e.push(a.latitude), e.push(a.longitude));
        return e
    };
    b.getNodeTitle = function (a) {
        return b.getNodeUserdata(a).title
    };
    b.detectBrowser();
    b.createLayers(h);
    b.ia()
}
window.ggHasHtml5Css3D = oc;
window.ggHasWebGL = pc;
window.pano2vrPlayer = pano2vrPlayer;

function pano2vrSkin(player, base) {
    var me = this;
    var flag = false;
    var nodeMarker = new Array();
    var activeNodeMarker = new Array();
    this.player = player;
    this.player.skinObj = this;
    this.divSkin = player.divSkin;
    var basePath = "";
    if (base == '?') {
        var scripts = document.getElementsByTagName('script');
        for (var i = 0; i < scripts.length; i++) {
            var src = scripts[i].src;
            if (src.indexOf('skin.js') >= 0) {
                var p = src.lastIndexOf('/');
                if (p >= 0) {
                    basePath = src.substr(0, p + 1);
                }
            }
        }
    } else if (base) {
        basePath = base;
    }
    this.elementMouseDown = new Array();
    this.elementMouseOver = new Array();
    var cssPrefix = '';
    var domTransition = 'transition';
    var domTransform = 'transform';
    var prefixes = 'Webkit,Moz,O,ms,Ms'.split(',');
    var i;
    for (i = 0; i < prefixes.length; i++) {
        if (typeof document.body.style[prefixes[i] + 'Transform'] !== 'undefined') {
            cssPrefix = '-' + prefixes[i].toLowerCase() + '-';
            domTransition = prefixes[i] + 'Transition';
            domTransform = prefixes[i] + 'Transform';
        }
    }
    this.player.setMargins(0, 0, 0, 0);
    this.updateSize = function (startElement) {
        var stack = new Array();
        stack.push(startElement);
        while (stack.length > 0) {
            e = stack.pop();
            if (e.ggUpdatePosition) {
                e.ggUpdatePosition();
            }
            if (e.hasChildNodes()) {
                for (i = 0; i < e.childNodes.length; i++) {
                    stack.push(e.childNodes[i]);
                }
            }
        }
    }
    parameterToTransform = function (p) {
        return 'translate(' + p.rx + 'px,' + p.ry + 'px) rotate(' + p.a + 'deg) scale(' + p.sx + ',' + p.sy + ')';
    }
    this.findElements = function (id, regex) {
        var r = new Array();
        var stack = new Array();
        var pat = new RegExp(id, '');
        stack.push(me.divSkin);
        while (stack.length > 0) {
            e = stack.pop();
            if (regex) {
                if (pat.test(e.ggId)) r.push(e);
            } else {
                if (e.ggId == id) r.push(e);
            }
            if (e.hasChildNodes()) {
                for (i = 0; i < e.childNodes.length; i++) {
                    stack.push(e.childNodes[i]);
                }
            }
        }
        return r;
    }
    this.addSkin = function () {
        this._loading_image = document.createElement('div');
        this._loading_image.ggId = 'loading image';
        this._loading_image.ggParameter = {
            rx: 0,
            ry: 0,
            a: 0,
            sx: 1,
            sy: 1
        };
        this._loading_image.ggVisible = true;
        this._loading_image.className = 'ggskin ggskin_image';
        this._loading_image.ggUpdatePosition = function () {
            this.style[domTransition] = 'none';
            if (this.parentNode) {
                w = this.parentNode.offsetWidth;
                this.style.left = (-90 + w / 2) + 'px';
                h = this.parentNode.offsetHeight;
                this.style.top = (-2 + h / 2) + 'px';
            }
        }
        hs = 'position:absolute;';
        hs += 'left: -90px;';
        hs += 'top:  -2px;';
        hs += 'width: 180px;';
        hs += 'height: 6px;';
        hs += cssPrefix + 'transform-origin: 50% 50%;';
        hs += 'visibility: inherit;';
        this._loading_image.setAttribute('style', hs);
        this._loading_image__img = document.createElement('img');
        this._loading_image__img.setAttribute('src', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAALQAAAAGCAYAAABqz7RMAAAAMUlEQVRYhe3SUQkAIBQEQbV/zcuhJYQHx0yC/did5C4ocaYD4CdDU8XQVDE0VQxNlQee5gO6BibsywAAAABJRU5ErkJggg==');
        this._loading_image__img.setAttribute('style', 'position: absolute;top: 0px;left: 0px;-webkit-user-drag:none;');
        this._loading_image__img['ondragstart'] = function () {
            return false;
        };
        me.player.checkLoaded.push(this._loading_image__img);
        this._loading_image.appendChild(this._loading_image__img);
        this._loading_text = document.createElement('div');
        this._loading_text.ggId = 'loading text';
        this._loading_text.ggParameter = {
            rx: 0,
            ry: 0,
            a: 0,
            sx: 1,
            sy: 1
        };
        this._loading_text.ggVisible = true;
        this._loading_text.className = 'ggskin ggskin_text';
        hs = 'position:absolute;';
        hs += 'left: 1px;';
        hs += 'top:  -29px;';
        hs += 'width: 200px;';
        hs += 'height: 20px;';
        hs += cssPrefix + 'transform-origin: 50% 50%;';
        hs += 'visibility: inherit;';
        hs += 'border: 0px solid #000000;';
        hs += 'color: #838383;';
        hs += 'text-align: left;';
        hs += 'white-space: nowrap;';
        hs += 'padding: 0px 1px 0px 1px;';
        hs += 'overflow: hidden;';
        this._loading_text.setAttribute('style', hs);
        this._loading_text.ggUpdateText = function () {
            var hs = "<b>正在载入... " + (me.player.getPercentLoaded() * 100.0).toFixed(0) + "%<\/b>";
            if (hs != this.ggText) {
                this.ggText = hs;
                this.innerHTML = hs;
            }
        }
        this._loading_text.ggUpdateText();
        this._loading_image.appendChild(this._loading_text);
        this._loading_bar = document.createElement('div');
        this._loading_bar.ggId = 'loading bar';
        this._loading_bar.ggParameter = {
            rx: 0,
            ry: 0,
            a: 0,
            sx: 1,
            sy: 1
        };
        this._loading_bar.ggVisible = true;
        this._loading_bar.className = 'ggskin ggskin_rectangle';
        hs = 'position:absolute;';
        hs += 'left: 0px;';
        hs += 'top:  0px;';
        hs += 'width: 181px;';
        hs += 'height: 6px;';
        hs += cssPrefix + 'transform-origin: 0% 50%;';
        hs += 'visibility: inherit;';
        hs += 'background: #c5c5c5;';
        hs += 'border: 0px solid #e5e5e5;';
        this._loading_bar.setAttribute('style', hs);
        this._loading_image.appendChild(this._loading_bar);
        this.divSkin.appendChild(this._loading_image);
        this.divSkin.ggUpdateSize = function (w, h) {
            me.updateSize(me.divSkin);
        }
        this.divSkin.ggViewerInit = function () {}
        this.divSkin.ggLoaded = function () {
            me._loading_image.style[domTransition] = 'none';
            me._loading_image.style.visibility = 'hidden';
            me._loading_image.ggVisible = false;
        }
        this.divSkin.ggReLoaded = function () {}
        this.divSkin.ggEnterFullscreen = function () {}
        this.divSkin.ggExitFullscreen = function () {}
        this.skinTimerEvent();
    };
    this.hotspotProxyClick = function (id) {}
    this.hotspotProxyOver = function (id) {}
    this.hotspotProxyOut = function (id) {}
    this.changeActiveNode = function (id) {
        var newMarker = new Array();
        var i, j;
        var tags = me.player.userdata.tags;
        for (i = 0; i < nodeMarker.length; i++) {
            var match = false;
            if (nodeMarker[i].ggMarkerNodeId == id) match = true;
            for (j = 0; j < tags.length; j++) {
                if (nodeMarker[i].ggMarkerNodeId == tags[j]) match = true;
            }
            if (match) {
                newMarker.push(nodeMarker[i]);
            }
        }
        for (i = 0; i < activeNodeMarker.length; i++) {
            if (newMarker.indexOf(activeNodeMarker[i]) < 0) {
                if (activeNodeMarker[i].ggMarkerNormal) {
                    activeNodeMarker[i].ggMarkerNormal.style.visibility = 'inherit';
                }
                if (activeNodeMarker[i].ggMarkerActive) {
                    activeNodeMarker[i].ggMarkerActive.style.visibility = 'hidden';
                }
                if (activeNodeMarker[i].ggDeactivate) {
                    activeNodeMarker[i].ggDeactivate();
                }
            }
        }
        for (i = 0; i < newMarker.length; i++) {
            if (activeNodeMarker.indexOf(newMarker[i]) < 0) {
                if (newMarker[i].ggMarkerNormal) {
                    newMarker[i].ggMarkerNormal.style.visibility = 'hidden';
                }
                if (newMarker[i].ggMarkerActive) {
                    newMarker[i].ggMarkerActive.style.visibility = 'inherit';
                }
                if (newMarker[i].ggActivate) {
                    newMarker[i].ggActivate();
                }
            }
        }
        activeNodeMarker = newMarker;
    }
    this.skinTimerEvent = function () {
        setTimeout(function () {
            me.skinTimerEvent();
        }, 10);
        this._loading_text.ggUpdateText();
        var hs = '';
        if (me._loading_bar.ggParameter) {
            hs += parameterToTransform(me._loading_bar.ggParameter) + ' ';
        }
        hs += 'scale(' + (1 * me.player.getPercentLoaded() + 0) + ',1.0) ';
        me._loading_bar.style[domTransform] = hs;
    };
    this.addSkin();
};