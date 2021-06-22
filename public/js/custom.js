"use strict";

/* global DocumentTouch */
var _prefLang = '';
var _lang = document.getElementsByTagName('html')[0].lang;
var _direction = _lang === 'ar' ? 'rtl' : 'ltr';

$(window).on('load', function () {
    if (feather) {
        feather.replace({
            width: 14
            , height: 14
        });
    }
})

jQuery.fn.serializeObject = function (i) {
    function e(i, t) {
        var a,
            r = t.splice(0, 1);
        return 0 === t.length
            ? a = i
            : i[r]
                ? a = e(i[r], t)
                : (i[r] = {}, a = e(i[r], t)),
            a;
    }

    var t = {},
        a = this.serializeArray(),
        r = this;
    return jQuery.each(a, function () {
        var a = this.name,
            s = t;
        if (i) {
            if (i[a]) {
                var n = i[a].split(".");
                s = e(t, n),
                    a = a.split(".").splice(-1, 1);
            }
        } else {
            if (-1 !== a.indexOf(".")) {
                var n = a.split(".");
                s = e(t, n),
                    a = a.split(".").splice(-1, 1);
            }
            var l = jQuery("*[name='" + this.name + "']", r).data("form-path");
            l && (s = e(s, [a, l]), a = l);
        }
        void 0 !== s[a]
            ? (s[a].push || (s[a] = [s[a]]), s[a].push(this.value || ""))
            : s[a] = this.value || "";
    }),
        t;
};

// Helpful Functions
function getBaseURL() {
    return jQuery("base:first", "head").length === 1 ? (jQuery("base:first", "head").attr("href") + '/') : '';
};

function gridLang() {
    return jQuery("base#grid-lang:first", "head").length === 1 ? (jQuery("#grid-lang:first", "head").attr("href") + '/') : '';
};

function getWebsiteBaseURL() {
    return jQuery("base#website-base", "head").length === 1 ? (jQuery("base#website-base", "head").attr("href") + '/') : '';
};

function avatarWrapper(value) {
    var $name = value.full_name,
        $email = value.email,
        $image = value.avatar,
        stateNum = Math.floor(Math.random() * 6),
        states = ['success', 'danger', 'warning', 'info', 'primary', 'secondary'],
        $state = states[stateNum],
        $initials = $name.match(/\b\w/g) || [];
    $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
    if ($image) {
        // For Avatar image
        var $output =
            '<img  src="' + assetPath + 'images/avatars/' + $image + '" alt="Avatar" width="32" height="32">';
    } else {
        // For Avatar badge
        $output = '<div class="avatar-content">' + $initials + '</div>';
    }
    // Creates full output for row
    var colorClass = $image === '' ? ' bg-light-' + $state + ' ' : ' ';

    var $rowOutput =
        '<div class="d-flex justify-content-left align-items-center">' +
        '<div class="avatar-wrapper">' +
        '<div class="avatar' +
        colorClass +
        'mr-50">' +
        $output +
        '</div>' +
        '</div>' +
        '<div class="d-flex flex-column">' +
        '<h6 class="user-name text-truncate mb-0">' +
        $name +
        '</h6>' +
        '<small class="text-truncate text-muted">' +
        $email +
        '</small>' +
        '</div>' +
        '</div>';
    return $rowOutput;
};

function appendRowsTable(columns, data, $tableBody) {
    data.length ? $tableBody.html('') : $tableBody.html(`<tr><td colspan="${columns.length}" class="text-center"><i class="fa fa-exclamation-triangle"></i> No data to display</td></tr>`);
    for (var i = 0; i < data.length; i++) {
        var td;
        var tr = document.createElement('tr');
        for (var j = 0; j < columns.length; ++j) {
            td = document.createElement('td');
            if (['contact_number', 'phone1', 'phone2', 'mobile'].indexOf(columns[j]['name']) > -1) {
                td.classList.add('phone-number');
            }
            var val = data[i][columns[j]['name']];
            if (typeof columns[j]['name'] === 'object') {
                val = data[i][columns[j]['name'][0]];
                for (var k = 1; k < columns[j]['name'].length; ++k) {
                    val = val[columns[j]['name'][k]]
                }
            }
            td.innerHTML = formatValue(val, columns[j]['type'], columns[j]['pathFunc']);
            tr.appendChild(td);
        }
        $tableBody.append(tr);
    }
};

