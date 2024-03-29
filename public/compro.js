// Theme mode
let mode = window.localStorage.getItem('mode'),
    root = document.getElementsByTagName('html')[0];
if (mode !== null && mode === 'dark') {
    root.classList.add('dark-mode');
} else {
    root.classList.remove('dark-mode');
}
// Page loading scripts
(function () {
    window.onload = function () {
        const preloader = document.querySelector('.page-loading');
        preloader.classList.remove('active');
        setTimeout(function () {
            preloader.remove();
        }, 1000);
    };
})();
// Google Tag Manager
(function (w, d, s, l, i) {
    w[l] = w[l] || []; w[l].push({
        'gtm.start':
            new Date().getTime(), event: 'gtm.js'
    }); var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
            '../www.googletagmanager.com/gtm5445.html?id=' + i + dl; f.parentNode.insertBefore(j, f);
})(window, document, 'script', 'dataLayer', 'GTM-WKV3GT5');