<?php
/**
 *      [Powerlong] Copyright © 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */
Core::load_class('init', 'admin');
class article_control extends init_control {
	protected $service = '';
	public function _initialize() {
		parent::_initialize();
		$this->service = $this->load->service('article');
		$this->category_service = $this->load->service('article_category');
		$this->load->helper('attachment');
	}
	/**
	 * [index 文章列表]
 	 */
	public function index(){
		$sqlmap = array();
		$_GET['limit'] = isset($_GET['limit']) ? $_GET['limit'] : 10;
		if($_GET['types'] == 'hotelnews'){
			$sqlmap['category_id'] = 4;
		}else{
			$sqlmap['category_id'] = array('IN','1,2,3');
		}
		$article = $this->load->table('article')->where($sqlmap)->page($_GET['page'])->limit($_GET['limit'])->order("sort DESC")->select();
		foreach($article as $key => $value){
		   $article[$key]['category'] = $this->load->table('article_category')->where(array('id' =>array('eq',$value['category_id'])))->getField('name');
		   $article[$key]['dataline'] = date('Y-m-d H:i:s',$value['dataline']);
	    }
        $count = $this->load->table('article')->where($sqlmap)->count();
        $pages = $this->admin_pages($count, $_GET['limit']);
        $this->load->librarys('View')->assign('article',$article);
		$this->load->librarys('View')->assign('pages',$pages);
        $this->load->librarys('View')->display('article_index');
	}


	/**
	 * [index 文章列表]
	 */
	public function index_hotel(){
		$sqlmap = array();
		$_GET['limit'] = isset($_GET['limit']) ? $_GET['limit'] : 10;
		if($_GET['types'] == 'hotelnews'){
			$sqlmap['category_id'] = 4;
		}else{
			$sqlmap['category_id'] = array('IN','1,2,3');
		}
		$article = $this->load->table('article')->where($sqlmap)->page($_GET['page'])->limit($_GET['limit'])->order("sort DESC")->select();
		foreach($article as $key => $value){
			$article[$key]['category'] = $this->load->table('article_category')->where(array('id' =>array('eq',$value['category_id'])))->getField('name');
			$article[$key]['dataline'] = date('Y-m-d H:i:s',$value['dataline']);
		}
		$count = $this->load->table('article')->where($sqlmap)->count();
		$pages = $this->admin_pages($count, $_GET['limit']);
		$this->load->librarys('View')->assign('article',$article);
		$this->load->librarys('View')->assign('pages',$pages);
		$this->load->librarys('View')->display('article_index');
	}

	/**
	 * [index 文章列表]
	 */
	public function index_recruit(){
		$sqlmap = array();
		$_GET['limit'] = isset($_GET['limit']) ? $_GET['limit'] : 10;
		if($_GET['types'] == 'recruit'){
			$sqlmap['category_id'] = 5;
		}else{
			$sqlmap['category_id'] = array('IN','1,2,3');
		}
		$article = $this->load->table('article')->where($sqlmap)->page($_GET['page'])->limit($_GET['limit'])->order("sort DESC")->select();
		foreach($article as $key => $value){
			$article[$key]['category'] = $this->load->table('article_category')->where(array('id' =>array('eq',$value['category_id'])))->getField('name');
			$article[$key]['dataline'] = date('Y-m-d H:i:s',$value['dataline']);
		}
		$count = $this->load->table('article')->where($sqlmap)->count();
		$pages = $this->admin_pages($count, $_GET['limit']);
		$this->load->librarys('View')->assign('article',$article);
		$this->load->librarys('View')->assign('pages',$pages);
		$this->load->librarys('View')->display('article_index');
	}


	/**
	 * [article_category_choose 选择框]
 	 */
	public function article_category_choose(){
		$category = $this->category_service->get_category_tree();
		$this->load->librarys('View')->assign('category',$category);
        $this->load->librarys('View')->display('article_category_choose');
	}
	/**
	 * [add 添加文章]
 	 */
	public function add(){
		if(checksubmit('dosubmit')){
			if(!empty($_FILES['thumb']['name'])) {
				$code = attachment_init(array('module'=>'article','path'=>'article','mid'=>$this->admin['id'],'allow_exts'=>array('bmp','jpg','jpeg','gif','png')));
				$_GET['thumb'] = $this->load->service('attachment/attachment')->setConfig($code)->upload('thumb');
				if(!$_GET['thumb']){
					showmessage($this->load->service('attachment/attachment')->error);
				}
			}
			//自定义时间
			if($_GET['dataline']){
				$_GET['dataline'] = strtotime($_GET['dataline']);
			}

			$result = $this->service->add($_GET);
			if(!$result){
				showmessage($this->service->error);
			}else{
				$this->load->service('attachment/attachment')->attachment($_GET['thumb'], '',false);
				$this->load->service('attachment/attachment')->attachment($_GET['content'],'');
				if($_GET['types'] == 'hotelnews'){
					showmessage(lang('_operation_success_'),url('index_hotel',array('types'=>'hotelnews')));
				}elseif($_GET['types'] == 'recruit'){
					showmessage(lang('_operation_success_'),url('index_recruit',array('types'=>'recruit')));
				}else{
					showmessage(lang('_operation_success_'),url('index'));
				}
			}
		}else{
			$this->load->librarys('View')->display('article_edit');
		}
	}
	/**
	 * [edit 编辑文章]
 	 */
	public function edit(){
		$info = $this->service->get_article_by_id($_GET['id']);
		if(checksubmit('dosubmit')){
			if(!empty($_FILES['thumb']['name'])) {
				$code = attachment_init(array('module'=>'article','path'=>'article','mid'=>$this->admin['id'],'allow_exts'=>array('bmp','jpg','jpeg','gif','png')));
				$_GET['thumb'] = $this->load->service('attachment/attachment')->setConfig($code)->upload('thumb');
				if(!$_GET['thumb']){
					showmessage($this->load->service('attachment/attachment')->error);
				}
				$this->load->service('attachment/attachment')->attachment($_GET['thumb'], $info['thumb'],false);
			}
			$this->load->service('attachment/attachment')->attachment($_GET['content'], $info['content']);
			//自定义时间
			if($_GET['dataline']){
				$_GET['dataline'] = strtotime($_GET['dataline']);
			}
			$result = $this->service->edit($_GET);
			if(!$result){
				showmessage($this->service->error);
			}else{
				if($_GET['types'] == 'hotelnews'){
					showmessage(lang('_operation_success_'),url('index_hotel',array('types'=>'hotelnews')));
				}elseif($_GET['types'] == 'recruit'){
					showmessage(lang('_operation_success_'),url('index_recruit',array('types'=>'recruit')));
				}else{
					showmessage(lang('_operation_success_'),url('index'));
				}

			}
		}else{
			$this->load->librarys('View')->assign('info',$info);
        	$this->load->librarys('View')->display('article_edit');
		}
	}
	/**
	 * [delete 删除文章]
 	 */
	public function delete(){
		$result = $this->service->delete($_GET);
		if(!$result){
			showmessage($this->service->error);
		}
		showmessage(lang('_operation_success_'),url('misc/article/index'),1);
	}
	/**
	 * [ajax_edit 编辑文章]
 	 */
	public function ajax_edit(){
		$result = $this->service->ajax_edit($_GET);
		$this->ajaxReturn($result);
	}
}