function buildSimplePagination(options) {
    onClick = window[options.onClick];
    columns = options.columns;
    var html = '';
    html += `<li class="page-item ${options.onFirstPage ? 'disabled' : ''}"><a href="javascript:;" onclick="onClick(columns, ${options.page - 1})" class="page-link">« Previous</a></li>`;
    html += `<li class="page-item ${options.hasMorePages ? '' : 'disabled'}"><a href="javascript:;" onclick="onClick(columns, ${options.page + 1})" class="page-link">» Next</a></li>`;
    options.widget.find('.pagination').html(html);
};

function formatValue(value, type, pathFunc = '') {
    switch (type) {
        case 'string':
            return jQuery.isEmptyObject(value) ? '-' : value;
        case 'ucword':
            return ucwords(value);
        case 'ucword_string':
            return jQuery.isEmptyObject(value) ? '-' : ucwords(value.replace('_', ' '));
        // case 'translated_string':
        //     return jQuery.isEmptyObject(value) ? '-' : Lang.get(`global.${value}`);
        case 'float':
            return number_format(value, 2);
        case 'positive':
            return value > 0 ? value : '-';
        case 'percent':
            return '%' + number_format(value, 2);
        case 'money':
            return number_format(value, 3);
        case 'number':
            return number_format(value, 0);
        case 'date':
            return jQuery.isEmptyObject(value) || value === undefined ? '-' : date('M j, Y', strtotime(value));
        case 'datetime':
            return jQuery.isEmptyObject(value) || value === undefined ? '-' : date('j M Y g:i A', strtotime(value));
        case 'boolean':
            return value ? 'Yes' : 'No';
        case 'link':
            return `<a href="${value}" target="_blank"><i class="fas fa-2x fa-link"></i></a>`;
        case 'avatar':
            return `<img src="${value}" class="img-thumbnail img-circle img-md image-thumbnail">`;
        case 'details_link':
            return `<a href="javascript:;" class="custom-details-link" data-value="${value}">${value}</a>`;
        case 'document':
            return `<a href="${window[pathFunc](value)}" target="_blank"><i class="fas fa-2x fa-download"></i></a>`;
        case 'json':
            var json = value;
            try {
                json = JSON.stringify(value).replace(/\\n/g, "")
                    .replace(/\\/g, "")
                    .replace(/\\&/g, "")
                    .replace(/\\r/g, "")
                    .replace(/\\t/g, "")
                    .replace(/\\b/g, "")
                    .replace(/\\f/g, "");
            } catch (e) {
            }
            return jQuery.isEmptyObject(value) ? '-' : `<code>${json}</code>`;
        default:
            return value;
    }
};

function changeGridLangPreference(keyValue, keyName, $el, dataTablesReload = false) {
    jQuery.ajax({
        url: getBaseURL() + "user_preferences",
        data: {
            'key': keyName,
            'value': keyValue,
        },
        dataType: "JSON",
        type: "POST",
        beforeSend: function () {
            $el.attr('disabled', true);
            $el.addClass('disabled');
        },
        complete: function () {
            $el.attr('disabled', false);
            $el.removeClass('disabled');
        },
        success: function () {
            if (dataTablesReload) {
                _prefLang = keyValue;
                reloadDataGrid();
                jQuery('.grid-heading .lang-text').html(keyValue.toUpperCase())
                jQuery('.grid-heading .lang-icon').attr('class', 'lang-icon mr-25 flag-icon flag-icon-' + keyValue)
            } else {
                location.reload();
            }
        },
        error: HandleJsonErrors
    });
}

function isTouchDevice() {
    return true === ("ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch);
};

function isEmpty(str) {
    return str ? (str.length === 0 || !str.trim()) : true;
};

function validateEmail(mail, notify) {
    if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(mail)) {
        return (true)
    }
    let _notify = notify === undefined ? true : notify;
    if (_notify) {
        console.log(_notify);
        toastr.warning(Lang.get('global.must_be_a_valid_email_address'), 400);
    }
    return (false)
}

function formatDate(str) {
    return jQuery.isEmptyObject(str) ? '-' : (str.length > 12 ? str.substring(0, str.length - 9) : str);
};

