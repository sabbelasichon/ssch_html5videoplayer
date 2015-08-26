<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$TCA['tx_sschhtml5videoplayer_domain_model_subtitle'] = array(
    'ctrl' => $TCA['tx_sschhtml5videoplayer_domain_model_subtitle']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, track, static_lang_isocode, selected',
    ),
    'types' => array(
        '1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, track, static_lang_isocode, selected,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
    ),
    'palettes' => array(
        '1' => array('showitem' => ''),
    ),
    'columns' => array(
        'sys_language_uid' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
                ),
            ),
        ),
        'l10n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table' => 'tx_sschhtml5videoplayer_domain_model_subtitle',
                'foreign_table_where' => 'AND tx_sschhtml5videoplayer_domain_model_subtitle.pid=###CURRENT_PID### AND tx_sschhtml5videoplayer_domain_model_subtitle.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),
        't3ver_label' => array(
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            )
        ),
        'hidden' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => array(
                'type' => 'check',
            ),
        ),
        'starttime' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => array(
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => array(
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ),
            ),
        ),
        'endtime' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => array(
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => array(
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ),
            ),
        ),
        'track' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_subtitle.track',
            'config' => array(
                'type' => 'input',
                'size' => 255,
                'eval' => 'trim',
                'wizards' => array(
                    '_PADDING' => 2,
                    'link' => array(
                        'type' => 'popup',
                        'title' => 'Link',
                        'icon' => 'link_popup.gif',
                        'script' => 'browse_links.php?mode=wizard',
                        'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
                    )
                )
            ),
        ),
        'static_lang_isocode' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_tca.php:sys_language.isocode',
            'displayCond' => 'EXT:static_info_tables:LOADED:true',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table' => 'static_languages',
                'foreign_table_where' => 'AND static_languages.pid=0 ORDER BY static_languages.lg_name_en',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
            )
        ),
        'selected' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_subtitle.selected',
            'config' => array(
                'type' => 'check',
            ),
        ),
    ),
);