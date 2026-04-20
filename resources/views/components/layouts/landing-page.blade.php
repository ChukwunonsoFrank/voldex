<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-17538896252"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-17538896252');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Yfxai - Automated AI Trading</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preload" href="{{ asset('wp-content/uploads/2024/06/space-cover.webp') }}" as="image">
    <link rel="preload" href="{{ asset('wp-content/uploads/2024/06/door-2.webp') }}" as="image">
    <link rel="preload" href="{{ asset('wp-content/uploads/2024/05/door-mobil.webp') }}" as="image">
    <link rel="preload" href="{{ asset('wp-content/uploads/2023/03/EuclidSquare-Bold.ttf') }}" as="font"
        type="font/ttf" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('wp-content/uploads/2023/03/EuclidSquare-Regular.ttf') }}" as="font"
        type="font/ttf" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('wp-content/uploads/2023/03/EuclidSquare-Medium.ttf') }}" as="font"
        type="font/ttf" crossorigin="anonymous">
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />

    <link rel='dns-prefetch' href='https://code.jquery.com/' />
    <link rel='dns-prefetch' href='https://maxcdn.bootstrapcdn.com/' />
    <link rel='dns-prefetch' href='https://unpkg.com/' />
    <link rel='dns-prefetch' href='https://cdn.jsdelivr.net/' />
    <link rel='dns-prefetch' href='https://cdnjs.cloudflare.com/' />
    <link rel='dns-prefetch' href='https://js-eu1.hs-scripts.com/' />

    <script>
        window._wpemojiSettings = {
            "baseUrl": "https:\/\/s.w.org\/images\/core\/emoji\/15.0.3\/72x72\/",
            "ext": ".png",
            "svgUrl": "https:\/\/s.w.org\/images\/core\/emoji\/15.0.3\/svg\/",
            "svgExt": ".svg",
            "source": {
                "concatemoji": "https:\/\/tradelocker.com\/wp-includes\/js\/wp-emoji-release.min.js?ver=6.6.1"
            }
        };
        /*! This file is auto-generated */
        ! function(i, n) {
            var o, s, e;

            function c(e) {
                try {
                    var t = {
                        supportTests: e,
                        timestamp: (new Date).valueOf()
                    };
                    sessionStorage.setItem(o, JSON.stringify(t))
                } catch (e) {}
            }

            function p(e, t, n) {
                e.clearRect(0, 0, e.canvas.width, e.canvas.height), e.fillText(t, 0, 0);
                var t = new Uint32Array(e.getImageData(0, 0, e.canvas.width, e.canvas.height).data),
                    r = (e.clearRect(0, 0, e.canvas.width, e.canvas.height), e.fillText(n, 0, 0), new Uint32Array(e
                        .getImageData(0, 0, e.canvas.width, e.canvas.height).data));
                return t.every(function(e, t) {
                    return e === r[t]
                })
            }

            function u(e, t, n) {
                switch (t) {
                    case "flag":
                        return n(e, "\ud83c\udff3\ufe0f\u200d\u26a7\ufe0f", "\ud83c\udff3\ufe0f\u200b\u26a7\ufe0f") ? !1 : !
                            n(e, "\ud83c\uddfa\ud83c\uddf3", "\ud83c\uddfa\u200b\ud83c\uddf3") && !n(e,
                                "\ud83c\udff4\udb40\udc67\udb40\udc62\udb40\udc65\udb40\udc6e\udb40\udc67\udb40\udc7f",
                                "\ud83c\udff4\u200b\udb40\udc67\u200b\udb40\udc62\u200b\udb40\udc65\u200b\udb40\udc6e\u200b\udb40\udc67\u200b\udb40\udc7f"
                            );
                    case "emoji":
                        return !n(e, "\ud83d\udc26\u200d\u2b1b", "\ud83d\udc26\u200b\u2b1b")
                }
                return !1
            }

            function f(e, t, n) {
                var r = "undefined" != typeof WorkerGlobalScope && self instanceof WorkerGlobalScope ? new OffscreenCanvas(
                        300, 150) : i.createElement("canvas"),
                    a = r.getContext("2d", {
                        willReadFrequently: !0
                    }),
                    o = (a.textBaseline = "top", a.font = "600 32px Arial", {});
                return e.forEach(function(e) {
                    o[e] = t(a, e, n)
                }), o
            }

            function t(e) {
                var t = i.createElement("script");
                t.src = e, t.defer = !0, i.head.appendChild(t)
            }
            "undefined" != typeof Promise && (o = "wpEmojiSettingsSupports", s = ["flag", "emoji"], n.supports = {
                everything: !0,
                everythingExceptFlag: !0
            }, e = new Promise(function(e) {
                i.addEventListener("DOMContentLoaded", e, {
                    once: !0
                })
            }), new Promise(function(t) {
                var n = function() {
                    try {
                        var e = JSON.parse(sessionStorage.getItem(o));
                        if ("object" == typeof e && "number" == typeof e.timestamp && (new Date).valueOf() <
                            e.timestamp + 604800 && "object" == typeof e.supportTests) return e.supportTests
                    } catch (e) {}
                    return null
                }();
                if (!n) {
                    if ("undefined" != typeof Worker && "undefined" != typeof OffscreenCanvas && "undefined" !=
                        typeof URL && URL.createObjectURL && "undefined" != typeof Blob) try {
                        var e = "postMessage(" + f.toString() + "(" + [JSON.stringify(s), u.toString(), p
                                .toString()
                            ].join(",") + "));",
                            r = new Blob([e], {
                                type: "text/javascript"
                            }),
                            a = new Worker(URL.createObjectURL(r), {
                                name: "wpTestEmojiSupports"
                            });
                        return void(a.onmessage = function(e) {
                            c(n = e.data), a.terminate(), t(n)
                        })
                    } catch (e) {}
                    c(n = f(s, u, p))
                }
                t(n)
            }).then(function(e) {
                for (var t in e) n.supports[t] = e[t], n.supports.everything = n.supports.everything && n
                    .supports[t], "flag" !== t && (n.supports.everythingExceptFlag = n.supports
                        .everythingExceptFlag && n.supports[t]);
                n.supports.everythingExceptFlag = n.supports.everythingExceptFlag && !n.supports.flag, n
                    .DOMReady = !1, n.readyCallback = function() {
                        n.DOMReady = !0
                    }
            }).then(function() {
                return e
            }).then(function() {
                var e;
                n.supports.everything || (n.readyCallback(), (e = n.source || {}).concatemoji ? t(e
                    .concatemoji) : e.wpemoji && e.twemoji && (t(e.twemoji), t(e.wpemoji)))
            }))
        }((window, document), window._wpemojiSettings);
    </script>

    <style id='cf-frontend-style-inline-css'>
        @font-face {
            font-family: 'Source Code Pro';
            font-weight: 400;
            src: url('{{ asset('wp-content/uploads/2024/07/Source-Code-Pro-for-Powerline.otf') }}') format('OpenType');
        }

        @font-face {
            font-family: 'Menlo';
            font-weight: 400;
            src: url('{{ asset('wp-content/uploads/2023/12/Menlo-Regular.woff') }}') format('woff');
        }

        @font-face {
            font-family: 'Inter';
            font-weight: 700;
            src: url('{{ asset('wp-content/uploads/2023/12/Inter-VariableFont_slntwght.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Inter';
            font-weight: 600;
            src: url('{{ asset('wp-content/uploads/2023/12/Inter-VariableFont_slntwght.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Inter';
            font-weight: 500;
            src: url('{{ asset('wp-content/uploads/2023/12/Inter-VariableFont_slntwght.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Euclid Square';
            font-weight: 400;
            font-display: auto;
            font-fallback: Helvetica;
            src: url('{{ asset('wp-content/uploads/2023/03/EuclidSquare-Regular.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Euclid Square';
            font-weight: 700;
            font-display: auto;
            font-fallback: Helvetica;
            src: url('{{ asset('wp-content/uploads/2023/03/EuclidSquare-Bold.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Euclid Square';
            font-weight: 300;
            font-display: auto;
            font-fallback: Helvetica;
            src: url('{{ asset('wp-content/uploads/2023/03/EuclidSquare-Light.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Euclid Square';
            font-weight: 500;
            font-display: auto;
            font-fallback: Helvetica;
            src: url('{{ asset('wp-content/uploads/2023/03/EuclidSquare-Medium.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Euclid Square';
            font-weight: 600;
            font-display: auto;
            font-fallback: Helvetica;
            src: url('{{ asset('wp-content/uploads/2023/03/EuclidSquare-SemiBold.ttf') }}') format('truetype');
        }
    </style>
    <link rel='stylesheet' id='dashicons-css' href='{{ asset('wp-includes/css/dashicons.minb6a4.css') }}'
        media='all' />
    <link rel='stylesheet' id='menu-icons-extra-css'
        href='{{ asset('wp-content/plugins/menu-icons/css/extra.minc28c.css') }}' media='all' />
    <link rel='stylesheet' id='hello-elementor-style-css'
        href='{{ asset('wp-content/themes/hello-elementor/style8a54.css') }}' media='all' />
    <link rel='stylesheet' id='hello-elementor-child-style-css'
        href='{{ asset('wp-content/uploads/wp-less/tradelocker-child/css/style-5430c549c4.css') }}' media='all' />
    <link rel='stylesheet' id='price-calc-style-css'
        href='{{ asset('wp-content/uploads/wp-less/tradelocker-child/css/price-calc-a7036eb618.css') }}'
        media='all' />
    <link rel='stylesheet' id='elementor-widgets-css'
        href='{{ asset('wp-content/uploads/wp-less/tradelocker-child/css/elementor-widgets-e4d9c83533.css') }}'
        media='all' />
    <link rel='stylesheet' id='prism-vs-code-css'
        href='{{ asset('wp-content/themes/tradelocker-child/css/prism-vs-code39c0.css') }}' media='all' />
    <link rel='stylesheet' id='select2css-css'
        href='{{ asset('wp-content/themes/tradelocker-child/css/select29cd0.css') }}' media='all' />

    <style id='wp-emoji-styles-inline-css'>
        img.wp-smiley,
        img.emoji {
            display: inline !important;
            border: none !important;
            box-shadow: none !important;
            height: 1em !important;
            width: 1em !important;
            margin: 0 0.07em !important;
            vertical-align: -0.1em !important;
            background: none !important;
            padding: 0 !important;
        }
    </style>

    <link rel='stylesheet' id='wp-block-library-css'
        href='{{ asset('wp-includes/css/dist/block-library/style.minb6a4.css') }}' media='all' />
    <style id='classic-theme-styles-inline-css'>
        /*! This file is auto-generated */
        .wp-block-button__link {
            color: #fff;
            background-color: #32373c;
            border-radius: 9999px;
            box-shadow: none;
            text-decoration: none;
            padding: calc(.667em + 2px) calc(1.333em + 2px);
            font-size: 1.125em
        }

        .wp-block-file__button {
            background: #32373c;
            color: #fff;
            text-decoration: none
        }
    </style>
    <style id='global-styles-inline-css'>
        :root {
            --wp--preset--aspect-ratio--square: 1;
            --wp--preset--aspect-ratio--4-3: 4/3;
            --wp--preset--aspect-ratio--3-4: 3/4;
            --wp--preset--aspect-ratio--3-2: 3/2;
            --wp--preset--aspect-ratio--2-3: 2/3;
            --wp--preset--aspect-ratio--16-9: 16/9;
            --wp--preset--aspect-ratio--9-16: 9/16;
            --wp--preset--color--black: #000000;
            --wp--preset--color--cyan-bluish-gray: #abb8c3;
            --wp--preset--color--white: #ffffff;
            --wp--preset--color--pale-pink: #f78da7;
            --wp--preset--color--vivid-red: #cf2e2e;
            --wp--preset--color--luminous-vivid-orange: #ff6900;
            --wp--preset--color--luminous-vivid-amber: #fcb900;
            --wp--preset--color--light-green-cyan: #7bdcb5;
            --wp--preset--color--vivid-green-cyan: #00d084;
            --wp--preset--color--pale-cyan-blue: #8ed1fc;
            --wp--preset--color--vivid-cyan-blue: #0693e3;
            --wp--preset--color--vivid-purple: #9b51e0;
            --wp--preset--gradient--vivid-cyan-blue-to-vivid-purple: linear-gradient(135deg, rgba(6, 147, 227, 1) 0%, rgb(155, 81, 224) 100%);
            --wp--preset--gradient--light-green-cyan-to-vivid-green-cyan: linear-gradient(135deg, rgb(122, 220, 180) 0%, rgb(0, 208, 130) 100%);
            --wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange: linear-gradient(135deg, rgba(252, 185, 0, 1) 0%, rgba(255, 105, 0, 1) 100%);
            --wp--preset--gradient--luminous-vivid-orange-to-vivid-red: linear-gradient(135deg, rgba(255, 105, 0, 1) 0%, rgb(207, 46, 46) 100%);
            --wp--preset--gradient--very-light-gray-to-cyan-bluish-gray: linear-gradient(135deg, rgb(238, 238, 238) 0%, rgb(169, 184, 195) 100%);
            --wp--preset--gradient--cool-to-warm-spectrum: linear-gradient(135deg, rgb(74, 234, 220) 0%, rgb(151, 120, 209) 20%, rgb(207, 42, 186) 40%, rgb(238, 44, 130) 60%, rgb(251, 105, 98) 80%, rgb(254, 248, 76) 100%);
            --wp--preset--gradient--blush-light-purple: linear-gradient(135deg, rgb(255, 206, 236) 0%, rgb(152, 150, 240) 100%);
            --wp--preset--gradient--blush-bordeaux: linear-gradient(135deg, rgb(254, 205, 165) 0%, rgb(254, 45, 45) 50%, rgb(107, 0, 62) 100%);
            --wp--preset--gradient--luminous-dusk: linear-gradient(135deg, rgb(255, 203, 112) 0%, rgb(199, 81, 192) 50%, rgb(65, 88, 208) 100%);
            --wp--preset--gradient--pale-ocean: linear-gradient(135deg, rgb(255, 245, 203) 0%, rgb(182, 227, 212) 50%, rgb(51, 167, 181) 100%);
            --wp--preset--gradient--electric-grass: linear-gradient(135deg, rgb(202, 248, 128) 0%, rgb(113, 206, 126) 100%);
            --wp--preset--gradient--midnight: linear-gradient(135deg, rgb(2, 3, 129) 0%, rgb(40, 116, 252) 100%);
            --wp--preset--font-size--small: 13px;
            --wp--preset--font-size--medium: 20px;
            --wp--preset--font-size--large: 36px;
            --wp--preset--font-size--x-large: 42px;
            --wp--preset--spacing--20: 0.44rem;
            --wp--preset--spacing--30: 0.67rem;
            --wp--preset--spacing--40: 1rem;
            --wp--preset--spacing--50: 1.5rem;
            --wp--preset--spacing--60: 2.25rem;
            --wp--preset--spacing--70: 3.38rem;
            --wp--preset--spacing--80: 5.06rem;
            --wp--preset--shadow--natural: 6px 6px 9px rgba(0, 0, 0, 0.2);
            --wp--preset--shadow--deep: 12px 12px 50px rgba(0, 0, 0, 0.4);
            --wp--preset--shadow--sharp: 6px 6px 0px rgba(0, 0, 0, 0.2);
            --wp--preset--shadow--outlined: 6px 6px 0px -3px rgba(255, 255, 255, 1), 6px 6px rgba(0, 0, 0, 1);
            --wp--preset--shadow--crisp: 6px 6px 0px rgba(0, 0, 0, 1);
        }

        :where(.is-layout-flex) {
            gap: 0.5em;
        }

        :where(.is-layout-grid) {
            gap: 0.5em;
        }

        body .is-layout-flex {
            display: flex;
        }

        .is-layout-flex {
            flex-wrap: wrap;
            align-items: center;
        }

        .is-layout-flex> :is(*, div) {
            margin: 0;
        }

        body .is-layout-grid {
            display: grid;
        }

        .is-layout-grid> :is(*, div) {
            margin: 0;
        }

        :where(.wp-block-columns.is-layout-flex) {
            gap: 2em;
        }

        :where(.wp-block-columns.is-layout-grid) {
            gap: 2em;
        }

        :where(.wp-block-post-template.is-layout-flex) {
            gap: 1.25em;
        }

        :where(.wp-block-post-template.is-layout-grid) {
            gap: 1.25em;
        }

        .has-black-color {
            color: var(--wp--preset--color--black) !important;
        }

        .has-cyan-bluish-gray-color {
            color: var(--wp--preset--color--cyan-bluish-gray) !important;
        }

        .has-white-color {
            color: var(--wp--preset--color--white) !important;
        }

        .has-pale-pink-color {
            color: var(--wp--preset--color--pale-pink) !important;
        }

        .has-vivid-red-color {
            color: var(--wp--preset--color--vivid-red) !important;
        }

        .has-luminous-vivid-orange-color {
            color: var(--wp--preset--color--luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-amber-color {
            color: var(--wp--preset--color--luminous-vivid-amber) !important;
        }

        .has-light-green-cyan-color {
            color: var(--wp--preset--color--light-green-cyan) !important;
        }

        .has-vivid-green-cyan-color {
            color: var(--wp--preset--color--vivid-green-cyan) !important;
        }

        .has-pale-cyan-blue-color {
            color: var(--wp--preset--color--pale-cyan-blue) !important;
        }

        .has-vivid-cyan-blue-color {
            color: var(--wp--preset--color--vivid-cyan-blue) !important;
        }

        .has-vivid-purple-color {
            color: var(--wp--preset--color--vivid-purple) !important;
        }

        .has-black-background-color {
            background-color: var(--wp--preset--color--black) !important;
        }

        .has-cyan-bluish-gray-background-color {
            background-color: var(--wp--preset--color--cyan-bluish-gray) !important;
        }

        .has-white-background-color {
            background-color: var(--wp--preset--color--white) !important;
        }

        .has-pale-pink-background-color {
            background-color: var(--wp--preset--color--pale-pink) !important;
        }

        .has-vivid-red-background-color {
            background-color: var(--wp--preset--color--vivid-red) !important;
        }

        .has-luminous-vivid-orange-background-color {
            background-color: var(--wp--preset--color--luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-amber-background-color {
            background-color: var(--wp--preset--color--luminous-vivid-amber) !important;
        }

        .has-light-green-cyan-background-color {
            background-color: var(--wp--preset--color--light-green-cyan) !important;
        }

        .has-vivid-green-cyan-background-color {
            background-color: var(--wp--preset--color--vivid-green-cyan) !important;
        }

        .has-pale-cyan-blue-background-color {
            background-color: var(--wp--preset--color--pale-cyan-blue) !important;
        }

        .has-vivid-cyan-blue-background-color {
            background-color: var(--wp--preset--color--vivid-cyan-blue) !important;
        }

        .has-vivid-purple-background-color {
            background-color: var(--wp--preset--color--vivid-purple) !important;
        }

        .has-black-border-color {
            border-color: var(--wp--preset--color--black) !important;
        }

        .has-cyan-bluish-gray-border-color {
            border-color: var(--wp--preset--color--cyan-bluish-gray) !important;
        }

        .has-white-border-color {
            border-color: var(--wp--preset--color--white) !important;
        }

        .has-pale-pink-border-color {
            border-color: var(--wp--preset--color--pale-pink) !important;
        }

        .has-vivid-red-border-color {
            border-color: var(--wp--preset--color--vivid-red) !important;
        }

        .has-luminous-vivid-orange-border-color {
            border-color: var(--wp--preset--color--luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-amber-border-color {
            border-color: var(--wp--preset--color--luminous-vivid-amber) !important;
        }

        .has-light-green-cyan-border-color {
            border-color: var(--wp--preset--color--light-green-cyan) !important;
        }

        .has-vivid-green-cyan-border-color {
            border-color: var(--wp--preset--color--vivid-green-cyan) !important;
        }

        .has-pale-cyan-blue-border-color {
            border-color: var(--wp--preset--color--pale-cyan-blue) !important;
        }

        .has-vivid-cyan-blue-border-color {
            border-color: var(--wp--preset--color--vivid-cyan-blue) !important;
        }

        .has-vivid-purple-border-color {
            border-color: var(--wp--preset--color--vivid-purple) !important;
        }

        .has-vivid-cyan-blue-to-vivid-purple-gradient-background {
            background: var(--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple) !important;
        }

        .has-light-green-cyan-to-vivid-green-cyan-gradient-background {
            background: var(--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan) !important;
        }

        .has-luminous-vivid-amber-to-luminous-vivid-orange-gradient-background {
            background: var(--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-orange-to-vivid-red-gradient-background {
            background: var(--wp--preset--gradient--luminous-vivid-orange-to-vivid-red) !important;
        }

        .has-very-light-gray-to-cyan-bluish-gray-gradient-background {
            background: var(--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray) !important;
        }

        .has-cool-to-warm-spectrum-gradient-background {
            background: var(--wp--preset--gradient--cool-to-warm-spectrum) !important;
        }

        .has-blush-light-purple-gradient-background {
            background: var(--wp--preset--gradient--blush-light-purple) !important;
        }

        .has-blush-bordeaux-gradient-background {
            background: var(--wp--preset--gradient--blush-bordeaux) !important;
        }

        .has-luminous-dusk-gradient-background {
            background: var(--wp--preset--gradient--luminous-dusk) !important;
        }

        .has-pale-ocean-gradient-background {
            background: var(--wp--preset--gradient--pale-ocean) !important;
        }

        .has-electric-grass-gradient-background {
            background: var(--wp--preset--gradient--electric-grass) !important;
        }

        .has-midnight-gradient-background {
            background: var(--wp--preset--gradient--midnight) !important;
        }

        .has-small-font-size {
            font-size: var(--wp--preset--font-size--small) !important;
        }

        .has-medium-font-size {
            font-size: var(--wp--preset--font-size--medium) !important;
        }

        .has-large-font-size {
            font-size: var(--wp--preset--font-size--large) !important;
        }

        .has-x-large-font-size {
            font-size: var(--wp--preset--font-size--x-large) !important;
        }

        :where(.wp-block-post-template.is-layout-flex) {
            gap: 1.25em;
        }

        :where(.wp-block-post-template.is-layout-grid) {
            gap: 1.25em;
        }

        :where(.wp-block-columns.is-layout-flex) {
            gap: 2em;
        }

        :where(.wp-block-columns.is-layout-grid) {
            gap: 2em;
        }

        :root :where(.wp-block-pullquote) {
            font-size: 1.5em;
            line-height: 1.6;
        }
    </style>

    <link rel='stylesheet' id='hello-elementor-css'
        href='{{ asset('wp-content/themes/hello-elementor/style.min41fe.css') }}' media='all' />
    <link rel='stylesheet' id='hello-elementor-theme-style-css'
        href='{{ asset('wp-content/themes/hello-elementor/theme.min41fe.css') }}' media='all' />
    <link rel='stylesheet' id='hello-elementor-header-footer-css'
        href='{{ asset('wp-content/themes/hello-elementor/header-footer.min41fe.css') }}' media='all' />
    <link rel='stylesheet' id='elementor-frontend-css'
        href='{{ asset('wp-content/plugins/elementor/assets/css/frontend-lite.mina44d.css') }}' media='all' />
    <link rel='stylesheet' id='elementor-post-23-css'
        href='{{ asset('wp-content/uploads/elementor/css/post-23578b.css') }}' media='all' />
    <link rel='stylesheet' id='elementor-icons-css'
        href='{{ asset('wp-content/plugins/elementor/assets/lib/eicons/css/elementor-icons.minfc13.css') }}'
        media='all' />
    <link rel='stylesheet' id='swiper-css'
        href='{{ asset('wp-content/plugins/elementor/assets/lib/swiper/v8/css/swiper.min94a4.css') }}'
        media='all' />
    <link rel='stylesheet' id='elementor-post-2264-css'
        href='{{ asset('wp-content/uploads/elementor/css/post-22648455.css') }}' media='all' />
    <link rel='stylesheet' id='elementor-custom-widget-editor-css'
        href='{{ asset('wp-content/plugins/elementor-custom-widgets/assets/css/editorb6a4.css') }}' media='all' />
    <link rel='stylesheet' id='elementor-icons-shared-0-css'
        href='{{ asset('wp-content/plugins/elementor/assets/lib/font-awesome/css/fontawesome.min52d5.css') }}'
        media='all' />
    <link rel='stylesheet' id='elementor-icons-fa-solid-css'
        href='{{ asset('wp-content/plugins/elementor/assets/lib/font-awesome/css/solid.min52d5.css') }}'
        media='all' />

    <script data-cookieconsent="ignore" data-cookiecategory="essential"
        src="{{ asset('code.jquery.com/jquery-3.6.0.min.js') }}" id="jquery-js"></script>

    <script async src="https://www.google.com/recaptcha/api.js"></script>
    @livewireStyles
    @vite('resources/css/app.css')

    <style>
        [x-cloak] {
            display: none !important;
        }

        .gt_container-unisv1 a.glink span {
            color: #7a7a7a;
            font-weight: 400;
        }
    </style>
    <!-- Meta Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '789556817321629');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=789556817321629&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/693d5de40981ca197f7a915d/1jcbrdhu4';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
</head>

<body
    class="home page-template page-template-elementor_header_footer page page-id-2264 wp-custom-logo elementor-default elementor-template-full-width elementor-kit-23 elementor-page elementor-page-2264">
    <header id="site-header" class="site-header dynamic-header header-full-width menu-dropdown-mobile"
        role="banner">
        <div class="header-inner">
            <div class="site-branding show-logo">
                <div class="site-logo show">
                    <a href="{{ route('home') }}" class="custom-logo-link" rel="home" aria-current="page"><img
                            src="{{ asset('wp-content/uploads/2023/05/yfxai-logo.png') }}" class="custom-logo" /></a>
                </div>
            </div>
            <nav class="site-navigation show">
                <div style="display: flex; margin-right: 16px;">
                    <div class="gtranslate_wrapper"></div>
                </div>
                <div class="menu-primary-menu-container">
                    <ul id="menu-primary-menu" class="menu">
                        <li id='menu-item-1' class="menu-item menu-item-type-custom menu-item-object-custom"><a
                                href="/#home-section" data-analytics-label="Start trading">Home<span
                                    class="menu-item-description"></span></a> </li>
                        <li id='menu-item-2' class="menu-item menu-item-type-custom menu-item-object-custom"><a
                                href="/#features-section" data-analytics-label="Start trading">Features<span
                                    class="menu-item-description"></span></a> </li>
                        <li id='menu-item-3' class="menu-item menu-item-type-custom menu-item-object-custom"><a
                                href="/#faqs-section" data-analytics-label="Start trading">FAQs<span
                                    class="menu-item-description"></span></a> </li>
                        <li id='menu-item-4' class="menu-item menu-item-type-custom menu-item-object-custom"><a
                                href="{{ route('register') }}" data-analytics-label="Start trading">Sign Up<span
                                    class="menu-item-description"></span></a> </li>
                        <li id='menu-item-5' class="menu-item menu-item-type-custom menu-item-object-custom"><a
                                href="{{ route('login') }}" data-analytics-label="Start trading"
                                style="color: #000000;">Login<span class="menu-item-description"></span></a> </li>
                    </ul>
                </div>
            </nav>
            <div class="site-navigation-toggle-holder show" style="max-width: 50%;">
                <div style="display: flex; margin-right: 16px; margin-top: -6px;">
                    <div class="gtranslate_wrapper"></div>
                </div>
                <div class="site-navigation-toggle" role="button" tabindex="0">
                    <svg width="21" height="18" viewBox="0 0 21 18" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect y="1.33716" width="21" height="1" fill="white" fill-opacity="0.2" />
                        <rect y="8.33716" width="21" height="1" fill="white" fill-opacity="0.2" />
                        <rect y="15.3372" width="21" height="1" fill="white" fill-opacity="0.2" />
                        <rect x="2" y="7.33716" width="15" height="3" fill="white" />
                        <rect x="2" y="14.3372" width="12" height="3" fill="white" />
                        <rect x="2" y="0.337158" width="17" height="3" fill="white" />
                    </svg>
                    <span class="screen-reader-text">Menu</span>
                </div>
            </div>
            <nav id="mobile__navbar" class="site-navigation-drop" aria-hidden="true">
                <div class="menu-primary-menu-container">
                    <ul id="menu-primary-menu" class="menu">
                        <li id='menu-item-1' class="menu-item menu-item-type-custom menu-item-object-custom"><a
                                onclick="toggleNavbar()" href="/#home-section"
                                data-analytics-label="Start trading">Home<span
                                    class="menu-item-description"></span></a> </li>
                        <li id='menu-item-2' class="menu-item menu-item-type-custom menu-item-object-custom"><a
                                onclick="toggleNavbar()" href="/#features-section"
                                data-analytics-label="Start trading">Features<span
                                    class="menu-item-description"></span></a> </li>
                        <li id='menu-item-3' class="menu-item menu-item-type-custom menu-item-object-custom"><a
                                onclick="toggleNavbar()" href="/#faqs-section"
                                data-analytics-label="Start trading">FAQs<span
                                    class="menu-item-description"></span></a> </li>
                        <li id='menu-item-4' class="menu-item menu-item-type-custom menu-item-object-custom"><a
                                href="{{ route('register') }}" data-analytics-label="Start trading">Sign Up<span
                                    class="menu-item-description"></span></a> </li>
                        <li id='menu-item-5' class="menu-item menu-item-type-custom menu-item-object-custom"><a
                                href="{{ route('login') }}" data-analytics-label="Start trading">Login<span
                                    class="menu-item-description"></span></a> </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <div data-elementor-type="wp-page" data-elementor-id="2264" class="elementor elementor-2264">
        {{ $slot }}
    </div>

    <div id="downloadModal"
        style="display: none; position: fixed; top: 0; left: 0; height: 100svh; width: 100%; padding-left: 1rem; padding-right: 1rem; padding-top: 1.5rem; z-index: 20;">
        <div
            style="position: absolute; top: 0; right: 0; bottom: 0; left: 0; height: 100svh; width: 100%; padding-left: 1rem; padding-right: 1rem; padding-top: 1.5rem; z-index: 20; background-color: #000000; opacity: 0.85;">
        </div>
        <div
            style="position: relative; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; z-index: 30;">
            <div
                style="max-width: 24rem; margin-left: auto; margin-right: auto; display: flex; flex-direction: column; background-color: #000000; border: 1px solid #26252a; border-radius: 1rem; pointer-events: auto;">
                <div
                    style="padding-top: 1.5rem; padding-bottom: 1.5rem; padding-left: 1rem; padding-right: 1rem; overflow-y: auto;">
                    <div style="display: flex; justify-content: flex-end; align-items: center;">
                        <div id="cancelDownloadModalBtn" style="flex: none;">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="16" cy="16" r="16" fill="#1A1B20" />
                                <path d="M21 11L11 21" stroke="white" stroke-width="1.66667" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M11 11L21 21" stroke="white" stroke-width="1.66667" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <div style="text-align: center;">
                            <h1 style="color: white; font-weight: medium; font-size: 1.5rem;">Download Yfxai App
                            </h1>
                        </div>
                    </div>

                    <div style="margin-top: 1.5rem; display: grid; grid-template-columns: 1fr; row-gap: 0.5rem;">
                        <div>
                            <ul class="app-links">
                                <a id="googlePlayDownloadBtn"
                                    href="https://play.google.com/store/apps/details?id=com.haryadewalayanankonstruksi&hl=en">
                                    <li class="playstore">
                                        <div class="supertitle">Get it on</div>
                                        <div class="title">Google Play</div>
                                    </li>
                                </a>
                                <a id="appStoreDownloadBtn" href="https://apps.apple.com/ng/app/yfxai/id6755783410">
                                    <li class="appstore">
                                        <div class="supertitle">Download on the</div>
                                        <div class="title">App Store</div>
                                    </li>
                                </a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="elementor-section elementor-section-boxed">
        <div class="elementor-container">
            <div class="footer-grid">
                <div class="footer-column">
                    <div class="tradelocker-logo-container">
                        <a class="tradelocker-logo" href="{{ route('home') }}">
                            <svg width="77" height="20" viewBox="0 0 77 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14.1551 1.37744L6.29851 13.7281L3.58246 17.9989C3.30885 18.4308 2.88458 18.623 2.46288 18.623C1.78015 18.623 1.10742 18.1138 1.10742 17.2876V5.36136L5.54776 12.343L7.72147 8.92823L5.45228 5.36136H1.10742V2.53084C1.10742 1.89429 1.62692 1.3777 2.26961 1.3777H14.1551V1.37744Z"
                                    fill="#40FFDD" />
                                <path
                                    d="M18.5001 1.37671V17.4691C18.5001 18.1057 17.9806 18.6222 17.3379 18.6222H7.52832L15.965 5.36063L18.5001 1.37696V1.37671Z"
                                    fill="#40FFDD" />
                                <path opacity="0.07"
                                    d="M14.1551 1.37744L6.29851 13.7281L3.58246 17.9989C3.30885 18.4308 2.88458 18.623 2.46288 18.623C1.78015 18.623 1.10742 18.1138 1.10742 17.2876V16.988C1.10742 17.6643 1.996 17.919 2.35996 17.3473L5.54776 12.3427L7.72147 8.92798L12.5286 1.37744H14.1551Z"
                                    fill="black" />
                                <path
                                    d="M33.1628 11.9945V17.5156H29.5325V12.0583L23.8735 2.86353H28.2512L30.6642 6.94061C31.0487 7.64147 31.3048 8.29972 31.4542 8.78798C31.6251 8.29972 31.9026 7.64122 32.2658 6.96179L34.6574 2.86353H38.8002L33.1626 11.9945H33.1628Z"
                                    fill="white" />
                                <path
                                    d="M43.3699 6.21847V6.89789H46.0605V9.76466H43.3699V17.5156H39.825V9.76466H38.5225V6.89789H39.825V6.09085C39.825 2.86318 41.6615 1.37671 44.096 1.37671C44.9076 1.37671 45.5695 1.44052 46.2956 1.61025V4.47702C45.8472 4.39202 45.3773 4.34965 44.865 4.34965C44.0108 4.34965 43.3701 4.94435 43.3701 6.21847H43.3699Z"
                                    fill="white" />
                                <path
                                    d="M58.4459 17.5154H54.1536L53.2782 15.7104C52.9365 15.1157 52.5949 14.3939 52.3385 13.8842C52.1037 14.3727 51.7407 15.0733 51.3775 15.7315L50.3953 17.5154H46.3379L49.9895 12.1218L46.5301 6.89795H50.8224L51.3988 8.17207C51.6763 8.68177 52.0821 9.53118 52.3811 10.1256C52.6373 9.59473 53.0859 8.74532 53.406 8.17207L54.0679 6.89795H58.1253L54.7299 11.9306L58.4456 17.5154H58.4459Z"
                                    fill="white" />
                                <path
                                    d="M70.1908 17.2183V17.5156H66.7314C66.5605 17.0273 66.4966 16.56 66.4537 16.1141C65.7489 17.1547 64.5747 17.728 63.1653 17.728C60.795 17.728 58.4673 16.3265 58.4673 12.2494C58.4673 8.17232 60.8589 6.70703 63.2079 6.70703C64.6173 6.70703 65.7492 7.2591 66.4537 8.2785V6.8982H69.8918V14.9674C69.8918 15.6468 69.9772 16.6024 70.1908 17.2183ZM66.347 13.1412V11.2938C66.0908 10.2532 65.0444 9.67998 64.1473 9.67998C63.336 9.67998 62.1186 10.2109 62.1186 12.207C62.1186 14.2032 63.3999 14.7553 64.2115 14.7553C65.1296 14.7553 66.0905 14.182 66.347 13.1414V13.1412Z"
                                    fill="white" />
                                <path
                                    d="M75.8923 5.05062H72.1553V1.6106H75.8923V5.05062ZM72.2833 6.89799H75.8282V17.5154H72.2833V6.89799Z"
                                    fill="white" />
                            </svg>
                        </a>
                        <p>Unlock your potential.</p>
                        <div class="system-status-wrapper flex-wrap">
                            <div id="status-container"></div>
                            <a rel="noreferrer noopener" href="{{ route('login') }}"
                                class="status status-up">LIVE</a>
                            <a rel="noreferrer noopener" href="{{ route('login') }}"
                                class="status status-up">DEMO</a>
                        </div>
                    </div>
                </div>
                <div class="col-1">
                    <h5>Resources</h5>
                    <div class="menu-business-container">
                        <ul id="menu-business" class="menu">
                            <li id="menu-item-2374"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2374"><a
                                    href="{{ route('register') }}">Sign Up</a></li>
                            <li id="menu-item-2374"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2374"><a
                                    href="{{ route('login') }}">Sign In</a></li>
                            <li id="menu-item-2374"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2374"><a
                                    href="/#features-section">Features</a></li>
                            <li id="menu-item-2374"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2374"><a
                                    href="/#faqs-section">FAQs</a></li>
                            <li id="menu-item-2374"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2374"><a
                                    href="{{ route('findus') }}">Find Us</a></li>
                            <li id="menu-item-1005"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1005"><a
                                    href="{{ route('terms') }}">Terms and Conditions</a></li>
                            <li id="menu-item-1006"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1006"><a
                                    href="{{ route('privacy') }}">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="elementor-container">
            <div class="app-wrapper">
                <ul class="app-links">
                    <a href="https://play.google.com/store/apps/details?id=com.haryadewalayanankonstruksi&hl=en">
                        <li class="playstore">
                            <div class="supertitle">Get it on</div>
                            <div class="title">Google Play</div>
                        </li>
                    </a>
                    <a href="https://apps.apple.com/ng/app/yfxai/id6755783410">
                        <li class="appstore">
                            <div class="supertitle">Download on the</div>
                            <div class="title">App Store</div>
                        </li>
                    </a>
                </ul>
            </div>
        </div>
    </footer>
    <div class="disclaimer elementor-section elementor-section-boxed">
        <div class="elementor-container">
            <p style="font-size:14px">
                Yfxai is available worldwide with no regional restrictions. Access to our platform is limited
                to individuals aged 18 years and above. By using our services, you acknowledge that you understand these
                risks and agree to our Terms & Conditions. Our platform operates with transparency, instant
                deposits/withdrawals, and 24/7 support to ensure a secure trading environment. We are fully licensed and
                registered under the Luxembourg Registrar with the registration number ‘L482937615’ you can look up the
                registration number or search ‘Yfxai’ at the Luxembourg registrar <a
                    href="https://luxembourgregistrar.org/search-company"
                    style="text-decoration: underline;">here</a>.
            </p>
        </div>
        <br>
        <div style="text-align: center;">
            <p style="font-size:14px">Yfxai © <span id="year">{{ now()->year }}</span>. All rights reserved.
            </p>
        </div>
    </div>

    <script>
        document.getElementById("year").innerHTML = new Date().getFullYear();
    </script>

    <script>
        function toggleNavbar() {
            document.getElementById('mobile__navbar').setAttribute('aria-hidden', true);
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cancelInstallCount = parseInt(localStorage.getItem('cancelInstallCount') || '0', 10);
            const lastShownDate = localStorage.getItem('lastShownDate');
            const today = new Date().toDateString();

            if (cancelInstallCount < 3 && lastShownDate !== today) {
                setTimeout(function() {
                    const modal = document.getElementById('downloadModal');
                    if (modal) {
                        modal.style.display = 'block';
                    }
                }, 5000);
            }

            // Download buttons set count to 3
            const googlePlayBtn = document.getElementById('googlePlayDownloadBtn');
            const appStoreBtn = document.getElementById('appStoreDownloadBtn');

            if (googlePlayBtn) {
                googlePlayBtn.addEventListener('click', function() {
                    localStorage.setItem('cancelInstallCount', '3');
                    const modal = document.getElementById('downloadModal');
                    if (modal) {
                        modal.style.display = 'none';
                    }
                });
            }

            if (appStoreBtn) {
                appStoreBtn.addEventListener('click', function() {
                    localStorage.setItem('cancelInstallCount', '3');
                    const modal = document.getElementById('downloadModal');
                    if (modal) {
                        modal.style.display = 'none';
                    }
                });
            }

            // Cancel button increments count and sets today's date
            const cancelBtn = document.getElementById('cancelDownloadModalBtn');
            if (cancelBtn) {
                cancelBtn.addEventListener('click', function() {
                    const current = parseInt(localStorage.getItem('cancelInstallCount') || '0', 10);
                    localStorage.setItem('cancelInstallCount', current + 1);
                    localStorage.setItem('lastShownDate', today);

                    const modal = document.getElementById('downloadModal');
                    if (modal) {
                        modal.style.display = 'none';
                    }
                });
            }
        });
    </script>

    <link rel='stylesheet' id='e-animations-css'
        href="{{ asset('wp-content/plugins/elementor/assets/lib/animations/animations.mina44d.css') }}"
        media='all' />
    <script data-cookieconsent="ignore" data-cookiecategory="essential"
        src="{{ asset('maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') }}" id="scrollspy-js"></script>
    <script data-cookieconsent="ignore" data-cookiecategory="essential"
        src="{{ asset('unpkg.com/typeit@8.7.1/dist/index.umd.js') }}" id="typeit-js"></script>
    <script data-cookieconsent="ignore" data-cookiecategory="essential"
        src="{{ asset('cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min4819.js') }}" id="select2-js"></script>
    <script data-cookieconsent="ignore" data-cookiecategory="essential"
        src="{{ asset('cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.minb6a4.js') }}" id="gsap-js"></script>
    <script data-cookieconsent="ignore" data-cookiecategory="essential"
        src="{{ asset('cdn.jsdelivr.net/npm/gsap@3.12.7/dist/ScrollTrigger.minb6a4.js') }}" id="scroll-trigger-js">
    </script>
    <script src="{{ asset('cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/CSSRulePlugin.minb6a4.js') }}"
        id="cssrule-plugin-js"></script>
    <script data-cookieconsent="ignore" data-cookiecategory="essential"
        src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/SplitText.min.js" id="split-text-js"></script>
    <script data-cookieconsent="ignore" data-cookiecategory="essential"
        src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/ScrollSmoother.min.js" id="scroll-smoother-js"></script>
    <script data-cookieconsent="ignore" data-cookiecategory="essential"
        src="{{ asset('cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.minb6a4.js') }}" id="prism-js"></script>
    <script data-cookieconsent="ignore" data-cookiecategory="essential"
        src="{{ asset('cdnjs.cloudflare.com/ajax/libs/prism/1.17.1/components/prism-python.minb11e.js') }}"
        id="prism-python-js"></script>
    <script data-cookieconsent="ignore" data-cookiecategory="essential"
        src="{{ asset('wp-content/themes/tradelocker-child/js/animate-typed120.js') }}" id="animate-type-js"></script>
    <script src="{{ asset('wp-content/themes/tradelocker-child/js/accordionda59.js') }}" async defer
        data-cookieconsent="ignore" data-cookiecategory="essential"></script>
    <script data-cookieconsent="ignore" data-cookiecategory="essential"
        src="{{ asset('wp-content/themes/tradelocker-child/js/anchoring32e8.js') }}" id="anchoring-js-js"></script>
    <script src="{{ asset('wp-content/themes/tradelocker-child/js/utils6798.js') }}" id="utils-js-js"></script>
    <script src="{{ asset('wp-content/themes/tradelocker-child/js/gsap-activations290c.js') }}" id="gsap-activations-js">
    </script>
    <script src="{{ asset('wp-content/themes/tradelocker-child/js/marqueec2dd.js') }}" id="marquee-activations-js">
    </script>
    <script src="{{ asset('wp-content/themes/tradelocker-child/js/switch-tabs0ab2.js') }}" async defer
        data-cookieconsent="ignore" data-cookiecategory="essential"></script>
    <script src="{{ asset('wp-content/themes/tradelocker-child/js/platform-link69a7.js') }}" async defer
        data-cookieconsent="ignore" data-cookiecategory="essential"></script>
    <script data-cookieconsent="ignore" data-cookiecategory="essential"
        src="{{ asset('wp-content/themes/tradelocker-child/js/animations580a.js') }}" id="animations-js"></script>
    <script id="ajax-search-js-extra">
        var ajax_obj = {
            "ajaxurl": "https:\/\/tradelocker.com\/wp-admin\/admin-ajax.php"
        };
    </script>
    <script src="{{ asset('wp-content/themes/tradelocker-child/js/ajax-search544d.js') }}" id="ajax-search-js"></script>
    <script id="leadin-script-loader-js-js-extra">
        var leadin_wordpress = {
            "userRole": "visitor",
            "pageType": "home",
            "leadinPluginVersion": "11.3.6"
        };
    </script>
    <script src="{{ asset('js-eu1.hs-scripts.com/1452689439a4a.js') }}" id="leadin-script-loader-js-js"></script>
    <script src="{{ asset('wp-content/plugins/maintainnance-plugin/js/campaign-bara20d.js') }}" id="campaign-bar-js">
    </script>
    <script src="{{ asset('cdn.jsdelivr.net/npm/js-cookie@2.2.1/src/js.cookie.min77e6.js') }}" id="js-cookie-js"></script>
    <script src="{{ asset('wp-content/plugins/partner-portal-plugin/js/fetchCookies0b99.js') }}" id="fetchCookies-js">
    </script>
    <script src="{{ asset('wp-content/plugins/partners-plugin/js/searchfiltere9db.js') }}" id="search-filter-js"></script>
    <script src="{{ asset('wp-content/themes/tradelocker-child/js/toggle-projects7ae3.js') }}" id="toggle-projects-js">
    </script>
    <script src="{{ asset('wp-content/themes/hello-elementor/assets/js/hello-frontend.min41fe.js') }}"
        id="hello-theme-frontend-js"></script>
    <script src="{{ asset('wp-content/plugins/elementor/assets/js/webpack.runtime.mina44d.js') }}"
        id="elementor-webpack-runtime-js"></script>
    <script src="{{ asset('wp-content/plugins/elementor/assets/js/frontend-modules.mina44d.js') }}"
        id="elementor-frontend-modules-js"></script>
    <script src="{{ asset('wp-content/plugins/elementor/assets/lib/waypoints/waypoints.min05da.js') }}"
        id="elementor-waypoints-js"></script>
    <script src="{{ asset('wp-includes/js/jquery/ui/core.minb37e.js') }}" id="jquery-ui-core-js"></script>
    <script id="elementor-frontend-js-before">
        var elementorFrontendConfig = {
            "environmentMode": {
                "edit": false,
                "wpPreview": false,
                "isScriptDebug": false
            },
            "i18n": {
                "shareOnFacebook": "Share on Facebook",
                "shareOnTwitter": "Share on Twitter",
                "pinIt": "Pin it",
                "download": "Download",
                "downloadImage": "Download image",
                "fullscreen": "Fullscreen",
                "zoom": "Zoom",
                "share": "Share",
                "playVideo": "Play Video",
                "previous": "Previous",
                "next": "Next",
                "close": "Close"
            },
            "is_rtl": false,
            "breakpoints": {
                "xs": 0,
                "sm": 480,
                "md": 768,
                "lg": 1025,
                "xl": 1440,
                "xxl": 1600
            },
            "responsive": {
                "breakpoints": {
                    "mobile": {
                        "label": "Mobile Portrait",
                        "value": 767,
                        "default_value": 767,
                        "direction": "max",
                        "is_enabled": true
                    },
                    "mobile_extra": {
                        "label": "Mobile Landscape",
                        "value": 880,
                        "default_value": 880,
                        "direction": "max",
                        "is_enabled": false
                    },
                    "tablet": {
                        "label": "Tablet Portrait",
                        "value": 1024,
                        "default_value": 1024,
                        "direction": "max",
                        "is_enabled": true
                    },
                    "tablet_extra": {
                        "label": "Tablet Landscape",
                        "value": 1200,
                        "default_value": 1200,
                        "direction": "max",
                        "is_enabled": false
                    },
                    "laptop": {
                        "label": "Laptop",
                        "value": 1366,
                        "default_value": 1366,
                        "direction": "max",
                        "is_enabled": false
                    },
                    "widescreen": {
                        "label": "Widescreen",
                        "value": 2400,
                        "default_value": 2400,
                        "direction": "min",
                        "is_enabled": false
                    }
                }
            },
            "version": "3.13.4",
            "is_static": false,
            "experimentalFeatures": {
                "e_dom_optimization": true,
                "e_optimized_assets_loading": true,
                "e_optimized_css_loading": true,
                "a11y_improvements": true,
                "additional_custom_breakpoints": true,
                "container": true,
                "e_swiper_latest": true,
                "hello-theme-header-footer": true,
                "landing-pages": true
            },
            "urls": {
                "assets": "https:\/\/tradelocker.com\/wp-content\/plugins\/elementor\/assets\/"
            },
            "swiperClass": "swiper",
            "settings": {
                "page": [],
                "editorPreferences": []
            },
            "kit": {
                "body_background_background": "classic",
                "active_breakpoints": ["viewport_mobile", "viewport_tablet"],
                "global_image_lightbox": "yes",
                "lightbox_enable_counter": "yes",
                "lightbox_enable_fullscreen": "yes",
                "lightbox_enable_zoom": "yes",
                "lightbox_enable_share": "yes",
                "lightbox_title_src": "title",
                "lightbox_description_src": "description",
                "hello_header_logo_type": "logo",
                "hello_header_menu_layout": "horizontal",
                "hello_footer_logo_type": "logo"
            },
            "post": {
                "id": 2264,
                "title": "Next-Gen%20Forex%20Trading%20Platform%20-%20TradeLocker",
                "excerpt": "",
                "featuredImage": "https:\/\/tradelocker.com\/wp-content\/uploads\/2025\/03\/cover-1-1-1024x574.jpg"
            }
        };
    </script>
    <script src="{{ asset('wp-content/plugins/elementor/assets/js/frontend.mina44d.js') }}" id="elementor-frontend-js">
    </script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        window.gtranslateSettings = {
            "default_language": "en",
            "detect_browser_language": true,
            "wrapper_selector": ".gtranslate_wrapper",
            "flag_size": 24,
            "flag_style": "3d"
        }
    </script>
    <script>
        async function forceClearCache() {
            if ('serviceWorker' in navigator) {

                // 1. Get all cache names
                const cacheNames = await caches.keys();

                // 2. Delete all caches
                await Promise.all(
                    cacheNames.map(name => {
                        console.log(`Deleting cache: ${name}`);
                        return caches.delete(name);
                    })
                );

                // 3. Unregister the Service Worker (Optional but recommended for a hard reset)
                const registrations = await navigator.serviceWorker.getRegistrations();
                for (let registration of registrations) {
                    await registration.unregister();
                }

                // 4. Reload the page to grab fresh assets
                window.location.reload(true);
            }
        }
    </script>
    <script src="https://cdn.gtranslate.net/widgets/latest/popup.js" defer></script>
    <script>
        // Wait for the DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Select all elements with class 'gt_switcher-popup'
            document.querySelectorAll('.gt_switcher-popup').forEach(function(el) {
                // Find all span children and hide them
                el.querySelectorAll('span').forEach(function(span) {
                    span.style.display = 'none';
                });
            });
        });
    </script>
    @livewireScripts
    @vite('resources/js/app.js')
</body>

</html>
