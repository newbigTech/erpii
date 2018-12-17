<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model{

	public function __construct(){
  		parent::__construct();
	}
	
	//add for more
	public function get_admin($where='',$type=1,$order=''){
	    $sql = 'select
					a.*,
	               ifnull(SUBSTRING_INDEX(b.path,",",1),-1) as topId,
	               if(length(b.path)-length(replace(b.path,",",""))>0,SUBSTRING_INDEX(SUBSTRING_INDEX(path,",",2),",",-1),-1) as midId,
                   if(length(b.path)-length(replace(b.path,",",""))>1,SUBSTRING_INDEX(SUBSTRING_INDEX(path,",",3),",",-1),-1) as lowId,
	               case b.level when 1 then "topId" when 2 then "midId" when 3 then "lowId" else "-9" end as orgLevelName,
	               b.level as orgLevel,
	               b.name as orgName,
	               if(a.roleid=0,"",if(b.level=1,concat("topId","=",a.orgId),concat("midId","=",if(length(b.path)-length(replace(b.path,",",""))>0,SUBSTRING_INDEX(SUBSTRING_INDEX(path,",",2),",",-1),-1)))) as orgMidWhere,
	               if(a.roleid=0,"",concat(case b.level when 1 then "topId" when 2 then "midId" when 3 then "lowId" else "-9" end,"=",a.orgId)) as orgWhere
		        from '.$this->db->dbprefix('admin').' a
		        left join (select id,level,name,path from '.$this->db->dbprefix('org').' where isDelete=0 and level in (1,2,3)) b on b.id=a.orgId
				where '.$where.($order?' order by '.$order:'');
	    return $this->mysql_model->query($sql,$type);
	}
	//add for more
	
	//库存统计
	public function get_inventory($where='',$type=2) {
	    $where = $this->getOrgWhere($where,0,'GROUP');
	    $sql = 'select 
					a.invId,a.locationId,sum(a.qty) as qty,   
		            b.name as invName, b.number as invNumber,b.spec as invSpec,b.categoryId ,b.categoryName,b.unitName,b.unitid,
					if(d.lowQty>=0,d.lowQty,b.lowQty) as lowQty,
					if(d.highQty>=0,d.highQty,b.highQty) as highQty,
					(sum(a.qty) - if(d.highQty>=0,d.highQty,b.highQty)) as qty1,
					(sum(a.qty) - if(d.lowQty>=0,d.lowQty,b.lowQty)) as qty2,
					c.name as locationName
		        from '.$this->db->dbprefix('invoice_info').' as a 
					left join 
						(select id,name,number,spec,unitName,unitid,lowQty,highQty,categoryId,categoryName from '.$this->db->dbprefix('goods').' where isDelete=0) as b 
					on a.invId=b.id 
					left join 
						(select id,name,locationNo from '.$this->db->dbprefix('storage').' where isDelete=0) as c 
					on a.locationId=c.id 
					left join 
						(select id,lowQty,highQty,locationId,invId from '.$this->db->dbprefix('warehouse').' group by invId,locationId) as d
					on a.invId=d.invId and a.locationId=d.locationId
				where '.$where;//die($sql);
		return $this->mysql_model->query($sql,$type);		
	}	


	//获取库存 用于判断库存是否满足
	public function get_invoice_info_inventory() {
	    $where = $this->getOrgWhere('');
		$list = $this->mysql_model->query('select invId,locationId,sum(qty) as qty from '.$this->db->dbprefix('invoice_info').' as a where isDelete=0 '.$where.' group by invId,locationId',2);//add by michen 20170917 for where isDelete=0
		foreach($list as $arr=>$row){
		    $v[$row['invId']][$row['locationId']] = $row['qty'];
		}		
		return isset($v) ? $v :array();				
	}		
	
	
	//获取订单单据列表
	public function get_order($where='',$type=2) {
	    $where = $this->getOrgWhere($where);
	    $sql = 'select 
		            a.*,
					b.name as contactName,b.number as contactNo,   
					c.number as salesNo ,c.name as salesName, 
					d.number as accountNumber ,d.name as accountName
				from '.$this->db->dbprefix('order').' as a 
					left join 
						(select id,number, name from '.$this->db->dbprefix('contact').' where isDelete=0) as b
					on a.buId=b.id 
					left join 
						(select id,name,number from '.$this->db->dbprefix('staff').' where isDelete=0) as c
					on a.salesId=c.id 
					left join 
					    (select id,name,number from '.$this->db->dbprefix('account').' where isDelete=0) as d 
					on a.accId=d.id 
				where '.$where;
		return $this->mysql_model->query($sql,$type);	
	}	
	
	//获取订单明细
	public function get_order_info($where='',$type=2) {
	    $where = $this->getOrgWhere($where);
	    $sql = 'select 
		            a.*, 
					b.name as invName, b.number as invNumber, b.spec as invSpec, 
					b.unitName as mainUnit,b.pinYin,b.purPrice,b.quantity,b.salePrice,b.unitId,
					c.number as contactNo, c.name as contactName,
					d.name as locationName ,d.locationNo ,
					e.number as salesNo ,e.name as salesName
				from '.$this->db->dbprefix('order_info').' as a 
					left join 
						(select id,name,number,spec,unitName,unitId,pinYin,purPrice,quantity,salePrice from '.$this->db->dbprefix('goods').' where isDelete=0) as b 
					on a.invId=b.id 
					left join 
						(select id,number, name from '.$this->db->dbprefix('contact').' where isDelete=0) as c
					on a.buId=c.id 	
					left join 
						(select id,name,locationNo from '.$this->db->dbprefix('storage').' where isDelete=0) as d 
					on a.locationId=d.id 
					left join 
						(select id,name,number from '.$this->db->dbprefix('staff').' where isDelete=0) as e
					on a.salesId=e.id 	
				where '.$where;
		return $this->mysql_model->query($sql,$type); 	
	}
	
	
	//获取单据列表
	public function get_invoice($where='',$type=2) {
	    $where = $this->getOrgWhere($where);
	    $sql = 'select 
		            a.*,
					b.name as contactName,b.number as contactNo,   
					c.number as salesNo ,c.name as salesName, 
					d.number as accountNumber ,d.name as accountName,
					(a.rpAmount + ifnull(e.nowCheck,0)) as hasCheck
				from '.$this->db->dbprefix('invoice').' as a 
					left join 
						(select id,number, name from '.$this->db->dbprefix('contact').' where isDelete=0) as b
					on a.buId=b.id 
					left join 
						(select id,name,number from '.$this->db->dbprefix('staff').' where isDelete=0) as c
					on a.salesId=c.id 
					left join 
					    (select id,name,number from '.$this->db->dbprefix('account').' where isDelete=0) as d 
					on a.accId=d.id 
					left join 
					    (select billId,sum(nowCheck) as nowCheck from '.$this->db->dbprefix('verifica_info').' where isDelete=0 group by billId) as e
					on a.id=e.billId
				where '.$where;
		return $this->mysql_model->query($sql,$type);	
	}	
	
	
	//销售汇总表（按商品） 毛利计算 单价成本
	public function get_profit($where) {
	    $where = $this->getOrgWhere($where,1);//add for 门店成本统计$where = $this->getOrgWhere($where);
	    $sql = 'select 
					invId,locationId,billDate,sum(qty) as qty,
					sum(case when transType=150501 or transType=150502 or transType=150807 or transType=150706 or billType="INI" or transType=103091 or transType=104091 then amount else 0 end) as inamount,
					sum(case when transType=150501 or transType=150502 or transType=150706 or billType="INI" or transType=103091 or transType=104091 then qty else 0 end) as inqty
				from '.$this->db->dbprefix('invoice_info').' as a where isDelete=0 '.$where.' group by invId,locationId';
	    $list = $this->mysql_model->query($sql,2); 	
		foreach($list as $arr=>$row){
		    $v['qty'][$row['invId']][$row['locationId']]      = $row['qty'];                      
			$v['inqty'][$row['invId']][$row['locationId']]    = $row['inqty'];    
			$v['inamount'][$row['invId']][$row['locationId']] = $row['inamount'];   
			$v['inprice'][$row['invId']][$row['locationId']]  = $row['inqty']>0 ? $row['inamount']/$row['inqty'] :0;   
		}		
		return isset($v) ? $v :array();	
	}
	
	//获取单据列表统计
	public function get_invoice_infosum($where='',$type=2) {
	    $where = $this->getOrgWhere($where,0,'group');
	    $sql = 'select 
		            a.*,sum(a.qty) as sumqty,sum(a.amount) as sumamount,  
					b.name as invName, b.number as invNumber, b.spec as invSpec, 
					b.unitName as mainUnit,b.pinYin,b.purPrice,b.quantity,b.salePrice,b.unitId,
					c.number as contactNo, c.name as contactName,
					d.name as locationName ,d.locationNo ,
					e.number as salesNo ,e.name as salesName
				from '.$this->db->dbprefix('invoice_info').' as a 
					left join 
						(select id,name,number,spec,unitName,unitId,pinYin,purPrice,quantity,salePrice from '.$this->db->dbprefix('goods').' where isDelete=0) as b 
					on a.invId=b.id 
					left join 
						(select id,number, name from '.$this->db->dbprefix('contact').' where isDelete=0) as c
					on a.buId=c.id 	
					left join 
						(select id,name,locationNo from '.$this->db->dbprefix('storage').' where isDelete=0) as d 
					on a.locationId=d.id 
					left join 
						(select id,name,number from '.$this->db->dbprefix('staff').' where isDelete=0) as e
					on a.salesId=e.id 	
				where '.$where;
		return $this->mysql_model->query($sql,$type); 	
	}
	
	//获取单据列表明细
	public function get_invoice_info($where='',$type=2) {
	    $where = $this->getOrgWhere($where);
	    $sql = 'select 
		            a.*, 
					b.name as invName, b.number as invNumber, b.spec as invSpec, 
					b.unitName as mainUnit,b.pinYin,b.purPrice,b.quantity,b.salePrice,b.unitId,
					c.number as contactNo, c.name as contactName,
					d.name as locationName ,d.locationNo ,
					e.number as salesNo ,e.name as salesName
				from '.$this->db->dbprefix('invoice_info').' as a 
					left join 
						(select id,name,number,spec,unitName,unitId,pinYin,purPrice,quantity,salePrice from '.$this->db->dbprefix('goods').' where isDelete=0) as b 
					on a.invId=b.id 
					left join 
						(select id,number, name from '.$this->db->dbprefix('contact').' where isDelete=0) as c
					on a.buId=c.id 	
					left join 
						(select id,name,locationNo from '.$this->db->dbprefix('storage').' where isDelete=0) as d 
					on a.locationId=d.id 
					left join 
						(select id,name,number from '.$this->db->dbprefix('staff').' where isDelete=0) as e
					on a.salesId=e.id 	
				where '.$where;
		return $this->mysql_model->query($sql,$type); 	
	}
	
	
	
	//获取未核销列表
	public function get_unhx($where='',$type=2) {
	    $where = $this->getOrgWhere($where);
	    $sql = 'select 
		            a.*,ifnull(b.nowCheck,0)+a.rpAmount as nowCheck,(a.amount-ifnull(b.nowCheck,0)-a.rpAmount) as notCheck
				from '.$this->db->dbprefix('invoice').' as a 
					left join 
					    (select billId,sum(nowCheck) as nowCheck from '.$this->db->dbprefix('verifica_info').' where isDelete=0 group by billId) as b 
					on a.id=b.billId
				where '.$where;
		return $this->mysql_model->query($sql,$type);	
	}	
	
	
	//商品收发明细表(期初数量)  商品收发明细表(接口)
	public function get_goods_beginning($where='',$beginDate,$type=2) {
	    $where = $this->getOrgWhere($where,1);
	    $sql = 'select 
					a.id,a.name as invName, a.number as invNumber, a.spec as invSpec,b.qty
				from '.$this->db->dbprefix('goods').' as a 
				left join 
					(select invId,sum(qty) as qty from '.$this->db->dbprefix('invoice_info').' where isDelete=0 and billDate<"'.$beginDate.'" group by invId) as b 
				on a.id=b.invId  
				where '.$where;
		return $this->mysql_model->query($sql,$type); 	 
	}
	
	//商品库存余额表(接口)
	public function get_invBalance($where='',$select='',$type=2) {
	    $where = $this->getOrgWhere($where,0,'group');
	    $sql = 'select 
		            a.invId,a.locationId,sum(a.qty) as qty,sum(a.amount) as amount,
					'.$select.'
					b.name as invName, b.number as invNumber, b.spec as invSpec, b.unitName as mainUnit, b.categoryId,b.salePrice,
					c.locationNo
				from '.$this->db->dbprefix('invoice_info').' as a 
					left join 
						(select id,name,number,spec,unitName,categoryId,salePrice from '.$this->db->dbprefix('goods').' where isDelete=0) as b 
					on a.invId=b.id 
					left join 
						(select id,name,locationNo from '.$this->db->dbprefix('storage').' where isDelete=0) as c 
					on a.locationId=c.id 
				where '.$where;	
		return $this->mysql_model->query($sql,$type); 
	}
	
	//获取商品收发汇总表 
	public function get_deliverSummary($where='',$beginDate,$endDate,$type=2) {
	    $where = $this->getOrgWhere($where,0,'group');
	    $sql = 'select 
		            sum(case when a.billDate<"'.$beginDate.'" then qty else 0 end ) as qty0,
		            sum(qty) as qty14,
					sum(case when a.transType=150501 and a.billDate>="'.$beginDate.'" and a.billDate<="'.$endDate.'" then qty else 0 end ) as qty2,
					sum(case when a.transType=150502 and a.billDate>="'.$beginDate.'" and a.billDate<="'.$endDate.'" then qty else 0 end ) as qty9,
					sum(case when a.transType=150601 and a.billDate>="'.$beginDate.'" and a.billDate<="'.$endDate.'" then qty else 0 end ) as qty10,
					sum(case when a.transType=150602 and a.billDate>="'.$beginDate.'" and a.billDate<="'.$endDate.'" then qty else 0 end ) as qty3,
					sum(case when a.transType=150701 and a.billDate>="'.$beginDate.'" and a.billDate<="'.$endDate.'" then qty else 0 end ) as qty4,
					sum(case when a.transType=150702 and a.billDate>="'.$beginDate.'" and a.billDate<="'.$endDate.'" then qty else 0 end ) as qty3,
					sum(case when a.transType=150801 and a.billDate>="'.$beginDate.'" and a.billDate<="'.$endDate.'" then qty else 0 end ) as qty11,
					sum(case when a.transType=103091 and a.billDate>="'.$beginDate.'" and a.billDate<="'.$endDate.'" and qty>0 then qty else 0 end ) as qty1,
					sum(case when a.transType=103091 and a.billDate>="'.$beginDate.'" and a.billDate<="'.$endDate.'" and qty<0 then qty else 0 end ) as qty8,
					sum(case when a.transType=104091 and a.billDate>="'.$beginDate.'" and a.billDate<="'.$endDate.'" and qty>0 then qty else 0 end ) as qty21,
					sum(case when a.transType=104091 and a.billDate>="'.$beginDate.'" and a.billDate<="'.$endDate.'" and qty<0 then qty else 0 end ) as qty22,
					sum(case when a.transType=150807 and a.billDate>="'.$beginDate.'" and a.billDate<="'.$endDate.'" then qty else 0 end ) as qty6,
					sum(case when a.transType=150706 and a.billDate>="'.$beginDate.'" and a.billDate<="'.$endDate.'"then qty else 0 end ) as qty5,
					sum(case when a.transType=150806 and a.billDate>="'.$beginDate.'" and a.billDate<="'.$endDate.'" then qty else 0 end ) as qty12,
					a.invId, a.locationId,
					b.name as invName, b.number as invNumber, b.spec as invSpec, b.unitName as mainUnit,
					c.name as locationName ,c.locationNo
				from '.$this->db->dbprefix('invoice_info').' as a 
				    left join 
						(select id,name,number,spec,unitName from '.$this->db->dbprefix('goods').' where isDelete=0) as b 
					on a.invId=b.id 
					left join 
						(select id,name,locationNo from '.$this->db->dbprefix('storage').' where isDelete=0) as c
					on a.locationId=c.id 
				where '.$where;
		return $this->mysql_model->query($sql,2); 
	}
	
	
	//获取供应商客户   用于应付账、收账明细、客户、供应商对账单、来往单位欠款 (期初余额)  
	public function get_contact($where1='',$where2='',$type=2) {
	    $where1 = $this->getOrgWhere($where1,0,'order','');
	    $where2 = $this->getOrgWhere($where2,1);
	    $sql = 'select 
					a.id,a.type,a.difMoney,a.name,a.number,(a.difMoney + ifnull(b.arrears,0)) as amount,b.arrears
				from '.$this->db->dbprefix('contact').' as a 
				left join 
					(select buId,billType,sum(arrears) as arrears from '.$this->db->dbprefix('invoice').' where isDelete=0 '.$where1.' group by buId) as b 
			    on a.id=b.buId  
				where '.$where2;
		return $this->mysql_model->query($sql,$type); 	
	}
 

	//获取结算用户     现金银行报表(期初余额)
	public function get_account($where1='',$where2='',$type=2) {
	    $where1 = $this->getOrgWhere($where1,0,'order','');
	    $where2 = $this->getOrgWhere($where2,1);
	    $sql = 'select 
		            a.id,a.date,a.type,a.name as accountName,a.number as accountNumber,
		            b.payment,(a.amount + ifnull(b.payment,0)) as amount
		        from '.$this->db->dbprefix('account').' as a 
				left join 
				    (select accId,billDate,sum(payment) as payment from '.$this->db->dbprefix('account_info').' where isDelete=0 '.$where1.' GROUP BY accId) as b 
			    on a.id=b.accId  
				where '.$where2;	
		return $this->mysql_model->query($sql,$type);		
	}	
	

	//获取结算明细     用于其他收支明细表、现金银行报表(明细)
	public function get_account_info($where='',$type=2) {
	    $where = $this->getOrgWhere($where);
	    $sql = 'select 
		            a.id,a.iid,a.accId,a.buId,a.isDelete,a.billType,a.billNo,a.remark,a.billDate,a.payment,a.wayId,a.settlement,a.transType,a.transTypeName,
					b.name as contactName,b.number as contactNo,
					c.name as categoryName,
					d.name as accountName,d.number as accountNumber
				from '.$this->db->dbprefix('account_info').' as a 
				left join 
					(select id,name,number from '.$this->db->dbprefix('contact').' where isDelete=0) as b 
				on a.buId=b.id 
				left join 
					(select id,name from '.$this->db->dbprefix('category').' where isDelete=0) as c 
				on a.wayId=c.id 
				left join 
					(select id,name,number from '.$this->db->dbprefix('account').' where isDelete=0) as d 
				on a.accId=d.id 
				where '.$where;	
		return $this->mysql_model->query($sql,$type); 	
	}


	//获取商品明细 
	public function get_goods($where='',$type=2) {//,$order
	    $where = $this->getOrgWhere($where,1);
	    $where2 = $this->getOrgWhere('',0,'order','');
	    $sql = 'select 
					a.*,b.iniqty,b.iniunitCost,b.iniamount,b.totalqty
				from '.$this->db->dbprefix('goods').' as a 
				left join 
					(select 
						invId,
						sum(qty) as totalqty, 
						sum(case when billType="INI" then qty else 0 end) as iniqty,
						sum(case when billType="INI" then price else 0 end) as iniunitCost,
						sum(case when billType="INI" then amount else 0 end) as iniamount
					from '.$this->db->dbprefix('invoice_info').' 
					where isDelete=0 '.$where2.' group by invId) as b 
				on a.id=b.invId  where '.$where;//.$order
		return $this->mysql_model->query($sql,$type); 	
	}	
 
	//add for more
	private function getOrgWhere($where,$base=0,$sp='order',$tb='a'){
	    $part = explode($sp, $where);
	    if(count($part)>0){
	       $where = $part[0];
	       $order = $part[1];
	    }else{
	        $order = '';
	    }//session2
	    $this->jxcsys = $this->session->userdata('jxcsys');
	    $this->canOperate = ($this->jxcsys['roleid'] != 0 && $this->jxcsys['orgId'] && $this->jxcsys['lowId']>0);//$this->jxcsys['orgLevel']==3
	    $orgWhere = explode('=',$this->jxcsys['orgWhere']);
	    $this->orgWhere = array($orgWhere[0]=>$orgWhere[1]);
	    $orgMidWhere = explode('=',$this->jxcsys['orgMidWhere']);
	    $this->orgMidWhere =  array($orgMidWhere[0]=>$orgMidWhere[1]);
	    $this->orgMidWhereStr = $this->jxcsys['orgMidWhere'];
	    $this->orgWhereStr = $this->jxcsys['orgWhere'];
	    
	    if($this->jxcsys['roleid'] == 0) return $where;
	    if(!$this->jxcsys['orgId']) return $where.' and (1=2) ';
	    if($base==1)
            return $where.' and ('.($tb?$tb.'.':'').$this->orgMidWhereStr.') '.($order?$sp.' '.$order:'');
        else
            return $where.' and ('.($tb?$tb.'.':'').$this->orgWhereStr.') '.($order?$sp.' '.$order:'');
	}
 
}