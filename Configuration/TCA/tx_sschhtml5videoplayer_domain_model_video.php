<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sschhtml5videoplayer_domain_model_video');

$imagesTca = [
    'exclude' => 1,
    'label' => 'Bilder',
    'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
        'images',
        ['maxitems' => 1],
        $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
    ),
];
$downloadsTca = [
    'exclude' => 1,
    'label' => 'Downloads',
    'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
        'downloads',
        ['maxitems' => 10]
    ),
];

return [
    'ctrl' => [
        'title' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video',
        'label' => 'title',
        'label_userFunc' => 'EXT:ssch_html5videoplayer/Classes/UserFuncs/Labels.php:Ssch\\SschHtml5videoplayer\\UserFuncs\\Labels->getLabel',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => 2,
        'versioning_followPages' => true,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'sortby' => 'sorting',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'iconfile' => 'EXT:ssch_html5videoplayer/Resources/Public/Icons/tx_sschhtml5videoplayer_domain_model_video.gif',
        'searchFields' => 'title,short_title,caption,alt,longdesc',
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, single_pid, caption, duration, poster_image, videos, external_source, external_type, copyright, height, width, subtitles, downloads, images, static_lang_isocode',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, static_lang_isocode, title, short_title, caption, copyright, duration, single_pid, description;;;richtext:rte_transform[mode=ts_css], poster_image, videos, external_source, width, height, downloads, images, --div--;LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video.subtitles,subtitles, --div--;LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video.versions,versions, --div--;LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video.related,related, --div--;LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_audio.categories, categories,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    ['LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1],
                    ['LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0],
                ],
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_sschhtml5videoplayer_domain_model_video',
                'foreign_table_where' => 'AND tx_sschhtml5videoplayer_domain_model_video.pid=###CURRENT_PID### AND tx_sschhtml5videoplayer_domain_model_video.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'starttime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y')),
                ],
            ],
        ],
        'endtime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y')),
                ],
            ],
        ],
        'title' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required',
            ],
        ],
        'short_title' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video.short_title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'copyright' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video.copyright',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'static_lang_isocode' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_tca.xlf:sys_language.isocode',
            'displayCond' => 'USER:Ssch\\SschHtml5videoplayer\\UserFuncs\\ExtensionLoadedConditionMatcher->isExtensionLoaded:static_info_tables',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'static_languages',
                'foreign_table_where' => 'AND static_languages.pid=0 ORDER BY static_languages.lg_name_en',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'caption' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video.caption',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'duration' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video.duration',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'description' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'softref' => 'rtehtmlarea_images,typolink_tag,images,email[subst],url',
                'wizards' => [
                    '_PADDING' => 2,
                    'RTE' => [
                        'notNewRecords' => 1,
                        'RTEonly' => 1,
                        'type' => 'script',
                        'title' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext.W.RTE',
                        'icon' => 'actions-wizard-rte',
                        'module' => [
                            'name' => 'wizard_rte'
                        ],
                    ],
                ],
            ],
        ],
        'alt' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video.alt',
            'config' => [
                'type' => 'input',
                'size' => 255,
                'eval' => 'trim,required',
            ],
        ],
        'longdesc' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video.longdesc',
            'config' => [
                'type' => 'input',
                'size' => '15',
                'max' => '255',
                'checkbox' => '',
                'eval' => 'trim',
                'wizards' => [
                    '_PADDING' => 2,
                    'link' => [
                        'type' => 'popup',
                        'title' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link_formlabel',
                        'icon' => 'actions-wizard-link',
                        'module' => [
                            'name' => 'wizard_link',
                        ],
                        'JSopenParams' => 'height=600,width=800,status=0,menubar=0,scrollbars=1'
                    ],
                ],
                'softref' => 'typolink'
            ],
        ],
        'poster_image' => [
            'exclude' => 0,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video.poster_image',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'poster_image',
                ['maxitems' => 1],
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
        ],
        'videos' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video.videos',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'videos',
                ['maxitems' => 45],
                'mp4,ogg,ogv,webm'
            ),
        ],
        'external_type' => [
            'exclude' => 0,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video.external_type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', ''],
                    [
                        'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video.external_type.I',
                        'video/youtube',
                    ],
                    [
                        'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video.external_type.II',
                        'video/vimeo',
                    ],
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => '',
            ],
        ],
        'external_source' => [
            'exclude' => 0,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video.external_source',
            'config' => [
                'type' => 'input',
                'size' => 255,
                'eval' => 'trim',
                'wizards' => [
                    '_PADDING' => 2,
                    'link' => [
                        'type' => 'popup',
                        'title' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link_formlabel',
                        'icon' => 'actions-wizard-link',
                        'module' => [
                            'name' => 'wizard_link',
                        ],
                        'JSopenParams' => 'height=600,width=800,status=0,menubar=0,scrollbars=1'
                    ],
                ],
                'softref' => 'typolink'
            ],
        ],
        'height' => [
            'exclude' => 0,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video.height',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int',
            ],
        ],
        'width' => [
            'exclude' => 0,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video.width',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int',
            ],
        ],
        'subtitles' => [
            'exclude' => 0,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video.subtitles',
            'config' => [
                'type' => 'inline',
                'languageMode' => 'inherit',
                'foreign_table' => 'tx_sschhtml5videoplayer_domain_model_subtitle',
                'foreign_field' => 'parentid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'parenttable',
                'maxitems' => 100,
                'behaviour' => [
                    'localizationMode' => 'select',
                    'localizeChildrenAtParentLocalization' => 1,
                ],
                'appearance' => [
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1,
                    'showSynchronizationLink' => 1,
                ],
            ],
        ],
        'versions' => [
            'exclude' => 0,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video.versions',
            'config' => [
                'type' => 'inline',
                'languageMode' => 'inherit',
                'foreign_table' => 'tx_sschhtml5videoplayer_domain_model_video',
                'foreign_field' => 'parentid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'parenttable',
                'maxitems' => 100,
                'behaviour' => [
                    'localizationMode' => 'select',
                    'localizeChildrenAtParentLocalization' => 1,
                ],
                'appearance' => [
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1,
                    'showSynchronizationLink' => 1,
                ],
            ],
        ],
        'parentid' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'parenttable' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'related' => [
            'exclude' => 0,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video.related',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_sschhtml5videoplayer_domain_model_video',
                'foreign_table_where' => ' ORDER BY tx_sschhtml5videoplayer_domain_model_video.title ASC',
                'size' => 5,
                'autoSizeMax' => 25,
                'minitems' => 0,
                'maxitems' => 50,
                'MM' => 'tx_sschhtml5videoplayer_video_video_mm',
            ],
        ],
        'single_pid' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video.single_pid',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'pages',
                'size' => '1',
                'maxitems' => '1',
                'minitems' => '0',
                'show_thumbs' => '1',
                'wizards' => [
                    'suggest' => [
                        'type' => 'suggest',
                    ],
                ],
            ],
        ],
        'categories' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_audio.categories',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectTree',
                'renderMode' => 'tree',
                'treeConfig' => [
                    'parentField' => 'parent',
                    'appearance' => [
                        'showHeader' => true,
                        'allowRecursiveMode' => true,
                        'expandAll' => true,
                        'maxLevels' => 99,
                    ],
                ],
                'MM' => 'sys_category_record_mm',
                'MM_match_fields' => [
                    'fieldname' => 'categories',
                    'tablenames' => 'tx_sschhtml5videoplayer_domain_model_video',
                ],
                'MM_opposite_field' => 'items',
                'foreign_table' => 'sys_category',
                'foreign_table_where' => ' AND (sys_category.sys_language_uid = 0 OR sys_category.l10n_parent = 0) ORDER BY sys_category.sorting',
                'size' => 10,
                'autoSizeMax' => 20,
                'minitems' => 0,
                'maxitems' => 20,
            ],
        ],
        'downloads' => $downloadsTca,
        'images' => $imagesTca,
    ],
];
