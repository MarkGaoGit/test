<?php
/**
 *      [Powerlong] Copyright © 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */
class template_control extends init_control
{
	public function _initialize() {
		parent::_initialize();
		$this->model = $this->load->service('admin/template');
	}

	public function index() {
		$tpls = $this->model->fetch_all();
		$this->load->librarys('View')->assign('tpls',$tpls);
		$this->load->librarys('View')->display('template');
	}

	public function setdefault() {
		$theme = trim($_GET['theme']);
		if(empty($theme)) {
			showmessage(lang('admin/theme_empty'));
		}
		$tpls = $this->model->fetch_all();
		if(!$tpls[$theme]) {
			showmessage(lang('admin/theme_no_exist'));
		}
		$this->config = new Config;
		$this->config->file('template')->note('模板配置配置文件')->space(32)->to_require_one(array('TPL_THEME' => $theme));
		$this->load->service('admin/cache')->template();
		$this->load->service('admin/cache')->taglib();
		showmessage(lang('_operation_success_'), url('index'), 1);
	}
}