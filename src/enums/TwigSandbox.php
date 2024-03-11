<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Send custom Twig messages when Craft events are triggered.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\enums;

/**
 * TwigSandbox enum
 * @since 1.0.0
 */
abstract class TwigSandbox
{

    /**
     * Default permitted tags.
     */
    public const DEFAULT_TAGS = [
        /**
         * TWIG TAGS
         */
        'apply',
        // 'autoescape',
        'block',
        // 'deprecated',
        // 'do',
        'embed',
        'extends',
        // 'flush',
        'for',
        'from',
        'if',
        'import',
        'include',
        'macro',
        // 'sandbox',
        'set',
        // 'use',
        'verbatim',
        'with',
        /**
         * CRAFT TAGS
         */
        'cache',
        // 'css',
        // 'dd',
        // 'dump',
        // 'exit',
        // 'header',
        // 'hook',
        // 'html',
        // 'js',
        'namespace',
        'nav',
        // 'paginate',
        // 'redirect',
        // 'requireAdmin',
        // 'requireEdition',
        // 'requireGuest',
        // 'requireLogin',
        // 'requirePermission',
        // 'script',
        'switch',
        'tag',
        /**
         * NOTIFIER TAGS
         */
        'skipMessage',
    ];

    /**
     * Default permitted filters.
     */
    public const DEFAULT_FILTERS = [
        /**
         * TWIG FILTERS
         */
        'abs',
        'batch',
        'capitalize',
        'column',
        // 'convert_encoding',
        'country_name',
        'currency_name',
        'currency_symbol',
        // 'data_uri',
        'date',
        'date_modify',
        'default',
        // 'escape',
        'first',
        'format',
        'format_currency',
        'format_date',
        'format_datetime',
        'format_number',
        'format_time',
        // 'html_to_markdown',
        // 'inky_to_html',
        // 'inline_css',
        'join',
        'json_encode',
        'keys',
        'language_name',
        'last',
        'locale_name',
        'lower',
        // 'map',
        // 'markdown_to_html',
        'nl2br',
        'number_format',
        'raw',
        'reduce',
        'replace',
        'reverse',
        'round',
        'slice',
        'slug',
        'sort',
        'spaceless',
        'split',
        'striptags',
        'timezone_name',
        'title',
        'trim',
        // 'u',
        'upper',
        // 'url_encode',
        /**
         * CRAFT FILTERS
         */
        'address',
        'append',
        'ascii',
        'atom',
        'attr',
        // 'base64_decode',
        // 'base64_encode',
        'boolean',
        'camel',
        'column',
        'contains',
        'currency',
        'date',
        'datetime',
        'diff',
        'duration',
        // 'encenc',
        'explodeClass',
        'explodeStyle',
        'filesize',
        'filter',
        'float',
        'group',
        'hash',
        'httpdate',
        'id',
        'index',
        'indexOf',
        'integer',
        'intersect',
        'json_encode',
        'json_decode',
        'kebab',
        'lcfirst',
        'length',
        // 'literal',
        // 'markdown',
        // 'md',
        'merge',
        'money',
        'multisort',
        'namespace',
        'namespaceAttributes',
        'namespaceInputId',
        'namespaceInputName',
        'ns',
        'number',
        'parseAttr',
        'parseRefs',
        'pascal',
        'percentage',
        'prepend',
        'purify',
        'push',
        'removeClass',
        'replace',
        'rss',
        'snake',
        'string',
        't',
        'time',
        'timestamp',
        'translate',
        'truncate',
        'ucfirst',
        'unique',
        'unshift',
        'ucwords',
        'values',
        'where',
        'widont',
        'without',
        'withoutKey',
    ];

    /**
     * Default permitted functions.
     */
    public const DEFAULT_FUNCTIONS = [
        /**
         * TWIG FUNCTIONS
         */
        'attribute',
        'block',
        // 'constant',
        'country_names',
        'country_timezones',
        'currency_names',
        'cycle',
        'date',
        // 'dump',
        'html_classes',
        'language_names',
        'locale_names',
        'parent',
        'random',
        'range',
        // 'script_names',
        // 'source',
        // 'template_from_string',
        'timezone_names',
        /**
         * CRAFT FUNCTIONS
         */
        // 'actionInput',
        // 'actionUrl',
        // 'alias',
        'attr',
        // 'beginBody',
        'block',
        'canCreateDrafts',
        'canDelete',
        'canDeleteForSite',
        'canDuplicate',
        'canSave',
        'canView',
        'ceil',
        // 'className',
        'clone',
        'collect',
        'combine',
        // 'configure',
        // 'constant',
        'cpUrl',
        // 'create',
        // 'csrfInput',
        // 'dataUrl',
        'date',
        // 'dump',
        // 'endBody',
        // 'expression',
        // 'failMessageInput',
        'floor',
        // 'getenv',
        // 'gql',
        // 'head',
        // 'hiddenInput',
        'include',
        'input',
        'max',
        'min',
        'ol',
        // 'parseBooleanEnv',
        // 'parseEnv',
        // 'plugin',
        'raw',
        // 'redirectInput',
        // 'renderObjectTemplate',
        'seq',
        'shuffle',
        'siteUrl',
        // 'source',
        // 'successMessageInput',
        // 'svg',
        'tag',
        'ul',
        'url',
    ];

    /**
     * Default permitted methods.
     */
    public const DEFAULT_METHODS = [];

    /**
     * Default permitted properties.
     */
    public const DEFAULT_PROPERTIES = [];

}
