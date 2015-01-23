#
# Table structure for table 'tx_sschhtml5videoplayer_domain_model_video'
#
CREATE TABLE tx_sschhtml5videoplayer_domain_model_video (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	
        sorting int(11) DEFAULT '0' NOT NULL,
        static_lang_isocode int(11) DEFAULT '0' NOT NULL,
        subtitles int(11) DEFAULT '0' NOT NULL,
	single_pid int(11) unsigned DEFAULT '0' NOT NULL,
	title varchar(255) DEFAULT '' NOT NULL,        
        short_title varchar(255) DEFAULT '' NOT NULL,        
        caption varchar(255) DEFAULT '' NOT NULL,
        copyright varchar(255) DEFAULT '' NOT NULL,
	poster_image varchar(255) DEFAULT '' NOT NULL,
	mp4_source varchar(255) DEFAULT '' NOT NULL,
	web_m_source varchar(255) DEFAULT '' NOT NULL,
	ogg_source varchar(255) DEFAULT '' NOT NULL,
        description text NOT NULL,        
	flash_source varchar(255) DEFAULT '' NOT NULL,
        external_source varchar(255) DEFAULT '' NOT NULL,
        external_type varchar(255) DEFAULT '' NOT NULL,
	height int(11) DEFAULT '0' NOT NULL,
	width int(11) DEFAULT '0' NOT NULL,
        duration varchar(8) DEFAULT '' NOT NULL,
        downloads int(11) unsigned DEFAULT '0' NOT NULL,
        images int(11) unsigned DEFAULT '0' NOT NULL,
        related int(11) unsigned DEFAULT '0' NOT NULL,
        versions int(11) unsigned DEFAULT '0' NOT NULL,
        alt varchar(255) DEFAULT '' NOT NULL,
        longdesc tinytext,
	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

        parenttable tinytext NOT NULL,
  	parentid tinytext NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,
	t3_origuid int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)
);

#
# Table structure for table 'tx_sschhtml5videoplayer_domain_model_subtitle'
#
CREATE TABLE tx_sschhtml5videoplayer_domain_model_subtitle (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

        sorting int(11) DEFAULT '0' NOT NULL,
	track varchar(255) DEFAULT '' NOT NULL,
        static_lang_isocode int(11) DEFAULT '0' NOT NULL,
        selected tinyint(4) unsigned DEFAULT '0' NOT NULL,
	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,
	t3_origuid int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

        parenttable tinytext NOT NULL,
  	parentid tinytext NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)
);

#
# Table structure for table 'tx_sschhtml5videoplayer_domain_model_audio'
#
CREATE TABLE tx_sschhtml5videoplayer_domain_model_audio (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

        title varchar(255) DEFAULT '' NOT NULL,
	audio_source varchar(255) DEFAULT '' NOT NULL,

        tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,
        description text NOT NULL,
	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,
	t3_origuid int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)
);

#
# Table structure for table 'tx_sschhtml5videoplayer_video_video_mm'
# 
#
CREATE TABLE tx_sschhtml5videoplayer_video_video_mm (
        uid_local int(11) DEFAULT '0' NOT NULL,
        uid_foreign int(11) DEFAULT '0' NOT NULL,
        tablenames varchar(30) DEFAULT '' NOT NULL,
        sorting int(11) DEFAULT '0' NOT NULL,

        KEY uid_local (uid_local),
        KEY uid_foreign (uid_foreign)
);