function substring(str, $limiter = 40) {
    return str.length > $limiter ? str.substring(0, $limiter) + '...' : str;
}

function HandleJsonErrors(xhr, errorThrown) {
    var _message = '';
    switch (xhr.status) {
        case 400:
            if (typeof xhr.responseJSON.message === 'string') {
                toastr.error(xhr.responseJSON.message, 400);
            }
            if (typeof xhr.responseJSON.message === 'object') {
                _message = '<div class="text-left">';
                for (var i in xhr.responseJSON.message) {
                    _message += xhr.responseJSON.message[i];
                }
                _message += '</div>';

                toastr.error(_message, '400', {
                    timeOut: 3000
                });
            }
            break;
        case 401:
            toastr.warning(xhr.responseJSON.message, '401');
            if (window.location.pathname !== '/login') {
                setTimeout(function () {
                    window.location = getBaseURL() + 'login';
                }, 1500);
            }
            break;
        case 403:
            toastr.error(xhr.responseJSON.message, '403');
            break;
        case 404:
            toastr.error(xhr.responseJSON.message, '404');
            break;
        case 406:
            toastr.warning(xhr.responseJSON.message, '406');
            break;
        case 422:
            _message = '<div class="text-left">';
            for (var i in xhr.responseJSON.errors) {
                _message += xhr.responseJSON.errors[i];
            }
            _message += '</div>';

            toastr.error(_message, '422', {
                timeOut: 5000
            });
            break;
        case 451:
            toastr.error(xhr.responseJSON.message, '451');
            break;
        case 500:
            toastr.error(xhr.responseJSON.message, '500');
            break;
        default:
            toastr.error('Something went wrong: ' + errorThrown, 'Oops..');
    }
    return false;
};

// Dialog Button Loading/Reset On Action
function btnLoading($this) {
    var $originalText = $this.html();
    $this.attr('data-original-text', $originalText)
        .attr('data-loading-text', ($originalText + ' ' + "<i class='fa fa-spinner fa-spin'></i>"))
        .prop('disabled', true)
        .html($this.data('loadingText'));
};

function btnReset($this) {
    $this.html($this.data('originalText'))
        .prop('disabled', false);
    $this.unbind();
};

function ucwords(str) {
    return (str + '').replace(/-/g, ' ').replace(/_/g, ' ').replace(/^(.)|\s+(.)/g, function ($1) {
        return $1.toUpperCase();
    });
};

function array_merge() {
    var args = Array.prototype.slice.call(arguments);
    var argl = args.length;
    var arg;
    var retObj = {};
    var k = '';
    var argil = 0;
    var j = 0;
    var i = 0;
    var ct = 0;
    var toStr = Object.prototype.toString;
    var retArr = true;
    for (i = 0; i < argl; i++) {
        if (toStr.call(args[i]) !== '[object Array]') {
            retArr = false;
            break
        }
    }
    if (retArr) {
        retArr = [];
        for (i = 0; i < argl; i++) {
            retArr = retArr.concat(args[i]);
        }
        return retArr;
    }
    for (i = 0, ct = 0; i < argl; i++) {
        arg = args[i];
        if (toStr.call(arg) === '[object Array]') {
            for (j = 0, argil = arg.length; j < argil; j++) {
                retObj[ct++] = arg[j];
            }
        } else {
            for (k in arg) {
                if (arg.hasOwnProperty(k)) {
                    if (parseInt(k, 10) + '' === k) {
                        retObj[ct++] = arg[k];
                    } else {
                        retObj[k] = arg[k];
                    }
                }
            }
        }
    }
    return retObj;
};

function number_format(number, decimals, decPoint, thousandsSep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ?
        0 :
        +number;
    var prec = !isFinite(+decimals) ?
        0 :
        Math.abs(decimals);
    var sep = (typeof thousandsSep === 'undefined') ?
        ',' :
        thousandsSep;
    var dec = (typeof decPoint === 'undefined') ?
        '.' :
        decPoint;
    var s = '';
    var toFixedFix = function (n, prec) {
        var k = Math.pow(10, prec);
        return '' + (
            Math.round(n * k) / k).toFixed(prec);
    };
    s = (
        prec ?
            toFixedFix(n, prec) :
            '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
};

function copyToClipboard(text) {
    const el = document.createElement('textarea');
    el.value = text;
    el.setAttribute('readonly', '');
    el.style.position = 'absolute';
    el.style.left = '-9999px';
    document.body.appendChild(el);
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);
    toastr.info('', 'Copied!');
};

