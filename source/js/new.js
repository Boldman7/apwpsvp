
/*  added by Boldman.*/
var i = 0;
var partTime = 0;
var randomTime = 0;
var playSequence = 0;

var partFirstRandomTime = 0;
var partSecondRandomTime = 0;
var randomVal = 0;
var partFlag = 0;
var measureTime = 0;

var randomClipMode = 0;

var wpsvpjq = jQuery;

var testVal = 0;
var myVar;

(function(c) {
    var b = function() {};
    b.test = document.createElement("div");
    b.isEmpty = function(b) {
        return 0 == b.replace(/^\s+|\s+$/g, "").length
    };
    b.strip = function(b) {
        return b.replace(/^\s+|\s+$/g, "")
    };
    b.isNumber = function(b) {
        return !isNaN(parseFloat(b)) && isFinite(b)
    };
    b.isMobile = function() {
        return /Android|webOS|iPhone|iPad|iPod|sony|BlackBerry/i.test(navigator.userAgent)
    };
    b.isIE = function() {
        return -1 != b.getInternetExplorerVersion() ? !0 : !1
    };
    b.isChrome = function() {
        return !!c.chrome && !!c.chrome.webstore
    };
    b.isSafari = function() {
        return 0 <
            Object.prototype.toString.call(c.HTMLElement).indexOf("Constructor")
    };
    b.hasLocalStorage = function() {
        try {
            return "localStorage" in c && null !== c.localStorage
        } catch (n) {
            return !1
        }
    };
    b.getInternetExplorerVersion = function() {
        var b = -1;
        if ("Microsoft Internet Explorer" == navigator.appName) {
            var c = navigator.userAgent,
                B = /MSIE ([0-9]{1,}[.0-9]{0,})/;
            null != B.exec(c) && (b = parseFloat(RegExp.$1))
        } else "Netscape" == navigator.appName && (c = navigator.userAgent, B = /Trident\/.*rv:([0-9]{1,}[.0-9]{0,})/, null != B.exec(c) && (b = parseFloat(RegExp.$1)));
        return b
    };
    b.isIOS = function() {
        return navigator.userAgent.match(/(iPad|iPhone|iPod)/g)
    };
    b.isiPhoneIpod = function() {
        var b = navigator.userAgent;
        return -1 < b.indexOf("iPhone") || -1 < b.indexOf("iPod")
    };
    b.isAndroid = function() {
        return -1 < navigator.userAgent.indexOf("Android")
    };
    b.hasHistory = function() {
        return !(!c.history || !history.pushState)
    };
    b.hasDownloadSupport = function() {
        return "download" in document.createElement("a")
    };
    b.volumeCanBeSet = function() {
        var b = document.createElement("audio");
        if (!b) return !1;
        b.volume = 0;
        return 0 ==
            b.volume ? !0 : !1
    };
    b.supportsWebGL = function() {
        try {
            return !!c.WebGLRenderingContext && !!document.createElement("canvas").getContext("experimental-webgl")
        } catch (n) {
            return !1
        }
    };
    b.canPlayMp4 = function() {
        var b = document.createElement("video");
        return !(!b.canPlayType || !b.canPlayType('video/mp4; codecs="avc1.42E01E, mp4a.40.2"').replace(/no/, ""))
    };
    b.canPlayMp3 = function() {
        var b = document.createElement("audio");
        return !(!b.canPlayType || !b.canPlayType("audio/mpeg;").replace(/no/, ""))
    };
    b.canPlayWav = function() {
        var b = document.createElement("audio");
        return !(!b.canPlayType || !b.canPlayType("audio/wav;").replace(/no/, ""))
    };
    b.relativePath = function(b) {
        return /^(?:[a-z]+:)?\/\//i.test(b)
    };
    b.qualifyURL = function(b) {
        var c = document.createElement("a");
        c.href = b;
        return c.href
    };
    b.hasFullscreen = function() {
        return b.test.requestFullscreen || b.test.mozRequestFullScreen || b.test.msRequestFullscreen || b.test.oRequestFullscreen || b.test.webkitRequestFullScreen
    };
    b.selectText = function(b) {
        var n = document;
        if (n.body.createTextRange) n = n.body.createTextRange(), n.moveToElementText(b),
            n.select();
        else if (c.getSelection) {
            var B = c.getSelection();
            n = n.createRange();
            n.selectNodeContents(b);
            B.removeAllRanges();
            B.addRange(n)
        }
    };
    b.randomiseArray = function(b) {
        var c = [],
            n = [],
            L;
        for (L = 0; L < b; L++) c[L] = L;
        for (L = 0; L < b; L++) {
            var v = Math.round(Math.random() * (c.length - 1));
            n[L] = c[v];
            c.splice(v, 1)
        }
        return n
    };
    b.sortArray = function(b, c) {
        var n, L = b.length,
            v = [];
        for (n = 0; n < L; n++) v[n] = b[c[n]];
        return v
    };
    b.keysrt = function(b, c, B) {
        var n = 1;
        B && (n = -1);
        return b.sort(function(b, l) {
            var v = b[c],
                g = l[c];
            return n * (v < g ? -1 : v > g ? 1 : 0)
        })
    };
    b.formatTime = function(b) {
        b = parseInt(b, 10);
        var c = Math.floor(b / 3600),
            n = Math.floor((b - 3600 * c) / 60);
        b = b - 3600 * c - 60 * n;
        if (0 < c) return 10 > c && (c = "0" + c), 10 > n && (n = "0" + n), 10 > b && (b = "0" + b), c + ":" + n + ":" + b;
        10 > n && (n = "0" + n);
        10 > b && (b = "0" + b);
        return n + ":" + b
    };
    b.toSeconds = function(b) {
        b = b.split(/[\.:,]+/);
        return Number(3600 * +b[0] + 60 * +b[1] + +b[2])
    };
    b.isScrolledIntoView = function(b) {
        b = b.getBoundingClientRect();
        var n = b.bottom;
        return 0 <= b.top && n <= c.innerHeight
    };
    b.getElementOffsetTop = function(b) {
        b = b.getBoundingClientRect();
        var n =
            document.body,
            B = document.documentElement;
        return Math.round(b.bottom - 100 + (c.pageYOffset || B.scrollTop || n.scrollTop) - (B.clientTop || n.clientTop || 0))
    };
    b.getScrollTop = function(b) {
        b = document.documentElement;
        return (c.pageYOffset || b.scrollTop) - (b.clientTop || 0)
    };
    b.rgbToHex = function(b) {
        return /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(b) ? b : (b = b.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i)) && 4 === b.length ? "#" + ("0" + parseInt(b[1], 10).toString(16)).slice(-2) + ("0" + parseInt(b[2], 10).toString(16)).slice(-2) +
            ("0" + parseInt(b[3], 10).toString(16)).slice(-2) : ""
    };
    b.getUrlParameter = function(b) {
        var n = {};
        c.location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(b, c, v) {
            n[c] = v
        });
        return b ? n[b] : n
    };
    b.checkCssExist = function(b) {
        for (var c = document.styleSheets, n = 0, L = c.length; n < L; n++)
            if (c[n].href == b) return;
        c = document.createElement("link");
        c.rel = "stylesheet";
        c.href = b;
        document.getElementsByTagName("head")[0].appendChild(c)
    };
    c.WPSVPUtils = b
})(window);
(function(c, b) {
    c.WPSVPYoutubeLoader = function(c) {
        function n(c) {
            b.ajax({
                url: "https://www.googleapis.com/youtube/v3/videos?id=" + c + "&key=" + ta + "&part=statistics,contentDetails",
                dataType: "jsonp"
            }).done(function(c) {
                if (c.error && c.error.message) console.log(c.error.message);
                else {
                    var l, Aa = c.items.length;
                    for (l = 0; l < Aa; l++) {
                        var n = c.items[l];
                        g[l].statistics = n.statistics;
                        var sa = g[l],
                            W = n.contentDetails.duration,
                            q = W.match(/\d+/g);
                        0 <= W.indexOf("M") && -1 == W.indexOf("H") && -1 == W.indexOf("S") && (q = [0, q[0], 0]);
                        0 <= W.indexOf("H") &&
                            -1 == W.indexOf("M") && (q = [q[0], 0, q[1]]);
                        0 <= W.indexOf("H") && -1 == W.indexOf("M") && -1 == W.indexOf("S") && (q = [q[0], 0, 0]);
                        W = 0;
                        3 == q.length && (W += 3600 * parseInt(q[0]), W += 60 * parseInt(q[1]), W += parseInt(q[2]));
                        2 == q.length && (W += 60 * parseInt(q[0]), W += parseInt(q[1]));
                        1 == q.length && (W += parseInt(q[0]));
                        sa.duration = W;
                        "360" == n.contentDetails.projection && (g[l].is360 = !0)
                    }
                    b(v).trigger("WPSVPYoutubeLoader.END_LOAD", {
                        info: ea,
                        data: g,
                        nextPageToken: C
                    })
                }
            }).fail(function(b, c, g) {
                console.log(b, c, g)
            })
        }

        function B(c) {
            b.ajax({
                url: c,
                dataType: "jsonp"
            }).done(function(c) {
                if (c.error &&
                    c.error.message) console.log(c.error.message);
                else {
                    var sa, fa = c.items.length;
                    (C = c.nextPageToken) && (C = S + "&pageToken=" + C);
                    for (sa = 0; sa < fa && g.length != Aa; sa++) {
                        var W = c.items[sa];
                        "youtube_playlist" == l || "youtube_single" == l || "youtube_single_list" == l ? W.status && "private" != W.status.privacyStatus && (W.snippet.title ? "Deleted video" != W.snippet.title : 1) && g.push(L(W, l)) : ("youtube_video_query" == l || "youtube_channel" == l) && g.push(L(W, l))
                    }
                    if ("youtube_single" == l || "youtube_single_list" == l) b(v).trigger("WPSVPYoutubeLoader.END_LOAD", {
                        info: ea,
                        data: g,
                        nextPageToken: C
                    });
                    else if (g.length < Aa)
                        if (c.nextPageToken) {
                            g.length + z > Aa && (z = Aa - g.length);
                            if ("youtube_playlist" == l) var aa = "https://www.googleapis.com/youtube/v3/playlistItems?pageToken=" + c.nextPageToken + "&part=snippet,status,contentDetails&maxResults=" + z + "&playlistId=" + q.path + "&key=" + ta;
                            else if ("youtube_video_query" == l) aa = "https://www.googleapis.com/youtube/v3/search?pageToken=" + c.nextPageToken + "&part=id,snippet&type=video&maxResults=" + z + "&order=" + Ub + "&q=" + encodeURIComponent(q.path) +
                                "&key=" + ta;
                            else if ("youtube_channel" == l || "youtube_user" == l) aa = "https://www.googleapis.com/youtube/v3/search?pageToken=" + c.nextPageToken + "&part=id,snippet&type=video&maxResults=" + z + "&order=date&channelId=" + q.path + "&key=" + ta;
                            B(aa)
                        } else if (oa && g.length) {
                        c = "";
                        fa = g.length;
                        for (sa = 0; sa < fa; sa++) c += g[sa].id + ",";
                        c = c.substr(0, c.length - 1);
                        n(c)
                    } else b(v).trigger("WPSVPYoutubeLoader.END_LOAD", {
                        info: ea,
                        data: g,
                        nextPageToken: C
                    });
                    else if (oa) {
                        c = "";
                        fa = g.length;
                        for (sa = 0; sa < fa; sa++) c += g[sa].id + ",";
                        c = c.substr(0, c.length -
                            1);
                        n(c)
                    } else b(v).trigger("WPSVPYoutubeLoader.END_LOAD", {
                        info: ea,
                        data: g,
                        nextPageToken: C
                    })
                }
            }).fail(function(b, c, g) {
                console.log(b, c, g)
            })
        }

        function L(b, c) {
            var g = jQuery.extend(!0, {}, q);
            g.type = "youtube";
            g.deeplink && "youtube_single" != g.origtype && (g.deeplink += aa.toString(), aa++);
            if ("youtube_single" == c || "youtube_single_list" == c) g.id = b.id;
            else if ("youtube_playlist" == c) g.id = b.contentDetails.videoId;
            else if ("youtube_video_query" == c || "youtube_channel" == c) g.id = b.id.videoId;
            b.snippet && (g.snippet = b.snippet, b.snippet.publishedAt &&
                (g.publishedAt = b.snippet.publishedAt));
            !g.title && b.snippet.title && (g.title = b.snippet.title);
            !g.description && b.snippet.description && (g.description = b.snippet.description);
            g.url || (g.url = "https://www.youtube.com/watch?v=" + g.id);
            b.contentDetails && b.contentDetails.projection && "360" == b.contentDetails.projection && (g.is360 = !0);
            b.statistics && (g.statistics = b.statistics);
            return g
        }
        var v = this,
            l, q, g = [],
            aa, z = 50,
            S, C, oa = c.getStats,
            fa, ea, Aa, Ub, ta = c.youtubeAppId,
            Cc;
        this.resumeLoad = function(c) {
            g = [];
            c ? (S = c.substr(0, c.lastIndexOf("&pageToken=")),
                B(c)) : b(v).trigger("WPSVPYoutubeLoader.END_LOAD", {
                data: g,
                nextPageToken: c
            })
        };
        this.getData = function(c) {
            ea = null;
            if ("youtube_channel" == c.type) {
                var g = "https://www.googleapis.com/youtube/v3/channels?part=id,snippet,statistics,brandingSettings&id=" + c.path + "&fields=items(id,snippet%2Ftitle,snippet%2Fdescription,snippet%2FpublishedAt,snippet%2Fthumbnails,statistics%2FsubscriberCount,statistics%2FviewCount,statistics%2FvideoCount,brandingSettings%2Fimage)&key=" + ta;
                b.ajax({
                    url: g,
                    dataType: "jsonp"
                }).done(function(b) {
                    ea =
                        b;
                    ea.fetch_type = c.type;
                    v.setData(c)
                }).fail(function(b, c, g) {
                    console.log(b, c, g)
                })
            } else "youtube_playlist" == c.type ? v.setData(c) : "youtube_video_query" == c.type ? v.setData(c) : "youtube_user" == c.type && (g = "https://www.googleapis.com/youtube/v3/channels?part=id,snippet,statistics,brandingSettings&forUsername=" + c.path + "&fields=items(id,snippet%2Ftitle,snippet%2Fdescription,snippet%2FpublishedAt,snippet%2Fthumbnails,statistics%2FsubscriberCount,statistics%2FviewCount,statistics%2FvideoCount,brandingSettings%2Fimage)&key=" +
                ta, b.ajax({
                    url: g,
                    dataType: "jsonp"
                }).done(function(b) {
                    ea = b;
                    c.type = "youtube_channel";
                    c.path = b.items[0].id;
                    ea.fetch_type = c.type;
                    v.setData(c)
                }).fail(function(b, c, g) {
                    console.log(b, c, g)
                }))
        };
        this.getChannelId = function() {
            return Cc
        };
        this.setDataFromCache = function(b) {
            g = [];
            q = b;
            Aa = q.limit || 400;
            z = 50;
            Aa < z && (z = Aa);
            Ub = q.sort || "relevance";
            l = q.type
        };
        this.setData = function(c) {
            if (ta) {
                g = [];
                q = c;
                aa = 0;
                Aa = q.limit || 400;
                z = 50;
                Aa < z && (z = Aa);
                Ub = q.sort || "relevance";
                l = q.type;
                C = null;
                if ("youtube_single" == l || "youtube_single_list" == l) S =
                    "https://www.googleapis.com/youtube/v3/videos?id=" + q.path + "&key=" + ta + "&part=snippet,contentDetails,status,statistics";
                else if ("youtube_playlist" == l) S = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet,status,contentDetails&maxResults=" + z + "&playlistId=" + q.path + "&key=" + ta;
                else if ("youtube_video_query" == l) S = "https://www.googleapis.com/youtube/v3/search?part=id,snippet&type=video&maxResults=" + z + "&order=" + Ub + "&q=" + encodeURIComponent(q.path) + "&key=" + ta;
                else if ("youtube_channel" == l) S = "https://www.googleapis.com/youtube/v3/search?part=id,snippet&type=video&order=date&maxResults=" +
                    z + "&order=date&channelId=" + q.path + "&key=" + ta;
                else {
                    "youtube_user" == l ? b.ajax({
                        url: "https://www.googleapis.com/youtube/v3/channels?part=id&forUsername=" + q.path + "&fields=items(id)&key=" + ta,
                        dataType: "jsonp"
                    }).done(function(b) {
                        l = c.type = "youtube_channel";
                        Cc = b.items[0].id;
                        c.path = Cc;
                        ea && (ea.fetch_type = c.type);
                        v.setData(c)
                    }).fail(function(b, c, g) {
                        console.log(b, c, g)
                    }) : console.log("Wrong youtube type!");
                    return
                }
                B(S)
            } else alert("Youtube API key missing! Set API key in settings.")
        };
        this.getChannelInfo = function(c) {
            b.ajax({
                url: "https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=" +
                    c + "&fields=items(snippet%2Fthumbnails,statistics%2FsubscriberCount)&key=" + ta,
                dataType: "jsonp"
            }).done(function(c) {
                b(v).trigger("WPSVPYoutubeLoader.CHANNEL_INFO", {
                    data: c
                })
            }).fail(function(b, c, g) {
                console.log(b, c, g)
            })
        };
        this.getComments = function(c) {
            fa = "https://www.googleapis.com/youtube/v3/commentThreads?part=snippet,replies&order=time&videoId=" + c + "&key=" + ta;
            b.ajax({
                url: fa,
                dataType: "jsonp"
            }).done(function(c) {
                b(v).trigger("WPSVPYoutubeLoader.COMMENTS_END_LOAD", {
                    data: c
                })
            }).fail(function(c, g, ea) {
                console.log(c,
                    g, ea);
                b(v).trigger("WPSVPYoutubeLoader.COMMENTS_ERROR_LOAD")
            })
        };
        this.resumeComments = function(c) {
            fa += "&pageToken=" + c;
            b.ajax({
                url: fa,
                dataType: "jsonp"
            }).done(function(c) {
                b(v).trigger("WPSVPYoutubeLoader.COMMENTS_END_LOAD", {
                    data: c
                })
            }).fail(function(c, g, ea) {
                console.log(c, g, ea);
                b(v).trigger("WPSVPYoutubeLoader.COMMENTS_ERROR_LOAD")
            })
        };
        this.getNextPageToken = function() {
            return C
        }
    }
})(window, jQuery);
(function(c, b) {
    c.WPSVPVimeoLoader = function(n) {
        function lc(c) {
            b.ajax({
                type: "GET",
                url: l + "includes/vimeo/vimeo_data.php",
                data: {
                    type: "next_page",
                    path: c,
                    vai: fa
                },
                dataType: "json"
            }).done(function(b) {
                B(b)
            }).fail(function(b, c, g) {
                console.log(b, c, g)
            })
        }

        function B(c) {
            aa = c.body.paging && c.body.paging.next ? c.body.paging.next : null;
            var l;
            var ea = c.body.data ? c.body.data.length : 1;
            for (l = 0; l < ea && S.length != q; l++) {
                var n = c.body.uri ? c.body : c.body.data[l];
                S.push(L(n))
            }
            S.length < q ? aa ? (S.length + g > q && (g = q - S.length, c = aa.split("per_page=")[1].split("&")[0],
                aa = aa.replace("per_page=" + c, "per_page=" + g)), lc(aa)) : b(v).trigger("WPSVPVimeoLoader.END_LOAD", {
                info: C,
                data: S,
                nextPageToken: aa
            }) : b(v).trigger("WPSVPVimeoLoader.END_LOAD", {
                info: C,
                data: S,
                nextPageToken: aa
            })
        }

        function L(c) {
            var g = b.extend(!0, {}, z);
            g.deeplink && "vimeo_single" != g.origtype && (g.deeplink += (oa + 1).toString(), oa++);
            g.type = "vimeo"; - 1 < c.uri.indexOf(":") && (c.uri = c.uri.substr(0, c.uri.lastIndexOf(":")));
            g.id = c.uri.substr(c.uri.lastIndexOf("/") + 1);
            c.duration && (g.duration = c.duration);
            !g.title && c.name && (g.title =
                c.name);
            !g.description && c.description && (g.description = c.description);
            !g.thumb && c.pictures && (g.pictures = c.pictures);
            g.url || (g.url = "https://vimeo.com/" + g.id);
            g.release_time = c.release_time;
            g.plays = c.stats.plays;
            g.comments = c.metadata.connections.comments.total;
            g.likes = c.metadata.connections.likes.total;
            g.categories = c.categories;
            g.user = c.user;
            c.download && c.download.link && (g.download = c.download.link);
            return g
        }
        var v = this,
            l = n.sourcePath,
            q, g = 100,
            aa, z = [],
            S = [],
            C, oa, fa = n.vai;
        this.resumeLoad = function(c) {
            S = [];
            c ? lc(c) : b(v).trigger("WPSVPVimeoLoader.END_LOAD", {
                data: S,
                nextPageToken: c
            })
        };
        this.getData = function(c) {
            C = null;
            "vimeo_channel" == c.type || "vimeo_group" == c.type || "vimeo_user_album" == c.type ? b.ajax({
                    type: "GET",
                    url: l + "includes/vimeo/vimeo_data.php",
                    data: {
                        type: "vimeo_user_album" == c.type ? "vimeo_user_info" : c.type + "_info",
                        path: c.path,
                        user_id: c.user_id,
                        vai: fa
                    },
                    dataType: "json"
                }).done(function(b) {
                    C = b.body;
                    C.fetch_type = c.type;
                    v.setData(c)
                }).fail(function(c, b, g) {
                    console.log(c, b, g)
                }) : "vimeo_album" == c.type ? v.setData(c) :
                "vimeo_video_query" == c.type && v.setData(c)
        };
        this.setDataFromCache = function(c) {
            S = [];
            z = c;
            g = 100;
            q = z.limit || 1E3;
            q < g && (g = q)
        };
        this.setData = function(v) {
            if ("file:" == c.location.protocol) console.log("Using Vimeo locally is not possible! This requires online server connection!");
            else {
                S = [];
                z = v;
                g = 100;
                q = z.limit || 1E3;
                q < g && (g = q);
                oa = 0;
                aa = null;
                "vimeo_single" == z.type && -1 < z.path.indexOf("/") && (z.path = z.path.replace("/", ":"));
                var n = l + "includes/vimeo/vimeo_data.php";
                v = {
                    type: z.type,
                    path: z.path,
                    user_id: z.user_id,
                    sort: z.sort,
                    sortDirection: z.sortDirection,
                    page: 1,
                    perPage: q < g ? q : g,
                    vai: fa
                };
                b.ajax({
                    type: "GET",
                    url: n,
                    data: v,
                    dataType: "json"
                }).done(function(c) {
                    if (!c.body) return console.log("Vimeo response null!"), !1;
                    B(c)
                }).fail(function(c, b, g) {
                    console.log(c, b, g)
                })
            }
        };
        this.getComments = function(c, g) {
            b.ajax({
                type: "GET",
                url: l + "includes/vimeo/vimeo_data.php",
                data: {
                    type: "video_comments",
                    video_id: c,
                    sortDirection: "desc",
                    page: 1,
                    perPage: g,
                    vai: fa
                },
                dataType: "json"
            }).done(function(c) {
                b(v).trigger("WPSVPVimeoLoader.COMMENTS_END_LOAD", {
                    data: c.body
                })
            }).fail(function(c,
                g, l) {
                console.log(c, g, l);
                b(v).trigger("WPSVPVimeoLoader.COMMENTS_ERROR_LOAD")
            })
        };
        this.resumeComments = function(c) {
            b.ajax({
                type: "GET",
                url: l + "includes/vimeo/vimeo_data.php",
                data: {
                    type: "next_page",
                    path: c,
                    vai: fa
                },
                dataType: "json"
            }).done(function(c) {
                b(v).trigger("WPSVPVimeoLoader.COMMENTS_END_LOAD", {
                    data: c.body
                })
            }).fail(function(c, g, l) {
                console.log(c, g, l);
                b(v).trigger("WPSVPVimeoLoader.COMMENTS_ERROR_LOAD")
            })
        };
        this.getNextPageToken = function() {
            return aa
        }
    }
})(window, jQuery);
(function(c, b) {
    c.WPSVPPlaylistManager = function(c) {
        function n() {
            C = WPSVPUtils.randomiseArray(l)
        }
        var B = this,
            L = c.loopingOn,
            v = c.randomPlay,
            l, q = !1,
            g = -1,
            aa, z, S = !1,
            C = [],
            oa = !1;
        setTimeout(function() {
            clearTimeout(this);
            b(B).trigger("WPSVPPlaylistManager.RANDOM_CHANGE", v);
            b(B).trigger("WPSVPPlaylistManager.LOOP_CHANGE", L)
        }, 50);
        this.setCounter = function(c, z) {
            "undefined" === typeof z && (z = !0);
            g = z ? g + parseInt(c, 10) : parseInt(c, 10);
            if (isNaN(g)) alert("WPSVPPlaylistManager message: No active media, counter = " + g);
            else if (q = !1, L) {
                if (v)
                    if (g >
                        l - 1) {
                        g = C[l - 1];
                        n();
                        if (C[0] == g) {
                            var fa = C.splice(0, 1);
                            C.push(fa)
                        }
                        g = 0
                    } else 0 > g && (g = C[0], n(), C[l - 1] == g && (fa = C.splice(l - 1, 1), C.unshift(fa)), g = l - 1);
                else g > l - 1 ? g = 0 : 0 > g && (g = l - 1);
                b(B).trigger("WPSVPPlaylistManager.COUNTER_READY", g)
            } else g > l - 1 ? (g = l - 1, q = !0) : 0 > g && (g = 0), q ? b(B).trigger("WPSVPPlaylistManager.PLAYLIST_END") : b(B).trigger("WPSVPPlaylistManager.COUNTER_READY", g)
        };
        this.getCounter = function() {
            return v ? oa ? g : C[g] : g
        };
        this.advanceHandler = function(c) {
            oa = !1;
            S ? (S = !1, z + c > l - 1 ? (g = l - 1, b(B).trigger("WPSVPPlaylistManager.COUNTER_READY",
                g)) : 0 > z + c ? (g = 0, b(B).trigger("WPSVPPlaylistManager.COUNTER_READY", g)) : B.setCounter(z + c, !1)) : B.setCounter(c)
        };
        this.processPlaylistRequest = function(c) {
            oa = !1;
            v && (oa = !0, aa = c, S || (z = g, S = !0));
            B.setCounter(c, !1)
        };
        this.setPlaylistItems = function(c, b) {
            "undefined" === typeof b && (b = !0);
            b && (g = -1);
            l = c;
            v && n()
        };
        this.reSetCounter = function(c) {
            "undefined" === typeof c ? g = -1 : (c = parseInt(c, 10), l ? (c > l - 1 ? c = l - 1 : 0 > c && (c = 0), g = c) : g = -1)
        };
        this.setRandom = function(c) {
            (v = "undefined" !== typeof c ? c : !v) && n();
            if (v) {
                var l = C.length;
                for (c = 0; c < l; c++)
                    if (C[c] ==
                        g) {
                        if (0 == c) break;
                        c = C.splice(c, 1);
                        C.unshift(parseInt(c, 10));
                        break
                    }
                g = 0
            } else S ? (g = aa, S = !1) : g = C[g];
            b(B).trigger("WPSVPPlaylistManager.RANDOM_CHANGE", v)
        };
        this.getRandom = function(c) {
            return v
        };
        this.setLooping = function(c) {
            L = "undefined" !== typeof c ? c : !L;
            b(B).trigger("WPSVPPlaylistManager.LOOP_CHANGE", L)
        };
        this.getLooping = function(c) {
            return L
        };
        this.getPosition = function(c) {
            return C.indexOf(c)
        }
    }
})(window, jQuery);
(function(c, b) {
    function n(c, b, l, n) {
        var g = {},
            v = l.width();
        l = l.height();
        n = lc(b, n);
        b = n.width;
        n = n.height;
        var q = (v - 0) / (l - 0),
            L = b / n;
        L < q ? c ? (g.width = (l - 0) / n * b, g.height = l - 0) : (g.height = (v - 0) / b * n, g.width = v - 0) : L > q ? c ? (g.height = (v - 0) / b * n, g.width = v - 0) : (g.width = (l - 0) / n * b, g.height = l - 0) : (g.width = v - 0, g.height = l - 0);
        return g
    }

    function lc(c, b) {
        var l = {};
        "video" == c ? b.videoWidth && b.videoHeight ? (l.width = b.videoWidth, l.height = b.videoHeight) : b[0] && b[0].videoWidth && b[0].videoHeight ? (l.width = b[0].videoWidth, l.height = b[0].videoHeight) :
            (l.width = 16, l.height = 9) : "iframe" == c ? b.sw && b.sh ? (l.width = b.sw, l.height = b.sh) : (l.width = 16, l.height = 9) : "image" == c && (l.width = b.width(), l.height = b.height());
        return l
    }
    var B = function() {};
    B.resizeMedia = function(c, b, l, q) {
        var g, v = l.width();
        var z = l.height();
        0 == b ? g = lc(c, q) : 1 == b ? g = n(!0, c, l, q) : 2 == b && (g = n(!1, c, l, q));
        c = parseInt((v - g.width) / 2, 10);
        z = parseInt((z - g.height) / 2, 10);
        q.css({
            width: g.width + "px",
            height: g.height + "px",
            left: c + "px",
            top: z + "px"
        })
    };
    c.WPSVPAspectRatio = B
})(window, jQuery);
(function(c) {
    c.fn.wpsvp = function(b) {
        function n() {
            Ba.swipe({
                swipeLeft: function(a, d, c, b, h, e) {
                    if (!u) return !1;
                    ("audio" == f || "video" == f && "video_360" != D || "image" == f && "image_360" != D || "youtube" == f && "chromeless" == la && !k.is360 || "vimeo" == f && "chromeless" == ba && !k.is360) && Vb()
                },
                swipeRight: function(a, d, c, b, h, e) {
                    if (!u) return !1;
                    ("audio" == f || "video" == f && "video_360" != D || "image" == f && "image_360" != D || "youtube" == f && "chromeless" == la && !k.is360 || "vimeo" == f && "chromeless" == ba && !k.is360) && kd()
                }
            })
        }

        function lc(a) {
            if (!Zd) {
                if ("touchstart" ==
                    a.type) {
                    if (a = a.originalEvent.touches, !(a && 0 < a.length)) return !1
                } else a.preventDefault();
                Zd = !0;
                Ha.on(rb, function(a) {
                    a: {
                        if ("touchmove" == a.type) {
                            if (a.originalEvent.touches && a.originalEvent.touches.length) var d = a.originalEvent.touches;
                            else if (a.originalEvent.changedTouches && a.originalEvent.changedTouches.length) d = a.originalEvent.changedTouches;
                            else break a;
                            if (1 < d.length) break a;
                            d = d[0]
                        } else d = a;
                        a.preventDefault();
                        B(d)
                    }
                }).on(Dc, function(a) {
                    a: if (Zd) {
                        Zd = !1;
                        Ha.off(rb).off(Dc);
                        if ("touchend" == a.type) {
                            if (a.originalEvent.touches &&
                                a.originalEvent.touches.length) var d = a.originalEvent.touches;
                            else if (a.originalEvent.changedTouches && a.originalEvent.changedTouches.length) d = a.originalEvent.changedTouches;
                            else break a;
                            if (1 < d.length) break a;
                            d = d[0]
                        } else d = a;
                        a.preventDefault();
                        B(d)
                    }
                })
            }
            return !1
        }

        function B(a) {
            a = a.pageX - Cb.offset().left;
            0 > a ? a = 0 : a > Za && (a = Za);
            var d = Math.max(0, Math.min(1, a / Za));
            if ("audio" == f) {
                var c = t.duration;
                var b = d * c;
                try {
                    t.currentTime = b.toFixed(1)
                } catch (sb) {}
            } else if ("video" == f) {
                c = m.duration;
                b = d * c;
                try {
                    m.currentTime = b.toFixed(1)
                } catch (sb) {}
            } else "youtube" ==
                f ? (c = y.getDuration(), b = d * c, y.seekTo(b)) : "vimeo" == f && (0 != Db ? (c = Db, b = d * c, w.setCurrentTime(b)) : w.getDuration().then(function(a) {
                    c = a;
                    b = d * c;
                    w.setCurrentTime(b)
                }), "chromeless" == ba & T && gb.show());
            T || (Se(!0), Te.width(b / c * Za));
            if (G && Ia.length) {
                var h = Ia.length;
                for (a = 0; a < h; a++) {
                    var e = Ia[a];
                    if (b >= e.start && b <= e.end) {
                        Ec.css("opacity", 1).text(e.text);
                        T || H.hide();
                        break
                    }
                }
            }
        }

        function L(a) {
            var d = a.pageX - Cb.offset().left;
            if (!WPSVPUtils.isNumber(d)) return !1;
            0 > d ? d = 0 : d > Za && (d = Za);
            var c = Math.max(0, Math.min(1, d / Za));
            if (!WPSVPUtils.isNumber(c)) return !1;
            d = e[0].getBoundingClientRect();
            var b = Ca[0].getBoundingClientRect();
            if ("audio" == f) var h = t.duration;
            else "video" == f ? h = m.duration : "youtube" == f ? h = y.getDuration() : "vimeo" == f && (h = Db);
            if (k.previewSeek && Eb.length) {
                var g = h * c;
                WPSVPUtils.isNumber(h) && uh.html(WPSVPUtils.formatTime(g));
                c = Eb.length;
                for (h = 0; h < c; h++) {
                    var sb = Eb[h];
                    var l = sb.start;
                    var n = sb.end;
                    if (g >= l && g <= n) {
                        if (!Fb) {
                            sb = sb.url;
                            var p = sb.substr(sb.lastIndexOf("=") + 1).split(",");
                            p = "-" + p[0] + "px -" + p[1] + "px";
                            Fb = {};
                            Fb.start = l;
                            Fb.end = n;
                            wh.css({
                                "background-image": "url(" +
                                    sb + ")",
                                "background-position": p
                            })
                        }
                    } else Fb && (g < Fb.start || g > Fb.end) && (Fb = null)
                }
                a = a.pageX - ua.scrollLeft() - d.left - mc.outerWidth() / 2;
                g = b.top - d.top - mc.outerHeight() - 10;
                "lightbox" != $a && (0 > a ? a = 0 : a + mc.outerWidth() > Ja.width() && (a = Ja.width() - mc.outerWidth()));
                mc.css({
                    left: parseInt(a, 10) + "px",
                    top: parseInt(g, 10) + "px"
                }).show()
            } else a = a.pageX - ua.scrollLeft() - d.left - U.outerWidth() / 2, g = "top" == xh ? b.top - d.top + Ca.outerHeight() + 10 : b.top - d.top - U.outerHeight(), "lightbox" != $a && (0 > a ? a = 0 : a + U.outerWidth() > e.width() && (a = e.width() -
                U.outerWidth())), U.css({
                left: parseInt(a, 10) + "px",
                top: parseInt(g, 10) + "px"
            }).show(), WPSVPUtils.isNumber(h) && U.text(WPSVPUtils.formatTime(h * c) + " / " + WPSVPUtils.formatTime(h))
        }

        function v(a) {
            if (u) {
                if (!$d) {
                    if ("touchstart" == a.type) {
                        if (a = a.originalEvent.touches, !(a && 0 < a.length)) return !1
                    } else a.preventDefault();
                    $d = !0;
                    Ha.on(rb, function(a) {
                        a: {
                            if ("touchmove" == a.type) {
                                if (a.originalEvent.touches && a.originalEvent.touches.length) var d = a.originalEvent.touches;
                                else if (a.originalEvent.changedTouches && a.originalEvent.changedTouches.length) d =
                                    a.originalEvent.changedTouches;
                                else break a;
                                if (1 < d.length) break a;
                                d = d[0]
                            } else d = a;
                            a.preventDefault();
                            q(d)
                        }
                    }).on(Dc, function(a) {
                        a: if ($d) {
                            $d = !1;
                            Ha.off(rb).off(Dc);
                            if ("touchend" == a.type) {
                                if (a.originalEvent.touches && a.originalEvent.touches.length) var d = a.originalEvent.touches;
                                else if (a.originalEvent.changedTouches && a.originalEvent.changedTouches.length) d = a.originalEvent.changedTouches;
                                else break a;
                                if (1 < d.length) break a;
                                d = d[0]
                            } else d = a;
                            a.preventDefault();
                            q(d)
                        }
                    })
                }
                return !1
            }
        }

        function l() {
            if (!u) return !1;
            0 <
                K ? (Ue = K, K = 0) : K = Ue;
            g()
        }

        function q(a) {
            nc ? K = Math.max(0, Math.min(1, (a.pageX - Fc.offset().left) / Gc)) : (K = Math.max(0, Math.min(1, (a.pageY - Fc.offset().top) / Gc)), K = 1 - K);
            g()
        }

        function g(a) {
            // console.log("setVolume");
            "undefined" !== typeof a && (K = a);
            "undefined" !== typeof K && ("audio" == f ? t && (t.volume = K, t.muted = 0 == K ? !0 : !1) : "video" == f ? m && (m.volume = K, m.muted = 0 == K ? !0 : !1) : "youtube" == f ? y && (y.setVolume(100 * K), 0 == K ? y.mute() : y.unMute()) : "vimeo" == f && w && w.setVolume(K));
            Hc.children().hide();
            0 == K ? (Hc.find(".wpsvp-btn-volume-off").show(),
                "custom" == Gb && (Ic.find(".wpsvp-context-volume-mute").hide(), Ic.find(".wpsvp-context-volume-unmute").show())) : 0 < K && .5 > K ? (Hc.find(".wpsvp-btn-volume-down").show(), "custom" == Gb && (Ic.find(".wpsvp-context-volume-unmute").hide(), Ic.find(".wpsvp-context-volume-mute").show())) : .5 <= K && 1 >= K && (Hc.find(".wpsvp-btn-volume-up").show(), "custom" == Gb && (Ic.find(".wpsvp-context-volume-unmute").hide(), Ic.find(".wpsvp-context-volume-mute").show()));
            yh.css(nc ? "width" : "height", K * Gc + "px");
            c(p).trigger("volumeChange", {
                instance: p,
                instanceName: M,
                volume: K
            })
        }

        function aa(a) {
            var d = nc ? a.pageX - Fc.offset().left : a.pageY - Fc.offset().top;
            0 > d ? d = 0 : d > Gc && (d = Gc);
            d = Math.max(0, Math.min(1, d / Gc));
            if (!WPSVPUtils.isNumber(d)) return !1;
            nc || (d = 1 - d);
            d = parseInt(100 * d, 10);
            U.text(d + " %");
            var c = e[0].getBoundingClientRect(),
                b = ab[0].getBoundingClientRect();
            nc ? (d = parseInt(a.pageX - ua.scrollLeft() - c.left - U.outerWidth() / 2), a = parseInt(b.top - c.top - U.outerHeight())) : (d = parseInt(b.left - c.left - U.outerWidth() / 2 + ab.outerWidth() / 2), a = parseInt(a.pageY - ua.scrollTop() - c.top - U.outerHeight() -
                10));
            U.css({
                left: d + "px",
                top: a + "px"
            }).show()
        }

        function z(a) {
            var d = "https:" == window.location.protocol ? "https:" : "http:",
                c = (window.screen.width - 600) / 2,
                b = (window.screen.height - 300) / 2,
                h = k.title || "",
                f = k.description || "",
                g = k.thumb || k.thumbDefault,
                l = k.share || window.location.href;
            WPSVPUtils.relativePath(g) || (g = WPSVPUtils.qualifyURL(k.thumb));
            if ("facebook" == a) {
                if (e.find('.wpsvp-share-item[data-type="facebook"]').length) {
                    alert("Facebook API key has not been set in settings!");
                    return
                }
                if (window.FB) {
                    FB.ui({
                        method: "share_open_graph",
                        action_type: "og.shares",
                        action_properties: JSON.stringify({
                            object: {
                                "og:url": l,
                                "og:title": h,
                                "og:description": f,
                                "og:image": g
                            }
                        })
                    }, function(a) {});
                    return
                }
            } else if ("twitter" == a) var m = d + "//twitter.com/intent/tweet?url=" + encodeURIComponent(l) + "&text=" + encodeURIComponent(h);
            else if ("googleplus" == a) m = d + "//plus.google.com/share?url=" + encodeURIComponent(l);
            else if ("tumblr" == a) m = d + "//www.tumblr.com/share/link?url=" + encodeURIComponent(l) + "&amp;name=" + encodeURIComponent(h) + "&amp;description=" + encodeURIComponent(f);
            else if ("reddit" == a) m = d + "//www.reddit.com/submit?url=" + encodeURIComponent(l);
            else if ("linkedin" == a) m = d + "//www.linkedin.com/shareArticle?mini=true&url=" + encodeURIComponent(l) + "&title=" + encodeURIComponent(h) + "&summary=" + encodeURIComponent(f) + "&source=" + document.title;
            else if ("digg" == a) m = d + "//digg.com/submit?url=" + encodeURIComponent(l) + "&title=" + encodeURIComponent(h);
            else if ("pinterest" == a) m = d + "//www.pinterest.com/pin/create/button/?url=" + encodeURIComponent(l) + "&media=" + encodeURIComponent(g) + "&description=" +
                encodeURIComponent(f);
            else if ("whatsapp" == a) {
                if (G) {
                    a = encodeURIComponent(h) + " - " + encodeURIComponent(l);
                    window.location.href = "whatsapp://send?text=" + a;
                    return
                }
                alert("Please share this content on mobile device!")
            }
            m && window.open(m, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=600,height=300,left=" + c + ",top=" + b)
        }

        function S(a) {
            (function(a, c, b) {
                var d = a.getElementsByTagName(c)[0];
                a.getElementById(b) || (a = a.createElement(c), a.id = b, a.src = "//connect.facebook.net/en_US/sdk.js", d.parentNode.insertBefore(a,
                    d))
            })(document, "script", "facebook-jssdk");
            window.fbAsyncInit = function() {
                FB.init({
                    appId: a,
                    xfbml: !0,
                    version: "v2.9"
                })
            }
        }



        function C() {
            if (c(this).hasClass("wpsvp-menu-active")) return !1;


            /*  added by Boldman.. The selected rate is applied by this code..*/

            var a = c(this).attr("data-value");
            "audio" == f ? t.playbackRate = Number(a) : "video" == f ? m.playbackRate = Number(a) : "youtube" == f ? y.setPlaybackRate(Number(a)) : "vimeo" == f && w.setPlaybackRate(Number(a)).then(function(a) {})["catch"](function(a) {
                console.log(a.name)
            });
            k.playbackRate = a;
            bb && (P.find(".wpsvp-settings-menu").hide(), cb.show())
        }

        function oa(a) {
            ae &&
                ae.removeClass("wpsvp-menu-active");
            ae = be.find(".wpsvp-menu-item[data-value='" + a + "']").addClass("wpsvp-menu-active");
            bb && P.find(".wpsvp-playback-rate-menu-value").text(ae.text())
        }

        function fa() {
            var a = [],
                d = k.path.length;
            for (Wb = 0; Wb < d; Wb++) {
                var c = k.path[Wb];
                a.push(c.quality)
            }
            return a
        }

        function ea(a, d) {
            var b, x = a.length;
            for (b = 0; b < x; b++) {
                var h = a[b];
                h.label ? c("<li/>").addClass("wpsvp-menu-item").attr({
                    "data-value": h.value,
                    "data-label": h.label
                }).text(h.label).on("click", Aa).appendTo(ld) : c("<li/>").addClass("wpsvp-menu-item").attr("data-value",
                    h).text(h).on("click", Aa).appendTo(ld)
            }
            Ub(d);
            oc.show();
            Wf.removeClass("wpsvp-force-hide")
        }

        function Aa() {
            if (c(this).hasClass("wpsvp-menu-active")) return !1;
            Hb && Hb.removeClass("wpsvp-menu-active");
            Hb = c(this).addClass("wpsvp-menu-active");
            var a = Hb.attr("data-value");
            k.quality = a;
            if ("image" == f || "audio" == f || "video" == f)
                if ("hls" == D) {
                    var d = parseInt(a, 10); - 1 == a ? (V.currentLevel = d, V.nextLevel = d, V.loadLevel = d) : V.currentLevel = a
                } else "dash" != D && va(!0);
            else "youtube" == f && y.setPlaybackQuality(a);
            bb && (P.find(".wpsvp-quality-menu-value").text(Hb.text()),
                P.find(".wpsvp-settings-menu").hide(), cb.show())
        }

        function Ub(a) {
            Hb && Hb.removeClass("wpsvp-menu-active");
            Hb = ld.find(".wpsvp-menu-item[data-value='" + a + "']").addClass("wpsvp-menu-active");
            bb && P.find(".wpsvp-quality-menu-value").text(Hb.text())
        }

        function ta() {
            var a = c(this).attr("data-value");
            "hls" == D && (V.audioTrack = a)
        }

        function Cc() {
            var a, d = k.subtitles.length,
                b = md;
            c("<li/>").addClass("wpsvp-menu-item").attr("data-label", md).text(md).on("click", sa).appendTo(pc);
            for (a = 0; a < d; a++) {
                var x = k.subtitles[a];
                c("<li/>").addClass("wpsvp-menu-item").attr({
                    "data-value": x.value,
                    "data-label": x.label
                }).text(x.label).on("click", sa).appendTo(pc);
                x["default"] && (b = x.label)
            }
            p.setSubtitle(b);
            qc.show();
            Xf.removeClass("wpsvp-force-hide")
        }

        function sa() {
            if (c(this).hasClass("wpsvp-menu-active")) return !1;
            Ka && Ka.removeClass("wpsvp-menu-active");
            Ka = c(this).addClass("wpsvp-menu-active");
            var a = Ka.attr("data-label");
            p.setSubtitle(a);
            bb && (P.find(".wpsvp-settings-menu").hide(), cb.show())
        }

        function W(a) {
            c.ajax({
                url: a.src
            }).done(function(d) {
                d = d.split(/[\r\n]/);
                var c;
                for (c in d) {
                    var b = d[c];
                    if (/.vtt/.test(b)) {
                        a.src =
                            a.src.substr(0, a.src.lastIndexOf("/") + 1) + b;
                        var h = !0;
                        break
                    }
                }
                h ? Tf(a) : console.log("Error loading subtitle!")
            }).fail(function(a, c, b) {
                console.log(a, c, b)
            })
        }

        function Tf(a) {
            db = [];
            var d = a.src; - 1 != d.indexOf("ebsfm:") && (d = atob(d.substr(6)));
            c.ajax({
                url: d
            }).done(function(d) {
                d = d.replace(/\r\n|\r|\n/g, "\n");
                d = WPSVPUtils.strip(d);
                d = d.split("\n\n");
                var c, b = 0,
                    F;
                for (c in d) {
                    var f = d[c].split("\n");
                    if ("WEBVTT" != f) {
                        if (2 <= f.length)
                            if (2 < f.length) {
                                var e = WPSVPUtils.strip(f[1].split(" --\x3e ")[0]);
                                var g = WPSVPUtils.strip(f[1].split(" --\x3e ")[1]);
                                var k = f[2];
                                if (2 < f.length)
                                    for (F = 3; F < f.length; F++) k += "\n" + f[F]
                            } else e = WPSVPUtils.strip(f[0].split(" --\x3e ")[0]), g = WPSVPUtils.strip(f[0].split(" --\x3e ")[1]), k = f[1];
                        db[b] = {};
                        db[b].start = WPSVPUtils.toSeconds(e);
                        db[b].end = WPSVPUtils.toSeconds(g);
                        db[b].text = k;
                        b++
                    }
                }
                ce[a.label] = db;
                rc = !0
            }).fail(function(a, d, c) {
                console.log(a, d, c)
            })
        }

        function rh() {
            Ia = [];
            c.ajax({
                url: k.chapters
            }).done(function(a) {
                a = a.replace(/\r\n|\r|\n/g, "\n");
                a = WPSVPUtils.strip(a);
                a = a.split("\n\n");
                var d, c = 0,
                    b;
                for (d in a) {
                    var h = a[d].split("\n");
                    if ("WEBVTT" !=
                        h) {
                        if (2 <= h.length)
                            if (2 < h.length) {
                                var f = WPSVPUtils.strip(h[1].split(" --\x3e ")[0]);
                                var e = WPSVPUtils.strip(h[1].split(" --\x3e ")[1]);
                                var g = h[2];
                                if (2 < h.length)
                                    for (b = 3; b < h.length; b++) g += "\n" + h[b]
                            } else f = WPSVPUtils.strip(h[0].split(" --\x3e ")[0]), e = WPSVPUtils.strip(h[0].split(" --\x3e ")[1]), g = h[1];
                        Ia[c] = {};
                        Ia[c].start = WPSVPUtils.toSeconds(f);
                        Ia[c].end = WPSVPUtils.toSeconds(e);
                        Ia[c].text = g;
                        c++
                    }
                }
            }).fail(function(a, d, c) {
                console.log("Error loading chapters: ", a.responseText, d, c)
            })
        }

        function Uf(a) {
            console.log("makeChapters");
            var d, b = Ia.length;
            for (d = 0; d < b; d++) {
                var x = Ia[d];
                var h = Math.abs(x.end - x.start);
                h = h / a * 100;
                var f = x.start / a * 100;
                x = c('<div class="wpsvp-chapter-indicator"><div class="wpsvp-chapter-indicator-highlight"></div></div>').css({
                    width: h + "%",
                    left: f + "%"
                }).attr({
                    "data-title": x.text,
                    "data-start": x.start,
                    "data-end": x.end
                });
                Ia[d].chapter = x;
                G || x.on("mouseenter", function() {
                    var a = c(this);
                    a.find(".wpsvp-chapter-indicator-highlight").addClass("wpsvp-chapter-indicator-highlight-visible");
                    Ec.css("opacity", 1).text(a.attr("data-title"));
                    T || H.hide()
                }).on("mouseleave", function() {
                    c(this).find(".wpsvp-chapter-indicator-highlight").removeClass("wpsvp-chapter-indicator-highlight-visible");
                    Ec.css("opacity", 0);
                    T || H.show()
                }).appendTo(Cb)
            }
        }

        function Vf(a) {
            var d, b = hb.length;
            for (d = 0; d < b; d++) {
                var x = hb[d];
                var h = Math.round(x.begin / a * 100);
                x.marker = c('<div class="wpsvp-ad-indicator"></div>').css({
                    left: h + "%"
                }).appendTo(Cb)
            }
        }

        function sh() {
            Eb = [];
            c.ajax({
                url: k.previewSeek
            }).done(function(a) {
                a = a.replace(/\r\n|\r|\n/g, "\n");
                a = WPSVPUtils.strip(a);
                a = a.split("\n\n");
                var d, c = 0;
                for (d in a) {
                    var b = a[d].split("\n");
                    if ("WEBVTT" != b) {
                        if (2 <= b.length) {
                            var h = WPSVPUtils.strip(b[0].split(" --\x3e ")[0]);
                            var f = WPSVPUtils.strip(b[0].split(" --\x3e ")[1]);
                            b = b[1];
                            Eb[c] = {};
                            Eb[c].start = WPSVPUtils.toSeconds(h);
                            Eb[c].end = WPSVPUtils.toSeconds(f);
                            Eb[c].url = b
                        }
                        c++
                    }
                }
            }).fail(function(a, d, c) {
                console.log(a, d, c)
            })
        }

        function th(a) {
            a.preventDefault();
            if (!u) return !1;
            a = c(a.currentTarget);
            if (a.hasClass("wpsvp-playback-toggle") || a.hasClass("wpsvp-big-play")) p.togglePlayback();
            else if (a.hasClass("wpsvp-playlist-toggle")) Yf();
            else if (a.hasClass("wpsvp-info-toggle")) Jc();
            else if (a.hasClass("wpsvp-info-close")) Jc(!1);
            else if (a.hasClass("wpsvp-embed-toggle")) nd();
            else if (a.hasClass("wpsvp-share-close")) Kc(!1);
            else if (a.hasClass("wpsvp-pwd-confirm")) {
                var d = de.val();
                if (WPSVPUtils.isEmpty(d)) alert(Ve);
                else if ("undefined" === typeof md5) {
                    a = document.createElement("script");
                    a.type = "text/javascript";
                    a.src = WPSVPUtils.qualifyURL(La + "js/scripts/md5.min.js");
                    a.onload = a.onreadystatechange = function() {
                        this.readyState && "complete" != this.readyState || (md5(d) !=
                            k.pwd ? alert(Ve) : (delete k.pwd, od.hide(), de.val(""), "video" == f && E ? va() : Xb(!0)))
                    };
                    a.onerror = function() {
                        alert("Error loading " + this.src)
                    };
                    var b = document.getElementsByTagName("script")[0];
                    b.parentNode.insertBefore(a, b)
                } else md5(d) != k.pwd ? alert(Ve) : (delete k.pwd, od.hide(), de.val(""), "video" == f && E ? va() : Xb(!0))
            } else if (a.hasClass("wpsvp-embed-close")) nd(!1);
            else if (a.hasClass("wpsvp-previous-toggle")) kd();
            else if (a.hasClass("wpsvp-next-toggle")) Vb();
            else if (a.hasClass("wpsvp-loop-toggle")) N.setLooping();
            else if (a.hasClass("wpsvp-shuffle-toggle")) N.setRandom();
            else if (a.hasClass("wpsvp-rewind-toggle")) p.seek(0);
            else if (a.hasClass("wpsvp-seek-backward")) p.seekBackward();
            else if (a.hasClass("wpsvp-seek-forward")) p.seekForward();
            else if (a.hasClass("wpsvp-share-toggle")) Kc();
            else if (a.hasClass("wpsvp-pip-toggle"))
                if (Zf)
                    if (document.pictureInPictureElement) try {
                        document.exitPictureInPicture()
                    } catch (x) {} else try {
                        m.requestPictureInPicture()
                    } catch (x) {} else m.webkitSupportsPresentationMode && "function" === typeof m.webkitSetPresentationMode && m.webkitSetPresentationMode("picture-in-picture" ===
                        m.webkitPresentationMode ? "inline" : "picture-in-picture");
                    else a.hasClass("wpsvp-share-item") && z(a.attr("data-type").toLowerCase());
            G && (ha && clearTimeout(ha), ha = setTimeout(function() {
                clearTimeout(this);
                ha = null;
                Lc()
            }, 4E3))
        }

        function $f(a) {
            a.preventDefault();
            if (!u) return !1;
            a = c(a.currentTarget);
            if (X && X.is(a)) return !1;
            We = !0;
            a = r.find(".wpsvp-playlist-item").index(a);
            N.processPlaylistRequest(a);
            c(p).trigger("clickPlaylistItem", {
                instance: p,
                instanceName: M
            });
            ag ? (a = I.offset().top, ua.scrollTop() > a && c("html,body").animate({
                    scrollTop: a
                },
                500)) : G && J.hasClass("wpsvp-playlist-holder-bottom") && (a = I.offset().top, ua.scrollTop() > a && c("html,body").animate({
                scrollTop: a
            }, 500))
        }

        function bg(a) {
            a.preventDefault();
            if (!u) return !1;
            a = c(a.currentTarget);
            if (!G && a.attr("data-hover-preview")) {
                var d = a.find(".wpsvp-thumbimg");
                d.attr("data-src", d.attr("src")).attr("src", a.attr("data-hover-preview"))
            }
            if (X && X.is(a)) return !1;
            a.addClass("wpsvp-playlist-item-selected")
        }

        function cg(a) {
            a.preventDefault();
            if (!u) return !1;
            a = c(a.currentTarget);
            if (!G && a.attr("data-hover-preview")) {
                var d =
                    a.find(".wpsvp-thumbimg");
                d.attr("src", d.attr("data-src"))
            }
            if (X && X.is(a)) return !1;
            a.removeClass("wpsvp-playlist-item-selected")
        }

        function pd() {
            X.removeClass("wpsvp-playlist-item-selected");
            c(p).trigger("playlistItemEnabled", {
                instance: p,
                instanceName: M
            });
            X = null
        }

        function zh() {
            X && pd();
            tb = N.getCounter();
            X = r.children(".wpsvp-playlist-item").eq(tb);
            if (X.length) {
                X.addClass("wpsvp-playlist-item-selected");
                if (Ib && 0 < A) {
                    if (!We)
                        if ("scroll" == eb)
                            if ("undefined" !== typeof mCustomScrollbar) "horizontal" == ya ? ia.mCustomScrollbar("scrollTo",
                                parseInt(X.position().left), {
                                    scrollInertia: 500
                                }) : ia.mCustomScrollbar("scrollTo", parseInt(X.position().top), {
                                scrollInertia: 500
                            });
                            else var a = setInterval(function() {
                                "undefined" !== typeof mCustomScrollbar && (clearInterval(a), "horizontal" == ya ? ia.mCustomScrollbar("scrollTo", parseInt(X.position().left), {
                                    scrollInertia: 500
                                }) : ia.mCustomScrollbar("scrollTo", parseInt(X.position().top), {
                                    scrollInertia: 500
                                }))
                            }, 500);
                    else if ("buttons" == eb) {
                        if ("horizontal" == ya) var d = J.width(),
                            b = r.width(),
                            x = "translateX";
                        else d = J.height(),
                            b = r.height(), x = "translateY";
                        if (b < d) return;
                        Qa.show();
                        Ma.show();
                        var h = -r.find(".wpsvp-playlist-item").index(X) * wa;
                        0 <= h ? (h = 0, Qa.hide()) : h <= d - b && (h = d - b, Ma.hide());
                        Ra = h;
                        r.one("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function() {
                            Yb = !1
                        }).css({
                            "-webkit-transform": "" + x + "(" + h + "px)",
                            "-ms-transform": "" + x + "(" + h + "px)",
                            transform: "" + x + "(" + h + "px)"
                        })
                    }
                    We = !1
                }
                c(p).trigger("playlistItemDisabled", {
                    instance: p,
                    instanceName: M
                })
            }
        }

        function dg(a) {
            a.preventDefault();
            if (!u || !f || !ub || "youtube" == f && "default" ==
                la || "vimeo" == f && "default" == ba) return !1;
            Jb()
        }

        function eg(a) {
            if (a.relatedTarget || a.toElement) {
                a.preventDefault();
                if (!u || !f || "youtube" == f && "default" == la || "vimeo" == f && "default" == ba) return !1;
                T && Lc()
            }
        }

        function Jb() {
            !k || !pa || Q || "youtube" == f && "default" == la || "vimeo" == f && "default" == ba || (Ja.addClass("wpsvp-interface-visible"), qa && Kb.addClass("wpsvp-subtitle-bottom"), ub = !1, G && (ha && clearTimeout(ha), ha = setTimeout(function() {
                clearTimeout(this);
                ha = null;
                Lc()
            }, 4E3)))
        }

        function Lc() {
            !T || Q || "youtube" == f && "default" == la || "vimeo" ==
                f && "default" == ba || (Ja.removeClass("wpsvp-interface-visible"), qa && Kb.removeClass("wpsvp-subtitle-bottom"), U.hide(), qd.removeClass("wpsvp-menu-bottom"), rd.removeClass("wpsvp-menu-bottom"), sd.removeClass("wpsvp-menu-bottom"), Ec.css("opacity", 0), ub = !0)
        }

        function td(a) {
            ha && clearTimeout(ha);
            a && (fg != a.clientX && (Jb(), document.body.style.cursor = "default"), fg = a.clientX);
            ha = setTimeout(function() {
                clearTimeout(this);
                ha = null;
                T && (Lc(), document.body.style.cursor = "none")
            }, 4E3)
        }

        function Jc(a) {
            if ("undefined" !== typeof a) {
                if (ib &&
                    1 == a || !ib && 0 == a) return !1;
                ib = !a
            }
            vb && nd(!1);
            jb && Kc(!1);
            bb && (P.hide().removeClass("wpsvp-menu-bottom").find(".wpsvp-settings-menu").css("display", "none"), cb.show());
            ib ? (Xe.hide(), wb && (p.playMedia(), wb = !1)) : (T && (p.pauseMedia(), wb = !0), Xe.show());
            ib = !ib
        }

        function Kc(a) {
            if ("undefined" !== typeof a) {
                if (jb && 1 == a || !jb && 0 == a) return !1;
                jb = !a
            }
            ib && Jc(!1);
            vb && nd(!1);
            bb && (P.hide().removeClass("wpsvp-menu-bottom").find(".wpsvp-settings-menu").css("display", "none"), cb.show());
            jb ? (Ye.hide(), wb && (p.playMedia(), wb = !1)) : (T && (p.pauseMedia(),
                wb = !0), Ye.show());
            jb = !jb
        }

        function nd(a) {
            if ("undefined" !== typeof a) {
                if (vb && 1 == a || !vb && 0 == a) return !1;
                vb = !a
            }
            ib && Jc(!1);
            jb && Kc(!1);
            bb && (P.hide().removeClass("wpsvp-menu-bottom").find(".wpsvp-settings-menu").css("display", "none"), cb.show());
            vb ? (Ze.hide(), Zb.text(Zb.attr("data-copy-text")), Lb.text(Lb.attr("data-copy-text")), wb && (p.playMedia(), wb = !1)) : (T && (p.pauseMedia(), wb = !0), Ze.show());
            vb = !vb
        }

        function gg(a) {
            Y = !0;
            xb.show();
            $b ? $e() : r.find(".wpsvp-playlist-item, .wpsvp-global-playlist-data").remove();
            var d = hg ? c(hg).find(a) :
                c(a);
            if (0 == d.length) return alert("Failed playlist selection! Playlist - " + a + " does not exist. Check activePlaylist option in settings!"), !1;
            d.find(".wpsvp-global-playlist-data").length && (ja = d.find(".wpsvp-global-playlist-data"), ja.find(".wpsvp-ad-section").length && (ud = ja.find(".wpsvp-ad-section")), ja.find(".wpsvp-annotation-section").length && (vd = ja.find(".wpsvp-annotation-section")), void 0 != ja.attr("data-upnext-time") && (wd = parseInt(ja.attr("data-upnext-time"), 10)), void 0 != ja.attr("data-pwd") && (xd = ja.attr("data-pwd")),
                void 0 != ja.attr("data-display-poster-on-mobile") && G && (ac = !0, Mc = yb = yd = R = !1));
            ee = a;
            c(p).trigger("playlistStartLoad", {
                instance: p,
                instanceName: M
            });
            zd = -1;
            ma = [];
            Sa = [];
            if (void 0 != d.attr("data-type") && "xml" == d.attr("data-type")) Ah(Mb(d));
            else {
                var b, x, h;
                d.children(".wpsvp-playlist-item").each(function() {
                    x = c(this);
                    h = x.attr("data-type");
                    RegExp(/^image|^audio|^video|^hls|^dash/).test(h) ? Sa.push(x.clone()) : void 0 != x.attr("data-noapi") ? Sa.push(x.clone()) : (b = Mb(x), Sa.push(b))
                });
                A = Sa.length;
                Da()
            }
        }

        function Na(a) {
            "youtube" ==
            a ? (ra = new WPSVPYoutubeLoader(b), c(ra).on("WPSVPYoutubeLoader.END_LOAD", function(a, c) {
                var d, b = c.data.length;
                for (d = 0; d < b; d++) {
                    var F = c.data[d];
                    ma.push(F)
                }
                ca = c.nextPageToken;
                kb ? af() : Da()
            }), Nb && ca && (ra.setDataFromCache(Mb(c(Nb))), fe = !1)) : "vimeo" == a && (xa = new WPSVPVimeoLoader(b), c(xa).on("WPSVPVimeoLoader.END_LOAD", function(a, c) {
                var d, b = c.data.length;
                for (d = 0; d < b; d++) {
                    var F = c.data[d];
                    ma.push(F)
                }
                ca = c.nextPageToken;
                kb ? af() : Da()
            }), Nb && ca && (xa.setDataFromCache(Mb(c(Nb))), fe = !1))
        }

        function Da() {
            zd++;
            if (zd > A - 1) af();
            else {
                var a =
                    Sa[zd],
                    d = a.type;
                d ? RegExp(/^youtube/).test(d) ? (bf = "youtube", ra || Na("youtube"), ra.setData(a)) : RegExp(/^vimeo/).test(d) ? (bf = "vimeo", xa || Na("vimeo"), xa.setData(a)) : RegExp(/^folder/).test(d) ? Bh(a) : RegExp(/^iframe/).test(d) ? (ma.push(a), Da()) : RegExp(/^image|^audio|^video|^hls|^dash/).test(d) && (ma.push(a), Da()) : (ma.push(a), Da())
            }
        }

        function Bh(a) {
            if ("file:" == window.location.protocol) return console.log("Reading files from folders locally is not possible! This requires online server connection."), Da(), !1;
            var d =
                a.type;
            if ("folder_video" == d) var b = ["mp4"];
            else "folder_audio" == d ? (a.id3 && (cf = sc = ma.length - 1), b = ["mp3", "wav"]) : "folder_image" == d && (b = ["jpg", "jpeg", "png", "gif"]);
            c.ajax({
                type: "GET",
                url: La + "includes/folder_parser.php",
                data: {
                    type: b,
                    dir: a.path,
                    limit: a.limit || 100
                },
                dataType: "json"
            }).done(function(b) {
                WPSVPUtils.keysrt(b, "filename");
                var h, F = b.length;
                for (h = 0; h < F; h++) {
                    var x = b[h];
                    if ("folder_audio" == d) {
                        if (/mp3|wav/.test(x.basename)) {
                            var f = c.extend(!0, {}, a);
                            f.type = "audio";
                            f.origtype = "folder_audio";
                            var e = x.fullpath;
                            var g = {};
                            f.path = [(g.quality = "default", g[x.extension] = e, g)]; /**********************f.poster=e.substr(0,e.lastIndexOf("/")+1)+"poster/"+x.filename+".jpg";f.thumb||(f.thumb=f.poster.replace(/\/poster\//,"/thumb/"));************************************/
                            f.share || (f.share = e);
                            f.title || (f.title = x.filename);
                            ma.push(f);
                            sc++
                        }
                    } else "folder_video" == d ? /mp4/.test(x.basename) && (f = c.extend(!0, {}, a), f.type = "video", f.origtype = "folder_video", e = x.fullpath, f.path = [{
                            quality: "default",
                            mp4: e
                        }],
                        /*****************************f.poster=e.substr(0,e.lastIndexOf("/")+1)+"poster/"+x.filename+".jpg",f.thumb||(f.thumb=
                        f.poster.replace(/\/poster\//,"/thumb/")),*****************************/
                        f.share || (f.share = e), f.title || (f.title = x.filename), ma.push(f)) : "folder_image" == d && /jpg|jpeg|png|gif/.test(x.basename) && (f = c.extend(!0, {}, a), f.type = "image", f.origtype = "folder_image", e = x.fullpath, f.path = [{
                        quality: "default",
                        image: e
                    }], f.thumb || (f.thumb = e.substr(0, e.lastIndexOf("/") + 1) + "thumb/" + x.filename + ".jpg"), f.share || (f.share = e), f.title || (f.title = x.filename), ma.push(f))
                }
                "folder_audio" == d ? a.id3 ? ge() : Da() : Da()
            }).fail(function(a, d, c) {
                console.log(a, d, c);
                Da()
            })
        }

        function ge() {
            if ("undefined" === typeof jsmediatags) {
                var a = document.createElement("script");
                a.type = "text/javascript";
                a.src = WPSVPUtils.qualifyURL(La + "js/scripts/jsmediatags.min.js");
                a.onload = a.onreadystatechange = function() {
                    this.readyState && "complete" != this.readyState || ge()
                };
                a.onerror = function() {
                    alert("Error loading " + this.src)
                };
                var d = document.getElementsByTagName("script")[0];
                d.parentNode.insertBefore(a, d)
            } else {
                var c = ma[sc];
                jsmediatags.read(c.path[0].mp3 || c.path[0].wav, {
                    onSuccess: function(a) {
                        var d = a.tags;
                        a = d.picture;
                        d.artist && (c.artist = d.artist);
                        d.title && (c.title = d.title);
                        d.album && (c.album = d.album);
                        if (a) {
                            d = "";
                            var b, F = a.data.length;
                            for (b = 0; b < F; b++) d += String.fromCharCode(a.data[b]);
                            c.thumb = "data:" + a.format + ";base64," + window.btoa(d)
                        }
                        sc--;
                        sc > cf ? ge() : Da()
                    },
                    onError: function(a) {
                        console.log("ID3 error: ", a.type, a.info);
                        sc--;
                        sc > cf ? ge() : Da()
                    }
                })
            }
        }

        function Ah(a) {
            c.ajax({
                type: "GET",
                url: a.path,
                dataType: "html"
            }).done(function(a) {
                var d, b, h;
                c(a).children(".wpsvp-playlist-item").each(function() {
                    d = c(this);
                    b = d.attr("data-type");
                    RegExp(/^image|^audio|^video|^hls|^dash/).test(b) ? Sa.push(d) : void 0 != d.attr("data-noapi") ? Sa.push(d) : (h = Mb(d), Sa.push(h))
                });
                A = Sa.length;
                Da()
            }).fail(function(a, c, b) {
                console.log(a, c, b);
                Da()
            })
        }

        function af() {
            var a, d = ma.length,
                b, f = 0;
            for (a = 0; a < d; a++) {
                Nc && f++;
                var h = ma[a];
                var e = h.type;
                if (h instanceof c && h.hasClass("wpsvp-playlist-item")) e = h;
                else {
                    h.origclasses || (h.origclasses = "wpsvp-playlist-item");
                    e = c('<div class="' + h.origclasses + '"/>').attr("data-type", e);
                    delete h.origclasses;
                    var g = null;
                    if ("youtube" == h.type) h.snippet.thumbnails &&
                        (h.snippet.thumbnails.medium ? g = h.snippet.thumbnails.medium.url : h.snippet.thumbnails.high ? g = h.snippet.thumbnails.high.url : h.snippet.thumbnails.standard && (g = h.snippet.thumbnails.standard.url));
                    else if ("vimeo" == h.type) {
                        var k = h.pictures.sizes;
                        var l = k.length;
                        for (b = 0; b < l; b++)
                            if (295 == k[b].width) {
                                g = k[b].link;
                                break
                            } else if (640 == k[b].width) {
                            g = k[b].link;
                            break
                        }
                    } else g = h.thumb;
                    g || (g = h.thumbDefault);
                    g && (b = c("<div/>").addClass("wpsvp-playlist-thumb").appendTo(e), k = h.alt ? h.alt : h.title ? h.title.replace(/"/g, "'") : "image",
                        c(new Image).addClass("wpsvp-thumbimg").appendTo(b).attr({
                            src: g,
                            alt: k
                        }), e.attr("data-thumb", g));
                    if (h.title || h.description || h.publishedAt)
                        for (g = c('<div class="wpsvp-playlist-info"></div>').appendTo(e), b = ig.length, k = 0; k < b; k++) l = ig[k], "title" == l && h.title ? (l = h.title.replace(/"/g, "'"), c('<span class="wpsvp-playlist-title">' + l + "</span>").appendTo(g), e.attr("data-title", l)) : "date" == l && h.publishedAt ? (l = new Date(h.publishedAt), l = l.getMonth() + 1 + "/" + l.getDate() + "/" + l.getFullYear(), c('<span class="wpsvp-playlist-published-date">' +
                            l + "</span>").appendTo(g)) : "description" == l && h.description && (l = h.description.replace(/"/g, "'"), e.attr("data-description", l), 0 < jg && (l = l.substr(0, jg) + "..."), c('<span class="wpsvp-playlist-description">' + l + "</span>").appendTo(g));
                    if (h.subtitles)
                        for (g = c('<div class="wpsvp-subtitles"></div>').appendTo(e), b = h.subtitles.length, k = 0; k < b; k++) {
                            l = h.subtitles[k];
                            var m = '<div data-label="' + l.label + '" data-src="' + l.src + '"';
                            m = l["default"] ? m + " data-default></div>" : m + "></div>";
                            c(m).appendTo(g)
                        }
                    if ("iframe" == h.type) e.attr("data-path",
                        h.path);
                    else if ("video" == h.type || "audio" == h.type || "image" == h.type) {
                        b = h.path.length;
                        m = "[";
                        for (k = 0; k < b; k++) l = h.path[k], m += '{"quality": "' + l.quality + '", "' + l.ext + '": "' + l.src + '"}', k < b - 1 && (m += ",");
                        m += "]";
                        e.attr("data-path", m);
                        h.defaultQuality && e.attr("data-quality", h.defaultQuality)
                    }
                    h.deeplink && e.attr("data-deeplink", h.deeplink);
                    h.id && e.attr("data-path", h.id);
                    h.mp4 && e.attr("data-mp4", h.mp4);
                    h.poster && e.attr("data-poster", h.poster);
                    h.download && e.attr("data-download", h.download);
                    h.share && e.attr("data-share",
                        h.share);
                    h.duration && e.attr("data-duration", h.duration);
                    h.start && e.attr("data-start", h.start);
                    h.end && e.attr("data-end", h.end);

                    /*  added by Boldman*/
                    h.randomClipTime && e.attr("data-random-clip-time", h.randomClipTime);

                    h.aspectRatio && e.attr("data-aspect-ratio", h.aspectRatio);
                    h.playbackRate && e.attr("data-playback-rate", h.playbackRate);
                    h.quality && e.attr("data-quality", h.quality);
                    h.origtype && ("folder_audio" == h.origtype || "folder_video" == h.origtype || "folder_image" == h.origtype) && e.attr("data-path", JSON.stringify(h.path));
                    h.width && e.attr("data-width", h.width);
                    h.height && e.attr("data-height", h.height);
                    h.is360 && e.attr("data-is360", "1");
                    h.customContent && (e.append(h.customContent), delete h.customContent);
                    h.previewSeek && e.attr("data-preview-seek", h.previewSeek);
                    h.chapters && e.attr("data-chapters", h.chapters);
                    h.endLink && (e.attr("data-end-link", h.endLink), h.endTarget && e.attr("data-end-target", h.endTarget));
                    h.user && h.user.account && e.attr("data-user-account", h.user.account);
                    h.pwd && e.attr("data-pwd", h.pwd);
                    h.liveStream && e.attr("data-live-stream", h.liveStream)
                }
                if (Nc) {
                    n ? n.after(e) : Oc ? e.appendTo(r) : r.children("div").eq(Ta).before(e);
                    var n = e
                } else e.appendTo(r);
                if (Ib && (e.on("click", $f), !G)) e.on("mouseenter", bg).on("mouseleave", cg)
            }
            $b = "exist";
            A = r.children(".wpsvp-playlist-item").length;
            console.log("playlistLength = ", A);
            "horizontal" == ya && r.width(A * wa);
            Nc ? (a = N.getCounter(), N.setPlaylistItems(A, !1), Ta <= a && (Oc || N.reSetCounter(a + f)), he && !G && (R = !0), ie ? (ie = !1, N.setCounter(Ta, !1)) : he && (lb = !1, N.setCounter(Ta, !1))) : N.setPlaylistItems(A);
            c(p).trigger("playlistEndLoad", {
                instance: p,
                instanceName: M,
                nextPageToken: ca
            });
            Ch()
        }

        function je() {
            if ("scroll" ==
                eb) {
                if ("undefined" === typeof mCustomScrollbar) {
                    if (window.playlistScrollLoading) {
                        setInterval(function() {
                            playlistScrollLoading || (clearInterval(this), je())
                        }, 100);
                        return
                    }
                    window.playlistScrollLoading = !0;
                    var a = document.createElement("script");
                    a.type = "text/javascript";
                    a.src = WPSVPUtils.qualifyURL(La + "js/scripts/jquery.mCustomScrollbar.concat.min.js");
                    a.onload = a.onreadystatechange = function() {
                        this.readyState && "complete" != this.readyState || (je(), window.playlistScrollLoading = !1)
                    };
                    a.onerror = function() {
                        alert("Error loading " +
                            this.src)
                    };
                    var d = document.getElementsByTagName("script")[0];
                    d.parentNode.insertBefore(a, d);
                    return
                }
                ia.mCustomScrollbar({
                    axis: "horizontal" == ya ? "x" : "y",
                    theme: b.playlistScrollTheme,
                    scrollInertia: 0,
                    scrollButtons: {
                        enable: !0
                    },
                    mouseWheel: {
                        normalizeDelta: !0,
                        deltaFactor: 50,
                        preventDefault: !0
                    },
                    keyboard: {
                        enable: !1
                    },
                    advanced: {
                        autoExpandHorizontalScroll: !0
                    },
                    callbacks: {
                        onOverflowYNone: function() {
                            ia.find(".mCSB_container").addClass("wpsvp-mCSB_full")
                        },
                        onOverflowY: function() {
                            ia.find(".mCSB_container").removeClass("wpsvp-mCSB_full")
                        },
                        onTotalScroll: function() {
                            Ob && ca && !Y && (Y = !0, xb.show(), kb = !0, ma = [], "youtube" == f ? (ra || Na("youtube"), ra.resumeLoad(ca)) : "vimeo" == f && (xa || Na("vimeo"), xa.resumeLoad(ca)))
                        },
                        alwaysTriggerOffsets: !1
                    }
                })
            } else if ("buttons" == eb) {
                if (!G) ia.on("mousewheel DOMMouseScroll", function(a) {
                    if (!u || Y || !bc) return !1;
                    if ("horizontal" == ya) var d = ia.width(),
                        c = r.width(),
                        b = "translateX";
                    else d = ia.height(), c = r.height(), b = "translateY";
                    if (!(c < d)) {
                        Qa.show();
                        Ma.show();
                        if (a.originalEvent.wheelDelta) var e = 0 < a.originalEvent.wheelDelta ? 1 : -1;
                        else a.originalEvent.detail && (e = 0 > a.originalEvent.detail ? 1 : -1);
                        Ra ? a = Ra : (a = r[0].style.transform.replace(/[^\d.]/g, ""), a = parseInt(a) || 0);
                        a += Dh * e;
                        0 < a ? (a = 0, Qa.hide()) : a <= d - c && (a = d - c, Ma.hide(), Ob && ca && !Y && (Y = !0, xb.show(), kb = !0, ma = [], "youtube" == f ? (ra || Na("youtube"), ra.resumeLoad(ca)) : "vimeo" == f && (xa || Na("vimeo"), xa.resumeLoad(ca))));
                        Ra = a;
                        r.css({
                            "-webkit-transform": "" + b + "(" + a + "px)",
                            "-ms-transform": "" + b + "(" + a + "px)",
                            transform: "" + b + "(" + a + "px)"
                        });
                        return !1
                    }
                });
                Qa.on("click", function() {
                    if (!u || Y || Yb) return !1;
                    Yb = !0;
                    if ("horizontal" == ya) var a = ia.width(),
                        d = r.width(),
                        c = "translateX";
                    else a = ia.height(), d = r.height(), c = "translateY";
                    if (!(d < a)) {
                        Qa.show();
                        Ma.show();
                        Ra ? d = Ra : (d = r[0].style.transform.replace(/[^\d.]/g, ""), d = parseInt(d) || 0);
                        if (0 != d % wa) {
                            for (var b = -(d % wa + wa); b <= a - wa;) b += wa;
                            d += b
                        } else d += wa * Math.floor(a / wa);
                        0 <= d && (d = 0, Qa.hide());
                        Ra = d;
                        r.one("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function() {
                            Yb = !1
                        }).css({
                            "-webkit-transform": "" + c + "(" + d + "px)",
                            "-ms-transform": "" + c + "(" + d + "px)",
                            transform: "" +
                                c + "(" + d + "px)"
                        })
                    }
                });
                Ma.on("click", function() {
                    if (!u || Y || Yb) return !1;
                    Yb = !0;
                    if ("horizontal" == ya) var a = ia.width(),
                        d = r.width(),
                        c = "translateX";
                    else a = ia.height(), d = r.height(), c = "translateY";
                    if (!(d < a)) {
                        Qa.show();
                        Ma.show();
                        if (Ra) var b = Ra;
                        else b = r[0].style.transform.replace(/[^\d.]/g, ""), b = parseInt(b) || 0;
                        if (0 != b % wa) {
                            for (var e = b % wa + wa; e <= a - wa;) e += wa;
                            b -= e
                        } else b -= wa * Math.floor(a / wa);
                        b <= a - d && (b = a - d, Ma.hide(), Ob && ca && !Y && (Y = !0, xb.show(), kb = !0, ma = [], "youtube" == f ? (ra || Na("youtube"), ra.resumeLoad(ca)) : "vimeo" == f &&
                            (xa || Na("vimeo"), xa.resumeLoad(ca))));
                        Ra = b;
                        r.one("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function() {
                            Yb = !1
                        }).css({
                            "-webkit-transform": "" + c + "(" + b + "px)",
                            "-ms-transform": "" + c + "(" + b + "px)",
                            transform: "" + c + "(" + b + "px)"
                        })
                    }
                });
                kg && lg()
            } else if ("hover" == eb) {
                if (!G) ia.on("mousemove", function(a) {
                    if (!u || Y || !bc) return !1;
                    if ("horizontal" == ya) {
                        var d = J.width(),
                            c = r.width();
                        if (c < d) return;
                        var b = parseInt(ia.css("left"), 10) + J.offset().left;
                        a = (d - c) / d * (a.pageX - b);
                        r.css("left", a + "px")
                    } else {
                        d = J.height();
                        c = r.height();
                        if (c < d) return;
                        b = parseInt(ia.css("top"), 10) + J.offset().top;
                        a = (d - c) / d * (a.pageY - b);
                        r.css("top", a + "px")
                    }
                    return !1
                });
                kg && lg()
            }
            df = !0
        }

        function lg() {
            var a, d, c, b, e, g = !1;
            r.off("touchstart.ap touchmove.ap touchend.ap click.ap-touchclick").on("touchstart.ap", function(h) {
                if (!u || Y) return !1;
                h = h.originalEvent.touches[0];
                a = r.position().left;
                d = r.position().top;
                c = h.pageX;
                b = h.pageY;
                e = !1;
                g = !0
            }).on("touchmove.ap", function(h) {
                if (g) {
                    h = h.originalEvent.touches[0];
                    Qa.show();
                    Ma.show();
                    if ("horizontal" == ya) {
                        var F =
                            a - c + h.pageX,
                            k = J.width(),
                            x = r.width();
                        if (x < k) return;
                        0 < F ? (F = 0, Qa.hide()) : F <= k - x && (F = k - x, Ma.hide(), Ob && ca && !Y && (Y = !0, xb.show(), kb = !0, ma = [], "youtube" == f ? (ra || Na("youtube"), ra.resumeLoad(ca)) : "vimeo" == f && (xa || Na("vimeo"), xa.resumeLoad(ca))));
                        r.css("left", F + "px")
                    } else {
                        F = d - b + h.pageY;
                        k = J.height();
                        x = r.height();
                        if (x < k) return;
                        0 < F ? (F = 0, Qa.hide()) : F <= k - x && (F = k - x, Ma.hide(), Ob && ca && !Y && (Y = !0, xb.show(), kb = !0, ma = [], "youtube" == f ? (ra || Na("youtube"), ra.resumeLoad(ca)) : "vimeo" == f && (xa || Na("vimeo"), xa.resumeLoad(ca))));
                        r.css("top", F + "px")
                    }
                    e = e || 5 < Math.abs(c - h.pageX) || 5 < Math.abs(b - h.pageY);
                    return !1
                }
            }).on("touchend.ap", function(a) {
                g = !1
            }).on("click.ap-touchclick", function(a) {
                if (e) return e = !1
            })
        }

        function Ch() {
            xb.hide();
            Y = !1;
            if (!u) {
                u = !0;
                if (mg) {
                    var a = document.createElement("script");
                    a.type = "text/javascript";
                    a.src = WPSVPUtils.qualifyURL(La + "js/scripts/jquery-ui.min.js");
                    a.onload = a.onreadystatechange = function() {
                        if (!this.readyState || "complete" == this.readyState) {
                            var a = document.createElement("script");
                            a.type = "text/javascript";
                            a.src = WPSVPUtils.qualifyURL(La + "js/scripts/jquery.ui.touch-punch.min.js");
                            a.onload = a.onreadystatechange = function() {
                                this.readyState && "complete" != this.readyState || r.sortable()
                            };
                            a.onerror = function() {
                                alert("Error loading " + this.src)
                            };
                            var d = document.getElementsByTagName("script")[0];
                            d.parentNode.insertBefore(a, d)
                        }
                    };
                    a.onerror = function() {
                        alert("Error loading " + this.src)
                    };
                    var d = document.getElementsByTagName("script")[0];
                    d.parentNode.insertBefore(a, d)
                }
                Ib && !df && je();
                if (!G) I.on("mouseenter", dg).on("mouseleave",
                    eg);
                tc();
                c(p).trigger("setupDone", {
                    instance: p,
                    instanceName: M
                });
                e.css("opacity", 1);
                ke && (ef = WPSVPUtils.getElementOffsetTop(e[0]), ua.on(ng, function() {
                    Pc || (Pc = !0, og(), setTimeout(function() {
                        Pc = !1
                    }, 100))
                }))
            }
            Qc && Ad && !fe && pg();
            if (Ib) {
                qg && (rg(), ff = cc, r.find(".wpsvp-playlist-item").each(function() {
                    if (0 < Ea) {
                        var a = 100 / cc;
                        c(this).css({
                            marginLeft: 0,
                            marginTop: 0,
                            marginRight: Ea + "px",
                            marginBottom: Ea + "px",
                            width: "calc(" + a + "% - " + Ea + "px)"
                        })
                    } else c(this).css({
                        marginLeft: 0,
                        marginTop: 0,
                        marginRight: Ea + "px",
                        marginBottom: Ea + "px",
                        width: 100 / cc + "%"
                    })
                }));
                var f = [];
                r.find(".wpsvp-thumbimg:not(.wpsvp-visible)").each(function() {
                    f.push(c(this))
                });
                var g = 0;
                a = f.length;
                for (d = 0; d < a; d++) setTimeout(function() {
                    clearTimeout(this);
                    f[g].addClass("wpsvp-visible");
                    g++
                }, 50 + 50 * d);
                b.truncatePlaylistDescription && ("undefined" !== typeof c.fn.dotdotdot ? r.find(".wpsvp-playlist-info:not(.is-truncated)").each(function() {
                    c(this).dotdotdot({
                        watch: b.truncateWatch
                    })
                }) : (a = document.createElement("script"), a.type = "text/javascript", a.src = WPSVPUtils.qualifyURL(La + "js/scripts/jquery.dotdotdot.min.js"),
                    a.onload = a.onreadystatechange = function() {
                        this.readyState && "complete" != this.readyState || r.find(".wpsvp-playlist-info:not(.is-truncated)").each(function() {
                            c(this).dotdotdot({
                                watch: b.truncateWatch
                            })
                        })
                    }, a.onerror = function() {
                        alert("Error loading " + this.src)
                    }, d = document.getElementsByTagName("script")[0], d.parentNode.insertBefore(a, d)))
            }!le && !Nc && 0 < A && (a = b.activeItem, a > A - 1 && (a = A - 1), -1 < a && N.setCounter(a, !1), le = !0);
            Nc = !1;
            kb && (kb = !1, "buttons" == eb && Ma.show())
        }

        function rg() {
            var a = e.width(),
                d, c = Bd.length;
            for (d =
                0; d < c; d++) {
                var b = Bd[d];
                a > b.width && (cc = b.column, Ea = b.gutter)
            }
            ia.css({
                paddingTop: Ea + "px",
                paddingLeft: Ea + "px"
            })
        }

        function Eh() {
            r.find(".wpsvp-global-playlist-data").length && (ja = r.find(".wpsvp-global-playlist-data").remove(), ja.find(".wpsvp-ad-section").length && (ud = ja.find(".wpsvp-ad-section")), ja.find(".wpsvp-annotation-section").length && (vd = ja.find(".wpsvp-annotation-section")), void 0 != ja.attr("data-upnext-time") && (wd = parseInt(ja.attr("data-upnext-time"), 10)), void 0 != ja.attr("data-pwd") && (xd = ja.attr("data-pwd")),
                void 0 != ja.attr("data-display-poster-on-mobile") && G && (ac = !0, Mc = yb = yd = R = !1));
            A = r.children(".wpsvp-playlist-item").length;
            console.log("playlistLength: ", A);
            if (0 < A) {
                r.find(".wpsvp-playlist-item").each(function() {
                    var a = c(this).on("click", $f);
                    if (!G) a.on("mouseenter", bg).on("mouseleave", cg)
                });
                N.setPlaylistItems(A);
                $b = "exist";
                "horizontal" == ya && r.width(A * wa);
                var a = [];
                r.find(".wpsvp-thumbimg:not(.wpsvp-visible)").each(function() {
                    a.push(c(this))
                });
                var d = 0,
                    f = a.length,
                    g;
                for (g = 0; g < f; g++) setTimeout(function() {
                    clearTimeout(this);
                    a[d].addClass("wpsvp-visible");
                    d++
                }, 50 + 50 * g);
                b.truncatePlaylistDescription && ("undefined" !== typeof c.fn.dotdotdot ? r.find(".wpsvp-playlist-info:not(.is-truncated)").each(function() {
                    c(this).dotdotdot({
                        watch: b.truncateWatch
                    })
                }) : (f = document.createElement("script"), f.type = "text/javascript", f.src = WPSVPUtils.qualifyURL(La + "js/scripts/jquery.dotdotdot.min.js"), f.onload = f.onreadystatechange = function() {
                        this.readyState && "complete" != this.readyState || r.find(".wpsvp-playlist-info:not(.is-truncated)").each(function() {
                            c(this).dotdotdot({
                                watch: b.truncateWatch
                            })
                        })
                    },
                    f.onerror = function() {
                        alert("Error loading " + this.src)
                    }, g = document.getElementsByTagName("script")[0], g.parentNode.insertBefore(f, g)))
            }
            if (!u) {
                u = !0;
                mg && (f = document.createElement("script"), f.type = "text/javascript", f.src = WPSVPUtils.qualifyURL(La + "js/scripts/jquery-ui.min.js"), f.onload = f.onreadystatechange = function() {
                    if (!this.readyState || "complete" == this.readyState) {
                        var a = document.createElement("script");
                        a.type = "text/javascript";
                        a.src = WPSVPUtils.qualifyURL(La + "js/scripts/jquery.ui.touch-punch.min.js");
                        a.onload =
                            a.onreadystatechange = function() {
                                this.readyState && "complete" != this.readyState || r.sortable({
                                    helper: "clone"
                                })
                            };
                        a.onerror = function() {
                            alert("Error loading " + this.src)
                        };
                        var d = document.getElementsByTagName("script")[0];
                        d.parentNode.insertBefore(a, d)
                    }
                }, f.onerror = function() {
                    alert("Error loading " + this.src)
                }, g = document.getElementsByTagName("script")[0], g.parentNode.insertBefore(f, g));
                Ib && !df && je();
                if (!G) I.on("mouseenter", dg).on("mouseleave", eg);
                tc();
                c(p).trigger("setupDone", {
                    instance: p,
                    instanceName: M
                });
                e.css("opacity",
                    1);
                ke && (ef = WPSVPUtils.getElementOffsetTop(e[0]), ua.on(ng, function() {
                    Pc || (Pc = !0, og(), setTimeout(function() {
                        Pc = !1
                    }, 100))
                }))
            }
            xb.hide();
            Y = !1;
            c(p).trigger("playlistEndLoad", {
                instance: p,
                instanceName: M
            });
            f = b.activeItem;
            f > A - 1 && (f = A - 1); - 1 < f && N.setCounter(f, !1);
            le = !0
        }

        function me() {
            WPSVPUtils.isScrolledIntoView(e[0]) ? (R = uc = !0, p.playMedia()) : Rc = setInterval(function() {
                WPSVPUtils.isScrolledIntoView(e[0]) && (clearInterval(Rc), Rc = null, R = uc = !0, p.playMedia())
            }, 400)
        }

        function og() {
            WPSVPUtils.getScrollTop() > ef ? e.hasClass(ne) ||
                e.addClass(ne) : e.hasClass(ne) && e.removeClass(ne);
            tc()
        }

        function Fh() {
            var a = k.path.length;
            k.quality || (k.quality = k.path[0].quality);
            var d = 0;
            a: for (; d < a; d++) {
                var c = k.path[d];
                for (var b in c)
                    if (c[b] == k.quality) {
                        "audio" == f ? sg && c.wav ? da = c.wav : sg && "wav" == c.ext ? da = c.src : tg && c.mp3 ? da = c.mp3 : tg && "mp3" == c.ext && (da = c.src) : "video" == f ? ug && c.mp4 ? da = c.mp4 : ug && "mp4" == c.ext && (da = c.src) : "image" == f && (c.image ? da = c.image : c.src && (da = c.src));
                        break a
                    }
            } - 1 != da.indexOf("ebsfm:") && (da = atob(da.substr(6)))
        }

        function va(a) {
            Cd = a;
            if (f &&
                !lb)
                if (Cd) {
                    Pb = !1;
                    Ua && cancelAnimationFrame(Ua);
                    Oa && clearInterval(Oa);
                    O = null;
                    fb && (fb.removeEventListener("change", oe), fb.reset());
                    if ("audio" == f) t && (O = t.currentTime, t.pause(), t.src = ""), vc && vc.off("ended pause play ratechange loadedmetadata error");
                    else if ("video" == f) {
                        wc && "video_360" == D && Sc && Sc.hide();
                        if (m) {
                            O = m.currentTime;
                            m.pause();
                            try {
                                m.currentTime = 0
                            } catch (sb) {}
                            m.src = "";
                            m = null
                        }
                        za && za.off("ended loadedmetadata ratechange waiting playing play pause error seeked")
                    } else "image" == f && ("image_360" == D ? (Tc &&
                        Tc.hide(), pe = !1) : (gf.hide().find(".wpsvp-media").remove(), xc = null));
                    H.hide();
                    pa = T = !1
                } else dc();
            if (!Cd && !lb) {

                k = qe ? qe : Uc ? Uc : Mb(X);
                qe = null;
                hf ? Vc && (re ? (k = Mb(re), Q = !0) : Wc && Dd && (k = Mb(Wc), Q = !0, Wc = null)) : (hf = !0, ud ? Vc = ud : k.adSection && (Vc = k.adSection), Vc && (Uc = k, Vc.find(".wpsvp-ad").each(function() {
                    var a = c(this);
                    if (a.hasClass("wpsvp-ad-pre")) Q = !0, k = Mb(a);
                    else if (a.hasClass("wpsvp-ad-mid")) {
                        var d = parseInt(a.attr("data-begin"), 10);
                        hb.push({
                            begin: d,
                            data: a
                        })
                    } else a.hasClass("wpsvp-ad-end") && (Wc = a)
                })));

                /*  added by Boldman*/

                // k.start = 3;
                // k.end = 6;


                "youtube_single" == k.type ?
                    k.type = "youtube" : "vimeo_single" == k.type && (k.type = "vimeo");
                f = k.type;
                "video_360" == f ? (f = "video", D = "video_360") : "image_360" == f && (f = "image", D = "image_360");
                Va = void 0 != k.aspectRatio ? k.aspectRatio : b.aspectRatio;
                k.subtitles && Cc();
                if (!jf && !Q && (jf = !0, vd ? Ed = vd : k.annotationSection && (Ed = k.annotationSection), Ed)) {
                    var d = 0;
                    Ed.find(".wpsvp-annotation").each(function() {
                        var a = c(this).clone().attr("data-id", d++).appendTo(ec);
                        a.hasClass("wpsvp-adsense-detail") ? (c('<ins class="adsbygoogle" style="display:inline-block;width:' +
                            a.attr("data-width") + "px;height:" + a.attr("data-height") + 'px" data-ad-client="' + a.attr("data-ad-client") + '" data-ad-slot="' + a.attr("data-ad-slot") + '"></ins>').prependTo(a), se = !0) : a.hasClass("wpsvp-adsense-code") && (se = !0);
                        Xc.push({
                            start: isNaN(parseInt(a.attr("data-show"), 10)) ? 0 : parseInt(a.attr("data-show"), 10),
                            end: isNaN(parseInt(a.attr("data-hide"), 10)) ? 1E5 : parseInt(a.attr("data-hide"), 10),
                            item: a
                        })
                    });
                    ec.show();
                    if (se)
                        if ("undefined" === typeof adsbygoogle) {
                            if ("file:" != window.location.protocol) {
                                var e = document.createElement("script");
                                e.type = "text/javascript";
                                e.src = "//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js";
                                e.onload = e.onreadystatechange = function() {
                                    this.readyState && "complete" != this.readyState || ec.find(".adsbygoogle").each(function() {
                                        (adsbygoogle = window.adsbygoogle || []).push({})
                                    })
                                };
                                e.onerror = function() {
                                    alert("Error loading " + this.src)
                                };
                                a = document.getElementsByTagName("script")[0];
                                a.parentNode.insertBefore(e, a)
                            }
                        } else ec.find(".adsbygoogle").each(function() {
                            (adsbygoogle = window.adsbygoogle || []).push({})
                        })
                }
                k.chapters &&
                    (rh(), Ca.addClass("wpsvp-seekbar-chapters"), Ec.css("display", "block"));
                !G && k.previewSeek && sh();
                if (wd && (a = X.next(), 0 == a.length && b.loopingOn && (a = r.find(".wpsvp-playlist-item").eq(0)), a.length)) {
                    var g;
                    void 0 != a.attr("data-thumb") ? g = a.attr("data-thumb") : a.find(".wpsvp-thumbimg").length && (g = a.find(".wpsvp-thumbimg").attr("src"));
                    var h;
                    void 0 != a.attr("data-title") ? h = a.attr("data-title") : a.find(".wpsvp-playlist-title").length && (h = a.find(".wpsvp-playlist-title").html());
                    if (g || h) g && kf.css("background-image", "url(" + g +
                        ")"), h && lf.html(h), mb.addClass("wpsvp-upnext-on")
                }
                "lightbox" == $a && (nb.css("display", "block"), "normal" == Wa && (g = fc.width() / yc, fc.height(g)), 1 != nb.css("opacity") && setTimeout(function() {
                    clearTimeout(this);
                    nb.css("opacity", 1)
                }, 50));
                if ("audio" == f)
                    if (k.poster && !lb) {
                        lb = !0;
                        c(new Image).addClass("wpsvp-media").appendTo(te.show()).on("load", function() {
                            E = c(this);
                            WPSVPAspectRatio.resizeMedia("image", Va, I, E);
                            E.addClass("wpsvp-visible")
                        }).on("error", function(a) {
                            console.log(a)
                        }).attr("src", k.poster);
                        if (ac) return;
                        if (!R) {
                            H.show();
                            return
                        }
                    } else te.show();
                else if (!("video" != f && "youtube" != f && "vimeo" != f || yb && !uc || R || !k.poster || lb)) {
                    lb = !0;
                    var l;
                    "video" == f ? l = gc : "youtube" == f ? l = hc : "vimeo" == f && (l = "default" == vg ? ue : ve);
                    c(new Image).addClass("wpsvp-media").appendTo(l.show()).on("load", function() {
                        E = c(this);
                        WPSVPAspectRatio.resizeMedia("image", Va, I, E);
                        E.addClass("wpsvp-visible");
                        ac || H.show()
                    }).on("error", function(a) {
                        console.log(a)
                    }).attr("src", k.poster);
                    Q || k.pwd && od.show();
                    return
                }
            }
            lb && (O = k.start || 0, lb = !1);
            Fd && !Q && (O = Fd, Fd = null);
            b.playbackPositionTime &&
                (O = b.playbackPositionTime, delete b.playbackPositionTime);
            if ("audio" == f || "video" == f || "image" == f) {
                if (Fh(), Cd || (l = fa(), we && 1 == l.length || ea(l, k.quality)), ("video_360" == D || "image_360" == D) && "undefined" === typeof THREE) {
                    e = document.createElement("script");
                    e.type = "text/javascript";
                    e.src = WPSVPUtils.qualifyURL(La + "js/scripts/three.min.js");
                    e.onload = e.onreadystatechange = function() {
                        if (!this.readyState || "complete" == this.readyState) {
                            var a = document.createElement("script");
                            a.type = "text/javascript";
                            a.src = WPSVPUtils.qualifyURL(La +
                                "js/scripts/orbitControls.min.js");
                            a.onload = e.onreadystatechange = function() {
                                this.readyState && "complete" != this.readyState || Xb()
                            };
                            a.onerror = function() {
                                alert("Error loading " + this.src)
                            };
                            var d = document.getElementsByTagName("script")[0];
                            d.parentNode.insertBefore(a, d)
                        }
                    };
                    e.onerror = function() {
                        alert("Error loading " + this.src)
                    };
                    a = document.getElementsByTagName("script")[0];
                    a.parentNode.insertBefore(e, a);
                    return
                }
            } else if ("hls" == f) {
                if (da = k.path, f = "video", D = "hls", !wg) {
                    "undefined" === typeof Hls ? (e = document.createElement("script"),
                        e.type = "text/javascript", e.src = "https://cdn.jsdelivr.net/npm/hls.js@latest", e.onload = e.onreadystatechange = function() {
                            this.readyState && "complete" != this.readyState || (xg(), Xb())
                        }, e.onerror = function() {
                            alert("Error loading " + this.src)
                        }, a = document.getElementsByTagName("script")[0], a.parentNode.insertBefore(e, a)) : (xg(), Xb());
                    return
                }
            } else if ("dash" == f && (da = k.path, f = "video", D = "dash", !yg)) {
                "undefined" === typeof dashjs ? (e = document.createElement("script"), e.type = "text/javascript", e.src = "https://cdn.dashjs.org/latest/dash.all.min.js",
                    e.onload = e.onreadystatechange = function() {
                        this.readyState && "complete" != this.readyState || (zg(), Xb())
                    }, e.onerror = function() {
                        alert("Error loading " + this.src)
                    }, a = document.getElementsByTagName("script")[0], a.parentNode.insertBefore(e, a)) : (zg(), Xb());
                return
            }
            Xb()
        }

        function Xb(a) {
            if (!Q && k.pwd) od.show();
            else {
                a && (Mc && (R = !0), yd && (R = !0));

                // console.log(testVal);
                // testVal ++;

                // console.log(randomClipMode);

                //     var myVar1 = setInterval(function(){

                //     if (randomClipMode == 1){
                //         if (m != null)
                //             m.playbackRate = 1;
                //         else if (t != null)
                //             t.playbackRate = 1;
                //     }
                //     else{

                //         i ++;
                //         // console.log("cccc");

                //         // determine which mode should be played.
                //         if ((partFirstRandomTime == 0) && (partSecondRandomTime == 0)){

                //             randomVal = Math.random() * 10;

                //             if (randomVal >= 3){
                //                 partFlag = 1;   //  fast mode(5:1:1)
                //             } else if (randomVal < 1.5){
                //                 partFlag = 2;   //  slow mode(1:5:1)
                //             } else{
                //                 partFlag = 3;   //  pause mode(1:5:1)
                //             }

                //             partFirstRandomTime = Math.random() * 20 + 10;  //  normal playing time

                //             // console.log("randomVal -->" + randomVal);
                //             // console.log("pastFirstRandomTime --> " + partFirstRandomTime);
                //         }


                //         /*  At this, it's played as normal speed for random time. 
                //             After this, it is played as playing mode randomly selected for random time.*/
                //         if (partFirstRandomTime > 0){

                //             if (measureTime == 0){
                //                 if (m != null){
                //                     m.playbackRate = 1;
                //                     m.volume = 0.5;
                //                 }
                //                 else if (t != null)
                //                     t.playbackRate = 1;
                //             }
                            
                //             if (measureTime < partFirstRandomTime){
                //                 measureTime ++;
                //                 console.log("prev");
                //                 console.log(measureTime);
                //             }else{
                //                 if (partFlag != 3)
                //                     partSecondRandomTime = Math.random() * 20 + 10;
                //                 else
                //                     partSecondRandomTime = Math.random() * 18 + 2;

                //                 // console.log("1->playbackRate --> " + m.playbackRate);
                //                 // console.log("pastSecondRandomTime --> " + partSecondRandomTime);
                //                 partFirstRandomTime = 0;
                //                 measureTime = 0;
                //             }
                //         }

                //         /*  After playing as normal speed, this is called*/
                //         if (partSecondRandomTime > 0){

                //             if (measureTime == 0){
                //                 if (partFlag == 1){
                //                     if (m != null){
                //                         m.playbackRate = Math.random() * 2 + 2;
                //                         m.volume = 0;
                //                     }
                //                     else if (t != null){
                //                         t.playbackRate = Math.random() * 2 + 2;
                //                     }
                //                 }
                //                 else if (partFlag == 2){
                //                     if (m != null){
                //                         m.playbackRate = 1 / (Math.floor(Math.random() * 4 + 1) * 2);
                //                         m.volume = 0;
                //                     }
                //                     else if (t != null)
                //                         t.playbackRate = 1 / (Math.floor(Math.random() * 4 + 1) * 2);
                //                 }
                //                 else if (partFlag == 3){
                //                     if (m != null){
                //                         m.playbackRate = 0;
                //                         m.volume = 0;
                //                     }
                //                     else if (t != null)
                //                         t.playbackRate = 1;
                //                 }

                //                 // console.log("2->playbackRate --> " + m.playbackRate);
                //             }
                            
                //             if (measureTime < partSecondRandomTime){
                //                 measureTime ++;
                //             }else{
                //                 partSecondRandomTime = 0;
                //                 measureTime = 0;
                //             }
                //         }
                //     }
                // }, 500);




                if ("audio" == f) Ag || (vc = c(document.createElement("audio")).attr("preload", Bg), t = vc[0], Ag = !0), t.src = da, vc.on("ended", function() {
                    ic()
                    // if (randomClipMode == 0)
                    //     clearInterval(myVar1);


                }).on("loadedmetadata", function() {

                        /*  added by Boldman!!!*/

                        // console.log("end");

                        if (randomClipMode == 0)
                            clearInterval(myVar);

                        if (k.randomClipTime != null){

                            k.start = Math.random() * t.duration;
                            k.end = k.randomClipTime + k.start;

                            randomClipMode = 1;
                            // k.start = 2;
                            // k.end = 4;
                        }else{
                            randomClipMode = 0;
                        }


                    t.playbackRate ?
                        t.playbackRate = Number(t.playbackRate) : oa(1);
                    if (mf) var a = setInterval(function() {
                        3 <= t.readyState && (clearInterval(a), null != O ? t.currentTime = O : null != k.start && (t.currentTime = k.start))
                    }, 100);
                    else null != O ? t.currentTime = O : null != k.start && (t.currentTime = k.start);
                    if (null != O) {
                        var d = t.play();
                        void 0 !== d && d.then(function(a) {})["catch"](function(a) {
                            H.show()
                        })
                    } else R ? (d = t.play(), void 0 !== d && d.then(function(a) {})["catch"](function(a) {
                        H.show()
                    })) : H.show();
                    O = null;
                    yb && !uc && me()
                }).on("play", function() {

						if (randomClipMode == 1){
	                        if (m != null)
	                            m.playbackRate = 1;
	                        else if (t != null)
	                            t.playbackRate = 1;
	                    }
	                    else{

                            console.log("before");

		                    myVar = setInterval(function(){

		                    	// console.log(testVal);
		                    	// testVal ++;

		                        i ++;

		                        // determine which mode should be played.
		                        if ((partFirstRandomTime == 0) && (partSecondRandomTime == 0)){

		                            randomVal = Math.random() * 10;

		                            if (randomVal > 4){
		                                partFlag = 1;   //  fast mode(3:1:1)
		                            } else if (randomVal <= 2){
		                                partFlag = 2;   //  slow mode(1:3:1)
		                            } else{
		                                partFlag = 3;   //  pause mode(1:3:1)
		                            }

		                            partFirstRandomTime = Math.random() * 20 + 10;  //  normal playing time

		                            // console.log("randomVal -->" + randomVal);
		                            // console.log("pastFirstRandomTime --> " + partFirstRandomTime);
		                        }


		                        /*  At this, it's played as normal speed for random time. 
		                            After this, it is played as playing mode randomly selected for random time.*/
		                        if (partFirstRandomTime > 0){

		                            if (measureTime == 0){
		                                if (m != null){
		                                    m.playbackRate = 1;
		                                    m.volume = 0.5;
		                                }
		                                else if (t != null){
		                                    t.playbackRate = 1;
		                                    t.volume = 0.5;
		                                }
		                            }
		                            
		                            if (measureTime < partFirstRandomTime){
		                                measureTime ++;
		                                // console.log("next");
		                                // console.log(measureTime);

		                            }else{
		                                if (partFlag == 1)
		                                    partSecondRandomTime = Math.random() * 5 + 2;
                                        else if (partFlag == 2)
                                            partSecondRandomTime = Math.random() * 20 + 10;
		                                else
		                                    partSecondRandomTime = Math.random() * 18 + 2;

		                                // console.log("1->playbackRate --> " + m.playbackRate);
		                                // console.log("pastSecondRandomTime --> ");
		                                partFirstRandomTime = 0;
		                                measureTime = 0;
		                            }
		                        }

		                        /*  After playing as normal speed, this is called*/
		                        if (partSecondRandomTime > 0){

		                            if (measureTime == 0){
		                                if (partFlag == 1){
		                                    if (m != null){
		                                        m.playbackRate = Math.random() * 2 + 2;
		                                        m.volume = 0;
		                                    }
		                                    else if (t != null){
		                                        t.playbackRate = Math.random() * 2 * 2;
		                                        t.volume = 0;
		                                    }
		                                }
		                                else if (partFlag == 2){
		                                    if (m != null){
		                                        m.playbackRate = 1 / (Math.floor(Math.random() * 4 + 1) * 2);
		                                        m.volume = 0;
		                                    }
		                                    else if (t != null){
		                                        t.playbackRate = 1 / (Math.floor(Math.random() * 4 + 1) * 2);
		                                        t.volume = 0;
		                                    }
		                                }
		                                else if (partFlag == 3){
		                                    if (m != null){
		                                        m.playbackRate = 0;
		                                        m.volume = 0;
		                                    }
		                                    else if (t != null){
		                                        t.playbackRate = 1;
		                                        t.volume = 0;
		                                    }
		                                }

		                                // console.log("2->playbackRate --> " + m.playbackRate);
		                            }
		                            
		                            if (measureTime < partSecondRandomTime){
		                                measureTime ++;
		                            }else{
		                                partSecondRandomTime = 0;
		                                measureTime = 0;
		                            }
		                        }

		                    	}, 100);
						}

                    Gd()
                }).on("pause",
                    function() {
                        xe()
                    }).on("ratechange", function() {
                    oa(t.playbackRate)
                }).on("error", function(a) {
                    c(p).trigger("mediaError", {
                        instance: p,
                        instanceName: M,
                        counter: tb
                    })
                }), R && t.load();
                else if ("video" == f) {
                    k.posterFrameTime && (da += "#t=" + k.posterFrameTime);

                    if (nf) gc.show(), za = gc.find(".wpsvp-media"), m = za[0];
                    else {
                        var d = " playsinline";
                        of && (d = "");
                        a = '<video class="wpsvp-media" preload="' + Bg + '"' + d + ">";
                        a += '<source src="' + da + '" />';
                        a += "</video>";
                        gc.show().html(a);
                        za = gc.find(".wpsvp-media");
                        m = za[0];
                        Hd && g(0)
                    }
                    if (wc && "video_360" == D &&
                        ("file:" == window.location.protocol && console.log("Playing 360 video and images requires online server connection!"), !Cg)) {
                        jc = new THREE.WebGLRenderer({
                            antialias: !0
                        });
                        jc.setSize(640, 360);
                        jc.domElement.className += "wpsvp-canvas-video";
                        Ba.prepend(c(jc.domElement));
                        Sc = Ba.find(".wpsvp-canvas-video");
                        Yc = new THREE.Texture(m);
                        Yc.minFilter = THREE.LinearFilter;
                        Yc.magFilter = THREE.LinearFilter;
                        Yc.format = THREE.RGBFormat;
                        pf = new THREE.Scene;
                        a = new THREE.SphereGeometry(500, 60, 40);
                        a.scale(-1, 1, 1);
                        var e = new THREE.MeshBasicMaterial({
                            map: Yc
                        });
                        a = new THREE.Mesh(a, e);
                        pf.add(a);
                        Cg = !0
                    }

                    /*  added by Boldman.*/

                    // console.log(randomClipMode);

                    // console.log(testVal);
                    // testVal ++;



                    za.on("ended", function() {
                        ic()

                        // console.log("next end and randomClipMode");
                        // console.log(randomClipMode);

                        // // if (randomClipMode == 0){
                        // //     clearInterval(myVar);
                        // //     console.log("Clear Interval at end");
                        // // }


                    }).on("loadedmetadata", function() {
                        WPSVPAspectRatio.resizeMedia("video", Va, I, za);
                        za.addClass("wpsvp-visible");

                        //k.playbackRate ? m.playbackRate = Number(k.playbackRate) : oa(0.5);

                        /*  added by Boldman.*/
                        //m.playbackRate = 0.5;

                        // console.log("aaa");

                        /*  added by Boldman!!!*/

                        if (randomClipMode == 0){
                            clearInterval(myVar);
                            // console.log("Clear Interval at load");
                        }

                        if (k.randomClipTime != null){

                            k.start = Math.random() * m.duration;
                            k.end = k.randomClipTime + k.start;

                            randomClipMode = 1;

                            // console.log("randomClipMode -> 1");

                            // k.start = 2;
                            // k.end = 4;
                        }else{
                            randomClipMode = 0;
                            // console.log("randomClipMode -> 0");
                        }

                        // k.start = 3;
                        // k.end  = 5;

                        if (mf) var a = setInterval(function() {
                            3 <= m.readyState && (clearInterval(a), null != O ? m.currentTime = O : null != k.start && (m.currentTime = k.start))
                        }, 100);
                        else null != O ? m.currentTime = O : null != k.start && (m.currentTime = k.start);
                        if (null != O) {
                            var d = m.play();
                            void 0 !== d && d.then(function(a) {})["catch"](function(a) {
                                H.show()
                            })
                        } else R ?
                            (d = m.play(), void 0 !== d && d.then(function(a) {})["catch"](function(a) {
                                H.show()
                            })) : H.show();
                        O = null;
                        za.find("source").remove();
                        yb && !uc && me()
                    }).on("waiting", function() {
                        G && "hls" == D || G && "dash" == D || gb.show()
                    }).on("playing", function() {

                        /*  added by Boldman..*/
                    //console.log("aaa");
                        gb.hide()
                    }).on("play", function() {

                    	// console.log("play");

	                    if (randomClipMode == 1){
	                        if (m != null)
	                            m.playbackRate = 1;
	                        else if (t != null)
	                            t.playbackRate = 1;
	                    }
	                    else{

                            console.log("after");

		                    myVar = setInterval(function(){

		                    	// console.log(testVal);
		                    	// testVal ++;

		                        i ++;

		                        // determine which mode should be played.
		                        if ((partFirstRandomTime == 0) && (partSecondRandomTime == 0)){

		                            randomVal = Math.random() * 10;

		                            if (randomVal > 4){
		                                partFlag = 1;   //  fast mode3:1:1)
		                            } else if (randomVal <= 2){
		                                partFlag = 2;   //  slow mode(1:3:1)
		                            } else{
		                                partFlag = 3;   //  pause mode(1:3:1)
		                            }

		                            partFirstRandomTime = Math.random() * 20 + 10;  //  normal playing time

		                            // console.log("randomVal -->" + randomVal);
		                            // console.log("pastFirstRandomTime --> " + partFirstRandomTime);
		                        }


		                        /*  At this, it's played as normal speed for random time. 
		                            After this, it is played as playing mode randomly selected for random time.*/
		                        if (partFirstRandomTime > 0){

		                            if (measureTime == 0){
		                                if (m != null){
		                                    m.playbackRate = 1;
		                                    m.volume = 0.5;
		                                }
		                                else if (t != null){
		                                    t.playbackRate = 1;
		                                    t.volume = 0.5;
		                                }
		                            }
		                            
		                            if (measureTime < partFirstRandomTime){
		                                measureTime ++;
		                                // console.log("next");
		                                // console.log(measureTime);

                                    // console.log(m.currentTime);

		                            }else{

                                        if (partFlag == 1)
                                            partSecondRandomTime = Math.random() * 5 + 2;
                                        else if (partFlag == 2)
                                            partSecondRandomTime = Math.random() * 20 + 10;
                                        else
                                            partSecondRandomTime = Math.random() * 18 + 2;

		                                // console.log("1->playbackRate --> " + m.playbackRate);
		                                // console.log("pastSecondRandomTime --> " + partSecondRandomTime);
		                                partFirstRandomTime = 0;
		                                measureTime = 0;
		                            }
		                        }

		                        /*  After playing as normal speed, this is called*/
		                        if (partSecondRandomTime > 0){

		                            if (measureTime == 0){
		                                if (partFlag == 1){
		                                    if (m != null){
		                                        m.playbackRate = Math.random() * 2 + 2;
		                                        m.volume = 0;
		                                    }
		                                    else if (t != null){
		                                        t.playbackRate = Math.random() * 2 * 2;
		                                        t.volume = 0;
		                                    }
		                                }
		                                else if (partFlag == 2){
		                                    if (m != null){

		                                        m.playbackRate = 1 / (Math.floor(Math.random() * 4 + 1) * 2);
		                                        m.volume = 0;
		                                    }
		                                    else if (t != null){
		                                        t.playbackRate = 1 / (Math.floor(Math.random() * 4 + 1) * 2);
		                                        t.volume = 0;
		                                    }
		                                }
		                                else if (partFlag == 3){
		                                    if (m != null){
		                                        m.playbackRate = 0;
		                                        m.volume = 0;
		                                    }
		                                    else if (t != null){
		                                        t.playbackRate = 1;
		                                        t.volume = 0;
		                                    }
		                                }

		                                // console.log("2->playbackRate --> " + m.playbackRate);
		                            }
		                            
		                            if (measureTime < partSecondRandomTime){
		                                measureTime ++;
		                            }else{



		                                partSecondRandomTime = 0;
		                                measureTime = 0;
		                            }
		                        }

		                    	}, 100);
						}


                        Gd()
                    }).on("pause", function() {
                        xe()
                    }).on("seeking", function() {
                        Pb = !1
                    }).on("seeked", function() {
                        gb.hide();
                        wc && "video_360" == D && (Pb = !0, Ua = requestAnimationFrame(qf))
                    }).on("ratechange", function() {
                        oa(m.playbackRate)
                    }).on("error", function(a) {
                        switch (a.target.error.code) {
                            case a.target.error.MEDIA_ERR_ABORTED:
                                console.log("You aborted the video playback.");
                                break;
                            case a.target.error.MEDIA_ERR_NETWORK:
                                console.log("A network error caused the video download to fail part-way.");
                                break;
                            case a.target.error.MEDIA_ERR_DECODE:
                                console.log("The video playback was aborted due to a corruption problem or because the video used features your browser did not support.");
                                break;
                            case a.target.error.MEDIA_ERR_SRC_NOT_SUPPORTED:
                                console.log("The video could not be loaded, either because the server or network failed or because the format is not supported.");
                                break;
                            default:
                                console.log("An unknown error occurred.")
                        }
                    });
                    if ("hls" == D)
                        if (rf) V.attachMedia(m);
                        else if (m.canPlayType("application/vnd.apple.mpegurl")) m.src = da;
                    else if (k.mp4) m.src = k.mp4, m.load();
                    else try {
                        m.src = da, m.load()
                    } catch (mi) {
                        alert("This browser or device does not support HLS extension. Please use mp4 video for playback!")
                    } else "dash" == D ? Dg ? Eg ? Pa.attachSource(da) : (Pa.initialize(m, da, R), Eg = !0) : k.mp4 ? (m.src = k.mp4, m.load()) : alert("This browser or device does not support MPEG-DASH extension. Please use mp4 video for playback!") : (m.src = da, m.load());
                    Gh && !nf &&
                        (a = m.play(), void 0 !== a && a.then(function(a) {})["catch"](function(a) {
                            H.show()
                        }));
                    nf = !0
                } else if ("image" == f) "image_360" == D ? ("file:" == window.location.protocol && console.log("Playing 360 video and images requires online server connection!"), Fg || (Id = new THREE.Scene, a = new THREE.SphereBufferGeometry(500, 60, 40), a.scale(-1, 1, 1), sf = new THREE.TextureLoader, tf = new THREE.MeshBasicMaterial({
                    map: sf
                }), Gg = new THREE.Mesh(a, tf), Id.add(Gg), ob = new THREE.WebGLRenderer, ob.setPixelRatio(window.devicePixelRatio), ob.setSize(640,
                    360), ob.domElement.className += "wpsvp-canvas-image", Ba.prepend(c(ob.domElement)), Tc = Ba.find(".wpsvp-canvas-image"), ye || (ye = !0, na = new THREE.PerspectiveCamera(90, 640 / 360, .1, 1E4), na.position.x += .1, fb = new THREE.OrbitControls(na, Ba[0]), fb.enableZoom = !1), Fg = !0), sf.load(da, function(a) {
                    Tc.show();
                    tf.map = a;
                    a = Ba.width();
                    var d = Ba.height();
                    ob.setSize(a, d);
                    na.aspect = a / d;
                    na.updateProjectionMatrix();
                    fb.addEventListener("change", oe);
                    ob.render(Id, na);
                    T = pa = !0;
                    Jd.show();
                    pe = Kd = !0;
                    k.duration && (Qb && clearTimeout(Qb), Qb = setTimeout(function() {
                        clearTimeout(this);
                        ic()
                    }, 1E3 * k.duration))
                }, function(a) {}, function(a) {})) : (gb.show(), c(new Image).addClass("wpsvp-media").prependTo(gf.show()).on("load", function() {
                    gb.hide();
                    xc = c(this);
                    WPSVPAspectRatio.resizeMedia("image", Va, I, xc);
                    xc.addClass("wpsvp-visible");
                    T = pa = !0;
                    k.duration && (uf = (new Date).getTime(), Ld = 1E3 * k.duration, Qb && clearTimeout(Qb), Qb = setTimeout(function() {
                        clearTimeout(this);
                        ic()
                    }, 1E3 * k.duration))
                }).on("error", function(a) {
                    console.log(a)
                }).attr("src", da)), Q ? k.duration && (vf.show(), Md = wf.width(), Oa && clearInterval(Oa),
                    Oa = setInterval(Se, 250)) : Ja.show();
                else if ("youtube" == f) {
                    if (Hg) xf && (a = 0, null != O ? a = O : null != k.start && (a = k.start), R ? y.loadVideoById({
                        videoId: k.path,
                        startSeconds: a,
                        endSeconds: k.end,
                        suggestedQuality: k.quality
                    }) : y.cueVideoById({
                        videoId: k.path,
                        startSeconds: a,
                        endSeconds: k.end,
                        suggestedQuality: k.quality
                    }));
                    else {
                        a = window.location.href.split("/");
                        a = a[0] + "//" + a[2];
                        var x = b.youtubeNoCookie ? "//www.youtube-nocookie.com/embed/" : "//www.youtube.com/embed/";
                        d = "1";
                        of && (d = "0");
                        var h = "ytplayer" + Math.floor(16777215 * Math.random()),
                            l = "https:" == window.location.protocol ? "https:" : "http:",
                            n = "&controls=0",
                            r = "&color=" + b.youtubePlayerColor,
                            u = "&showinfo=0",
                            v = "&modestbranding=1";
                        e = "&origin=" + a;
                        "chromeless" != la && (n = "&controls=1", u = "&showinfo=1", v = "&modestbranding=1");
                        d = l + x + k.path + "?enablejsapi=1" + n + "&rel=0" + u + ("&playsinline=" + d) + v + "&wmode=transparent&iv_load_policy=3&cc_load_policy=0" + r;
                        /^http/.test(a) && (d += e);
                        null != O ? d += "&start=" + O : k.start && (d += "&start=" + k.start);
                        k.end && (d += "&end=" + k.end);
                        zb = c("<iframe/>", {
                            id: h,
                            frameborder: 0,
                            src: d,
                            width: "100%",
                            height: "100%",
                            webkitAllowFullScreen: !0,
                            mozallowfullscreen: !0,
                            allowFullScreen: !0,
                            allow: "accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        });
                        "chromeless" == la && Hh && zb.addClass("wpsvp-yt-clean");
                        hc.show().prepend(zb);
                        window.YT || (a = document.createElement("script"), a.src = "https://www.youtube.com/iframe_api", e = document.getElementsByTagName("script")[0], e.parentNode.insertBefore(a, e));
                        var q = setInterval(function() {
                            window.YT && window.YT.Player && (q && clearInterval(q), y = new YT.Player(h, {
                                events: {
                                    onReady: Ih,
                                    onPlaybackQualityChange: Jh,
                                    onPlaybackRateChange: Kh,
                                    onStateChange: Lh,
                                    onError: Mh
                                }
                            }))
                        }, 100);
                        Hg = !0
                    }
                    hc.show();
                    "chromeless" == la && k.width && k.height && (zb.sw = k.width, zb.sh = k.height, WPSVPAspectRatio.resizeMedia("iframe", Va, hc, zb))
                } else "vimeo" == f ? ("file:" == window.location.protocol && console.log("Playing Vimeo requires online server connection!"), ba = "chromeless" == vg ? k.userAccount ? "basic" == k.userAccount ? "default" : "chromeless" : "default" : "default", "default" == ba ? Ig ? (pb = ue, qb = Nd, w = Jg, Kg && (pb.show(), w.loadVideo(k.path),
                    setTimeout(function() {
                        clearTimeout(this);
                        ze()
                    }, 500))) : (Nd = Lg("0"), ue.show().append(Nd), pb = ue, qb = Nd, window.Vimeo || (a = document.createElement("script"), a.src = "//player.vimeo.com/api/player.js", e = document.getElementsByTagName("script")[0], e.parentNode.insertBefore(a, e)), q = setInterval(function() {
                    window.Vimeo && (q && clearInterval(q), w = Jg = new Vimeo.Player(Nd[0]), w.on("loaded", ze), w.on("play", Mg), w.on("pause", Ng), w.on("ended", Og), w.on("error", Pg), "chromeless" == ba && (w.on("playbackratechange", Qg), w.on("timeupdate",
                        Rg)), Kg = !0)
                }, 100), Ig = !0) : (Sg ? (pb = ve, qb = Od, w = Tg, Ug && (pb.show(), w.loadVideo(k.path), setTimeout(function() {
                    clearTimeout(this);
                    ze()
                }, 500))) : (Od = Lg("1"), ve.show().append(Od), pb = ve, qb = Od, window.Vimeo || (a = document.createElement("script"), a.src = "//player.vimeo.com/api/player.js", e = document.getElementsByTagName("script")[0], e.parentNode.insertBefore(a, e)), q = setInterval(function() {
                    window.Vimeo && (q && clearInterval(q), w = Tg = new Vimeo.Player(Od[0]), w.on("loaded", ze), w.on("play", Mg), w.on("pause", Ng), w.on("ended",
                        Og), w.on("error", Pg), w.on("seeked", Nh), "chromeless" == ba && (w.on("playbackratechange", Qg), w.on("timeupdate", Rg)), Ug = !0)
                }, 100), Sg = !0), k.width && k.height && (qb.sw = k.width, qb.sh = k.height, WPSVPAspectRatio.resizeMedia("iframe", Va, pb, qb)))) : "iframe" == f && c('<iframe src="' + k.path + '" style="border: 0px none transparent; width:100%; height:100%;" webkitAllowFullScreen mozallowfullscreen allowFullScreen allow="autoplay"></iframe>').appendTo(Vg.show());
                if (!Cd) {
                    "video" == f && (Zf || m.webkitSupportsPresentationMode && "function" ===
                        typeof m.webkitSetPresentationMode) && Zc.show();
                    "audio" == f || "video" == f || "youtube" == f && "chromeless" == la || "vimeo" == f && "chromeless" == ba ? (k.liveStream ? (Rb.hide(), $c.hide(), Sb.hide(), Ca.hide(), ad.hide(), bd.hide(), cd.hide()) : (Rb.show(), $c.show(), Sb.show(), Ca.show(), ad.show(), bd.show(), cd.show()), Ab.show(), Bb.show(), dd.show()) : (Ab.hide(), Bb.hide(), dd.hide(), Rb.hide(), $c.hide(), Sb.hide(), Ca.hide(), ad.hide(), bd.hide(), cd.hide());
                    if (a = k.title || k.domTitle) Wg.html(a), Xg.html(a);
                    k.description ? (Yg.html(k.description),
                        ed.show()) : ed.hide();
                    Oh && k.download ? Pd.show().find("a").attr("href", k.download).attr("download", "") : Pd.hide()
                }("iframe" == f || "youtube" == f && "default" == la || "vimeo" == f && "default" == ba) && Ja.hide();
                Q ? c(p).trigger("adRequest", {
                    instance: p,
                    instanceName: M,
                    adId: k.adId
                }) : c(p).trigger("mediaRequest", {
                    instance: p,
                    instanceName: M,
                    counter: tb
                })
            }
        }

        function Ih(a) {
            xf = !0;
            Hd && (R = !0, g(0));
            R ? !yf && !zf || Zg || Hd ? y.playVideo() : "wall" == ka && y.playVideo() : null != O && k.poster && y.playVideo();
            yb && !uc && me()
        }

        function Jh(a) {
            Ub(a.data)
        }

        function Kh(a) {
            oa(a.data)
        }

        function Lh(a) {
            hc.is(":visible") && -1 != a.data && (0 == a.data ? Ae || (Ae = !0, ic()) : 1 == a.data ? (Be || (Ae = !1, Zg = !0, O = null, k.quality && y.setPlaybackQuality(k.quality), a = y.getAvailableQualityLevels(), we && 1 == a.length || "chromeless" == la && ea(a, y.getPlaybackQuality()), k.playbackRate && 1 != k.playbackRate ? y.setPlaybackRate(Number(k.playbackRate)) : "chromeless" == la && oa(1), Af && (Ce || (Ce = c('<div class="wpsvp-iframe-blocker"></div>').css("display", "block").on("click", function() {
                if (Q) a = y.getPlayerState(), 1 == a ? y.pauseVideo() : 2 == a ?
                    y.playVideo() : (-1 == a || 5 == a || 0 == a) && y.playVideo();
                else if (Be && ub) Jb();
                else {
                    var a = y.getPlayerState();
                    1 == a ? y.pauseVideo() : 2 == a ? y.playVideo() : (-1 == a || 5 == a || 0 == a) && y.playVideo()
                }
            }).appendTo(hc)), k.is360 ? Ce.css("display", "none") : Ce.css("display", "block")), Be = !0), "default" == la ? T = !0 : Gd()) : 2 == a.data ? "default" == la ? T = !1 : xe() : 3 != a.data && 5 == a.data && (null != O && k.poster ? y.playVideo() : R && "outer" == ka && y.playVideo()))
        }

        function Mh(a) {
            switch (a.data) {
                case 2:
                    console.log("Error code = " + a.data + ": The request contains an invalid parameter value. For example, this error occurs if you specify a video ID that does not have 11 characters, or if the video ID contains invalid characters, such as exclamation points or asterisks.");
                    break;
                case 100:
                    console.log("Error code = " + a.data + ": Video not found, removed, or marked as private");
                    break;
                case 101:
                    console.log("Error code = " + a.data + ": Embedding disabled for this video");
                    break;
                case 150:
                    console.log("Error code = " + a.data + ": Video not found, removed, or marked as private [same as error 100]")
            }
        }

        function Lg(a) {
            var d = WPSVPUtils.rgbToHex(b.vimeoPlayerColor);
            "#" == d.charAt(0) && (d = d.substr(1));
            var e = "1";
            of && (e = "0");
            var f = Mc ? "1" : "0",
                h = "player" + Math.floor(16777215 * Math.random());
            d = "?color=" +
                d;
            e = "&playsinline=" + e;
            var l = "&muted=0";
            f = "&autoplay=" + f;
            a = "&background=" + a;
            Hd && (l = "&muted=1", f = "&autoplay=1", R = !0, g(0));
            d = "https://player.vimeo.com/video/" + k.path + d + "&byline=1&portrait=1&title=1&autopause=1" + e + "&loop=0&dnt=1" + a + "&speed=1" + l + f;
            k.quality && (d += "&quality=" + k.quality);
            return c("<iframe/>", {
                id: h,
                frameborder: 0,
                src: d,
                width: "100%",
                height: "100%",
                webkitAllowFullScreen: !0,
                mozallowfullscreen: !0,
                allowFullScreen: !0,
                allow: "accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
            })
        }

        function Mg() {
            if (!De) {
                if (k.start || null != O) {
                    if (null != O) var a = O;
                    else k.start && (a = k.start);
                    O = null;
                    w.setCurrentTime(a).then(function(a) {})["catch"](function(a) {
                        console.log(a.name)
                    })
                }
                k.playbackRate && 1 != k.playbackRate ? w.setPlaybackRate(k.playbackRate).then(function(a) {})["catch"](function(a) {
                    Bb.hide();
                    console.log(a.name)
                }) : "chromeless" == ba && Bb.hide();
                Ee = !0;
                Mc && (R = !0);
                De = !0
            }
            "default" == ba ? T = !0 : Gd()
        }

        function Ng() {
            "default" == ba ? T = !1 : xe()
        }

        function Qg(a) {
            oa(a.playbackRate)
        }

        function ze() {
            if (Ph = "default" == ba ? !1 :
                !0) Fe || (Fe = c('<div class="wpsvp-iframe-blocker"></div>').css("display", "block").on("click", function() {
                Q ? w.getPaused().then(function(a) {
                    a ? w.play() : w.pause()
                }) : De && ub ? Jb() : w.getPaused().then(function(a) {
                    a ? w.play() : w.pause()
                })
            }).appendTo(pb)), k.is360 ? Fe.css("display", "none") : Fe.css("display", "block");
            R ? G ? Ee ? ("chromeless" == ba && H.show(), w.play()) : Ee = !0 : ((!yf && !zf || Ee) && w.play().then(function() {
                Gd()
            })["catch"](function(a) {}), "chromeless" == ba && H.show()) : null != O && k.poster ? w.play() : "chromeless" == ba && H.show();
            yb && !uc && me()
        }

        function Rg(a) {
            Db = a.duration;
            fd = a.seconds;
            Ge = a.percent
        }

        function Og() {
            w.off("timeupdate");
            w.off("ended");
            ic()
        }

        function Nh() {
            gb.hide()
        }

        function Pg(a) {
            console.log("Vimeo Player Error!", a)
        }

        function oe() {
            "image_360" == D && ob.render(Id, na);
            G && ub && Jb();
            Kd && (Kd = !1, setTimeout(function() {
                clearTimeout(this);
                Jd.hide()
            }, 1E3))
        }

        function xg() {
            V = new Hls;
            rf = Hls.isSupported();
            wg = !0;
            V.subtitleDisplay = !1;
            V.subtitleTrack = -1;
            V.on(Hls.Events.MEDIA_ATTACHED, function() {
                V.loadSource(da)
            });
            V.on(Hls.Events.MANIFEST_PARSED,
                function(a, d) {
                    if ($g) {
                        var c = [],
                            b, e = d.levels.length;
                        for (b = 0; b < e; b++) {
                            var f = d.levels[b];
                            f.width && c.push({
                                label: f.width + "x" + f.height + ", " + Math.ceil(Math.round(f.bitrate / 1E3)) + "kbps",
                                value: b.toString()
                            })
                        }
                        c.push({
                            label: "auto",
                            value: "-1",
                            selected: !0
                        });
                        we && 1 == c.length || ea(c, "-1")
                    }
                });
            V.on(Hls.Events.MANIFEST_LOADED, function(a, d) {});
            V.on(Hls.Events.LEVEL_LOADED, function(a, d) {});
            V.on(Hls.Events.AUDIO_TRACKS_UPDATED, function(a, d) {
                if (ah) {
                    var b = V.audioTracks,
                        e = b.length;
                    if (1 < e) {
                        var f;
                        for (f = 0; f < e; f++) {
                            var g = b[f];
                            var k = g.groupId + " - " + g.name;
                            g = g.id.toString();
                            c("<li/>").addClass("wpsvp-menu-item").attr({
                                "data-value": g,
                                "data-label": k
                            }).text(k).on("click", ta).appendTo(Qd)
                        }
                        He = !0;
                        kc.show();
                        Bf.removeClass("wpsvp-force-hide")
                    }
                }
            });
            V.on(Hls.Events.AUDIO_TRACK_SWITCHED, function(a, d) {
                if (He) {
                    var c = d.id;
                    Ie && Ie.removeClass("wpsvp-menu-active");
                    Ie = Qd.find(".wpsvp-menu-item[data-value='" + c + "']").addClass("wpsvp-menu-active");
                    bb && (P.find(".wpsvp-audio-language-menu-value").text(Ie.text()), P.find(".wpsvp-settings-menu").hide(), cb.show())
                }
            });
            V.on(Hls.Events.AUDIO_TRACK_LOADED, function(a, d) {});
            V.on(Hls.Events.SUBTITLE_TRACK_SWITCH, function(a, d) {
                var c = V.subtitleTracks.length;
                if (0 < c && !k.subtitles) {
                    var b;
                    k.subtitles = [];
                    for (b = 0; b < c; b++) {
                        var e = V.subtitleTracks[b];
                        var f = b.toString();
                        f = {
                            label: e.name,
                            value: f,
                            src: e.url
                        };
                        e["default"] && (f["default"] = !0);
                        k.subtitles.push(f)
                    }
                    Cc()
                }
            });
            V.on(Hls.Events.SUBTITLE_TRACK_LOADED, function(a, d) {});
            V.on(Hls.Events.ERROR, function(a, d) {
                if (d.fatal) switch (d.type) {
                    case Hls.ErrorTypes.NETWORK_ERROR:
                        console.log("fatal network error encountered, try to recover");
                        V.startLoad();
                        break;
                    case Hls.ErrorTypes.MEDIA_ERROR:
                        console.log("fatal media error encountered, try to recover");
                        V.recoverMediaError();
                        break;
                    default:
                        V.destroy()
                }
            })
        }

        function zg() {
            Pa = dashjs.MediaPlayer().create();
            yg = !0;
            Pa.setFastSwitchEnabled = !0;
            Pa.on(dashjs.MediaPlayer.events.STREAM_INITIALIZED, function(a) {
                if ($g) {
                    var d = Pa.getBitrateInfoListFor("video");
                    console.log(d);
                    var b = [],
                        e = d.length;
                    for (a = 0; a < e; a++) {
                        var f = d[a];
                        f.width && b.push({
                            label: f.width + "x" + f.height + ", " + Math.ceil(Math.round(f.bitrate / 1E3)) +
                                "kbps",
                            value: f.qualityIndex.toString()
                        })
                    }
                    b.push({
                        label: "auto",
                        value: "-1",
                        selected: !0
                    });
                    we && 1 == b.length || ea(b, "-1")
                }
                if (ah && (d = Pa.getBitrateInfoListFor("audio"), console.log(d), e = d.length, 1 < e)) {
                    for (a = 0; a < e; a++) f = d[a], b = Math.ceil(Math.round(f.bitrate / 1E3)) + "kbps", f = f.qualityIndex.toString(), c("<li/>").addClass("wpsvp-menu-item").attr({
                        "data-value": f,
                        "data-label": b
                    }).text(b).on("click", ta).appendTo(Qd);
                    He = !0;
                    kc.show();
                    Bf.removeClass("wpsvp-force-hide")
                }
            });
            Pa.on(dashjs.MediaPlayer.events.QUALITY_CHANGE_REQUESTED,
                function(a) {
                    console.log("QUALITY_CHANGE_REQUESTED", a.oldQuality, a.newQuality)
                });
            Pa.on(dashjs.MediaPlayer.events.QUALITY_CHANGE_RENDERED, function(a) {
                console.log("dashjs.MediaPlayer.events.QUALITY_CHANGE_RENDERED", a.newQuality)
            });
            Pa.on(dashjs.MediaPlayer.events.TRACK_CHANGE_RENDERED, function(a) {
                console.log("TRACK_CHANGE_RENDERED", a)
            });
            Pa.on(dashjs.MediaPlayer.events.TEXT_TRACKS_ADDED, function(a) {});
            Pa.on(dashjs.MediaPlayer.events.ERROR, function(a) {
                console.log("dashjs.MediaPlayer.events.ERROR " + a.error +
                    " : " + a.event.message)
            });
            Pa.on(dashjs.MediaPlayer.events.PLAYBACK_ERROR, function(a) {
                console.log("dashjs.MediaPlayer.events.PLAYBACK_ERROR")
            })
        }

        function dc() {
            Pb = !1;
            Ua && cancelAnimationFrame(Ua);
            Oa && clearInterval(Oa);
            Qb && (clearTimeout(Qb), Qb = null);
            Rc && (clearInterval(Rc), Rc = null);
            Jd.hide();
            Kd = !1;
            rf && "hls" == D && V.detachMedia();
            Dg && "dash" == D && Pa.attachSource(null);
            fb && (fb.removeEventListener("change", oe), fb.reset());
            if ("audio" == f) t && (t.pause(), t.src = ""), vc && vc.off("ended pause play ratechange loadedmetadata error"),
                te.hide();
            else if ("video" == f) {
                wc && "video_360" == D && Sc && Sc.hide();
                if (m) {
                    m.pause();
                    try {
                        m.currentTime = 0
                    } catch (a) {}
                    m.src = "";
                    m = null
                }
                za && za.off("ended loadedmetadata ratechange waiting playing play pause error seeked");
                gc.hide()
            } else "image" == f ? "image_360" == D ? (Tc && Tc.hide(), pe = !1) : (gf.hide().find(".wpsvp-media").remove(), xc = null) : "youtube" == f ? y && (Ae = !0, hc.hide(), xf && y.stopVideo(), Be = !1, zb && (zb.sw = null, zb.sh = null)) : "vimeo" == f ? (Ge = fd = Db = 0, w && (w.unload().then(function() {})["catch"](function(a) {
                    console.log(a)
                }),
                qb && (qb.sw = null, qb.sh = null)), De = !1, pb && pb.hide()) : "iframe" == f && Vg.empty().hide();
            E && (E.remove(), E = null);
            Q && (Q = !1, Rd.removeClass("wpsvp-ad-skip-btn-visible"), vf.hide(), bh.hide(), Dd = re = null, Cf.html(ch), Df = !1);
            ec.hide().empty();
            Xc = [];
            se = !1;
            Zc.hide();
            e.removeClass("wpsvp-holder-visible");
            Ca.hide();
            Ab.hide();
            Bb.hide();
            dd.hide();
            P.hide().removeClass("wpsvp-menu-bottom").find(".wpsvp-settings-menu").css("display", "none");
            cb.show();
            Rb.hide();
            $c.hide();
            Sb.hide();
            Ob = !1;
            Je = null;
            Sd.hide();
            Kb.empty();
            rc = !1;
            db = [];
            ce = [];
            Ka = qa = null;
            pc.empty();
            qc.hide();
            Xf.addClass("wpsvp-force-hide");
            oc.hide();
            ld.empty();
            Wf.addClass("wpsvp-force-hide");
            kc.hide();
            Qd.empty();
            Bf.addClass("wpsvp-force-hide");
            He = !1;
            R || Ja.hide();
            Ja.removeClass("wpsvp-interface-visible");
            qa && Kb.removeClass("wpsvp-subtitle-bottom");
            U.hide();
            Fb = null;
            Eb = [];
            mc.hide();
            qd.removeClass("wpsvp-menu-bottom");
            rd.removeClass("wpsvp-menu-bottom");
            sd.removeClass("wpsvp-menu-bottom");
            wb = !1;
            Xe.hide();
            Wg.html("");
            Xg.html("");
            Yg.html("");
            ed.hide();
            ib = !1;
            Ze.hide();
            Zb.text(Zb.attr("data-copy-text"));
            Lb.text(Lb.attr("data-copy-text"));
            Ye.hide();
            jb = !1;
            H.hide();
            mb.removeClass("wpsvp-upnext-on wpsvp-upnext-visible");
            kf.css("background-image", "none");
            lf.html("");
            od.hide();
            de.val("");
            k = D = f = O = null;
            lb = pa = T = !1;
            ub = !0;
            dh.width(0);
            eh.width(0);
            fh.width(0);
            Te.width(0)
        }

        function Ef() {
            u && f && (X && pd(), dc(), N.reSetCounter())
        }

        function $e() {
            f && dc();
            r.find(".wpsvp-playlist-item").remove();
            A = 0;
            N.reSetCounter();
            le = !1;
            ee = "";
            $b = null;
            kb = Yb = !1;
            xd = wd = vd = ud = ja = null;
            ac = !1
        }

        function Vb() {
            u && 0 != A && N.advanceHandler(1, !0)
        }

        function kd() {
            u &&
                0 != A && N.advanceHandler(-1, !0)
        }

        function Gd() {
            gb.hide();
            H.hide();
            Ab.find(".wpsvp-btn-play").hide();
            Ab.find(".wpsvp-btn-pause").show();
            "custom" == Gb && (Ke.find(".wpsvp-context-playback-play").hide(), Ke.find(".wpsvp-context-playback-pause").show());
            if (!pa) {
                Mc && (R = !0);
                yd && (R = !0);
                g();
                db.length && Sd.show();
                if (wc && "video_360" == D) {
                    gc.hide();
                    Sc.show();
                    Jd.show();
                    Kd = !0;
                    ye || (ye = !0, na = new THREE.PerspectiveCamera(90, 640 / 360, .1, 1E4), na.position.x += .1, fb = new THREE.OrbitControls(na, Ba[0]), fb.enableZoom = !1);
                    fb.addEventListener("change",
                        oe);
                    var a = Ba.width(),
                        d = Ba.height();
                    jc.setSize(a, d);
                    na.aspect = a / d;
                    na.updateProjectionMatrix();
                    Pb = !0;
                    Ua && cancelAnimationFrame(Ua);
                    Ua = requestAnimationFrame(qf)
                }
                if ("audio" == f || "video" == f || "youtube" == f && "chromeless" == la || "vimeo" == f && "chromeless" == ba) Oa && clearInterval(Oa), Oa = setInterval(Se, 250);
                Q ? c(p).trigger("adStart", {
                    instance: p,
                    instanceName: M,
                    adId: k.adId
                }) : c(p).trigger("mediaStart", {
                    instance: p,
                    instanceName: M,
                    counter: tb
                });
                pa = !0;
                if ("audio" == f || "video" == f || "youtube" == f && "chromeless" == la || "vimeo" == f && "chromeless" ==
                    ba)
                    if (a = p.getDuration(), isNaN(a)) var b = setTimeout(function() {
                        clearTimeout(b);
                        var a = p.getDuration();
                        Rb.html(WPSVPUtils.formatTime(0));
                        Sb.html(WPSVPUtils.formatTime(a));
                        Ja.show();
                        Za = Cb.width();
                        Q ? Ja.hide() : gh && Jb();
                        Td || (Ia.length && Uf(a), Td = !0);
                        Ud || (hh && hb.length && Vf(a), Ud = !0)
                    }, 500);
                    else Rb.html(WPSVPUtils.formatTime(0)), Sb.html(WPSVPUtils.formatTime(a)), Ja.show(), Za = Cb.width(), Q ? Ja.hide() : gh && Jb(), Td || (Ia.length && Uf(a), Td = !0), Ud || (hh && hb.length && Vf(a), Ud = !0);
                Q && (vf.show(), Md = wf.width())
            }
            if (Qh && 1 < wpsvp_mediaArr.length)
                for (d =
                    wpsvp_mediaArr.length, a = 0; a < d; a++) p != wpsvp_mediaArr[a].inst && wpsvp_mediaArr[a].inst.pauseMedia();
            Q ? c(p).trigger("adPlay", {
                instance: p,
                instanceName: M,
                adId: k.adId
            }) : c(p).trigger("mediaPlay", {
                instance: p,
                instanceName: M,
                counter: tb
            });
            T = !0
        }

        function xe() {
            gb.hide();
            Ab.find(".wpsvp-btn-play").show();
            Ab.find(".wpsvp-btn-pause").hide();
            "custom" == Gb && (Ke.find(".wpsvp-context-playback-pause").hide(), Ke.find(".wpsvp-context-playback-play").show());
            ib || jb || vb || (pa ? ("audio" == f || "video" == f || "youtube" == f && "chromeless" == la || "vimeo" ==
                f && "chromeless" == ba) && H.show() : "audio" != f && "video" != f || H.show());
            Q ? c(p).trigger("adPause", {
                instance: p,
                instanceName: M,
                adId: k.adId
            }) : c(p).trigger("mediaPause", {
                instance: p,
                instanceName: M,
                counter: tb
            });
            if (Q && k.link)
                if (k.target && "_blank" == k.target) window.open(k.link);
                else {
                    var a = k.link;
                    Ef();
                    window.location = a;
                    return
                }
            T = !1
        }

        function qf() {
            Pb && (za.readyState === za.HAVE_ENOUGH_DATA && (Yc.needsUpdate = !0), jc.render(pf, na), Ua = requestAnimationFrame(qf))
        }

        function Se(a) {
            if ("undefined" !== typeof a || T) {
                var d;
                if ("audio" ==
                    f) {
                    var e = t.currentTime,
                        g = t.duration;
                    if ("undefined" !== typeof t.buffered && 0 != t.buffered.length) {
                        try {
                            var h = t.buffered.end(t.buffered.length - 1)
                        } catch (vh) {}
                        isNaN(h) || (d = h / Math.floor(t.duration))
                    }
                } else if ("video" == f) {
                    if (e = m.currentTime, g = m.duration, "undefined" !== typeof m.buffered && 0 != m.buffered.length) {
                        try {
                            h = m.buffered.end(m.buffered.length - 1)
                        } catch (vh) {}
                        isNaN(h) || (d = h / Math.floor(m.duration))
                    }
                } else "youtube" == f ? (e = y.getCurrentTime(), g = y.getDuration(), d = y.getVideoLoadedFraction()) : "vimeo" == f ? (e = fd, g = Db, d =
                    Ge) : "image" == f && (d = 1E3 * k.duration, e = (new Date).getTime() - uf, Ld -= e, 0 > Ld && (Ld = 0), uf = (new Date).getTime(), e = (d - Ld) / 1E3, g = k.duration, d = 1);
                if (WPSVPUtils.isNumber(e) && WPSVPUtils.isNumber(g)) {
                    a = parseInt(e, 10);
                    if (Q) {
                        if (a != Je && (Rh.html("&nbsp;(-" + WPSVPUtils.formatTime(g - a) + ")"), 0 < a)) {
                            if (!Df && (Df = !0, Vd = !1, Wd = null, "undefined" !== typeof k.skipEnable)) {
                                Wd = k.skipEnable;
                                var l;
                                Dd ? (h = X.next(), 0 == h.length && b.loopingOn && (h = r.find(".wpsvp-playlist-item").eq(0)), h.length && (void 0 != h.attr("data-thumb") ? l = h.attr("data-thumb") : h.find(".wpsvp-thumbimg").length &&
                                    (l = h.find(".wpsvp-thumbimg").attr("src")))) : Uc.thumb ? l = Uc.thumb : X.find(".wpsvp-thumbimg").length && (l = X.find(".wpsvp-thumbimg").attr("src"));
                                l && c('<img src="' + l + '" alt=""/>').appendTo(ih.empty().show());
                                jh.show();
                                Rd.addClass("wpsvp-ad-skip-btn-visible")
                            }
                            null == Wd || Vd || (a < Wd ? Cf.html(ch + "&nbsp;" + (Wd - a).toString()) : (Vd = !0, ih.hide(), jh.hide(), bh.show()))
                        }
                        d && dh.width(d * Md);
                        eh.width(e / g * Md)
                    } else {
                        if (a != Je) {
                            if (k.end && e >= k.end) {
                                "loop" != Xd && "rewind" != Xd && (Oa && clearInterval(Oa), Pb = !1, Ua && cancelAnimationFrame(Ua));
                                ic();
                                return
                            }
                            if (hb.length)
                                for (h = hb.length, l = 0; l < h; l++) {
                                    var n = hb[l];
                                    if (a == n.begin) {
                                        Oa && clearInterval(Oa);
                                        Pb = !1;
                                        Ua && cancelAnimationFrame(Ua);
                                        re = n.data;
                                        Fd = n.begin + 1;
                                        Sh && (hb[l].marker.remove(), hb.splice(l, 1));
                                        va();
                                        return
                                    }
                                }
                            if (Xc.length)
                                for (h = Xc.length, l = 0; l < h; l++) {
                                    n = Xc[l];
                                    var p = n.start;
                                    var q = n.end;
                                    n = n.item;
                                    a >= p && a <= q - 1 ? n.wpsvpvisible || (n.hasClass("wpsvp-iframe") && n.find("iframe").each(function() {
                                        c(this).attr("src", c(this).attr("data-src"))
                                    }), n.css("display", "block"), n.wpsvpvisible = !0) : n.wpsvpvisible && (n.css("display",
                                        "none"), n.hasClass("wpsvp-iframe") && n.find("iframe").each(function() {
                                        c(this).attr("src", "about:blank")
                                    }), n.wpsvpvisible = !1)
                                }
                            if (rc && db.length)
                                for (h = db.length, l = 0; l < h; l++) n = db[l], p = n.start, q = n.end, a >= p && a <= q ? qa || (qa = c('<div class="wpsvp-subtitle">' + n.text + "</div>"), ub || Kb.addClass("wpsvp-subtitle-bottom"), qa.start = p, qa.end = q, Kb.append(qa)) : qa && (a < qa.start || a > qa.end) && (qa.remove(), qa = null);
                            0 < g && mb.hasClass("wpsvp-upnext-on") && (a > g - wd ? mb.addClass("wpsvp-upnext-visible") : mb.removeClass("wpsvp-upnext-visible"));
                            Rb.html(WPSVPUtils.formatTime(a));
                            Sb.html(WPSVPUtils.formatTime(g))
                        }
                        d && 1 != d && fh.width(d * Za);
                        Te.width(e / g * Za)
                    }
                    Je = a
                }
            }
        }

        function ic() {
            Q && c(p).trigger("adEnd", {
                instance: p,
                instanceName: M,
                adId: k.adId
            });
            if ("undefined" !== typeof k.endLink)
                if ("_blank" == k.endTarget) window.open(k.endLink);
                else {
                    Ef();
                    window.location = k.endLink;
                    return
                }
            if (Q && !Dd) va();
            else if (Wc) Dd = !0, va();
            else {
                c(p).trigger("mediaEnd", {
                    instance: p,
                    instanceName: M,
                    counter: tb
                });
                var a = k.start || 0;
                "next" == Xd ? Vb() : "loop" == Xd ? "audio" == f ? t && (t.currentTime = a, t.play()) : "video" == f ? m && (m.currentTime =
                    a, m.play()) : "youtube" == f ? y && (y.seekTo(a), y.playVideo()) : "vimeo" == f && w && (w.pause(), w.setCurrentTime(a), w.play()) : "rewind" == Xd && ("audio" == f ? t && (t.currentTime = a, t.pause()) : "video" == f ? m && (m.currentTime = a, m.pause()) : "youtube" == f ? y && (y.seekTo(a), y.pauseVideo()) : "vimeo" == f && w && (w.pause(), w.setCurrentTime(a)))
            }
        }

        function tc() {
            if ("left_bottom" == ka || "right_bottom" == ka)
                if (e.width() > Th) {
                    J.removeClass("wpsvp-playlist-holder-bottom").width(Uh);
                    var a = Z ? e.width() - J.width() : e.width();
                    I.width(a);
                    if ("100%" == gd) {
                        var d =
                            e.height();
                        I.height(d);
                        J.height(d)
                    } else d = "fullscreen" == Wa ? e.height() : a / yc, I.height(d), J.height(d), e.height(d)
                } else J.addClass("wpsvp-playlist-holder-bottom"), "100%" == gd ? (J.css({
                    height: Ff,
                    width: "100%"
                }), a = e.width(), d = Z ? e.height() - J.height() : e.height(), I.css({
                    height: d,
                    width: a
                })) : (a = e.width(), d = a / yc, I.css({
                    height: d,
                    width: a
                }), J.css({
                    height: Ff,
                    width: "100%"
                }), Z ? e.height(d + J.height()) : e.height(d), "fullscreen" == Wa && (Z ? I.height(e.height() - J.height()) : I.height(e.height())));
            else "left" == ka || "right" == ka ? (a = Z ?
                e.width() - J.width() : e.width(), I.width(a), "100%" == gd && (d = e.height(), I.height(d))) : "bottom" == ka || "top" == ka ? "100%" == gd ? (a = Z ? e.height() - J.height() : e.height(), I.height(a)) : (a = e.width(), d = a / yc, I.height(d), Z ? e.height(d + J.height()) : e.height(d), "fullscreen" == Wa && (Z ? I.height(e.height() - J.height()) : I.height(e.height()))) : "lightbox" == $a ? "normal" == Wa && (a = fc.width(), d = a / yc, fc.height(d)) : "outer" == ka ? (a = e.width(), d = a / yc, I.height(d)) : "no-playlist" == ka && (a = e.width(), d = a / yc, I.height(d), e.height(d), "fullscreen" == Wa &&
                I.height(e.height()));
            Ib && qg && (rg(), cc != ff && (ff = cc, r.find(".wpsvp-playlist-item").each(function() {
                if (0 < Ea) {
                    var a = 100 / cc;
                    c(this).css({
                        marginLeft: 0,
                        marginTop: 0,
                        marginRight: Ea + "px",
                        marginBottom: Ea + "px",
                        width: "calc(" + a + "% - " + Ea + "px)"
                    })
                } else c(this).css({
                    marginLeft: 0,
                    marginTop: 0,
                    marginRight: Ea + "px",
                    marginBottom: Ea + "px",
                    width: 100 / cc + "%"
                })
            })));
            if (Ib)
                if ("buttons" == eb) {
                    if ("horizontal" == ya) {
                        a = ia.width();
                        var b = r.width();
                        d = "translateX"
                    } else a = ia.height(), b = r.height(), d = "translateY";
                    if (b < a) {
                        bc = !1;
                        Qa.hide();
                        Ma.hide();
                        var g = parseInt(a / 2 - b / 2, 10)
                    } else bc = !0, Ra ? g = Ra : (g = r[0].style.transform.replace(/[^\d.]/g, ""), g = parseInt(g) || 0), 0 < g ? (g = 0, Ma.show()) : g < a - b && (g = a - b, Qa.show());
                    Ra = g;
                    r.css({
                        "-webkit-transform": "" + d + "(" + g + "px)",
                        "-ms-transform": "" + d + "(" + g + "px)",
                        transform: "" + d + "(" + g + "px)"
                    })
                } else "hover" == eb && ("horizontal" == ya ? (a = ia.width(), b = r.width(), b < a ? (bc = !1, g = parseInt(a / 2 - b / 2, 10)) : (bc = !0, g = parseInt(r.css("left"), 10), 0 < g ? g = 0 : g < a - b && (g = a - b)), r.css("left", g + "px")) : (d = ia.height(), b = r.height(), b < d ? (bc = !1, g = parseInt(d / 2 - b / 2,
                    10)) : (bc = !0, g = parseInt(r.css("top"), 10), 0 < g ? g = 0 : g < d - b && (g = d - b)), r.css("top", g + "px")));
            Za = Cb.width();
            Md = wf.width();
            f && ("audio" == f ? E && WPSVPAspectRatio.resizeMedia("image", Va, I, E) : "video" == f ? wc && "video_360" == D ? Pb && (a = Ba.width(), d = Ba.height(), jc.setSize(a, d), na.aspect = a / d, na.updateProjectionMatrix()) : E ? WPSVPAspectRatio.resizeMedia("image", Va, I, E) : za && WPSVPAspectRatio.resizeMedia("video", Va, I, za) : "image" == f ? "image_360" == D ? pe && (a = Ba.width(), d = Ba.height(), ob.setSize(a, d), na.aspect = a / d, na.updateProjectionMatrix(),
                ob.render(Id, na)) : xc && WPSVPAspectRatio.resizeMedia("image", Va, I, xc) : "youtube" == f ? "chromeless" == la && k.width && k.height && WPSVPAspectRatio.resizeMedia("iframe", Va, hc, zb) : "vimeo" == f && "chromeless" == ba && k.width && k.height && WPSVPAspectRatio.resizeMedia("iframe", Va, pb, qb));
            if (hd)
                for (g = hd.length, a = e.width(), b = 0; b < g; b++) d = hd[b], a < d.width ? (-1 == d.elements.indexOf("controls") && Ja.addClass("wpsvp-force-hide"), -1 == d.elements.indexOf("seekbar") && Ca.addClass("wpsvp-force-hide"), -1 == d.elements.indexOf("play") && Ab.addClass("wpsvp-force-hide"), -1 == d.elements.indexOf("time") && (Rb.addClass("wpsvp-force-hide"), Sb.addClass("wpsvp-force-hide"), $c.addClass("wpsvp-force-hide")), -1 == d.elements.indexOf("download") && Pd.addClass("wpsvp-force-hide"), -1 == d.elements.indexOf("pip") && Zc.addClass("wpsvp-force-hide"), -1 == d.elements.indexOf("share") && Gf.addClass("wpsvp-force-hide"), -1 == d.elements.indexOf("info") && ed.addClass("wpsvp-force-hide"), -1 == d.elements.indexOf("embed") && Hf.addClass("wpsvp-force-hide"), -1 == d.elements.indexOf("next") && If.addClass("wpsvp-force-hide"), -1 == d.elements.indexOf("previous") && Jf.addClass("wpsvp-force-hide"), -1 == d.elements.indexOf("seek_backward") && ad.addClass("wpsvp-force-hide"), -1 == d.elements.indexOf("seek_forward") && bd.addClass("wpsvp-force-hide"), -1 == d.elements.indexOf("rewind") && cd.addClass("wpsvp-force-hide"), -1 == d.elements.indexOf("volume") && dd.addClass("wpsvp-force-hide"), -1 == d.elements.indexOf("fullscreen") && Fa.addClass("wpsvp-force-hide"), -1 == d.elements.indexOf("playlist") && Kf.addClass("wpsvp-force-hide"), -1 == d.elements.indexOf("quality") &&
                    oc.addClass("wpsvp-force-hide"), -1 == d.elements.indexOf("playback_rate") && Bb.addClass("wpsvp-force-hide"), -1 == d.elements.indexOf("subtitles") && (qc.addClass("wpsvp-force-hide"), Sd.addClass("wpsvp-force-hide")), -1 == d.elements.indexOf("annotations") && ec.addClass("wpsvp-force-hide"), -1 == d.elements.indexOf("audio_language") && kc.addClass("wpsvp-force-hide"), -1 == d.elements.indexOf("upnext") && mb.addClass("wpsvp-force-hide"), -1 == d.elements.indexOf("settings") && kh.addClass("wpsvp-force-hide")) : (-1 == d.elements.indexOf("controls") &&
                    Ja.removeClass("wpsvp-force-hide"), -1 == d.elements.indexOf("seekbar") && Ca.removeClass("wpsvp-force-hide"), -1 == d.elements.indexOf("play") && Ab.removeClass("wpsvp-force-hide"), -1 == d.elements.indexOf("time") && (Rb.removeClass("wpsvp-force-hide"), Sb.removeClass("wpsvp-force-hide"), $c.removeClass("wpsvp-force-hide")), -1 == d.elements.indexOf("download") && Pd.removeClass("wpsvp-force-hide"), -1 == d.elements.indexOf("pip") && Zc.removeClass("wpsvp-force-hide"), -1 == d.elements.indexOf("share") && Gf.removeClass("wpsvp-force-hide"), -1 ==
                    d.elements.indexOf("info") && ed.removeClass("wpsvp-force-hide"), -1 == d.elements.indexOf("embed") && Hf.removeClass("wpsvp-force-hide"), -1 == d.elements.indexOf("next") && If.removeClass("wpsvp-force-hide"), -1 == d.elements.indexOf("previous") && Jf.removeClass("wpsvp-force-hide"), -1 == d.elements.indexOf("seek_backward") && ad.removeClass("wpsvp-force-hide"), -1 == d.elements.indexOf("seek_forward") && bd.removeClass("wpsvp-force-hide"), -1 == d.elements.indexOf("rewind") && cd.removeClass("wpsvp-force-hide"), -1 == d.elements.indexOf("volume") &&
                    dd.removeClass("wpsvp-force-hide"), -1 == d.elements.indexOf("fullscreen") && Fa.removeClass("wpsvp-force-hide"), -1 == d.elements.indexOf("playlist") && Kf.removeClass("wpsvp-force-hide"), -1 == d.elements.indexOf("quality") && oc.removeClass("wpsvp-force-hide"), -1 == d.elements.indexOf("playback_rate") && Bb.removeClass("wpsvp-force-hide"), -1 == d.elements.indexOf("subtitles") && (qc.removeClass("wpsvp-force-hide"), Sd.removeClass("wpsvp-force-hide")), -1 == d.elements.indexOf("annotations") && ec.removeClass("wpsvp-force-hide"), -1 == d.elements.indexOf("audio_language") &&
                    kc.removeClass("wpsvp-force-hide"), -1 == d.elements.indexOf("upnext") && mb.removeClass("wpsvp-force-hide"), -1 == d.elements.indexOf("settings") && kh.removeClass("wpsvp-force-hide"));
            if (Vh && qa) {
                a = Kb.width();
                g = lh.length;
                for (b = 0; b < g; b++)
                    if (d = lh[b], a > d.width) var h = d.size;
                Kb.css("fontSize", h + "px")
            }
            bb && P.is(":visible") && (P.height() > Lf.offset().top - ua.scrollTop() ? (P.addClass("wpsvp-menu-bottom"), e.addClass("wpsvp-holder-visible")) : (P.removeClass("wpsvp-menu-bottom"), e.removeClass("wpsvp-holder-visible")))
        }

        function Yf(a) {
            if (!u) return !1;
            if ("undefined" !== typeof a) {
                if (Z && 1 == a || !Z && 0 == a) return !1;
                Z = !a
            }
            Z ? J.hide() : J.show();
            Z = !Z;
            tc()
        }

        function Mb(a) {
            var d = {};
            if ("html" == (a.type ? "data" : "html")) {
                d.origclasses = a.attr("class");
                d.type = a.attr("data-type");
                xd ? d.pwd = xd : void 0 == a.attr("data-pwd") || WPSVPUtils.isEmpty(a.attr("data-pwd")) || (d.pwd = a.attr("data-pwd"));
                void 0 != a.attr("data-noapi") && (d.noapi = !0);
                void 0 != a.attr("data-live-stream") && (d.liveStream = !0);
                void 0 == a.attr("data-alt") || WPSVPUtils.isEmpty(a.attr("data-alt")) || (d.alt = a.attr("data-alt"));
                void 0 == a.attr("data-deeplink") || WPSVPUtils.isEmpty(a.attr("data-deeplink")) || (d.deeplink = a.attr("data-deeplink"));
                "image" == d.type || "image_360" == d.type || "audio" == d.type || "video" == d.type || "video_360" == d.type ? d.path = a.data("path") : void 0 == a.attr("data-path") || WPSVPUtils.isEmpty(a.attr("data-path")) || (d.path = a.attr("data-path"), -1 != d.path.indexOf("ebsfm:") && (d.path = atob(d.path.substr(6))));
                void 0 == a.attr("data-mp4") || WPSVPUtils.isEmpty(a.attr("data-mp4")) || (d.mp4 = a.attr("data-mp4"));
                void 0 == a.attr("data-thumb") ||
                    WPSVPUtils.isEmpty(a.attr("data-thumb")) || (d.thumb = a.attr("data-thumb"));
                void 0 == a.attr("data-title") || WPSVPUtils.isEmpty(a.attr("data-title")) || (d.title = a.attr("data-title"));
                a.find(".wpsvp-playlist-title").length && (d.domTitle = a.find(".wpsvp-playlist-title").html());
                void 0 == a.attr("data-description") || WPSVPUtils.isEmpty(a.attr("data-description")) ? a.find(".wpsvp-playlist-description").length && (d.description = a.find(".wpsvp-playlist-description").html()) : d.description = a.attr("data-description");
                void 0 == a.attr("data-quality") ||
                    WPSVPUtils.isEmpty(a.attr("data-quality")) || (d.quality = a.attr("data-quality"));
                void 0 == a.attr("data-download") || WPSVPUtils.isEmpty(a.attr("data-download")) || (d.download = a.attr("data-download"));
                void 0 == a.attr("data-poster") || WPSVPUtils.isEmpty(a.attr("data-poster")) || (d.poster = a.attr("data-poster"));
                void 0 == a.attr("data-poster-frame-time") || WPSVPUtils.isEmpty(a.attr("data-poster-frame-time")) || (d.posterFrameTime = a.attr("data-poster-frame-time"));
                void 0 == a.attr("data-start") || WPSVPUtils.isEmpty(a.attr("data-start")) ||
                    (d.start = Number(a.attr("data-start")));
                void 0 == a.attr("data-end") || WPSVPUtils.isEmpty(a.attr("data-end")) || (d.end = Number(a.attr("data-end")));

                /*  added by Boldman */
                void 0 != a.attr("data-random-clip-time") && !WPSVPUtils.isEmpty(a.attr("data-random-clip-time")) && WPSVPUtils.isNumber(a.attr("data-random-clip-time")) && (d.randomClipTime = Number(a.attr("data-random-clip-time")));
                
                //void 0 == a.attr("data-random-clip-time") || WPSVPUtils.isEmpty(a.attr("data-random-clip-time")) || (d.randomClipTime = Number(a.attr("data-random-clip-time")));
                void 0 == a.attr("data-duration") || WPSVPUtils.isEmpty(a.attr("data-duration")) || (d.duration = a.attr("data-duration"));
                void 0 != a.attr("data-playback-rate") && !WPSVPUtils.isEmpty(a.attr("data-playback-rate")) && WPSVPUtils.isNumber(a.attr("data-playback-rate")) && (d.playbackRate = Number(a.attr("data-playback-rate")));
                void 0 == a.attr("data-aspect-ratio") || WPSVPUtils.isEmpty(a.attr("data-aspect-ratio")) ||
                    (d.aspectRatio = a.attr("data-aspect-ratio"));
                void 0 != a.attr("data-id3") && (d.id3 = !0);
                void 0 == a.attr("data-share") || WPSVPUtils.isEmpty(a.attr("data-share")) || (d.share = a.attr("data-share"));
                void 0 == a.attr("data-limit") || WPSVPUtils.isEmpty(a.attr("data-limit")) || (d.limit = Number(a.attr("data-limit")));
                void 0 == a.attr("data-width") || WPSVPUtils.isEmpty(a.attr("data-width")) || void 0 == a.attr("data-height") || WPSVPUtils.isEmpty(a.attr("data-height")) || (d.width = parseInt(a.attr("data-width"), 10), d.height = parseInt(a.attr("data-height"),
                    10));
                void 0 != a.attr("data-is360") && (d.is360 = !0);
                void 0 == a.attr("data-preview-seek") || WPSVPUtils.isEmpty(a.attr("data-preview-seek")) || (d.previewSeek = a.attr("data-preview-seek"));
                void 0 == a.attr("data-user-id") || WPSVPUtils.isEmpty(a.attr("data-user-id")) || (d.user_id = a.attr("data-user-id"));
                void 0 == a.attr("data-sort") || WPSVPUtils.isEmpty(a.attr("data-sort")) || (d.sort = a.attr("data-sort"), void 0 == a.attr("data-sort-direction") || WPSVPUtils.isEmpty(a.attr("data-sort-direction")) || (d.sortDirection = a.attr("data-sort-direction")));
                void 0 == a.attr("data-user-account") || WPSVPUtils.isEmpty(a.attr("data-user-account")) || (d.userAccount = a.attr("data-user-account"));
                if (a.children(".wpsvp-subtitles").length) {
                    var b = a.children(".wpsvp-subtitles");
                    b.children("div").length && (d.subtitles = [], b.children("div").each(function() {
                        var a = c(this),
                            b = a.attr("data-label");
                        b = {
                            label: b,
                            value: b,
                            src: a.attr("data-src")
                        };
                        void 0 != a.attr("data-default") && (b["default"] = !0);
                        d.subtitles.push(b)
                    }))
                }
                a.find(".wpsvp-custom-playlist-item-content").length && (d.customContent =
                    a.find(".wpsvp-custom-playlist-item-content").html());
                void 0 != a.attr("data-chapters") && (d.chapters = a.attr("data-chapters"));
                void 0 == a.attr("data-link") || WPSVPUtils.isEmpty(a.attr("data-link")) || (d.link = a.attr("data-link"), void 0 == a.attr("data-target") || WPSVPUtils.isEmpty(a.attr("data-target")) ? d.target = "_blank" : d.target = a.attr("data-target"));
                void 0 == a.attr("data-end-link") || WPSVPUtils.isEmpty(a.attr("data-end-link")) || (d.endLink = a.attr("data-end-link"), d.endTarget = "_blank", void 0 == a.attr("data-end-target") ||
                    WPSVPUtils.isEmpty(a.attr("data-end-target")) || (d.endTarget = a.attr("data-end-target")));
                void 0 == a.attr("data-skip-enable") || WPSVPUtils.isEmpty(a.attr("data-skip-enable")) || (d.skipEnable = Math.abs(parseInt(a.attr("data-skip-enable"), 10)));
                void 0 == a.attr("data-ad-id") || WPSVPUtils.isEmpty(a.attr("data-ad-id")) || (d.adId = a.attr("data-ad-id"));
                a.children(".wpsvp-ad-section").length && (d.adSection = a.children(".wpsvp-ad-section"));
                a.children(".wpsvp-annotation-section").length && (d.annotationSection = a.children(".wpsvp-annotation-section"))
            } else d =
                c.extend(!0, {}, a);
            void 0 != a.attr("data-load-more") && (Ob = !0, Nb = a.wrap("<p>").parent().html(), Ad && "youtube_user" == d.type && (mh = !0));
            return d
        }

        function pg() {
            var a = {
                playlist: c.trim(r.html()),
                activePlaylist: ee,
                date: Math.floor(Date.now() / 1E3)
            };
            Ob && ca && Nb && (a.loadMoreOnTotalScroll = !0, a.nextPageToken = ca, a.loadMoreItem = Nb, mh && (a.channelId = ra.getChannelId()));
            localStorage.setItem(zc, JSON.stringify(a))
        }
        var e = c(this),
            Ba = e.find(".wpsvp-media-holder").show(),
            J = e.find(".wpsvp-playlist-holder"),
            ia = e.find(".wpsvp-playlist-inner"),
            r = e.find(".wpsvp-playlist-content"),
            nh = e.find(".wpsvp-playlist-filter-msg"),
            Sd = e.find(".wpsvp-subtitle-holder").css("display", "none"),
            Kb = e.find(".wpsvp-subtitle-holder-inner"),
            ec = e.find(".wpsvp-annotation-holder").css("display", "none"),
            I = e.find(".wpsvp-player-holder").show(),
            gc = e.find(".wpsvp-video-holder"),
            te = e.find(".wpsvp-audio-holder"),
            gf = e.find(".wpsvp-image-holder"),
            hc = e.find(".wpsvp-youtube-holder"),
            ue = e.find(".wpsvp-vimeo-holder-default"),
            ve = e.find(".wpsvp-vimeo-holder-chromeless"),
            Vg = e.find(".wpsvp-iframe-holder"),
            Ja = e.find(".wpsvp-player-interface"),
            Ab = e.find(".wpsvp-playback-toggle"),
            Rb = e.find(".wpsvp-media-time-current"),
            $c = e.find(".wpsvp-media-time-separator"),
            Sb = e.find(".wpsvp-media-time-total"),
            mc = e.find(".wpsvp-preview-seek-wrap"),
            wh = e.find(".wpsvp-preview-seek-inner"),
            uh = e.find(".wpsvp-preview-seek-time-current"),
            Ca = e.find(".wpsvp-seekbar"),
            Cb = e.find(".wpsvp-progress-bg"),
            fh = e.find(".wpsvp-load-level"),
            Te = e.find(".wpsvp-progress-level"),
            dd = e.find(".wpsvp-volume-wrapper"),
            Hc = e.find(".wpsvp-volume-toggle"),
            ab = e.find(".wpsvp-volume-seekbar"),
            Fc = e.find(".wpsvp-volume-bg"),
            yh = e.find(".wpsvp-volume-level"),
            Xe = e.find(".wpsvp-info-holder");
        e.find(".wpsvp-info-data");
        e.find(".wpsvp-info-inner");
        var ed = e.find(".wpsvp-info-toggle"),
            Wg = e.find(".wpsvp-player-title"),
            Yg = e.find(".wpsvp-player-desc"),
            Ze = e.find(".wpsvp-embed-holder");
        e.find(".wpsvp-embed-data-wrap");
        var Hf = e.find(".wpsvp-embed-toggle"),
            od = e.find(".wpsvp-pwd-holder"),
            de = e.find(".wpsvp-pwd-field"),
            Ve = e.find(".wpsvp-pwd-error").text(),
            Kf = e.find(".wpsvp-playlist-toggle"),
            gb = e.find(".wpsvp-player-loader"),
            xb = e.find(".wpsvp-playlist-loader"),
            H = e.find(".wpsvp-big-play"),
            Mf = e.find(".wpsvp-loop-toggle"),
            Nf = e.find(".wpsvp-shuffle-toggle"),
            Pd = e.find(".wpsvp-download-toggle"),
            Gf = e.find(".wpsvp-share-toggle"),
            Ye = e.find(".wpsvp-share-holder"),
            ad = e.find(".wpsvp-seek-backward"),
            bd = e.find(".wpsvp-seek-forward"),
            cd = e.find(".wpsvp-rewind-toggle"),
            Qa = e.find(".wpsvp-nav-backward"),
            Ma = e.find(".wpsvp-nav-forward"),
            Jd = e.find(".wpsvp-vr-info"),
            nb = e.find(".wpsvp-lightbox-wrap"),
            Wh = e.find(".wpsvp-lightbox"),
            Xh = e.find(".wpsvp-lightbox-inner"),
            fc = e.find(".wpsvp-lightbox-content-inner"),
            Yh =
            e.find(".wpsvp-lightbox-close"),
            Zh = e.find(".wpsvp-lightbox-prev"),
            $h = e.find(".wpsvp-lightbox-next"),
            mb = e.find(".wpsvp-upnext-wrap"),
            kf = e.find(".wpsvp-upnext-thumb"),
            lf = e.find(".wpsvp-upnext-title"),
            If = e.find(".wpsvp-next-toggle"),
            Jf = e.find(".wpsvp-previous-toggle"),
            Lf = e.find(".wpsvp-settings-toggle"),
            Bb = e.find(".wpsvp-playback-rate-toggle"),
            sd = e.find(".wpsvp-playback-rate-menu-holder"),
            be = e.find(".wpsvp-playback-rate-menu"),
            oc = e.find(".wpsvp-quality-toggle").hide(),
            rd = e.find(".wpsvp-quality-menu-holder"),
            ld = e.find(".wpsvp-quality-menu"),
            Wf = e.find(".wpsvp-quality-settings-menu"),
            qc = e.find(".wpsvp-subtitle-toggle").hide(),
            qd = e.find(".wpsvp-subtitle-menu-holder"),
            pc = e.find(".wpsvp-subtitle-menu"),
            Xf = e.find(".wpsvp-subtitle-settings-menu"),
            Qd = e.find(".wpsvp-audio-language-menu"),
            Of = e.find(".wpsvp-audio-language-menu-holder"),
            kc = e.find(".wpsvp-audio-language-toggle").hide(),
            Bf = e.find(".wpsvp-audio-language-settings-menu"),
            Ec = e.find(".wpsvp-chapter-title"),
            Zc = e.find(".wpsvp-pip-toggle").hide(),
            Lb = e.find(".wpsvp-link-copy"),
            Zb = e.find(".wpsvp-embed-copy"),
            Xg = e.find(".wpsvp-player-header-title"),
            vf = e.find(".wpsvp-ad-seekbar"),
            wf = e.find(".wpsvp-ad-progress-bg"),
            dh = e.find(".wpsvp-ad-load-level"),
            eh = e.find(".wpsvp-ad-progress-level"),
            Rh = e.find(".wpsvp-ad-info-time"),
            Rd = e.find(".wpsvp-ad-skip-btn"),
            jh = e.find(".wpsvp-ad-skip-msg"),
            Cf = e.find(".wpsvp-ad-skip-msg-text"),
            ch = Cf.html(),
            bh = e.find(".wpsvp-ad-skip-msg-end"),
            ih = e.find(".wpsvp-ad-skip-thumb");
        b = c.extend(!0, {}, {
            youtubePlayerType: "chromeless",
            blockYoutubeEvents: !1,
            vimeoPlayerType: "default",
            vimeoPlayerColor: "#00adef",
            blockVimeoEvents: !0,
            playerRatio: 1.7777777,
            playlistBottomHeight: 300,
            playlistSideWidth: 290,
            lightboxMaxWidth: 920,
            preload: "auto",
            sourcePath: "",
            instanceName: "",
            thumbScrollValue: 50,
            youtubePlayerColor: "red",
            verticalBottomSepearator: 700,
            subtitleOffText: "Disabled",
            showInterfaceOnMediaStart: !0,
            sortableTracks: !1,
            useMobileNativePlayer: !1,
            hideQualityMenuOnSingleQuality: !0,
            aspectRatio: 2,
            randomPlay: !1,
            loopingOn: !0,
            hidePlaylistOnFullscreenEnter: !0,
            playlistItemContent: "title,description",
            dynamicSubtitleSize: !0,
            playbackPositionKey: "wpsvp-playback-position",
            rightClickContextMenu: "custom",
            focusVideoOnActive: !1,
            playlistOpened: !0,
            limitDescriptionText: 100,
            showStreamVideoBitrateMenu: !1,
            showStreamAudioBitrateMenu: !1,
            seekTime: 10,
            createAdMarkers: !0,
            playAdsOnlyOnce: !1,
            showAnnotationsOnlyOnce: !1,
            playlistStorageKey: "wpsvp-playlist-storage",
            truncateWatch: !0
        }, b);
        var G = WPSVPUtils.isMobile(),
            Qc = WPSVPUtils.hasLocalStorage(),
            La = b.sourcePath,
            M = b.instanceName,
            hg = b.playlistList,
            Xd = b.mediaEndAction,
            ai = b.useKeyboardNavigationForPlayback,
            K = b.volume,
            R = b.autoPlay,
            yd = b.autoPlayAfterFirst,
            yb = b.autoPlayInViewport,
            Mc = R,
            Zg, Ee, Hd = b.forceMutedAutoplay,
            Z = b.playlistOpened,
            Va, we = b.hideQualityMenuOnSingleQuality,
            Qh = b.togglePlaybackOnMultipleInstances,
            mg = b.sortableTracks,
            Bg = b.preload,
            yc = b.playerRatio,
            Pf = b.hidePlaylistOnFullscreenEnter,
            id, ke = b.minimizeOnScroll,
            ne = b.minimizeClass,
            Ff = b.playlistBottomHeight,
            Uh = b.playlistSideWidth,
            bi = b.lightboxMaxWidth,
            Af = b.blockYoutubeEvents,
            Ph = b.blockVimeoEvents,
            la = b.youtubePlayerType,
            vg = b.vimeoPlayerType,
            Bd = b.breakPointArr,
            Th = b.verticalBottomSepearator,
            hd = b.elementsVisibilityArr,
            md = b.subtitleOffText,
            Sh = b.playAdsOnlyOnce,
            ci = b.showAnnotationsOnlyOnce,
            gh = b.showInterfaceOnMediaStart,
            Ac = b.playbackPositionKey,
            oh = b.rememberPlaybackPosition && Qc && Ac,
            of = b.useMobileNativePlayer,
            di = b.useGa && "file:" != window.location.protocol,
            ph = b.useSwipeNavigation && "ontouchstart" in window,
            jg = b.limitDescriptionText,
            ig = b.playlistItemContent.split(","),
            Vh = b.dynamicSubtitleSize,
            Gb = b.rightClickContextMenu,
            ag = b.focusVideoOnActive,
            Ib = !0,
            $a = "normal",
            $g = b.showStreamVideoBitrateMenu,
            ah = b.showStreamAudioBitrateMenu,
            Tb = b.seekTime,
            hh = b.createAdMarkers,
            Hh = b.forceYoutubeChromeless,
            zc = b.playlistStorageKey,
            Ad = b.cacheTime,
            Ga = e.attr("class").split(/\s+/),
            gd = "normal"; - 1 < Ga.indexOf("wpsvp-layout-100") && (gd = "100%");
        var eb = "none"; - 1 < Ga.indexOf("wpsvp-nt-scroll") ? eb = "scroll" : -1 < Ga.indexOf("wpsvp-nt-buttons") ? eb = "buttons" : -1 < Ga.indexOf("wpsvp-nt-hover") && (eb = "hover");
        var ya = "vertical";
        if (-1 < Ga.indexOf("wpsvp-ht") || -1 < Ga.indexOf("wpsvp-hb")) ya = "horizontal";
        var ka = "right_bottom"; - 1 < Ga.indexOf("wpsvp-vlb") ? ka = "left_bottom" : -1 < Ga.indexOf("wpsvp-vl") ?
            ka = "left" : -1 < Ga.indexOf("wpsvp-vr") ? ka = "right" : -1 < Ga.indexOf("wpsvp-ht") ? ka = "top" : -1 < Ga.indexOf("wpsvp-hb") ? ka = "bottom" : -1 < Ga.indexOf("wpsvp-vb") ? ka = "bottom" : -1 < Ga.indexOf("wpsvp-wall") ? (ka = "wall", $a = "lightbox") : -1 < Ga.indexOf("wpsvp-outer") ? ka = "outer" : -1 < Ga.indexOf("wpsvp-no-playlist") && (ka = "no-playlist", Ib = !1);
        "outer" == ka && (Pf = !1, ag = !0);
        "default" == la ? Af = !1 : ph && (Af = !0);
        "100%" == gd && (ke = yb = !1);
        "lightbox" == $a && (ke = yb = !1, Z = !0);
        "" != b.wrapperMaxWidth && e.css("max-width", b.wrapperMaxWidth + "px");
        if (Bd && Bd.length) {
            WPSVPUtils.keysrt(Bd,
                "width");
            var qg = !0
        }
        hd && hd.length && WPSVPUtils.keysrt(hd, "width");
        var mf = WPSVPUtils.isIOS(),
            ei = WPSVPUtils.isiPhoneIpod(),
            Gh = WPSVPUtils.isAndroid(),
            fi = WPSVPUtils.hasFullscreen(),
            Oh = WPSVPUtils.hasDownloadSupport(),
            gi = WPSVPUtils.volumeCanBeSet(),
            hi = WPSVPUtils.supportsWebGL(),
            ug = WPSVPUtils.canPlayMp4(),
            tg = WPSVPUtils.canPlayMp3(),
            sg = WPSVPUtils.canPlayWav(),
            yf = WPSVPUtils.isChrome(),
            zf = WPSVPUtils.isSafari(),
            Zf = document.pictureInPictureEnabled,
            u = !1,
            Y = !0,
            kb, bf, p = this,
            Qf = c("body"),
            ua = c(window),
            Ha = c(document),
            Le = c("html"),
            Rf, pa, tb, Oa,
            Ua, k, qe, Uc, X, A, ng = "scroll." + M,
            Fb, Eb = [],
            V, rf, He, wg, Pa, Dg = window.MediaSource,
            yg, Eg, sc, cf, Ag, vc, t, E, lb, m, za, nf, ra, zb, y, Hg, xf, Be, Ae, Ce, mh, xa, qb, w, pb, ba, Jg, Tg, Ig, Sg, Nd, Od, Kg, Ug, De, Db = 0,
            fd = 0,
            Ge = 0,
            Fe, wc = !0,
            Kd, Cg, Sc, jc, Yc, pf, Pb, na, fb, ye, xc, uf, Ld, Qb, Fg, pe, Tc, sf, tf, Id, ob, Gg, Dh = b.thumbScrollValue,
            bc = !0,
            Yb, Ra, Rc, uc, ef, Pc, Cd, O, f, D, da, T, We, wb, ib, vb, jb, ha, fg = 0,
            ub = !0,
            $b, le, zd, ma = [],
            Sa = [],
            ja, wd, ac, ae, Hb, Ie, Ka, rc, ce = [],
            db = [],
            qa, lh = [{
                width: 0,
                size: 18
            }, {
                width: 480,
                size: 20
            }, {
                width: 768,
                size: 22
            }, {
                width: 1024,
                size: 24
            }, {
                width: 1280,
                size: 36
            }],
            Oc, Ta, Nc, he, ie, df, cc, Ea, ff, Ia = [],
            Td, Vc, ud, Md = 0,
            Fd, hf, Q, re, hb = [],
            Wc, Dd, Wd, Vd, Df, Ud, Xc = [],
            Je, jf, Ed, vd, se, xd;
        window.playlistScrollLoading = !1;
        "scroll" == eb && WPSVPUtils.checkCssExist(WPSVPUtils.qualifyURL(La + "css/jquery.mCustomScrollbar.css"));
        "undefined" === typeof window.wpsvp_mediaArr && (window.wpsvp_mediaArr = []);
        wpsvp_mediaArr.push({
            inst: p,
            id: M
        });
        if (di) {
            if ("undefined" === typeof ga) {
                var Xa = document.createElement("script");
                Xa.type = "text/javascript";
                Xa.src = "//www.google-analytics.com/analytics.js";
                Xa.onload =
                    Xa.onreadystatechange = function() {
                        this.readyState && "complete" != this.readyState || ga("create", b.gaTrackingId, "auto")
                    };
                Xa.onerror = function() {
                    alert("Error loading " + this.src)
                };
                var Yd = document.getElementsByTagName("script")[0];
                Yd.parentNode.insertBefore(Xa, Yd)
            } else ga("create", b.gaTrackingId, "auto");
            Pd.on("click", function() {
                c(p).trigger("mediaDownload", {
                    instance: p,
                    instanceName: M,
                    counter: tb
                })
            })
        }
        ph && ("undefined" === typeof c.fn.swipe ? (Xa = document.createElement("script"), Xa.type = "text/javascript", Xa.src = WPSVPUtils.qualifyURL(La +
            "js/scripts/jquery.touchSwipe.min.js"), Xa.onload = Xa.onreadystatechange = function() {
            this.readyState && "complete" != this.readyState || n()
        }, Xa.onerror = function() {
            alert("Error loading " + this.src)
        }, Yd = document.getElementsByTagName("script")[0], Yd.parentNode.insertBefore(Xa, Yd)) : n());
        if ("lightbox" == $a) {
            Xh.css("max-width", bi + "px");
            Yh.on("click", function() {
                nb.one("transitionend", function() {
                    nb.css("display", "none")
                }).css("opacity", 0);
                f && dc();
                X && pd()
            });
            if (b.clickOnBackgroundClosesLightbox) Wh.on("click", function(a) {
                a.target ==
                    this && (nb.one("transitionend", function() {
                        nb.css("display", "none")
                    }).css("opacity", 0), f && dc(), X && pd())
            });
            Zh.on("click", function(a) {
                a.stopImmediatePropagation();
                kd()
            });
            $h.on("click", function(a) {
                a.stopImmediatePropagation();
                Vb()
            })
        }
        b.logoPosition && ("tl" == b.logoPosition ? e.find(".wpsvp-logo").css({
            top: b.logoMargin + "px",
            left: b.logoMargin + "px"
        }) : "tr" == b.logoPosition ? e.find(".wpsvp-logo").css({
            top: b.logoMargin + "px",
            right: b.logoMargin + "px"
        }) : "bl" == b.logoPosition ? e.find(".wpsvp-logo").css({
            bottom: b.logoMargin + "px",
            left: b.logoMargin + "px"
        }) : "br" == b.logoPosition && e.find(".wpsvp-logo").css({
            bottom: b.logoMargin + "px",
            right: b.logoMargin + "px"
        }));
        G ? R = !1 : yb && (R = !1);
        yd && (R = !1);
        Hd && (R = !0);
        Ib || (Z = !1, J.css({
            width: 0,
            height: 0
        }).hide());
        Z ? J.show() : J.hide();
        ei && Zc.remove();
        hi || (wc = !1, Jd.remove(), yf && console.log("Turn Hardware Acceleration On Within Chrome Browser to enable 360 video and images!"));
        "bottom" == ka && "vertical" == ya && J.css({
            height: Ff
        });
        var Me = c('<div class="wpsvp-playlist-item"></div>').prependTo(e);
        var wa = "horizontal" ==
            ya ? Me.outerWidth(!0) : Me.outerHeight(!0);
        Me.remove();
        Me = null;
        oh && (window.attachEvent || window.addEventListener)(mf ? "pagehide" : "beforeunload", function(a) {
            window.event && (window.event.cancelBubble = !0);
            if (!u || !f) return !1;
            a = {
                volume: K,
                activeItem: tb,
                resumeTime: parseInt(p.getCurrentTime(), 10)
            };
            localStorage.setItem(Ac, JSON.stringify(a))
        });
        mb.find(".wpsvp-upnext-close").on("click", function() {
            mb.removeClass("wpsvp-upnext-on wpsvp-upnext-visible")
        });
        kf.on("click", function() {
            mb.removeClass("wpsvp-upnext-on wpsvp-upnext-visible");
            Vb()
        });
        lf.on("click", function() {
            mb.removeClass("wpsvp-upnext-on wpsvp-upnext-visible");
            Vb()
        });
        Rd.on("click", function() {
            if (!u || !Q || !Vd) return !1;
            Q && c(p).trigger("adSkip", {
                instance: p,
                instanceName: M,
                adId: k.adId
            });
            ic()
        });
        ec.on("click", ".wpsvp-annotation-close", function() {
            var a = c(this).attr("data-id");
            ci ? (c(this).parent().remove(), Xc.splice(a, 1)) : c(this).parent().hide()
        });
        e.hasClass("wpsvp-skin-light-flat") || e.hasClass("wpsvp-skin-gray-flat");
        if ("ontouchstart" in window) {
            var kg = !0;
            var Ne = "touchstart.ap mousedown.ap";
            var rb = "touchmove.ap mousemove.ap";
            var Dc = "touchend.ap mouseup.ap"
        } else window.PointerEvent ? (Ne = "pointerdown.ap", rb = "pointermove.ap", Dc = "pointerup.ap") : (Ne = "mousedown.ap", rb = "mousemove.ap", Dc = "mouseup.ap");
        te.on("click", function() {
            if (ac) return !1;
            if (G)
                if (pa && ub) Jb();
                else {
                    if (t)
                        if (t.paused) {
                            var a = t.play();
                            void 0 !== a && a.then(function(a) {})["catch"](function(a) {
                                H.show()
                            })
                        } else t.pause()
                } else t ? t.paused ? (a = t.play(), void 0 !== a && a.then(function(a) {})["catch"](function(a) {
                H.show()
            })) : t.pause() : E && !pa && va()
        });
        gc.on("click", function() {
            if (ac) return !1;
            if (G)
                if (pa && ub) Jb();
                else if (m)
                if (m.paused) {
                    var a = m.play();
                    void 0 !== a && a.then(function(a) {})["catch"](function(a) {
                        H.show()
                    })
                } else m.pause();
            else E && !pa && (E.remove(), E = null, va());
            else m ? m.paused ? (a = m.play(), void 0 !== a && a.then(function(a) {})["catch"](function(a) {
                H.show()
            })) : m.pause() : E && !pa && (E.remove(), E = null, va())
        });
        e.find(".wpsvp-search-field").on("keyup.apfilter", function() {
            if (0 == A) return !1;
            var a = c(this).val(),
                b, e = 0;
            for (b = 0; b < A; b++) {
                var f = r.children(".wpsvp-playlist-item").eq(b).find(".wpsvp-playlist-title").html(); - 1 < f.indexOf(a) ? r.children(".wpsvp-playlist-item").eq(b).show() : (r.children(".wpsvp-playlist-item").eq(b).hide(), e++)
            }
            e == A ? nh.show() : nh.hide()
        });
        var Wa = "normal",
            Sf;
        Ha.on("fullscreenchange mozfullscreenchange MSFullscreenChange webkitfullscreenchange", function(a) {
            Sf == M && (ha && clearTimeout(ha), "fullscreen" == Wa ? (Wa = "normal", Le.removeClass("wpsvp-fs-overflow"), e.removeClass("wpsvp-fs"), "lightbox" == $a && fc.removeClass("wpsvp-fs"), Fa.find(".wpsvp-btn-fullscreen").show(), Fa.find(".wpsvp-btn-normal").hide(), "custom" == Gb &&
                (Oe.find(".wpsvp-context-fullscreen-enter").show(), Oe.find(".wpsvp-context-fullscreen-exit").hide()), id && !Z && (id = !1, J.show(), Z = !0), G || Ha.off("mousemove", td), document.body.style.cursor = "default", Sf = null, c(p).trigger("fullscreenExit", {
                    instance: p,
                    instanceName: M
                })) : (Wa = "fullscreen", Le.addClass("wpsvp-fs-overflow"), e.addClass("wpsvp-fs"), "lightbox" == $a && fc.addClass("wpsvp-fs"), Fa.find(".wpsvp-btn-fullscreen").hide(), Fa.find(".wpsvp-btn-normal").show(), "custom" == Gb && (Oe.find(".wpsvp-context-fullscreen-enter").hide(), Oe.find(".wpsvp-context-fullscreen-exit").show()),
                Pf && Z && (id = !0, J.hide(), Z = !1), G ? ha = setTimeout(function() {
                    clearTimeout(this);
                    ha = null;
                    Lc()
                }, 4E3) : (Ha.on("mousemove", td), ha = setTimeout(function() {
                    clearTimeout(this);
                    ha = null;
                    td()
                }, 4E3)), c(p).trigger("fullscreenEnter", {
                    instance: p,
                    instanceName: M
                })));
            zf && tc()
        });
        var Fa = e.find(".wpsvp-fullscreen-toggle").on("click", function(a) {
            Sf = M;
            a = e[0];
            "normal" == Wa && c(p).trigger("fullscreenBeforeEnter", {
                instance: p,
                instanceName: M
            });
            fi ? a.requestFullscreen ? document.fullscreenElement ? document.exitFullscreen() : a.requestFullscreen() :
                a.webkitRequestFullScreen ? document.webkitIsFullScreen ? document.webkitCancelFullScreen() : a.webkitRequestFullScreen() : a.msRequestFullscreen ? document.msIsFullscreen || document.msFullscreenElement ? document.msExitFullscreen() : a.msRequestFullscreen() : a.mozRequestFullScreen && (document.fullscreenElement || document.mozFullScreenElement ? document.mozCancelFullScreen() : a.mozRequestFullScreen()) : ("fullscreen" == Wa ? (Wa = "normal", Le.removeClass("wpsvp-fs-overflow"), e.removeClass("wpsvp-fs"), "lightbox" == $a && fc.removeClass("wpsvp-fs"),
                    document.body.style.cursor = "default", Fa.find(".wpsvp-btn-fullscreen").show(), Fa.find(".wpsvp-btn-normal").hide(), id && !Z && (id = !1, J.show(), Z = !0), c(p).trigger("fullscreenExit", {
                        instance: p,
                        instanceName: M
                    })) : (Wa = "fullscreen", Le.addClass("wpsvp-fs-overflow"), e.addClass("wpsvp-fs"), "lightbox" == $a && fc.addClass("wpsvp-fs"), Fa.find(".wpsvp-btn-fullscreen").hide(), Fa.find(".wpsvp-btn-normal").show(), Pf && Z && (id = !0, J.hide(), Z = !1), G ? ha = setTimeout(function() {
                    clearTimeout(this);
                    ha = null;
                    Lc()
                }, 4E3) : (Ha.on("mousemove", td), ha = setTimeout(function() {
                    clearTimeout(this);
                    ha = null;
                    td()
                }, 4E3)), c(p).trigger("fullscreenEnter", {
                    instance: p,
                    instanceName: M
                })), tc())
        });
        Fa.find(".wpsvp-btn-normal").hide();
        Fa.find(".wpsvp-btn-fullscreen").show();
        if ("disabled" == Gb) e.on("contextmenu", function() {
            return !1
        });
        else if ("custom" == Gb) {
            var jd = function() {
                    Qf.off("click.apcc", jd);
                    Bc.hide()
                },
                Bc = I.find(".wpsvp-context-menu").on("contextmenu", function(a) {
                    return !1
                }),
                Ke = Bc.find(".wpsvp-context-playback").on("click", function(a) {
                    p.togglePlayback()
                }),
                Oe = Bc.find(".wpsvp-context-fullscreen").on("click", function(a) {
                    Fa.click()
                }),
                Ic = Bc.find(".wpsvp-context-volume").on("click", function(a) {
                    l()
                });
            I.on("contextmenu", function(a) {
                if (c(a.target).hasClass("wpsvp-volume-level") || c(a.target).hasClass("wpsvp-volume-bg") || c(a.target).hasClass("wpsvp-progress-level") || c(a.target).hasClass("wpsvp-progress-bg") || c(a.target).hasClass("wpsvp-load-level") || c(a.target).hasClass("wpsvp-embed-code")) return !0;
                a.preventDefault();
                a.stopPropagation();
                var b = I[0].getBoundingClientRect(),
                    e = Bc.outerWidth(!0),
                    f = Bc.outerHeight(!0),
                    g = parseInt(a.pageX - ua.scrollLeft() -
                        b.left, 10);
                a = parseInt(a.pageY - ua.scrollTop() - b.top, 10);
                g > I.width() - e && (g -= e);
                a > I.height() - f && (a -= f);
                Bc.css({
                    left: g + "px",
                    top: a + "px"
                }).show();
                Qf.one("click.apcc", jd)
            }).on("mouseleave", jd);
            Qf.on("mouseleave", jd);
            Ha.on("contextmenu", jd).keyup(function(a) {
                27 == a.keyCode && jd()
            })
        }
        var U = e.find(".wpsvp-tooltip");
        if (!G) e.find("[data-tooltip]").on("mouseenter", function(a) {
            a = c(this);
            var b = e[0].getBoundingClientRect(),
                f = a[0].getBoundingClientRect();
            U.text(a.attr("data-tooltip"));
            if (void 0 != a.attr("data-tooltip-position"))
                if ("left" ==
                    a.attr("data-tooltip-position")) var g = parseInt(f.top - b.top - U.outerHeight() / 2 + a.outerHeight() / 2),
                    h = parseInt(f.left - b.left - U.outerWidth() - 3);
                else "bottom" == a.attr("data-tooltip-position") && (g = parseInt(f.top - b.top + a.outerHeight()), h = parseInt(f.left - b.left - U.outerWidth() / 2 + a.outerWidth() / 2));
            else g = parseInt(f.top - b.top - U.outerHeight()), h = parseInt(f.left - b.left - U.outerWidth() / 2 + a.outerWidth() / 2);
            "lightbox" != $a && (0 > h ? h = 0 : h + U.outerWidth() > e.width() && (h = e.width() - U.outerWidth()), 0 > g + b.top && (g = parseInt(f.top -
                b.top + U.outerHeight() + 15)));
            U.css({
                left: h + "px",
                top: g + "px"
            }).show()
        }).on("mouseleave", function(a) {
            U.hide()
        });
        var Zd, Za, xh = Ca.hasClass("wpsvp-position-top") ? "top" : "bottom";
        Ca.on(Ne, function(a) {
            if (u) {
                if (Q) return !1;
                lc(a);
                return !1
            }
        });
        if (!G) {
            var Pe = function() {
                pa && (Ca.off(rb, L).off("mouseout", Pe), Ha.off("mouseout", Pe), k.previewSeek ? mc.hide() : U.hide())
            };
            Ca.on("mouseover", function() {
                pa && (Ca.on(rb, L).on("mouseout", Pe), Ha.on("mouseout", Pe))
            })
        }
        var nc = ab.hasClass("wpsvp-volume-horizontal"),
            Ue = .5;
        nc ? ab.width() : ab.height();
        var Gc = nc ? Fc.width() : Fc.height(),
            $d;
        0 > K ? K = 0 : 1 < K && (K = 1);
        0 != K && (Ue = K);
        if (!gi || G) ab.remove(), Hc.on("click", function(a) {
            l()
        });
        else Hc.on("click", function(a) {
            G && 0 != ab.length && !ab.hasClass("wpsvp-force-hide") || l()
        });
        ab.on(Ne, function(a) {
            v(a);
            return !1
        });
        if (!G) {
            var Qe = function() {
                ab.off(rb, aa).off("mouseout", Qe);
                Ha.off("mouseout", Qe);
                U.hide()
            };
            ab.on("mouseover", function() {
                ab.on(rb, aa).on("mouseout", Qe);
                Ha.on("mouseout", Qe)
            })
        }
        WPSVPUtils.isEmpty(b.facebookAppId) ? console.log("facebookAppId has not been set in settings!") :
            "file:" != window.location.protocol && S(b.facebookAppId);
        var kh = e.find(".wpsvp-settings-wrap"),
            P = e.find(".wpsvp-settings-holder"),
            cb = e.find(".wpsvp-settings-home"),
            bb = P.length;
        Lf.on("click", function() {
            ib && Jc(!1);
            vb && nd(!1);
            jb && Kc(!1);
            P.is(":visible") ? (P.hide(), P.find(".wpsvp-settings-menu").css("display", "none"), cb.css("display", "block")) : P.show()
        });
        bb && (cb.find(".wpsvp-menu-item").on("click", function() {
            var a = c(this).attr("data-target");
            cb.hide();
            P.find(".wpsvp-settings-menu").css("display", "none");
            P.find("." + a +
                "-holder").css("display", "block");
            P.height() > Lf.offset().top - ua.scrollTop() && (P.addClass("wpsvp-menu-bottom"), e.addClass("wpsvp-holder-visible"))
        }), P.find(".wpsvp-menu-header").on("click", function() {
            P.find(".wpsvp-settings-menu").css("display", "none");
            cb.css("display", "block");
            P.removeClass("wpsvp-menu-bottom");
            e.removeClass("wpsvp-holder-visible")
        }), be.find(".wpsvp-menu-item").each(function() {
            c(this).on("click", C)
        }));
        Bb.length && (Bb.on("mouseenter", function() {
            sd.show();
            be.height() > Bb.offset().top - ua.scrollTop() &&
                (sd.addClass("wpsvp-menu-bottom"), e.addClass("wpsvp-holder-visible"))
        }).on("mouseleave", function() {
            sd.hide().removeClass("wpsvp-menu-bottom");
            e.removeClass("wpsvp-holder-visible")
        }), be.find(".wpsvp-menu-item").each(function() {
            c(this).on("click", C)
        }));
        if (oc.length) oc.on("mouseenter", function() {
            rd.show();
            ld.height() > oc.offset().top - ua.scrollTop() && (rd.addClass("wpsvp-menu-bottom"), e.addClass("wpsvp-holder-visible"))
        }).on("mouseleave", function() {
            rd.hide().removeClass("wpsvp-menu-bottom");
            e.removeClass("wpsvp-holder-visible")
        });
        if (kc.length) kc.on("mouseenter", function() {
            Of.show();
            Qd.height() > kc.offset().top - ua.scrollTop() && (Of.addClass("wpsvp-menu-bottom"), e.addClass("wpsvp-holder-visible"))
        }).on("mouseleave", function() {
            Of.hide().removeClass("wpsvp-menu-bottom");
            e.removeClass("wpsvp-holder-visible")
        });
        if (qc.length) qc.on("mouseenter", function() {
            qd.show();
            pc.height() > qc.offset().top - ua.scrollTop() && (qd.addClass("wpsvp-menu-bottom"), e.addClass("wpsvp-holder-visible"))
        }).on("mouseleave", function() {
            qd.hide().removeClass("wpsvp-menu-bottom");
            e.removeClass("wpsvp-holder-visible")
        });
        this.setSubtitle = function(a) {
            if (!u || !f) return !1;
            Kb.empty();
            Sd.show();
            if (a == md || "" == a) rc = !1, qa = null, Ka && Ka.removeClass("wpsvp-menu-active"), Ka = pc.find(".wpsvp-menu-item[data-label='" + md + "']").addClass("wpsvp-menu-active");
            else if (ce[a]) rc = !1, qa = null, Ka && Ka.removeClass("wpsvp-menu-active"), Ka = pc.find(".wpsvp-menu-item[data-label='" + a + "']").addClass("wpsvp-menu-active"), db = ce[a], rc = !0;
            else {
                var b, c = k.subtitles.length;
                for (b = 0; b < c; b++) {
                    var e = k.subtitles[b];
                    if (e.label == a) {
                        rc = !1;
                        qa = null;
                        Ka && Ka.removeClass("wpsvp-menu-active");
                        Ka = pc.find(".wpsvp-menu-item[data-label='" + a + "']").addClass("wpsvp-menu-active");
                        "hls" == D ? W(e) : "dash" != D && Tf(e);
                        break
                    }
                }
            }
            bb && P.find(".wpsvp-subtitle-menu-value").text(a)
        };
        ai && Ha.keyup(function(a) {
            a.stopImmediatePropagation();
            a.preventDefault();
            if (!u) return !1;
            var b = a.keyCode;
            a = c(a.target);
            if (37 == b) p.seekBackward();
            else if (39 == b) p.seekForward();
            else if (33 == b) kd();
            else if (34 == b) Vb();
            else if (32 == b) {
                if (a.hasClass("wpsvp-search-field") || a.hasClass("wpsvp-pwd-field")) return !1;
                p.togglePlayback()
            } else if (77 == b) {
                if (a.hasClass("wpsvp-search-field") || a.hasClass("wpsvp-pwd-field")) return !1;
                l()
            }
        });
        var qh = [Ab, Kf, Fa, H, dd, ed, Gf, ad, bd, cd, Mf, Nf, Hf, If, Jf, Zc, e.find(".wpsvp-pwd-confirm"), e.find(".wpsvp-embed-close"), e.find(".wpsvp-info-close"), e.find(".wpsvp-share-item"), e.find(".wpsvp-share-close")],
            ii = qh.length,
            Wb;
        for (Wb = 0; Wb < ii; Wb++) c(qh[Wb]).css("cursor", "pointer").on("click", th);
        var ji = e.find(".wpsvp-link-code").text(window.location.href);
        Lb.on("click", function() {
            WPSVPUtils.selectText(ji[0]);
            try {
                document.execCommand("copy"),
                    Lb.text(Lb.attr("data-copied-text"))
            } catch (a) {
                alert("Please press Ctrl/Cmd+C to copy code!")
            }
            Zb.text(Zb.attr("data-copy-text"))
        });
        if (b.embedWidth && !WPSVPUtils.isEmpty(b.embedWidth) && b.embedHeight && !WPSVPUtils.isEmpty(b.embedHeight)) {
            var ki = b.embedSrc || window.location.href,
                li = e.find(".wpsvp-embed-code").text('<iframe width="' + b.embedWidth + '" height="' + b.embedHeight + '" src="' + ki + '" frameborder="0" scrolling="no" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>');
            e.find(".wpsvp-embed-copy").on("click",
                function() {
                    WPSVPUtils.selectText(li[0]);
                    try {
                        document.execCommand("copy"), Zb.text(Zb.attr("data-copied-text"))
                    } catch (a) {
                        alert("Please press Ctrl/Cmd+C to copy code!")
                    }
                    Lb.text(Lb.attr("data-copy-text"))
                })
        }
        e.find(".wpsvp-embed-inner");
        var N = new WPSVPPlaylistManager(b);
        c(N).on("WPSVPPlaylistManager.COUNTER_READY", function(a, b) {
            lb = !1;

            k = Uc = null;
            
            hf = !1;
            Vc = Wc = Fd = null;
            hb = [];
            Cb.find(".wpsvp-ad-indicator").remove();
            Ud = !1;
            Cb.find(".wpsvp-chapter-indicator").remove();
            Ec.css({
                display: "none",
                opacity: 0
            });
            Ia = [];
            Td = !1;
            Ca.removeClass("wpsvp-seekbar-chapters");
            jf = !1;
            Ed = null;
            zh();
            va()
        }).on("WPSVPPlaylistManager.RANDOM_CHANGE", function(a, b) {
            b ? Nf.addClass("wpsvp-contr-btn-hover") : Nf.removeClass("wpsvp-contr-btn-hover")
        }).on("WPSVPPlaylistManager.LOOP_CHANGE", function(a, b) {
            b ? Mf.addClass("wpsvp-contr-btn-hover") : Mf.removeClass("wpsvp-contr-btn-hover")
        });
        window.onYouTubeIframeAPIReady = function() {};
        ua.on("resize", function() {
            if (!u) return !1;
            Rf && clearTimeout(Rf);
            Rf = setTimeout(tc, 100)
        });
        this.playMedia = function() {
            if (!u || !f || T) return !1;
            if ("audio" == f) {
                if (t) {
                    var a = t.play();
                    void 0 !==
                        a && a.then(function(a) {})["catch"](function(a) {
                            H.show()
                        })
                }
            } else "video" == f ? E ? (E.remove(), E = null, va()) : m && (a = m.play(), void 0 !== a && a.then(function(a) {})["catch"](function(a) {
                H.show()
            })) : "youtube" == f ? y.playVideo() : "vimeo" == f && w.play();
            T = !0
        };
        this.pauseMedia = function() {
            if (!u || !f || !T) return !1;
            "audio" == f ? t && t.pause() : "video" == f ? m && m.pause() : "youtube" == f ? y.pauseVideo() : "vimeo" == f && w.pause();
            T = !1
        };
        this.togglePlayback = function() {
            if (!u || !f) return !1;
            if (!ac)
                if ("audio" == f)
                    if (E && !pa) H.hide(), gb.show(), va();
                    else {
                        if (t)
                            if (t.paused) {
                                var a =
                                    t.play();
                                void 0 !== a && a.then(function(a) {})["catch"](function(a) {
                                    H.show()
                                })
                            } else t.pause()
                    } else "video" == f ? E && !pa ? (E.remove(), E = null, H.hide(), gb.show(), va()) : m && (m.paused ? (a = m.play(), void 0 !== a && a.then(function(a) {})["catch"](function(a) {
                H.show()
            })) : m.pause()) : "youtube" == f ? E && !pa ? (E.remove(), E = null, H.hide(), va()) : (a = y.getPlayerState(), 1 == a ? y.pauseVideo() : 2 == a ? y.playVideo() : (-1 == a || 5 == a || 0 == a) && y.playVideo()) : "vimeo" == f && (E && !pa ? (E.remove(), E = null, H.hide(), va()) : w.getPaused().then(function(a) {
                a ? w.play() :
                    w.pause()
            }))
        };
        this.nextMedia = function() {
            if (!u) return !1;
            Vb()
        };
        this.previousMedia = function() {
            if (!u) return !1;
            kd()
        };
        this.setVolume = function(a) {
            if (!u) return !1;
            0 > a ? a = 0 : 1 < a && (a = 1);
            g(a)
        };
        this.toggleMute = function() {
            if (!u) return !1;
            l()
        };
        this.seek = function(a) {
            if (!u || !f) return !1;
            "audio" == f ? t.currentTime = a : "video" == f ? m.currentTime = a : "youtube" == f ? y.seekTo(a) : "vimeo" == f && w.setCurrentTime(a)
        };
        this.seekBackward = function(a) {
            if (!u || !f) return !1;
            if ("audio" == f) {
                if (t) try {
                    t.currentTime = Math.max(t.currentTime - (a || Tb), 0)
                } catch (F) {
                    console.log(F)
                }
            } else if ("video" ==
                f) {
                if (m) try {
                    m.currentTime = Math.max(m.currentTime - (a || Tb), 0)
                } catch (F) {
                    console.log(F)
                }
            } else if ("youtube" == f) {
                var b = Math.max(y.getCurrentTime() - (a || Tb), 0);
                y.seekTo(b)
            } else "vimeo" == f && w.getCurrentTime().then(function(b) {
                w.setCurrentTime(Math.max(b - (a || Tb), 0))
            })
        };
        this.seekForward = function(a) {
            if (!u || !f) return !1;
            if ("audio" == f) {
                if (t) try {
                    t.currentTime = Math.min(t.currentTime + (a || Tb), t.duration)
                } catch (F) {
                    console.log(F)
                }
            } else if ("video" == f) {
                if (m) try {
                    m.currentTime = Math.min(m.currentTime + (a || Tb), m.duration)
                } catch (F) {
                    console.log(F)
                }
            } else if ("youtube" ==
                f) {
                var b = Math.min(y.getCurrentTime() + (a || Tb), y.getDuration());
                y.seekTo(b)
            } else "vimeo" == f && (0 != Db && 0 != fd ? (b = Math.min(fd + (a || Tb), Db), w.setCurrentTime(b)) : w.getCurrentTime().then(function(b) {
                w.getDuration().then(function(c) {
                    w.setCurrentTime(Math.min(b + (a || Tb), c))
                })
            }))
        };
        this.getCurrentTime = function() {
            if (!u || !f) return !1;
            if ("audio" == f) return t.currentTime;
            if ("video" == f) return m.currentTime;
            if ("youtube" == f) return y.getCurrentTime();
            if ("vimeo" == f) return fd
        };
        this.getDuration = function() {
            if (!u || !f) return !1;
            if ("audio" == f) return t.duration;
            if ("video" == f) return m.duration;
            if ("youtube" == f) return y.getDuration();
            if ("vimeo" == f) return Db
        };
        this.getLoadProgress = function() {
            if (!u || !f) return !1;
            var a;
            if ("audio" == f) {
                if ("undefined" !== typeof t.buffered && 0 != t.buffered.length) {
                    try {
                        var b = t.buffered.end(t.buffered.length - 1)
                    } catch (F) {}
                    isNaN(b) || (a = b / Math.floor(t.duration))
                }
            } else if ("video" == f) {
                if ("undefined" !== typeof m.buffered && 0 != m.buffered.length) {
                    try {
                        b = m.buffered.end(m.buffered.length - 1)
                    } catch (F) {}
                    isNaN(b) || (a = b / Math.floor(m.duration))
                }
            } else "youtube" ==
                f ? a = y.getVideoLoadedFraction() : "vimeo" == f && (a = Ge);
            return a
        };
        this.togglePlaylist = function(a) {
            if (!u) return !1;
            Yf(a)
        };
        this.toggleRandom = function(a) {
            if (!u || "undefined" === typeof N) return !1;
            N.setRandom(a)
        };
        this.toggleLoop = function(a) {
            if (!u || "undefined" === typeof N) return !1;
            N.setLooping(a)
        };
        this.setPlaybackRate = function(a) {

            if (!u || !f) return !1;

            k.playbackRate = a;
            "audio" == f ? t && (t.playbackRate = a) : "video" == f ? m && (m.playbackRate = a) : "youtube" == f ? y.setPlaybackRate(a) : "vimeo" == f && w.setPlaybackRate(a).then(function(a) {})["catch"](function(a) {
                console.log(a.name)
            })
        };
        this.setPlaybackQuality = function(a) {
            if (!u || !f) return !1;
            if ("image" == f || "audio" == f || "video" == f) {
                if ("hls" != D || "dash" != D) k.quality = a, Ub(a), va(!0)
            } else "youtube" == f && y.setPlaybackQuality(a)
        };
        this.toggleInfo = function(a) {
            if (!u || !f) return !1;
            Jc(a)
        };
        this.toggleShare = function(a) {
            if (!u || !f) return !1;
            Kc(a)
        };
        this.toggleFullscreen = function() {
            if (!u) return !1;
            Fa.click()
        };
        this.openLightbox = function() {
            if (!u) return !1;
            f && dc();
            nb.css("display", "block");
            setTimeout(function() {
                clearTimeout(this);
                nb.css("opacity", 1)
            }, 50)
        };
        this.closeLightbox =
            function() {
                if (!u) return !1;
                nb.one("transitionend", function() {
                    nb.css("display", "none")
                }).css("opacity", 0);
                f && dc()
            };
        this.destroyMedia = function() {
            if (!u) return !1;
            Ef()
        };
        this.destroyPlaylist = function() {
            if (!u) return !1;
            $e()
        };
        this.loadPlaylist = function(a) {
            if (!u || Y) return !1;
            if ("string" === typeof a) {
                if (ee == a) return !1;
                gg(a)
            } else return alert("Invalid value loadPlaylist!"), !1
        };
        this.setAutoPlay = function(a) {
            R = a
        };
        this.inputMedia = function(a) {
            if (!u || Y) return !1;
            if ("undefined" === typeof a) return alert("inputMedia method requires data parameter. inputMedia failed."), !1;
            X && pd();
            N.reSetCounter();
            qe = a;
            va()
        };
        this.loadMedia = function(a) {
            if (!u || Y || !$b) return !1;
            if ("number" === typeof a) 0 > a ? a = 0 : a > A - 1 && (a = A - 1), N.processPlaylistRequest(a);
            else return alert("Invalid value loadMedia!"), !1
        };
        this.addTrack = function(a, b, e, f) {
            if (!u || Y) return !1;
            if ("undefined" === typeof a) return alert("addTrack method requires format parameter. AddTrack failed."), !1;
            if ("undefined" === typeof b) return alert("addTrack method requires track parameter. AddTrack failed."), !1;
            he = !1;
            "undefined" !== typeof e &&
                (he = e);
            e = 1;
            var d = !1;
            if ("string" !== typeof b && "[object Object]" !== Object.prototype.toString.call(b))
                if ("[object Array]" === Object.prototype.toString.call(b)) e = b.length, d = !0;
                else return alert("addTrack method requires track as string, object or array parameter. AddTrack failed."), !1;
            Ta = f;
            Oc = !1;
            Nc = !0;
            if ($b)
                if ("undefined" !== typeof Ta) {
                    if (0 > Ta || Ta > A) return alert('Invalid position to insert track to. Position number "' + f + '" doesnt exist. AddTrack failed.'), !1;
                    Ta == A && (Oc = !0)
                } else Oc = !0, Ta = A;
            else {
                if ("undefined" !==
                    typeof Ta) {
                    if (0 != Ta) return alert('Invalid position to insert track to. Position number "' + f + '" doesnt exist. AddTrack failed.'), !1
                } else Ta = 0;
                Oc = !0
            }
            Y = !0;
            xb.show();
            zd = -1;
            ma = [];
            Sa = [];
            for (f = 0; f < e; f++) {
                var g = d ? b[f] : b;
                g = "html" == a ? c(c.parseHTML(g)) : g;
                Sa.push(g)
            }
            A = Sa.length;
            ie = !1;
            $b || (ie = !0);
            $b = "exist";
            fe = !1;
            Da()
        };
        this.removeTrack = function(a) {
            if (!u || Y) return !1;
            if (0 != A) {
                if ("undefined" === typeof a) return alert("removeTrack method requires id parameter. removeTrack failed."), !1;
                if ("string" === typeof a) {
                    var b = !1;
                    r.find(".wpsvp-playlist-item").each(function() {
                        if (c(this).find(".wpsvp-playlist-title").html() == a) return e = c(this), a = r.find(".wpsvp-playlist-item").index(e), b = !0, !1
                    });
                    if (!b) return alert('Track with title "' + a + '" doesnt exist. RemoveTrack failed.'), !1
                } else if ("number" === typeof a) {
                    a = parseInt(a, 10);
                    if (0 > a || a > A - 1) return alert('Invalid id number. Track number  "' + a + '" doesnt exist. RemoveTrack failed.'), !1;
                    var e = r.find(".wpsvp-playlist-item").eq(a)
                } else return alert("removeTrack method requires either a id number or a track title to remove. removeTrack failed."), !1;
                e.remove();
                A = r.children(".wpsvp-playlist-item").length;
                if (0 < A) {
                    var f = N.getCounter();
                    a == f ? (dc(), N.setPlaylistItems(A)) : (N.setPlaylistItems(A, !1), a < f && N.reSetCounter(N.getCounter() - 1));
                    Qc && Ad && pg()
                } else $e()
            }
        };
        this.setLoadMore = function(a) {
            Ob = a
        };
        this.loadMore = function() {
            if (!Y) {
                Y = !0;
                xb.show();
                kb = !0;
                ma = [];
                var a = bf;
                "youtube" == a ? (ra || Na("youtube"), ra.resumeLoad(ca)) : "vimeo" == a && (xa || Na("vimeo"), xa.resumeLoad(ca))
            }
        };
        this.getTitle = function() {
            return u && k ? k.title || k.domTitle || "" : !1
        };
        this.getMediaPlaying = function() {
            return u ?
                T : !1
        };
        this.getPlaylistLength = function() {
            return u ? A : !1
        };
        this.getSetupDone = function() {
            return u
        };
        this.getSettings = function() {
            return b
        };
        this.getActiveItemId = function() {
            return u ? "undefined" !== typeof N ? N.getCounter() : null : !1
        };
        this.adSkip = function() {
            if (!u || !Q || !Vd) return !1;
            Rd && Rd.trigger("click")
        };
        var Re = WPSVPUtils.getUrlParameter();
        Re.t && (b.playbackPositionTime = Re.t);
        Re.media_id && (b.activeItem = Re.media_id);
        if (Ac)
            if (!oh) localStorage.removeItem(Ac);
            else if (Qc && localStorage.getItem(Ac)) {
            var Ya = JSON.parse(localStorage.getItem(Ac));
            b.playbackPositionTime = Ya.resumeTime;
            K = Ya.volume;
            b.activeItem = Ya.activeItem;
            localStorage.removeItem(Ac)
        }
        if (Qc)
            if (Ad) {
                if (b.activePlaylist && !WPSVPUtils.isEmpty(b.activePlaylist) && localStorage.getItem(zc))
                    if (Ya = JSON.parse(localStorage.getItem(zc)), Ya.date + Ad > Math.floor(Date.now() / 1E3))
                        if (Ya.activePlaylist == b.activePlaylist) {
                            var ee = b.activePlaylist;
                            b.activePlaylist = "";
                            r.html(Ya.playlist);
                            var fe = !0;
                            if (Ya.loadMoreOnTotalScroll) {
                                var Ob = Ya.loadMoreOnTotalScroll;
                                var ca = Ya.nextPageToken;
                                var Nb = Ya.loadMoreItem;
                                Ya.channelId && (Nb = Nb.replace(/youtube_user/g, "youtube_channel").replace(/data-path="(.*?)"/g, "data-path='" + Ya.channelId + "'"))
                            }
                        } else localStorage.removeItem(zc);
                else localStorage.removeItem(zc)
            } else localStorage.removeItem(zc);
        this.deletePlaylistCache = function() {
            Qc && localStorage.removeItem(zc)
        };
        b.activePlaylist && !WPSVPUtils.isEmpty(b.activePlaylist) ? gg(b.activePlaylist) : (console.log("setupFromDom"), Eh());
        return this
    }
})(jQuery);