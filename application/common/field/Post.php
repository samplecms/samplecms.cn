<?php
// +----------------------------------------------------------------------
// | 文章
// +----------------------------------------------------------------------
// | Copyright (c) 20016 
// +----------------------------------------------------------------------
// | Author: sunkangchina <weichat>
// +----------------------------------------------------------------------
namespace app\common\field;
use app\common\Hook;
class Post extends Base{
	public $title = '文章';
	public $table = 'posts';
	
	public $allowField = ['title','content','type','status','sort','files'];
 
	public $message = [
			'title.require'  =>  ['title'=>'标题必须'],
			'title.min'  =>  ['title'=>'标题字符不少于6'],
			'content' => ['content'=>'内容必须'],
	];
	
	
	public $rule = [
			'title'  =>  'require|min:6',
			'content' =>  'require',
	];
	
	public $field = [
		'title'=>[
			'label'=>'标题',	
			'element'=>'input',
				
		],
		'content'=>[
				'label'=>'内容',
				'element'=>'editor'
		],
		'files'=>[
				'label'=>'图片',
				'element'=>'upload',
				'option'=>[
					'call'=>"
						$('.form-field-files img').click(function(){
							 	console.log($(this).attr('src'));
								redactor_content.insertHtml('<img src=\"'+$(this).attr('rel')+'\" />');	
						});
						
					",
				]
		],			
		'type'=>[
				'label'=>'分类',
				'element'=>'select',
				'data'=>"Type::element_select",
		],
		'status'=>[
				'label'=>'状态',
				'element'=>'select',
				'data'=>[  
					1=>'启用',
					-1=>'禁用',
				]
		],

		
	];
	 
	
	
	public $scene = [
			'add'   =>  ['title','content'],
			'edit'  =>  ['title','content'],
	];
	

	 public function init(){
		parent::init();
		Hook::add('admin.field.before_insert','app\common\field\Post@before_insert');
		 


		
	}
	
	

	static function before_insert(&$data){
		$data['sort'] = time();
	}

	 
	
	
}