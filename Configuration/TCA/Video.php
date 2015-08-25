<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}
$imagesTca = array(
    'exclude' => 1,
    'label' => 'Bilder',
    'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('images', array('maxitems' => 1), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
    ),
);
$downloadsTca = array(
    'exclude' => 1,
    'label' => 'Downloads',
    'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('downloads', array('maxitems' => 10)
    ),
);

$TCA['tx_sschhtml5videoplayer_domain_model_video'] = array(
    'ctrl' => $TCA['tx_sschhtml5videoplayer_domain_model_video']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, single_pid, caption, duration, poster_image, mp4_source, web_m_source, ogg_source, external_source, copyright, height, width, subtitles, downloads, images, static_lang_isocode',
    ),
    'types' => array(
        '1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, static_lang_isocode, title, short_title, caption, copyright, duration, single_pid, description;;;richtext[paste|bold|italic|underline|formatblock|class|left|center|right|orderedlist|unorderedlist|outdent|indent|link|image]:rte_transform[mode=ts], poster_image, mp4_source, web_m_source, ogg_source, external_source, width, height, downloads, images, --div--;LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xml:tx_sschhtml5videoplayer_domain_model_video.subtitles,subtitles, --div--;LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xml:tx_sschhtml5videoplayer_domain_model_video.versions,versions, --div--;LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xml:tx_sschhtml5videoplayer_domain_model_video.related,related,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
    ),
    'palettes' => array(
        '1' => array('showitem' => ''),
    ),
    'columns' => array(
        'sys_language_uid' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
                ),
            ),
        ),
        'l10n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table' => 'tx_sschhtml5videoplayer_domain_model_video',
                'foreign_table_where' => 'AND tx_sschhtml5videoplayer_domain_model_video.pid=###CURRENT_PID### AND tx_sschhtml5videoplayer_domain_model_video.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),
        't3ver_label' => array(
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            )
        ),
        'hidden' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config' => array(
                'type' => 'check',
            ),
        ),
        'starttime' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
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
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
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
        'title' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xml:tx_sschhtml5videoplayer_domain_model_video.title',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'short_title' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xml:tx_sschhtml5videoplayer_domain_model_video.short_title',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'copyright' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xml:tx_sschhtml5videoplayer_domain_model_video.copyright',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
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
        'caption' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xml:tx_sschhtml5videoplayer_domain_model_video.caption',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'duration' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xml:tx_sschhtml5videoplayer_domain_model_video.duration',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'description' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xml:tx_sschhtml5videoplayer_domain_model_video.description',
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
        'alt' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xml:tx_sschhtml5videoplayer_domain_model_video.alt',
            'config' => array(
                'type' => 'input',
                'size' => 255,
                'eval' => 'trim,required'
            ),
        ),
        'longdesc' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xml:tx_sschhtml5videoplayer_domain_model_video.longdesc',
            'config' => array(
                'type' => 'input',
                'size' => '15',
                'max' => '255',
                'checkbox' => '',
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
            )
        ),
        'poster_image' => array(
            'exclude' => 0,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xml:tx_sschhtml5videoplayer_domain_model_video.poster_image',
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
        'mp4_source' => array(
            'exclude' => 0,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xml:tx_sschhtml5videoplayer_domain_model_video.mp4_source',
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
        'web_m_source' => array(
            'exclude' => 0,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xml:tx_sschhtml5videoplayer_domain_model_video.web_m_source',
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
        'ogg_source' => array(
            'exclude' => 0,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xml:tx_sschhtml5videoplayer_domain_model_video.ogg_source',
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
        'flash_source' => array(
            'exclude' => 0,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xml:tx_sschhtml5videoplayer_domain_model_video.flash_source',
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
        'external_source' => array(
            'exclude' => 0,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xml:tx_sschhtml5videoplayer_domain_model_video.external_source',
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
        'height' => array(
            'exclude' => 0,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xml:tx_sschhtml5videoplayer_domain_model_video.height',
            'config' => array(
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ),
        ),
        'width' => array(
            'exclude' => 0,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xml:tx_sschhtml5videoplayer_domain_model_video.width',
            'config' => array(
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ),
        ),
        'subtitles' => array(
            'exclude' => 0,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xml:tx_sschhtml5videoplayer_domain_model_video.subtitles',
            'config' => Array(
                'type' => 'inline',
                'languageMode' => 'inherit',
                'foreign_table' => 'tx_sschhtml5videoplayer_domain_model_subtitle',
                'foreign_field' => 'parentid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'parenttable',
                'maxitems' => 100,
                "behaviour" => Array(
                    "localizationMode" => "select",
                    "localizeChildrenAtParentLocalization" => 1,
                ),
                "appearance" => array(
                    "showPossibleLocalizationRecords" => 1,
                    "showAllLocalizationLink" => 1,
                    "showSynchronizationLink" => 1,
                ),
            )
        ),
        'versions' => array(
            'exclude' => 0,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xml:tx_sschhtml5videoplayer_domain_model_video.versions',
            'config' => Array(
                'type' => 'inline',
                'languageMode' => 'inherit',
                'foreign_table' => 'tx_sschhtml5videoplayer_domain_model_video',
                'foreign_field' => 'parentid',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'parenttable',
                'maxitems' => 100,
                "behaviour" => Array(
                    "localizationMode" => "select",
                    "localizeChildrenAtParentLocalization" => 1,
                ),
                "appearance" => array(
                    "showPossibleLocalizationRecords" => 1,
                    "showAllLocalizationLink" => 1,
                    "showSynchronizationLink" => 1,
                ),
            )
        ),
        'parentid' => Array(
            'config' => Array(
                'type' => 'passthrough',
            ),
        ),
        'parenttable' => Array(
            'config' => Array(
                'type' => 'passthrough',
            ),
        ),
        'related' => array(
            'exclude' => 0,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xml:tx_sschhtml5videoplayer_domain_model_video.related',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_sschhtml5videoplayer_domain_model_video',
                'foreign_table_where' => ' ORDER BY tx_sschhtml5videoplayer_domain_model_video.title ASC',
                'size' => 5,
                'autoSizeMax' => 25,
                'minitems' => 0,
                'maxitems' => 50,
                'MM' => 'tx_sschhtml5videoplayer_video_video_mm',
            )
        ),
        'single_pid' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xml:tx_sschhtml5videoplayer_domain_model_video.single_pid',
            'config' => array(
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'pages',
                'size' => '1',
                'maxitems' => '1',
                'minitems' => '0',
                'show_thumbs' => '1',
                'wizards' => array(
                    'suggest' => array(
                        'type' => 'suggest',
                    ),
                ),
            )
        ),
        'downloads' => $downloadsTca,
        'images' => $imagesTca
    ),
);