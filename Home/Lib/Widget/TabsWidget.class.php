<?php
/*
 * 标题：AK单页订单管理系统企业版
 * 作者：123456（微信号）
 * 官方网址：123456
 * *
 */
class TabsWidget extends Widget 
{
	public function render($data)
	{
		if(empty($data['status'])) return false;
		$ids = is_array($data['id'])?implode(',', $data['id']):$data['id'];
		if(empty($ids)){ return false;}
		$category = M('Category')->where("type=1 AND id IN($ids)")->order("field(id,$ids)")->select();
		$Item = M('Item');
		foreach($category as &$cat){
			$where = "is_delete=0 AND status=1 AND image!='' AND category_id={$cat['id']}";
			$cat['data'] = $Item->where($where)->field('id,sn,name,brief,price,image,thumb')->limit($data['num'])->order('sort_order ASC')->select();
		}
		$list['data'] = $category;
		return $this->renderFile ("index", $list);
	}
}
?>