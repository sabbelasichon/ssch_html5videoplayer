<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$TCA['tx_sschhtml5videoplayer_domain_model_audio'] = array(
    'ctrl' => $TCA['tx_sschhtml5videoplayer_domain_model_audio']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, audio_source, image',
    ),
    'types' => array(
        '1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, image, description;;;richtext[paste|bold|italic|underline|formatblock|class|left|center|right|orderedlist|unorderedlist|outdent|indent|link|image]:rte_transform[mode=ts], audio_source, --div--;LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_audio.categories, categories, --div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
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
                    array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0),
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
                'foreign_table' => 'tx_sschhtml5videoplayer_domain_model_audio',
                'foreign_table_where' => 'AND tx_sschhtml5videoplayer_domain_model_audio.pid=###CURRENT_PID### AND tx_sschhtml5videoplayer_domain_model_audio.sys_language_uid IN (-1,0)',
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
            ),
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
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y')),
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
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y')),
                ),
            ),
        ),
        'title' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_audio.title',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required',
            ),
        ),
        'description' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video.description',
            'config' => array(
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'wizards' => array(
                    '_PADDING' => 2,
                    'RTE' => array(
                        'notNewRecords' => 1,
                        'RTEonly' => 1,
                        'type' => 'script',
                        'title' => 'Full screen Rich Text Editing|Formatteret redigering i hele vinduet',
                        'icon' => 'wizard_rte2.gif',
                        'script' => 'wizard_rte.php',
                    ),
                ),
            ),
        ),
        'audio_source' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_audio.audio_source',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                '$(field_name)', array('maxitems' => 1), 'mp3'
            ),
        ),
        'image' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_audio.image',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'image', array('maxitems' => 1), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
        ),
        'categories' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_audio.categories',
            'config' => array(
                'type' => 'select',
                'renderMode' => 'tree',
                'treeConfig' => array(
                    'parentField' => 'parent',
                    'appearance' => array(
                        'showHeader' => true,
                        'allowRecursiveMode' => true,
                        'expandAll' => true,
                        'maxLevels' => 99,
                    ),
                ),
                'MM' => 'sys_category_record_mm',
                'MM_match_fields' => array(
                    'fieldname' => 'categories',
                    'tablenames' => 'tx_sschhtml5videoplayer_domain_model_audio',
                ),
                'MM_opposite_field' => 'items',
                'foreign_table' => 'sys_category',
                'foreign_table_where' => ' AND (sys_category.sys_language_uid = 0 OR sys_category.l10n_parent = 0) ORDER BY sys_category.sorting',
                'size' => 10,
                'autoSizeMax' => 20,
                'minitems' => 0,
                'maxitems' => 20,
            ),
        ),
    ),
);