function date(format, timestamp) {
    var jsdate,
        f;
    var txtWordsEn = [
        'Sun',
        'Mon',
        'Tues',
        'Wednes',
        'Thurs',
        'Fri',
        'Satur',
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
    ];
    var txtWordsTr = [
        'Pazar',
        'Pazartesi',
        'Salı',
        'Çarşamba',
        'Perşembe',
        'Cuma',
        'Cumartesi',
        'Ocak',
        'Şubat',
        'Mart',
        'Nisan',
        'Mayıs',
        'Haziran',
        'Temmuz',
        'Ağustos',
        'Eylül',
        'Ekim',
        'Kasım',
        'Aralık'
    ];
    var txtWordsAr = [
        'أحد',
        'الاثنين',
        'الثلاثاء',
        'الأربعاء',
        'الخميس',
        'الجمعة',
        'السبت',
        'كانون الثاني',
        'شباط',
        'آذار',
        'نيسان',
        'أيار',
        'حزيران',
        'تموز',
        'آب',
        'أيلول',
        'تشرين الأول',
        'تشرين الثاني',
        'كانون الأول'
    ];
    var txtWords = _lang === 'ar'
        ? txtWordsAr
        : (
            _lang === 'en'
                ? txtWordsEn
                : txtWordsTr);
    var formatChr = /\\?(.?)/gi;
    var formatChrCb = function (t, s) {
        return f[t]
            ? f[t]()
            : s;
    };
    var _pad = function (n, c) {
        n = String(n);
        while (n.length < c) {
            n = '0' + n;
        }
        return n;
    };
    f = {
        d: function () {
            return _pad(f.j(), 2);
        },
        D: function () {
            return f.l().slice(0, 3);
        },
        j: function () {
            return jsdate.getDate();
        },
        l: function () {
            return txtWords[f.w()] + (
                _lang === 'ar'
                    ? 'يوم'
                    : (
                        _lang === 'en'
                            ? 'day'
                            : 'gün'));
        },
        N: function () {
            return f.w() || 7;
        },
        S: function () {
            var j = f.j();
            var i = j % 10;
            if (i <= 3 && parseInt((j % 100) / 10, 10) === 1) {
                i = 0;
            }
            return ['st', 'nd', 'rd'][i - 1] || 'th';
        },
        w: function () {
            return jsdate.getDay();
        },
        z: function () {
            var a = new Date(f.Y(), f.n() - 1, f.j());
            var b = new Date(f.Y(), 0, 1);
            return Math.round((a - b) / 864e5);
        },
        W: function () {
            var a = new Date(f.Y(), f.n() - 1, f.j() - f.N() + 3);
            var b = new Date(a.getFullYear(), 0, 4);
            return _pad(1 + Math.round((a - b) / 864e5 / 7), 2);
        },
        F: function () {
            return txtWords[6 + f.n()];
        },
        m: function () {
            return _pad(f.n(), 2);
        },
        M: function () {
            return _lang === 'ar'
                ? f.F()
                : f.F().slice(0, 3);
        },
        n: function () {
            return jsdate.getMonth() + 1;
        },
        t: function () {
            return (new Date(f.Y(), f.n(), 0)).getDate();
        },
        L: function () {
            var j = f.Y();
            return j % 4 === 0 & j % 100 !== 0 | j % 400 === 0;
        },
        o: function () {
            var n = f.n();
            var W = f.W();
            var Y = f.Y();
            return Y + (
                n === 12 && W < 9
                    ? 1
                    : n === 1 && W > 9
                        ? -1
                        : 0);
        },
        Y: function () {
            return jsdate.getFullYear();
        },
        y: function () {
            return f.Y().toString().slice(-2);
        },
        a: function () {
            return jsdate.getHours() > 11
                ? (
                    _lang === 'ar'
                        ? 'م'
                        : 'pm')
                : (
                    _lang === 'ar'
                        ? 'ص'
                        : 'am');
        },
        A: function () {
            return f.a().toUpperCase();
        },
        B: function () {
            var H = jsdate.getUTCHours() * 36e2;
            var i = jsdate.getUTCMinutes() * 60;
            var s = jsdate.getUTCSeconds();
            return _pad(Math.floor((H + i + s + 36e2) / 86.4) % 1e3, 3);
        },
        g: function () {
            return f.G() % 12 || 12;
        },
        G: function () {
            return jsdate.getHours();
        },
        h: function () {
            return _pad(f.g(), 2);
        },
        H: function () {
            return _pad(f.G(), 2);
        },
        i: function () {
            return _pad(jsdate.getMinutes(), 2);
        },
        s: function () {
            return _pad(jsdate.getSeconds(), 2);
        },
        u: function () {
            return _pad(jsdate.getMilliseconds() * 1000, 6);
        },
        e: function () {
            var msg = 'Not supported (see source code of date() for timezone on how to add support)';
            throw new Error(msg);
        },
        I: function () {
            var a = new Date(f.Y(), 0);
            var c = Date.UTC(f.Y(), 0);
            var b = new Date(f.Y(), 6);
            var d = Date.UTC(f.Y(), 6);
            return ((a - c) !== (b - d))
                ? 1
                : 0;
        },
        O: function () {
            var tzo = jsdate.getTimezoneOffset();
            var a = Math.abs(tzo);
            return (
                tzo > 0
                    ? '-'
                    : '+') + _pad(Math.floor(a / 60) * 100 + a % 60, 4);
        },
        P: function () {
            var O = f.O();
            return (O.substr(0, 3) + ':' + O.substr(3, 2));
        },
        T: function () {
            return 'UTC';
        },
        Z: function () {
            return -jsdate.getTimezoneOffset() * 60;
        },
        c: function () {
            return 'Y-m-d\\TH:i:sP'.replace(formatChr, formatChrCb);
        },
        r: function () {
            return 'D, d M Y H:i:s O'.replace(formatChr, formatChrCb);
        },
        U: function () {
            return jsdate / 1000 | 0;
        }
    };
    var _date = function (format, timestamp) {
        jsdate = (timestamp === undefined ? new Date() // Not provided
            : (timestamp instanceof Date) ? new Date(timestamp) // JS Date()
                : new Date(timestamp * 1000) // UNIX timestamp (auto-convert to int)
        );
        return format.replace(formatChr, formatChrCb);
    };
    return _date(format, timestamp);
};
function strtotime(text, now) {
    var parsed;
    var match;
    var today;
    var year;
    var date;
    var days;
    var ranges;
    var len;
    var times;
    var regex;
    var i;
    var fail = false;
    if (!text) {
        return fail;
    }
    text = text.replace(/^\s+|\s+$/g, '').replace(/\s{2,}/g, ' ').replace(/[\t\r\n]/g, '').toLowerCase();
    var pattern = new RegExp([
        '^(\\d{1,4})',
        '([\\-\\.\\/:])',
        '(\\d{1,2})',
        '([\\-\\.\\/:])',
        '(\\d{1,4})',
        '(?:\\s(\\d{1,2}):(\\d{2})?:?(\\d{2})?)?',
        '(?:\\s([A-Z]+)?)?$'
    ].join(''));
    match = text.match(pattern);
    if (match && match[2] === match[4]) {
        if (match[1] > 1901) {
            switch (match[2]) {
                case '-':
                    // YYYY-M-D
                    if (match[3] > 12 || match[5] > 31) {
                        return fail;
                    }
                    return new Date(match[1], parseInt(match[3], 10) - 1, match[5], match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
                case '.':
                    // YYYY.M.D is not parsed by strtotime()
                    return fail;
                case '/':
                    // YYYY/M/D
                    if (match[3] > 12 || match[5] > 31) {
                        return fail;
                    }
                    return new Date(match[1], parseInt(match[3], 10) - 1, match[5], match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
            }
        } else if (match[5] > 1901) {
            switch (match[2]) {
                case '-':
                    // D-M-YYYY
                    if (match[3] > 12 || match[1] > 31) {
                        return fail;
                    }
                    return new Date(match[5], parseInt(match[3], 10) - 1, match[1], match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
                case '.':
                    // D.M.YYYY
                    if (match[3] > 12 || match[1] > 31) {
                        return fail;
                    }
                    return new Date(match[5], parseInt(match[3], 10) - 1, match[1], match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
                case '/':
                    // M/D/YYYY
                    if (match[1] > 12 || match[3] > 31) {
                        return fail;
                    }
                    return new Date(match[5], parseInt(match[1], 10) - 1, match[3], match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
            }
        } else {
            switch (match[2]) {
                case '-':
                    // YY-M-D
                    if (match[3] > 12 || match[5] > 31 || (match[1] < 70 && match[1] > 38)) {
                        return fail;
                    }
                    year = match[1] >= 0 && match[1] <= 38
                        ? +match[1] + 2000
                        : match[1];
                    return new Date(year, parseInt(match[3], 10) - 1, match[5], match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
                case '.':
                    // D.M.YY or H.MM.SS
                    if (match[5] >= 70) {
                        // D.M.YY
                        if (match[3] > 12 || match[1] > 31) {
                            return fail;
                        }
                        return new Date(match[5], parseInt(match[3], 10) - 1, match[1], match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
                    }
                    if (match[5] < 60 && !match[6]) {
                        // H.MM.SS
                        if (match[1] > 23 || match[3] > 59) {
                            return fail;
                        }
                        today = new Date();
                        return new Date(today.getFullYear(), today.getMonth(), today.getDate(), match[1] || 0, match[3] || 0, match[5] || 0, match[9] || 0) / 1000;
                    }
                    // invalid format, cannot be parsed
                    return fail;
                case '/':
                    // M/D/YY
                    if (match[1] > 12 || match[3] > 31 || (match[5] < 70 && match[5] > 38)) {
                        return fail;
                    }
                    year = match[5] >= 0 && match[5] <= 38
                        ? +match[5] + 2000
                        : match[5];
                    return new Date(year, parseInt(match[1], 10) - 1, match[3], match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
                case ':':
                    // HH:MM:SS
                    if (match[1] > 23 || match[3] > 59 || match[5] > 59) {
                        return fail;
                    }
                    today = new Date();
                    return new Date(today.getFullYear(), today.getMonth(), today.getDate(), match[1] || 0, match[3] || 0, match[5] || 0) / 1000;
            }
        }
    }
    // other formats and "now" should be parsed by Date.parse()
    if (text === 'now') {
        return now === null || isNaN(now)
            ? new Date().getTime() / 1000 | 0
            : now | 0;
    }
    if (!isNaN(parsed = Date.parse(text))) {
        return parsed / 1000 | 0;
    }
    // Browsers !== Chrome have problems parsing ISO 8601 date strings, as they do
    // not accept lower case characters, space, or shortened time zones.
    // Therefore, fix these problems and try again.
    // Examples:
    //   2015-04-15 20:33:59+02
    //   2015-04-15 20:33:59z
    //   2015-04-15t20:33:59+02:00
    pattern = new RegExp(['^([0-9]{4}-[0-9]{2}-[0-9]{2})', '[ t]', '([0-9]{2}:[0-9]{2}:[0-9]{2}(\\.[0-9]+)?)', '([\\+-][0-9]{2}(:[0-9]{2})?|z)'].join(''));
    match = text.match(pattern);
    if (match) {
        // @todo: time zone information
        if (match[4] === 'z') {
            match[4] = 'Z';
        } else if (match[4].match(/^([+-][0-9]{2})$/)) {
            match[4] = match[4] + ':00';
        }
        if (!isNaN(parsed = Date.parse(match[1] + 'T' + match[2] + match[4]))) {
            return parsed / 1000 | 0;
        }
    }
    date = now
        ? new Date(now * 1000)
        : new Date();
    days = {
        'sun': 0,
        'mon': 1,
        'tue': 2,
        'wed': 3,
        'thu': 4,
        'fri': 5,
        'sat': 6
    };
    ranges = {
        'yea': 'FullYear',
        'mon': 'Month',
        'day': 'Date',
        'hou': 'Hours',
        'min': 'Minutes',
        'sec': 'Seconds'
    };

    function lastNext(type, range, modifier) {
        var diff;
        var day = days[range];
        if (typeof day !== 'undefined') {
            diff = day - date.getDay();
            if (diff === 0) {
                diff = 7 * modifier;
            } else if (diff > 0 && type === 'last') {
                diff -= 7;
            } else if (diff < 0 && type === 'next') {
                diff += 7;
            }
            date.setDate(date.getDate() + diff);
        }
    }

    function process(val) {
        var splt = val.split(' ');
        var type = splt[0];
        var range = splt[1].substring(0, 3);
        var typeIsNumber = /\d+/.test(type);
        var ago = splt[2] === 'ago';
        var num = (
            type === 'last'
                ? -1
                : 1) * (
                ago
                    ? -1
                    : 1);
        if (typeIsNumber) {
            num *= parseInt(type, 10);
        }
        if (ranges.hasOwnProperty(range) && !splt[1].match(/^mon(day|\.)?$/i)) {
            return date['set' + ranges[range]](date['get' + ranges[range]]() + num);
        }
        if (range === 'wee') {
            return date.setDate(date.getDate() + (num * 7));
        }
        if (type === 'next' || type === 'last') {
            lastNext(type, range, num);
        } else if (!typeIsNumber) {
            return false;
        }
        return true;
    }

    times = '(years?|months?|weeks?|days?|hours?|minutes?|min|seconds?|sec' + '|sunday|sun\\.?|monday|mon\\.?|tuesday|tue\\.?|wednesday|wed\\.?' + '|thursday|thu\\.?|friday|fri\\.?|saturday|sat\\.?)';
    regex = '([+-]?\\d+\\s' + times + '|' + '(last|next)\\s' + times + ')(\\sago)?';
    match = text.match(new RegExp(regex, 'gi'));
    if (!match) {
        return fail;
    }
    for (i = 0, len = match.length; i < len; i++) {
        if (!process(match[i])) {
            return fail;
        }
    }
    return (date.getTime() / 1000);
};

// Select2
// (function () {
//     if (jQuery && jQuery.fn && jQuery.fn.select2 && jQuery.fn.select2.amd)
//         var e = jQuery.fn.select2.amd;
//     return e.define("select2/i18n/tr", [], function () {
//         return {
//             inputTooLong: function (e) {
//                 var t = e.input.length - e.maximum,
//                     n = t + " karakter daha girmelisiniz";
//                 return n;
//             },
//             inputTooShort: function (e) {
//                 var t = e.minimum - e.input.length,
//                     n = "En az " + t + " karakter daha girmelisiniz";
//                 return n;
//             },
//             loadingMore: function () {
//                 return "Daha fazla…";
//             },
//             maximumSelected: function (e) {
//                 var t = "Sadece " + e.maximum + " seçim yapabilirsiniz";
//                 return t;
//             },
//             noResults: function () {
//                 return "Sonuç bulunamadı";
//             },
//             searching: function () {
//                 return "Aranıyor…";
//             }
//         }
//     }), {
//         define: e.define,
//         require: e.require
//     }
// })();
// (function () {
//     if (jQuery && jQuery.fn && jQuery.fn.select2 && jQuery.fn.select2.amd)
//         var e = jQuery.fn.select2.amd;
//     return e.define("select2/i18n/ar", [], function () {
//         return {
//             errorLoading: function () {
//                 return "لا يمكن تحميل النتائج";
//             },
//             inputTooLong: function (e) {
//                 var t = e.input.length - e.maximum,
//                     n = "الرجاء حذف " + (
//                         t === 1
//                             ? ("حرف ")
//                             : (
//                                 t === 2
//                                     ? "حرفين "
//                                     : (t + " أحرف")));
//                 return n;
//             },
//             inputTooShort: function (e) {
//                 var t = e.minimum - e.input.length,
//                     n = "الرجاء إضافة " + (
//                         t === 1
//                             ? ("حرف ")
//                             : (
//                                 t === 2
//                                     ? "حرفين "
//                                     : (t + " أحرف")));
//                 return n;
//             },
//             loadingMore: function () {
//                 return "جاري تحميل نتائج إضافية...";
//             },
//             maximumSelected: function (e) {
//                 var t = "تستطيع إختيار " + e.maximum + " بنود فقط";
//                 return t;
//             },
//             noResults: function () {
//                 return "لم يتم العثور على أي نتائج";
//             },
//             searching: function () {
//                 return "جاري البحث…";
//             }
//         }
//     }), {
//         define: e.define,
//         require: e.require
//     }
// })();
// !! Libraries Translations !!

function resetForm(selector) {
    let $form = jQuery(selector);
    $form[0].reset();
    $form.find('input:not([type="hidden"])').val('');
    $form.find('textarea').val('');
    $form.find('.select, .autocomplete').val('').trigger('change.select2');
};

function noDataTemplate() {
    return `<div class="no-data-to-display">
    <i class="fa fa-exclamation-triangle mb-2"></i>
    <br>
    ${Lang.get('global.no_data_to_display')}
    </div>`;
}

// DOM
jQuery(function () {
    // $('.select').select2({
    //     width: '100%'
    // });

    // Prevent Double Submits
    document.querySelectorAll('form').forEach(form => {
        if (form.classList.contains('non-ajax-form')) {
            form.addEventListener('submit', (e) => {
                // Prevent if already submitting
                if (form.classList.contains('is-submitting')) {
                    e.preventDefault();
                }
                // Add class to hook our visual indicator on
                form.classList.add('is-submitting');
                if (jQuery('form.is-submitting .btn[type="submit"]').length) {
                    btnLoading(jQuery('form.is-submitting .btn[type="submit"]'));
                }
            });
        }
    });

    if (jQuery('[data-toggle="tooltip"]').length) {
        jQuery('[data-toggle="tooltip"]').tooltip();
    }

    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    if (isTouchDevice() === true) {
        jQuery("[data-toggle='tooltip']").tooltip('disable');
    }

    var url = window.location.pathname.split('/');
    var $activeLink = jQuery('ul.nav-pills.nav-sidebar a[urls*="' + url[1] + '"]');
    $activeLink.parent().addClass('active');

    jQuery('.dropdown-notification').on('click', function () {
        jQuery('.dropdown-menu .scrollable-container').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');
        jQuery.ajax({
            type: 'GET',
            url: getBaseURL() + 'notifications',
            success(xhr) {
                jQuery('.dropdown-menu .overlay').remove();
                // jQuery('.notification-badge').text(xhr.count);
                jQuery('.notification-badge').hide();
                jQuery('.clear-notifications').attr('disabled', true);
                if (xhr.notifications.data.length > 0) {
                    jQuery('.clear-notifications').attr('disabled', false);
                    jQuery('.dropdown-menu .scrollable-container').html('');
                    for (let i = 0; i < xhr.notifications.data.length; i++) {
                        jQuery('.dropdown-menu .scrollable-container').append(`
                          <a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                              <div class="media-body">
                                <p class="media-heading">${xhr.notifications.data[i].data.message ? xhr.notifications.data[i].data.message : ''}</p>
                                <small class="notification-text">${date('d-m-Y g:i A', strtotime(xhr.notifications.data[i].created_at))}</small>
                              </div>
                            </div>
                          </a>`)
                    }
                }
            }
        });
    });

    jQuery('.clear-notifications').on('click', function () {
        if (window.confirm('Clear all notifications?')) {
            jQuery('.dropdown-menu .scrollable-container').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');
            jQuery.ajax({
                url: getBaseURL() + 'notifications/delete_all',
                dataType: "JSON",
                type: "POST",
                data: {
                    '_method': 'DELETE'
                },
                beforeSend: function () {
                },
                success: function () {
                    jQuery('.dropdown-menu .scrollable-container').html('<p class="text-center my-2">No Notifications</p>');
                    jQuery('.dropdown-menu .overlay').remove();
                    jQuery('.new-notifications-badge').hide();
                },
                error: HandleJsonErrors,
            });
        }
    });

    jQuery.fn.inputFilter = function (inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function () {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            }
        });
    };

    if (jQuery("input.numeric").length) {
        jQuery("input.numeric").inputFilter(function (value) {
            return /^(\d+(\.\d*)?)?$/.test(value);
        });
    }

    if (jQuery("input.money").length) {
        jQuery("input.money").inputFilter(function (value) {
            return /^(\d+(\.\d{0,2})?)?$/.test(value);
        });
    }

    if (jQuery("input.phone").length) {
        jQuery("input.phone").inputFilter(function (value) {
            return /^([1-9]\d*)?$/.test(value);
        });
    }

    if (jQuery("input.percentage").length) {
        jQuery("input.percentage").inputFilter(function (value) {
            return /^(\d{1,2}(\.\d{0,2})?|100(\.0{0,2})?)?$/.test(value);
        });
    }
});