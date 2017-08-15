<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/02/25 20:22:41 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_service_info_model extends CI_Model
{
    public $service_id = "";
    public $la_rank = "";
    public $service_type_id = "";
    public $service_name = "";
    public $service_company = "";
    public $service_phone = "";
    public $service_email = "";
    public $service_person = "";
    public $spreader_code = "";
    public $service_person_phone = "";
    public $service_province_code = "";
    public $service_city_code = "";
    public $service_address = "";
    public $service_license = "";
    public $service_doc1 = "";
    public $service_doc2 = "";
    public $service_class = "";
    public $service_products = "";
    public $service_deposit = "";
    public $service_website = "";
    public $service_balance = "";
    public $service_recharge = "";
    public $service_freeze_amount = "";
    public $service_logo = "";
    public $service_cpa = "";
    public $service_cps = "";
    public $service_pic = "";
    public $service_status = "";
    public $service_vipfirst = "";
    public $service_vipstart = "";
    public $service_vipend = "";
    public $service_desc = "";
    public $service_person_work = "";
    public $service_organization_code = "";
    public $service_license_code = "";
    public $service_join_addtime = "";
    public $service_laudit_desc = "";
    public $service_reg_source_type = "";
    public $service_score = "";
    public $service_use_score = "";
    public $spreader_code_source = "";
    public $service_qr = "";

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * 根据主键获取单条记录
     *
     * @PRIMARY KEY service_id
     *
     * @return 对象
     */
    public function get($service_id)
    {
        return $this->db->get_where('t_service_info',array('service_id' => $service_id))->row();
    }


    /**
     * 获取记录列表
     * 
     * 默认参数：获取按主键升序排列的前10条记录
     *
     * @param $limit		每页纪录数
     * @param $offset		结果集的偏移
     * @param $order_field	排序字段
     * @param $order_type	排序类型 ASC | DESC
     *
     * @return				对象数组
     * get_list(10,0) =>	select * from t_service_info limit 0,10
     */
    public function get_list($limit = 10, $offset = 0, $order_field = 'service_id', $order_type = 'ASC')
    {
        $this->db->order_by($order_field, $order_type);
        return $this->db->get('t_service_info', $limit, $offset)->result();
    }

    /**
     * 获取所有记录
     *
     * 默认参数：获取按主键升序排列的所有记录
     *
     * @param $order_field	排序字段
     * @param $order_type	排序类型 ASC | DESC
     *
     * @return				对象数组
     */
    public function get_all($order_field = 'service_id', $order_type = 'ASC')
    {
        $this->db->order_by($order_field, $order_type);
        return $this->db->get('t_service_info')->result();
    }

    /**
     * 获取表中所有记录的行数，用于分页 
     */
    public function count_all()
    {
        return $this->db->count_all('t_service_info');
    }

    /**
     * 查询	
     *
     * 默认参数：根据查询字段和关键词，返回按主键升序排列的前10条记录
     *
     * @param $field_name	查询的字段
     * @param $keywords		查询的关键字
     * @param $limit		每页纪录数
     * @param $offset		结果集的偏移
     * @param $order_field	排序字段
     * @param $order_type	排序类型 ASC | DESC
     *
     * @return				对象数组
     */
    public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'service_id', $order_type = 'ASC')
    {
        $this->db->from('t_service_info')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
        return $this->db->get()->result();
    }

    /**
     * 获取满足查询条件的所有记录总数，用于查询结果的分页
     *
     * @param $field_name	查询的字段
     * @param $keywords		查询的关键字
     *
     * @return				整形
     */
    public function count_search($field_name, $keywords)
    {
        $this->db->from('t_service_info')->like($field_name, $keywords);
        return $this->db->count_all_results();
    }

    /**
     * 插入一条记录
     *
     * @Exception			Exception
     *
     * @return				return $this->db->insert()
     */
    public function insert()
    {
        $this->db->insert('t_service_info', $this);
        return $this->db->insert_id();
    }

    /**
     * 更新一条记录
     *
     * @Exception			Exception
     * 
     * @return				return $this->db->update()
     */
    public function update()
    {
        return $this->db->update('t_service_info', $this, array('service_id' => $_POST['service_id']));
    }

    /**
     * 确认数据库表中的不能为空的列是否存在于$post数组中
     */
    private function validation_db_is_not_nullable_rules_by_insert($post)
    {
        if(!isset($post['service_name']) || empty($post['service_name'])) return false;
        if(!isset($post['service_phone']) || empty($post['service_phone'])) return false;
        if(!isset($post['service_person']) || empty($post['service_person'])) return false;
        if(!isset($post['service_person_phone']) || empty($post['service_person_phone'])) return false;
        if(!isset($post['service_province_code']) || empty($post['service_province_code'])) return false;
        if(!isset($post['service_city_code']) || empty($post['service_city_code'])) return false;
        if(!isset($post['service_address']) || empty($post['service_address'])) return false;
        if(!isset($post['service_license']) || empty($post['service_license'])) return false;
        if(!isset($post['service_doc1']) || empty($post['service_doc1'])) return false;
        if(!isset($post['service_doc2']) || empty($post['service_doc2'])) return false;
        if(!isset($post['service_class']) || empty($post['service_class'])) return false;
        if(!isset($post['service_products']) || empty($post['service_products'])) return false;
        if(!isset($post['service_deposit']) || empty($post['service_deposit'])) return false;
        if(!isset($post['service_website']) || empty($post['service_website'])) return false;
        if(!isset($post['service_balance']) || empty($post['service_balance'])) return false;
        if(!isset($post['service_recharge']) || empty($post['service_recharge'])) return false;
        if(!isset($post['service_freeze_amount']) || empty($post['service_freeze_amount'])) return false;
        if(!isset($post['service_cpa']) || empty($post['service_cpa'])) return false;
        if(!isset($post['service_cps']) || empty($post['service_cps'])) return false;
        if(!isset($post['service_token']) || empty($post['service_token'])) return false;

        return true;
    }

    /**
     * 确认数据库表中的不能为空的列是否存在于$post数组中
     */
    private function validation_db_is_not_nullable_rules_by_update($post)
    {
        if(!isset($post['service_id']) || empty($post['service_id'])) return false;
        if(!isset($post['service_name']) || empty($post['service_name'])) return false;
        if(!isset($post['service_phone']) || empty($post['service_phone'])) return false;
        if(!isset($post['service_person']) || empty($post['service_person'])) return false;
        if(!isset($post['service_person_phone']) || empty($post['service_person_phone'])) return false;
        if(!isset($post['service_province_code']) || empty($post['service_province_code'])) return false;
        if(!isset($post['service_city_code']) || empty($post['service_city_code'])) return false;
        if(!isset($post['service_address']) || empty($post['service_address'])) return false;
        if(!isset($post['service_license']) || empty($post['service_license'])) return false;
        if(!isset($post['service_doc1']) || empty($post['service_doc1'])) return false;
        if(!isset($post['service_doc2']) || empty($post['service_doc2'])) return false;
        if(!isset($post['service_class']) || empty($post['service_class'])) return false;
        if(!isset($post['service_products']) || empty($post['service_products'])) return false;
        if(!isset($post['service_deposit']) || empty($post['service_deposit'])) return false;
        if(!isset($post['service_website']) || empty($post['service_website'])) return false;
        if(!isset($post['service_balance']) || empty($post['service_balance'])) return false;
        if(!isset($post['service_recharge']) || empty($post['service_recharge'])) return false;
        if(!isset($post['service_freeze_amount']) || empty($post['service_freeze_amount'])) return false;
        if(!isset($post['service_cpa']) || empty($post['service_cpa'])) return false;
        if(!isset($post['service_cps']) || empty($post['service_cps'])) return false;
        if(!isset($post['service_token']) || empty($post['service_token'])) return false;

        return true;
    }

    /**
     * 根据主键删除单条记录
     *
     * @PRIMARY KEY service_id
     */
    public function delete($service_id)
    {
        return $this->db->delete('t_service_info',array('service_id' => $service_id));
    }
    /**
     * 根据主键获取单条记录
     *
     * @PRIMARY KEY s_class_id
     *
     * @return 对象
     */
    public function get_tag($field='user_id',$where)
    {
        return $this->db->select($field)->get_where('t_service_info',$where)->result_array();
    }

    /**
     * 修改
     * @param array $data
     * @param arrray $where
     * @return boolean
     * @author liuguangping
     * @version jia178 v1.0 2013/11/7
     */
    public function updates_global($data,$where){
        return $this->db->update('t_service_info',$data,$where)?true:false;
    }

    /**
     * 查询经销商的总条数 liuguangping
     * @param Int $province 省
     * @param Int $city 市
     * @param Int $district 区
     * @param Int $service_status 状态
     * @param String $key_word 关键字-微信号-公司名
     */

    public function admin_search_count($province,$city,$district,$service_status,$key_word){
        $where= " AND 1=1";
        if($province){
            $where.=" AND service_province_code=".$province;
        }
        if($city){
            $where.=" AND service_city_code=".$city;
        }
/* 		if($district){
            $where.=" AND pattern_id=".$pattern_id;
} */
        if($service_status && $service_status !=0){
            $where.=" AND service_status=".$service_status;
        }
        return $this->db->query("SELECT service_id FROM t_service_info WHERE (service_company LIKE '%{$key_word}%' OR service_name LIKE '%{$key_word}%')".$where)->result();

    }

    /**
     * 根据条件搜索房间
     * @param Int $brand_id 品牌id
     * @param Int $series_id 系列id
     * @param Int $pattern_id 款式id
     * @param Int $code 品牌编号,平台编号
     * @param Int $key_word  关键词
     *
     */

    public function admin_search($province,$city,$district,$service_status,$key_word,$offset,$limit){
        $where= " AND 1=1";
        if($province){
            $where.=" AND service_province_code=".$province;
        }
        if($city){
            $where.=" AND service_city_code=".$city;
        }
/* 		if($district){
            $where.=" AND pattern_id=".$pattern_id;
} */
        if($service_status && $service_status !=0){
            $where.=" AND service_status=".$service_status;
        }
        return $this->db->query("SELECT * FROM t_service_info WHERE (service_company LIKE '%{$key_word}%' OR service_name LIKE '%{$key_word}%')".$where." ORDER BY service_id DESC LIMIT {$offset},{$limit}")->result();
    }

    public function getBrandByName($field,$where){
        return $this->db->select($field)->get_where('t_service_info',$where)->row();	
    }

    /**
     * 根据service_id 和 wid 来查找主键
     *
     * @PRIMARY KEY sw_id
     */
    public function getServiceList(){
        return $this->db->query("SELECT * FROM t_service_info where service_status <=3")->result();
        // return $this->db->select($field)->get_where('t_weixin',$where)->result();
    }

    /**
     *description:根据企业名称查询
     *author:yanyalong
     *date:2014/05/12
     */
    public function getServiceInfoByCompany($service_company){
        return $this->db->query("select * from t_service_info where service_company='$service_company' and service_status<81")->row();
    }
    /**
     *description:根据企业邮箱查询
     *author:yanyalong
     *date:2014/05/12
     */
    public function getServiceInfoByEmail($service_email){
        return $this->db->query("select * from t_service_info where service_email='$service_email' and service_status<81")->row();
    }

    /**
     * 根据 spreader_code 推广者标识
     *
     * @PRIMARY KEY ss_id
    */
    public function setIncrease($spreader_code,$field,$type,$where,$sorce){
        $set = ($type == 'up')?"$field=$field+$sorce":"$field=$field-$sorce";
        return $this->db->query("UPDATE t_service_info set {$set} WHERE {$where}='".$spreader_code."'");
    }

    /**
     * 根据条件得到单条记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getOne($field='service_id',$where)
    {
         return $this->db->select($field)->get_where('t_service_info',$where)->row();
    }   

    /**
     * 根据service_id 和 sr_id 来查找主键
     *
     * @PRIMARY KEY sw_id
    */
    public function getArray($field='service_id',$where){
        return $this->db->select($field)->get_where('t_service_info',$where)->result();
    }

    /**
     * 查询经销商的总条数 liuguangping
     * @param Int $province 省
     * @param Int $city 市
     * @param Int $district 区
     * @param Int $service_status 状态
     * @param String $key_word 关键字-微信号-公司名
     */

    public function code_search_count($province,$city,$district,$is_code,$key_word){
        $where= " AND 1=1";
        if($province){
            $where.=" AND s.service_province_code=".$province;
        }
        if($city){
            $where.=" AND s.service_city_code=".$city;
        }
        if($is_code == 2){
            $where.=" AND r.rr_card_number<>''";
        }elseif($is_code == 1){
            $where.=" AND r.rr_card_number =''";
        }
       
        return $this->db->query("SELECT s.service_id,s.service_company,s.service_province_code,s.service_city_code,p.ss_name,r.rr_grant_time,r.rr_card_number FROM t_service_info as s JOIN t_service_spreader as p ON s.spreader_code_source=p.spreader_code LEFT JOIN t_service_spreader_rebate_record as r ON r.service_id=s.service_id  WHERE p.ss_type=1 AND s.service_status=1 AND r.service_id <> '' AND (s.service_company LIKE '%$key_word%' OR p.ss_name LIKE '%$key_word%')".$where." ORDER BY s.service_id DESC")->result();

    }

    /**
     * 根据条件搜索房间
     * @param Int $brand_id 品牌id
     * @param Int $series_id 系列id
     * @param Int $pattern_id 款式id
     * @param Int $code 品牌编号,平台编号
     * @param Int $key_word  关键词
     *
     */

    public function code_search($province,$city,$district,$is_code,$key_word,$offset,$limit){
        $where= " AND 1=1";
        if($province){
            $where.=" AND s.service_province_code=".$province;
        }
        if($city){
            $where.=" AND s.service_city_code=".$city;
        }

        if($is_code == 2){
            $where.=" AND r.rr_card_number<>''";
        }elseif($is_code == 1){
            $where.=" AND r.rr_card_number =''";
        }
        return $this->db->query("SELECT s.service_id,s.service_company,s.service_province_code,s.service_city_code,p.ss_name,r.rr_grant_time,r.rr_card_number FROM t_service_info as s JOIN t_service_spreader as p ON s.spreader_code_source=p.spreader_code LEFT JOIN t_service_spreader_rebate_record as r ON r.service_id=s.service_id  WHERE p.ss_type=1 AND s.service_status=1 AND r.service_id <> '' AND (s.service_company LIKE '%$key_word%' OR p.ss_name LIKE '%$key_word%')".$where." ORDER BY s.service_id DESC LIMIT {$offset},{$limit}")->result();
    }

}
