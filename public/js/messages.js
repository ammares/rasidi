/*!
 *  Lang.js for Laravel localization in JavaScript.
 *
 *  @version 1.1.12
 *  @license MIT https://github.com/rmariuzzo/Lang.js/blob/master/LICENSE
 *  @site    https://github.com/rmariuzzo/Lang.js
 *  @author  Rubens Mariuzzo <rubens@mariuzzo.com>
 */

(function(root, factory) {
    'use strict';

    if (typeof define === 'function' && define.amd) {
        // AMD support.
        define([], factory);
    } else if (typeof exports === 'object') {
        // NodeJS support.
        module.exports = factory();
    } else {
        // Browser global support.
        root.Lang = factory();
    }

}(this, function() {
    'use strict';

    function inferLocale() {
        if (typeof document !== 'undefined' && document.documentElement) {
            return document.documentElement.lang;
        }
    };

    function convertNumber(str) {
        if (str === '-Inf') {
            return -Infinity;
        } else if (str === '+Inf' || str === 'Inf' || str === '*') {
            return Infinity;
        }
        return parseInt(str, 10);
    }

    // Derived from: https://github.com/symfony/translation/blob/460390765eb7bb9338a4a323b8a4e815a47541ba/Interval.php
    var intervalRegexp = /^({\s*(\-?\d+(\.\d+)?[\s*,\s*\-?\d+(\.\d+)?]*)\s*})|([\[\]])\s*(-Inf|\*|\-?\d+(\.\d+)?)\s*,\s*(\+?Inf|\*|\-?\d+(\.\d+)?)\s*([\[\]])$/;
    var anyIntervalRegexp = /({\s*(\-?\d+(\.\d+)?[\s*,\s*\-?\d+(\.\d+)?]*)\s*})|([\[\]])\s*(-Inf|\*|\-?\d+(\.\d+)?)\s*,\s*(\+?Inf|\*|\-?\d+(\.\d+)?)\s*([\[\]])/;

    // Default options //

    var defaults = {
        locale: 'en'/** The default locale if not set. */
    };

    // Constructor //

    var Lang = function(options) {
        options = options || {};
        this.locale = options.locale || inferLocale() || defaults.locale;
        this.fallback = options.fallback;
        this.messages = options.messages;
    };

    // Methods //

    /**
     * Set messages source.
     *
     * @param messages {object} The messages source.
     *
     * @return void
     */
    Lang.prototype.setMessages = function(messages) {
        this.messages = messages;
    };

    /**
     * Get the current locale.
     *
     * @return {string} The current locale.
     */
    Lang.prototype.getLocale = function() {
        return this.locale || this.fallback;
    };

    /**
     * Set the current locale.
     *
     * @param locale {string} The locale to set.
     *
     * @return void
     */
    Lang.prototype.setLocale = function(locale) {
        this.locale = locale;
    };

    /**
     * Get the fallback locale being used.
     *
     * @return void
     */
    Lang.prototype.getFallback = function() {
        return this.fallback;
    };

    /**
     * Set the fallback locale being used.
     *
     * @param fallback {string} The fallback locale.
     *
     * @return void
     */
    Lang.prototype.setFallback = function(fallback) {
        this.fallback = fallback;
    };

    /**
     * This method act as an alias to get() method.
     *
     * @param key {string} The key of the message.
     * @param locale {string} The locale of the message
     *
     * @return {boolean} true if the given key is defined on the messages source, otherwise false.
     */
    Lang.prototype.has = function(key, locale) {
        if (typeof key !== 'string' || !this.messages) {
            return false;
        }

        return this._getMessage(key, locale) !== null;
    };

    /**
     * Get a translation message.
     *
     * @param key {string} The key of the message.
     * @param replacements {object} The replacements to be done in the message.
     * @param locale {string} The locale to use, if not passed use the default locale.
     *
     * @return {string} The translation message, if not found the given key.
     */
    Lang.prototype.get = function(key, replacements, locale) {
        if (!this.has(key, locale)) {
            return key;
        }

        var message = this._getMessage(key, locale);
        if (message === null) {
            return key;
        }

        if (replacements) {
            message = this._applyReplacements(message, replacements);
        }

        return message;
    };

    /**
     * This method act as an alias to get() method.
     *
     * @param key {string} The key of the message.
     * @param replacements {object} The replacements to be done in the message.
     *
     * @return {string} The translation message, if not found the given key.
     */
    Lang.prototype.trans = function(key, replacements) {
        return this.get(key, replacements);
    };

    /**
     * Gets the plural or singular form of the message specified based on an integer value.
     *
     * @param key {string} The key of the message.
     * @param count {number} The number of elements.
     * @param replacements {object} The replacements to be done in the message.
     * @param locale {string} The locale to use, if not passed use the default locale.
     *
     * @return {string} The translation message according to an integer value.
     */
    Lang.prototype.choice = function(key, number, replacements, locale) {
        // Set default values for parameters replace and locale
        replacements = typeof replacements !== 'undefined'
            ? replacements
            : {};

        // The count must be replaced if found in the message
        replacements.count = number;

        // Message to get the plural or singular
        var message = this.get(key, replacements, locale);

        // Check if message is not null or undefined
        if (message === null || message === undefined) {
            return message;
        }

        // Separate the plural from the singular, if any
        var messageParts = message.split('|');

        // Get the explicit rules, If any
        var explicitRules = [];

        for (var i = 0; i < messageParts.length; i++) {
            messageParts[i] = messageParts[i].trim();

            if (anyIntervalRegexp.test(messageParts[i])) {
                var messageSpaceSplit = messageParts[i].split(/\s/);
                explicitRules.push(messageSpaceSplit.shift());
                messageParts[i] = messageSpaceSplit.join(' ');
            }
        }

        // Check if there's only one message
        if (messageParts.length === 1) {
            // Nothing to do here
            return message;
        }

        // Check the explicit rules
        for (var j = 0; j < explicitRules.length; j++) {
            if (this._testInterval(number, explicitRules[j])) {
                return messageParts[j];
            }
        }

        locale = locale || this._getLocale(key);
        var pluralForm = this._getPluralForm(number, locale);

        return messageParts[pluralForm];
    };

    /**
     * This method act as an alias to choice() method.
     *
     * @param key {string} The key of the message.
     * @param count {number} The number of elements.
     * @param replacements {object} The replacements to be done in the message.
     *
     * @return {string} The translation message according to an integer value.
     */
    Lang.prototype.transChoice = function(key, count, replacements) {
        return this.choice(key, count, replacements);
    };

    /**
     * Parse a message key into components.
     *
     * @param key {string} The message key to parse.
     * @param key {string} The message locale to parse
     * @return {object} A key object with source and entries properties.
     */
    Lang.prototype._parseKey = function(key, locale) {
        if (typeof key !== 'string' || typeof locale !== 'string') {
            return null;
        }

        var segments = key.split('.');
        var source = segments[0].replace(/\//g, '.');

        return {
            source: locale + '.' + source,
            sourceFallback: this.getFallback() + '.' + source,
            entries: segments.slice(1)
        };
    };

    /**
     * Returns a translation message. Use `Lang.get()` method instead, this methods assumes the key exists.
     *
     * @param key {string} The key of the message.
     * @param locale {string} The locale of the message
     *
     * @return {string} The translation message for the given key.
     */
    Lang.prototype._getMessage = function(key, locale) {
        locale = locale || this.getLocale();
        key = this._parseKey(key, locale);

        // Ensure message source exists.
        if (this.messages[key.source] === undefined && this.messages[key.sourceFallback] === undefined) {
            return null;
        }

        // Get message from default locale.
        var message = this.messages[key.source];
        var entries = key.entries.slice();
        var subKey = '';
        while (entries.length && message !== undefined) {
            var subKey = !subKey ? entries.shift() : subKey.concat('.', entries.shift());
            if (message[subKey] !== undefined) {
                message = message[subKey]
                subKey = '';
            }
        }

        // Get message from fallback locale.
        if (typeof message !== 'string' && this.messages[key.sourceFallback]) {
            message = this.messages[key.sourceFallback];
            entries = key.entries.slice();
            subKey = '';
            while (entries.length && message !== undefined) {
                var subKey = !subKey ? entries.shift() : subKey.concat('.', entries.shift());
                if (message[subKey]) {
                    message = message[subKey]
                    subKey = '';
                }
            }
        }

        if (typeof message !== 'string') {
            return null;
        }

        return message;
    };

    /**
     * Return the locale to be used between default and fallback.
     * @param {String} key
     * @return {String}
     */
    Lang.prototype._getLocale = function(key) {
        key = this._parseKey(key, this.locale)
        if (this.messages[key.source]) {
            return this.locale;
        }
        if (this.messages[key.sourceFallback]) {
            return this.fallback;
        }
        return null;
    };

    /**
     * Find a message in a translation tree using both dotted keys and regular ones
     *
     * @param pathSegments {array} An array of path segments such as ['family', 'father']
     * @param tree {object} The translation tree
     */
    Lang.prototype._findMessageInTree = function(pathSegments, tree) {
        while (pathSegments.length && tree !== undefined) {
            var dottedKey = pathSegments.join('.');
            if (tree[dottedKey]) {
                tree = tree[dottedKey];
                break;
            }

            tree = tree[pathSegments.shift()]
        }

        return tree;
    };

    /**
     * Sort replacement keys by length in descending order.
     *
     * @param a {string} Replacement key
     * @param b {string} Sibling replacement key
     * @return {number}
     * @private
     */
    Lang.prototype._sortReplacementKeys = function(a, b) {
        return b.length - a.length;
    };

    /**
     * Apply replacements to a string message containing placeholders.
     *
     * @param message {string} The text message.
     * @param replacements {object} The replacements to be done in the message.
     *
     * @return {string} The string message with replacements applied.
     */
    Lang.prototype._applyReplacements = function(message, replacements) {
        var keys = Object.keys(replacements).sort(this._sortReplacementKeys);

        keys.forEach(function(replace) {
            message = message.replace(new RegExp(':' + replace, 'gi'), function (match) {
                var value = replacements[replace];

                // Capitalize all characters.
                var allCaps = match === match.toUpperCase();
                if (allCaps) {
                    return value.toUpperCase();
                }

                // Capitalize first letter.
                var firstCap = match === match.replace(/\w/i, function(letter) {
                    return letter.toUpperCase();
                });
                if (firstCap) {
                    return value.charAt(0).toUpperCase() + value.slice(1);
                }

                return value;
            })
        });
        return message;
    };

    /**
     * Checks if the given `count` is within the interval defined by the {string} `interval`
     *
     * @param  count     {int}    The amount of items.
     * @param  interval  {string} The interval to be compared with the count.
     * @return {boolean}          Returns true if count is within interval; false otherwise.
     */
    Lang.prototype._testInterval = function(count, interval) {
        /**
         * From the Symfony\Component\Translation\Interval Docs
         *
         * Tests if a given number belongs to a given math interval.
         *
         * An interval can represent a finite set of numbers:
         *
         *  {1,2,3,4}
         *
         * An interval can represent numbers between two numbers:
         *
         *  [1, +Inf]
         *  ]-1,2[
         *
         * The left delimiter can be [ (inclusive) or ] (exclusive).
         * The right delimiter can be [ (exclusive) or ] (inclusive).
         * Beside numbers, you can use -Inf and +Inf for the infinite.
         */

        if (typeof interval !== 'string') {
            throw 'Invalid interval: should be a string.';
        }

        interval = interval.trim();

        var matches = interval.match(intervalRegexp);
        if (!matches) {
            throw 'Invalid interval: ' + interval;
        }

        if (matches[2]) {
            var items = matches[2].split(',');
            for (var i = 0; i < items.length; i++) {
                if (parseInt(items[i], 10) === count) {
                    return true;
                }
            }
        } else {
            // Remove falsy values.
            matches = matches.filter(function(match) {
                return !!match;
            });

            var leftDelimiter = matches[1];
            var leftNumber = convertNumber(matches[2]);
            if (leftNumber === Infinity) {
                leftNumber = -Infinity;
            }
            var rightNumber = convertNumber(matches[3]);
            var rightDelimiter = matches[4];

            return (leftDelimiter === '[' ? count >= leftNumber : count > leftNumber)
                && (rightDelimiter === ']' ? count <= rightNumber : count < rightNumber);
        }

        return false;
    };

    /**
     * Returns the plural position to use for the given locale and number.
     *
     * The plural rules are derived from code of the Zend Framework (2010-09-25),
     * which is subject to the new BSD license (http://framework.zend.com/license/new-bsd).
     * Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
     *
     * @param {Number} count
     * @param {String} locale
     * @return {Number}
     */
    Lang.prototype._getPluralForm = function(count, locale) {
        switch (locale) {
            case 'az':
            case 'bo':
            case 'dz':
            case 'id':
            case 'ja':
            case 'jv':
            case 'ka':
            case 'km':
            case 'kn':
            case 'ko':
            case 'ms':
            case 'th':
            case 'tr':
            case 'vi':
            case 'zh':
                return 0;

            case 'af':
            case 'bn':
            case 'bg':
            case 'ca':
            case 'da':
            case 'de':
            case 'el':
            case 'en':
            case 'eo':
            case 'es':
            case 'et':
            case 'eu':
            case 'fa':
            case 'fi':
            case 'fo':
            case 'fur':
            case 'fy':
            case 'gl':
            case 'gu':
            case 'ha':
            case 'he':
            case 'hu':
            case 'is':
            case 'it':
            case 'ku':
            case 'lb':
            case 'ml':
            case 'mn':
            case 'mr':
            case 'nah':
            case 'nb':
            case 'ne':
            case 'nl':
            case 'nn':
            case 'no':
            case 'om':
            case 'or':
            case 'pa':
            case 'pap':
            case 'ps':
            case 'pt':
            case 'so':
            case 'sq':
            case 'sv':
            case 'sw':
            case 'ta':
            case 'te':
            case 'tk':
            case 'ur':
            case 'zu':
                return (count == 1)
                    ? 0
                    : 1;

            case 'am':
            case 'bh':
            case 'fil':
            case 'fr':
            case 'gun':
            case 'hi':
            case 'hy':
            case 'ln':
            case 'mg':
            case 'nso':
            case 'xbr':
            case 'ti':
            case 'wa':
                return ((count === 0) || (count === 1))
                    ? 0
                    : 1;

            case 'be':
            case 'bs':
            case 'hr':
            case 'ru':
            case 'sr':
            case 'uk':
                return ((count % 10 == 1) && (count % 100 != 11))
                    ? 0
                    : (((count % 10 >= 2) && (count % 10 <= 4) && ((count % 100 < 10) || (count % 100 >= 20)))
                        ? 1
                        : 2);

            case 'cs':
            case 'sk':
                return (count == 1)
                    ? 0
                    : (((count >= 2) && (count <= 4))
                        ? 1
                        : 2);

            case 'ga':
                return (count == 1)
                    ? 0
                    : ((count == 2)
                        ? 1
                        : 2);

            case 'lt':
                return ((count % 10 == 1) && (count % 100 != 11))
                    ? 0
                    : (((count % 10 >= 2) && ((count % 100 < 10) || (count % 100 >= 20)))
                        ? 1
                        : 2);

            case 'sl':
                return (count % 100 == 1)
                    ? 0
                    : ((count % 100 == 2)
                        ? 1
                        : (((count % 100 == 3) || (count % 100 == 4))
                            ? 2
                            : 3));

            case 'mk':
                return (count % 10 == 1)
                    ? 0
                    : 1;

            case 'mt':
                return (count == 1)
                    ? 0
                    : (((count === 0) || ((count % 100 > 1) && (count % 100 < 11)))
                        ? 1
                        : (((count % 100 > 10) && (count % 100 < 20))
                            ? 2
                            : 3));

            case 'lv':
                return (count === 0)
                    ? 0
                    : (((count % 10 == 1) && (count % 100 != 11))
                        ? 1
                        : 2);

            case 'pl':
                return (count == 1)
                    ? 0
                    : (((count % 10 >= 2) && (count % 10 <= 4) && ((count % 100 < 12) || (count % 100 > 14)))
                        ? 1
                        : 2);

            case 'cy':
                return (count == 1)
                    ? 0
                    : ((count == 2)
                        ? 1
                        : (((count == 8) || (count == 11))
                            ? 2
                            : 3));

            case 'ro':
                return (count == 1)
                    ? 0
                    : (((count === 0) || ((count % 100 > 0) && (count % 100 < 20)))
                        ? 1
                        : 2);

            case 'ar':
                return (count === 0)
                    ? 0
                    : ((count == 1)
                        ? 1
                        : ((count == 2)
                            ? 2
                            : (((count % 100 >= 3) && (count % 100 <= 10))
                                ? 3
                                : (((count % 100 >= 11) && (count % 100 <= 99))
                                    ? 4
                                    : 5))));

            default:
                return 0;
        }
    };

    return Lang;

}));
(function () {
    Lang = new Lang();
    Lang.setMessages({"en.auth":{"failed":"These credentials do not match our records.","logged_out_successfully":"Logged out successfully","logged_in_successfully":"Logged in successfully","throttle":"Too many login attempts. Please try again in :seconds seconds.","remember_me":"Remember Me","log_in_to_start_your_session":"Log in to start your session","copy_right":"<strong>Copyright &copy; :date <a href=\"http:\/\/www.cgteam.co\" target=\"_blank\">Cgteam<\/a>.<\/strong><br\/>All rights reserved.","user_is_banned":"User is banned","your_account_is_temporarily_locked_try_again_after_minutes":"Your account is temporarily locked, try again after :minutes minutes"},"en.global":{"en":"English","es":"Spanish","ar":"\u0627\u0644\u0639\u0631\u0628\u064a\u0629","tr":"T\u00fcrk\u00e7e","date_time":{"am":"AM","pm":"PM"},"table_grid":{"advanced_filters":"Advanced Filters","between":"Between","cancel":"Cancel","contains":"Contains","ends_with":"Ends With","export_to_excel_xls":"Export To Excel (.xls)","is_empty":"Is Empty","not_empty":"Not Empty","reset":"Reset","starts_with":"Starts With","submit":"Submit","to":"To"},"abilities":"Abilities","actions":"Actions","activate":"Activate","activated":"Activated","activate_email_template":"Email Template has been activated successfully","active":"Active","add_new_power_module":"Add new power module","add_new_provider":"Add new provider","add_new_user":"Add new user","add_role":"Add role","add_new_gateway":"Add new gateway","alert_when_create_email_template":"You can use variables like {message}, {user_name}, {verification_code}, {}...","alert_when_edit_email_template":"Do not edit or remove variables like {message}, {user_name},{verification_code}, {}...","allowed_extensin_and_size_pic":"Allowed JPG, GIF or PNG. Max size of 2MB","all_rights_reserved":"All Rights Reserved","answer":"Answer","appliance":"Appliance","appliances":"Appliances","appliances_count":"Appliances Count","are_you_sure_to_delete_this_item":"Are you sure to delete this item?","avatar":"Avatar","back_to_normal":"Back to normal","ban":"Ban","battery_storage":"Battery storage","browse":"Browse","business_name":"Business name","business_profile":"Business profile","business_profile_desc":"Logo, Email, phone and social media","business_profile_info":"Business profile info","business_profile_pages_help1":"You can add your own business profile info,","business_profile_pages_help2":"","business_profile_pages_help3":"","cancel":"Cancel","category":"Category","change_image":"Change image","change_password":"Change password","check_all":"Check all","check_all_columns_exist_in_excel_file":"Check all columns exist like the template and serial_number is not empty","choose_image":"Choose image","choose_one":"Choose one","clear":"Clear","clear_all":"Clear all","clear_failed_mail":"Clear failed mail logs!","clear_logs":"Clear Logs","client":"Client","clients":"Clients","client_assigned_label":"Client assigned label","client_id":"Client ID","client_name":"Client Name","city":"City","close":"Close","comfortable_temperature":"Comfortable Temperature","common":"Common","common?":"Common?","confirm":"Confirm","connected":"connected","contacted_at":"Contacted at","contact_us":"Contact us","copy":"Copy","country":"Country","created_at":"Created AT","create_role":"Create Role","current_password":"Current Password","customer":"Customer","current_password_is_incorrect":"Current password is incorrect","country_was_found_in_db":"Country was found in the DataBase","country_was_not_found_in_db":"Country was not found in the DataBase","date":"Date","deactivate":"Deactivate","deactivated":"Deactivated","deactivate_email_template":"Email Template has beed deactivated successfully","deactive":"Deactive","delete":"Delete","deleted_successfully":"Deleted Successfully","demand_requests":"Demand Requests","description":"description","desc_of_general_settings":"View and update email settings","desc_of_email_template_settings":"View and manage existing email content for each notification","desc_of_email_settings":"You can change your outgoing email settings here","desc_of_faq_settings":"Manage answers to frequency asked questions","desc_of_gateway_settings":"Show all registered devices, manage configuration variables","desc_of_how_it_works_settings":"list of all how it works instructions in your business","desc_of_Introductions_settings":"Introduction Description","desc_of_introduction_settings":"Design, simply explain how your business works","desc_of_key_features_settings":"List of all your key features in your business","desc_of_legal_settings":"Manage your business legal page","desc_of_login_logs":"See all the recorded login attempts","desc_of_power_modules_settings":"Show all defined appliances, manage configuration variables","desc_of_providers_settings":"Show all defined electricity providers, manage configration variables","desc_of_roles_and_permissions_settings":"View and manage the roles and permissions for the uses","desc_of_users_settings":"View and manage your staff information","details":"Details","device":"Device","devices":"Devices","device_id":"Device ID","device_used":"Device does not deleted ... It belongs to Clients","disable":"Disable","disabled":"Disabled","download_the_template":"Download The Template","do_you_really_want_to_action_name":"Do you really want to :action :name ?","drag_and_drop":"Drag and Drop","edit":"Edit","edit_device_schedule":"Edit device schedule","edit_email_template":"Edit Email Template","edit_client":"Edit Client","edit_faq":"Edit FAQ","edit_gateway":"Edit Gateway","edit_introduction":"Edit Introduction","edit_power_module":"Edit Power Module","edit_provider":"Edit Provider","edit_role":"Edit Role","edit_user":"Edit User","electricity_provider":"Electricity Provider","electricity_providers":"Electricity Providers","email":"E-mail","email_from_name":"From Name","email_from_address":"Fom Address","email_encryption":"Encryption","email_mailer":"Mailer","email_settings":"Outgoing Email Settings","email_server_host":"Email Server Host","email_server_port":"Email Server Port","email_template":"Email Template","email_templates":"Email Templates","enable":"Enable","enabled":"Enabled","enabled?":"Enabled?","entries":"entries","error":" error","error_message":"Error Message","excel_file":"Excel File","export_all_fields_csv":"Export All Fields Csv","export_all_fields_xlsx":"Export All Fields Xlsx","export_current_fields_csv":"Export Current Fields Csv","export_current_fields_xlsx":"Export Current Fields Xlsx","facebook":"Facebook","failed_mail_logs":"Failed Mail Logs","faq":"FAQ","faq_page_address":"FAQ","first_name":"First Name","forgot_password":"Forgot Password?","from_date_to_date":"From Date To Date","gateway":"Gateway","gateways":"Gateways","gateways_import":"Gateways Import","gateway_details":"Gateway Details","gateway_detials":"Gateway detials","gateway_id":"Geteway ID","gateway_sn":"Gateway Serial Number","general":"General","gereral_settings":"Gereral Settings","grid_saving_problem":"Something went wrong while saving grid preferences, try to reset the grid","home":"Home","how_it_works":"How It Works","hardware":"Hardware","has_hardware?":"Has Hardware?","icon":"Icon","image":"Image","import":"Import","import_from_excel":"Import from Excel","index":"Index","instagram":"Instagram","introductions":"Introductions","invalid_gateway_serial_number":"Invalid gateway serial number","ip_address":"IP Address","key_feature":"Key Feature","key_features":"Key Features","languages":"Languages","last_name":"Last Name","last_modified":"Last Modified","latitude":"Latitude","legal":"Legal","legal_pages":"Legal Page","legal_pages_help1":"You can create your own legal pages,","legal_pages_help2":"Your saved policies will be linked in the mobile application.","legal_pages_help3":"","linkedin":"Linkedin","loading":"Loading","location":"Location","login_logs":"Login Logs","login_date":"Login Date","login_logs_id":"Login Logs ID","logo":"Logo","logout":"Logout","longitude":"longitude","mark_replied":"Mark Replied","mark_replied?":"Mark Replied?","message":"Message","messages":"Messages","message_details":"Message Details","message_id":"Message ID","must_be_a_valid_email_address":"Must be a valid email address.","name":"Name","name_is_action":":name is :action !","name_is_not_action":":name is not :action !","new_password":"New Password","new":"New","new_faq":"New FAQ","new_gateway":"New Gateway","new_introduction":"New Introduction","new_power_module":"New Power Module","no":"No","normal":"Normal","no_role":"No Role","not_active":"Not Active","not_allowed_to_delete_role_related_to_user":"Not allowed to delete role because its related to a user","notifications":"Notifications","not_replied":"Not Replied","not_replied_yet":"Not Replied Yet","note":"Note","no_data_to_display":"No Data To Display","no_hardware":"no hardware","no_matching_records_found":"No matching records found","no_notifications":"No Notifications","no_country_was_found":"No country was found","of":"Off","old_password":"Old Password","order":"Order","or_click_to_select_file":"Or Click to select File","password":"Password","password_hint":"Password must be 6 characters at least","password_reset":"Password reset","password_has_been_changed_successfully":"Your password has been changed successfully!","phone":"Phone","povider_used":"Provider does not deleted ... There are Clients or Demand Request belong to it","power_avg_value":"Power Avg Value (watt)","power_energy":"Power\/Energy","power_metrics":"Power Metrics","power_module":"Power Module","power_modules":"Power Modules","power_module_id":"Power Module ID","privacy_policy":"Privacy Policy","profile":"Profile","provider":"Elctricity Provider","providers":"Elctricity Providers","provider_name":"Provider Name","question":"Question","registered_at":"Registered At","remember_me":"Remember Me","renew":"Renew","renew_subscription":"Renew Subscription","reorder_list_hint":"Drag & Drop to reorder the list","replied":"Replied","replied?":"Replied At?","replied_at":"Replied At","reports":"Reports","reset":"Reset","reset_password":"Reset password","reset_search":"Reset Search","retry_new_password":"Retry Password","role":"Role","roles_and_permissions":"Roles & Permissions","role_name":"Role Name","row_column_value_error":"In row :row, column :column => :error","save":"Save","save_changes":"Save changes","search_for_client_email":"search for Client, Email","search_for_device":"Search for Device","search_for_login_log":"Search for login log","search_for_name_subject":"Search for Name, Subject","search_for_provider_name":"Search For Provider Name","search_for_serial_number":"Search for Serial Number","search_for_title":"Search for Title","search_for_user_name_email":"Search for User Name, Email","select_category":"Select Category","select_option":"Select Option","select_role":"Select Role","send":"Send","send_mqtt":"Send MQTT","sent":"Sent","sent_at":"Sent At","sent_rule":"Sent Rule","sent_successfully":"Sent Successfully","sent_test_email":"Send Test Email","serial_number":"Serial Number","settings":"Settings","set_as_common":"Set as Common","set_device_as":"Set :name as \":action\" ?","showing":"Showing","sign_in":"Sign In","solar":"Solar","solar_pv":"Solar PV","solar_system":"Solar System","subscription_date":"Subscription Date","staff":"Staff","status":"Status","subject":"Subject","submit":"Submit","subscribed":"subscribed","subscription_is_valid_till":"Subscription is valid till","success_mail_logs":"Success Mail Logs","summary":"Summary","sorted_successfully":"Sorted Successfully!","sorted_error":"order or id is wrong","saved_successfully":"Saved Successfully!","template":"Template","template_name":"Template Name","term_of_use":"Term Of Use","test_email":"Test Email","there_is_no_image":"There is no image","the_provided_credentials_do_not_match_our_records":"The provided credentials do not match our records","this_email_was_sent_to":"This Email Was Sent To","this_client_is_not_active":"This client is not active. Please contact an administrator if you believe this is an error","this_gateway_is_already_registered":"This gateway is already registered","time_schedule":"Time schedule","title":"Title","twitter":"Twitter","to":"To","to_client":"To Client","to_customer":"To Customer","to_staff":"To Staff","unban":"Unban","undefined_index":"Undefined Index","unverify":"Unverify","upload":"Upload","upload_avatar":"Upload Avatar","upload_svg_file":"Upload SVG File","user":"User","username":"Username","users":"Users","user_agent":"User Agent","user_profile":"User Profile","updated_successfully":"Updated Successfully!","verify":"Verify","verified?":"Verified?","verified":"verified","new_client_has_completed_the_registration_process":"New client has completed the registration process.","new_gateway_has_been_registrated":"New gateway has been registrated.","new_subscription_date":"New Subscription Date","not_verified":"not verified","no_location":"no location","not_connected":"not connected","not_subscribed":"not subscribed","view_all":"View All","whoops":"Whoops! Something went wrong.","yes":"Yes"},"en.locale":{"Home":"Home","Dashboard":"Dashboard","Clients":"Clients","Reports":"Reports"},"en.pagination":{"previous":"&laquo; Previous","next":"Next &raquo;"},"en.passwords":{"password":"Passwords must be at least eight characters and match the confirmation.","reset":"Your password has been reset!","sent":"We have e-mailed your password reset link!","token":"This password reset token is invalid.","user":"We can't find a user with that e-mail address."},"en.permissions":{"home":"home","clients":"Show Clients Page","clients_show_appliances":"Show Client Appliances","clients_export":"Export Clients","clients_update":"Update Client","clients_activate_deactivate":"Activate\/Deactivate Client","clients_ban_unban":"Ban\/Unban Client","clients_reset_password":"Reset Client Password","messages":"Show Messages Page","messages_export":"Export Mesages","messages_mark_as_replied":"Mark Message As Replied","user_profile":"Show User Profile Page","user_profile_update":"Edit User Profile","user_profile_change_password":"Change User Password","settings":"Show Settings Page","settings_faq":"Show FAQ Page","settings_faq_create":"settings_faq_create","settings_faq_store":"Create New FAQ","settings_faq_edit":"settings_faq_edit","settings_faq_sort":"Sort FAQ","settings_faq_update":"Edit FAQ","settings_faq_destroy":"Delete FAQ","settings_legal":"Show Legal Page","settings_legal_store":"Create New Legal","settings_business_profiles":"Show Business Profile Page","settings_business_profiles_store":"Create New Business Profile","settings_gateways":"Show Gateways Page","settings_gateways_show":"Show Gateway Details","settings_gateways_export":"Export Gateways","settings_gateways_import":"Import Gateways","settings_gateways_download_template":"Download Gateways Template For Import","settings_gateways_store":"Create New Gateway","settings_gateways_update":"Edit Gateway","settings_gateways_activate_deactivate":"Activate\/Deactivate Gateway","settings_introductions":"Show Introductions Page","settings_introductions_create":"settings_introductions_create","settings_introductions_store":"Create New Introduction","settings_introductions_edit":"settings_introductions_edit","settings_introductions_sort":"Sort Introductions","settings_introductions_update":"Edit Introduction","settings_introductions_destroy":"Delete Introduction","settings_howitworks":"Show How It Works Page","settings_howitworks_create":"settings_howitworks_create","settings_howitworks_store":"Create New How It Works","settings_howitworks_edit":"settings_howitworks_edit","settings_howitworks_sort":"Sort How It Works","settings_howitworks_update":"Edit How It Works","settings_howitworks_destroy":"Delete How It Works","settings_keyfeatures":"Show Key Features Page","settings_keyfeatures_create":"settings_keyfeatures_create","settings_keyfeatures_store":"Create New Key Feature","settings_keyfeatures_edit":"settings_keyfeatures_edit","settings_keyfeatures_sort":"Sort Key Features","settings_keyfeatures_update":"Edit Key Feature","settings_keyfeatures_destroy":"Delete Key Feature","settings_devices":"Show Devices Page","settings_devices_store":"Create New Device","settings_devices_export":"Export Devices","settings_devices_update":"Edit Device","settings_devices_update_schedule":"Edit Device Schedule","settings_devices_enable_disable":"Enable\/Disable Device","settings_devices_common_normal":"Common\/Normal Device","settings_devices_destroy":"Delete Device","settings_users":"Show Users Page","settings_users_store":"Create New User","settings_users_update":"Edit User","settings_users_activate_deactivate":"Activate\/Deactivate User","settings_users_reset_password":"Reset User Password","settings_roles":"Show Roles Page","settings_roles_create":"settings_roles_create","settings_roles_store":"Create New Role","settings_roles_edit":"settings_roles_edit","settings_roles_update":"Edit Role","settings_roles_destroy":"Delete Role","settings_email_templates":"Show Email Templates Page","settings_email_templates_create":"settings_email_templates_create","settings_email_templates_store":"Create New Email Template","settings_email_templates_edit":"settings_email_templates_edit","settings_email_templates_load_mail_logs":"Show Email Template Mail Logs","settings_email_templates_clear_failed_mail_logs":"Cleare Email Tempalte Mail Logs","settings_email_templates_activate_deactivate":"Activate\/Deactivate Email Template","settings_email_templates_update":"Edit Email Template","settings_email_templates_send_test_mail":"Send Test Mail From Email Temaplte","settings_providers":"Show Providers Page","settings_providers_store":"Create New Provider","settings_providers_edit":"settings_providers_edit","settings_providers_update":"Edit Provider","settings_providers_destroy":"Delete Provider","settings_providers_verify_unverify":"Verify\/Unverify Provider","reports":"Show Reports Page","settings_general":"Show General Page","settings_general_email_settings":"Show Email Settings Page","settings_general_email_settings_store":"Edit Email Settings","reports_login_logs":"Show Login Logs","reports_login_logs_export":"Export Login Logs","clients_gateway_details":"clients_gateway_details","clients_renew_subscription":"clients_renew_subscription","settings_gateways_details":"settings_gateways_details"},"en.validation":{"accepted":"The :attribute must be accepted.","active_url":"The :attribute is not a valid URL.","after":"The :attribute must be a date after :date.","after_or_equal":"The :attribute must be a date after or equal to :date.","alpha":"The :attribute may only contain letters.","alpha_dash":"The :attribute may only contain letters, numbers, dashes and underscores.","alpha_num":"The :attribute may only contain letters and numbers.","array":"The :attribute must be an array.","before":"The :attribute must be a date before :date.","before_or_equal":"The :attribute must be a date before or equal to :date.","between":{"numeric":"The :attribute must be between :min and :max.","file":"The :attribute must be between :min and :max kilobytes.","string":"The :attribute must be between :min and :max characters.","array":"The :attribute must have between :min and :max items."},"boolean":"The :attribute field must be true or false.","confirmed":"The :attribute confirmation does not match.","date":"The :attribute is not a valid date.","date_equals":"The :attribute must be a date equal to :date.","date_format":"The :attribute does not match the format :format.","different":"The :attribute and :other must be different.","digits":"The :attribute must be :digits digits.","digits_between":"The :attribute must be between :min and :max digits.","dimensions":"The :attribute has invalid image dimensions.","distinct":"The :attribute field has a duplicate value.","email":"The :attribute must be a valid email address.","ends_with":"The :attribute must end with one of the following: :values","exists":"The selected :attribute is invalid.","file":"The :attribute must be a file.","filled":"The :attribute field must have a value.","gt":{"numeric":"The :attribute must be greater than :value.","file":"The :attribute must be greater than :value kilobytes.","string":"The :attribute must be greater than :value characters.","array":"The :attribute must have more than :value items."},"gte":{"numeric":"The :attribute must be greater than or equal :value.","file":"The :attribute must be greater than or equal :value kilobytes.","string":"The :attribute must be greater than or equal :value characters.","array":"The :attribute must have :value items or more."},"image":"The :attribute must be an image.","in":"The selected :attribute is invalid.","in_array":"The :attribute field does not exist in :other.","integer":"The :attribute must be an integer.","ip":"The :attribute must be a valid IP address.","ipv4":"The :attribute must be a valid IPv4 address.","ipv6":"The :attribute must be a valid IPv6 address.","json":"The :attribute must be a valid JSON string.","lt":{"numeric":"The :attribute must be less than :value.","file":"The :attribute must be less than :value kilobytes.","string":"The :attribute must be less than :value characters.","array":"The :attribute must have less than :value items."},"lte":{"numeric":"The :attribute must be less than or equal :value.","file":"The :attribute must be less than or equal :value kilobytes.","string":"The :attribute must be less than or equal :value characters.","array":"The :attribute must not have more than :value items."},"max":{"numeric":"The :attribute may not be greater than :max.","file":"The :attribute may not be greater than :max kilobytes.","string":"The :attribute may not be greater than :max characters.","array":"The :attribute may not have more than :max items."},"mimes":"The :attribute must be a file of type: :values.","mimetypes":"The :attribute must be a file of type: :values.","min":{"numeric":"The :attribute must be at least :min.","file":"The :attribute must be at least :min kilobytes.","string":"The :attribute must be at least :min characters.","array":"The :attribute must have at least :min items."},"not_in":"The selected :attribute is invalid.","not_regex":"The :attribute format is invalid.","numeric":"The :attribute must be a number.","present":"The :attribute field must be present.","regex":"The :attribute format is invalid.","required":"The :attribute field is required.","required_if":"The :attribute field is required when :other is :value.","required_unless":"The :attribute field is required unless :other is in :values.","required_with":"The :attribute field is required when :values is present.","required_with_all":"The :attribute field is required when :values are present.","required_without":"The :attribute field is required when :values is not present.","required_without_all":"The :attribute field is required when none of :values are present.","same":"The :attribute and :other must match.","size":{"numeric":"The :attribute must be :size.","file":"The :attribute must be :size kilobytes.","string":"The :attribute must be :size characters.","array":"The :attribute must contain :size items."},"starts_with":"The :attribute must start with one of the following: :values","string":"The :attribute must be a string.","timezone":"The :attribute must be a valid zone.","unique":"The :attribute has already been taken.","uploaded":"The :attribute failed to upload.","url":"The :attribute format is invalid.","uuid":"The :attribute must be a valid UUID.","custom":{"attribute-name":{"rule-name":"custom-message"}},"attributes":{"email":"Email Address","en":{"name":"Name (En)","title":"Title (En)","question":"Question (EN)","subject":"Subject (En)"},"es":{"name":"Name (ES)","title":"Title (ES)","question":"Question (ES)","subject":"Subject (ES)"}}}});
        })();