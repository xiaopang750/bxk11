<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/03/19 18:31:59 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_service_brands_apply_model extends CI_Model
{
    /**
     * @COLUMN_KEY		PRI
     * @DATA_TYPE		int
     * @IS_NULLABLE		NO
     * @COLUMN_DEFAULT	
     * @COLUMN_TYPE		int(11)
     * @EXTRA			auto_increment
     * @COLUMN_COMMENT	
     */
    public $apply_id;

    /**
     * @COLUMN_KEY		
     * @DATA_TYPE		int
     * @IS_NULLABLE		YES
     * @COLUMN_DEFAULT	
     * @COLUMN_TYPE		int(11)
     * @EXTRA			
     * @COLUMN_COMMENT	
     */
    public $service_id;

    /**
     * @COLUMN_KEY		
     * @DATA_TYPE		int
     * @IS_NULLABLE		YES
     * @COLUMN_DEFAULT	
     * @COLUMN_TYPE		int(11)
     * @EXTRA			
     * @COLUMN_COMMENT	
     */
    public $brand_id;

    /**
     * @COLUMN_KEY		
     * @DATA_TYPE		varchar
     * @IS_NULLABLE		NO
     * @COLUMN_DEFAULT	
     * @COLUMN_TYPE		varchar(50)
     * @EXTRA			
     * @COLUMN_COMMENT	
     */
    public $apply_brand_name;

    /**
     * @COLUMN_KEY		
     * @DATA_TYPE		varchar
     * @IS_NULLABLE		NO
     * @COLUMN_DEFAULT	
     * @COLUMN_TYPE		varchar(50)
     * @EXTRA			
     * @COLUMN_COMMENT	
     */
    public $apply_brand_ename;

    /**
     * @COLUMN_KEY		
     * @DATA_TYPE		varchar
     * @IS_NULLABLE		NO
     * @COLUMN_DEFAULT	
     * @COLUMN_TYPE		varchar(255)
     * @EXTRA			
     * @COLUMN_COMMENT	
     */
    public $apply_brand_img;

    /**
     * @COLUMN_KEY		
     * @DATA_TYPE		text
     * @IS_NULLABLE		NO
     * @COLUMN_DEFAULT	
     * @COLUMN_TYPE		text
     * @EXTRA			
     * @COLUMN_COMMENT	
     */
    public $apply_license_file;

    /**
     * @COLUMN_KEY		
     * @DATA_TYPE		timestamp
     * @IS_NULLABLE		NO
     * @COLUMN_DEFAULT	CURRENT_TIMESTAMP
     * @COLUMN_TYPE		timestamp
     * @EXTRA			on update CURRENT_TIMESTAMP
     * @COLUMN_COMMENT	
     */
    public $apply_license_begin;

    /**
     * @COLUMN_KEY		
     * @DATA_TYPE		timestamp
     * @IS_NULLABLE		NO
     * @COLUMN_DEFAULT	0000-00-00 00:00:00
     * @COLUMN_TYPE		timestamp
     * @EXTRA			
     * @COLUMN_COMMENT	
     */
    public $apply_license_end;

    /**
     * @COLUMN_KEY		
     * @DATA_TYPE		smallint
     * @IS_NULLABLE		NO
     * @COLUMN_DEFAULT	
     * @COLUMN_TYPE		smallint(6)
     * @EXTRA			
     * @COLUMN_COMMENT	
     */
    public $apply_status;

    /**
     * @COLUMN_KEY		
     * @DATA_TYPE		text
     * @IS_NULLABLE		NO
     * @COLUMN_DEFAULT	
     * @COLUMN_TYPE		text
     * @EXTRA			
     * @COLUMN_COMMENT	
     */
    public $apply_brand_seodesc;

    /**
     * @COLUMN_KEY		
     * @DATA_TYPE		text
     * @IS_NULLABLE		NO
     * @COLUMN_DEFAULT	
     * @COLUMN_TYPE		text
     * @EXTRA			
     * @COLUMN_COMMENT	
     */
    public $apply_laudit_desc;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * 根据主键获取单条记录
     *
     * @PRIMARY KEY apply_id
     *
     * @return 对象
     */
    public function get($apply_id)
    {
        return $this->db->get_where('t_service_brands_apply',array('apply_id' => $apply_id))->row();
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
     * get_list(10,0) =>	select * from t_service_brands_apply limit 0,10
     */
    public function get_list($limit = 10, $offset = 0, $order_field = 'apply_id', $order_type = 'ASC')
    {
        $this->db->order_by($order_field, $order_type);
        return $this->db->get('t_service_brands_apply', $limit, $offset)->result();
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
    public function get_all($order_field = 'apply_id', $order_type = 'ASC')
    {
        $this->db->order_by($order_field, $order_type);
        return $this->db->get('t_service_brands_apply')->result();
    }

    /**
     * 获取表中所有记录的行数，用于分页 
     */
    public function count_all()
    {
        return $this->db->count_all('t_service_brands_apply');
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
    public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'apply_id', $order_type = 'ASC')
    {
        $this->db->from('t_service_brands_apply')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
        $this->db->from('t_service_brands_apply')->like($field_name, $keywords);
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
        $this->db->insert('t_service_brands_apply', $this);
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
        return $this->db->update('t_service_brands_apply', $this, array('apply_id' => $post['apply_id']));
    }

    /**
     * 确认数据库表中的不能为空的列是否存在于$post数组中
     */
    private function validation_db_is_not_nullable_rules_by_insert($post)
    {
        if(!isset($post['apply_brand_name']) || empty($post['apply_brand_name'])) return false;
        if(!isset($post['apply_brand_ename']) || empty($post['apply_brand_ename'])) return false;
        if(!isset($post['apply_brand_img']) || empty($post['apply_brand_img'])) return false;
        if(!isset($post['apply_license_file']) || empty($post['apply_license_file'])) return false;
        if(!isset($post['apply_license_begin']) || empty($post['apply_license_begin'])) return false;
        if(!isset($post['apply_license_end']) || empty($post['apply_license_end'])) return false;
        if(!isset($post['apply_status']) || empty($post['apply_status'])) return false;

        return true;
    }

    /**
     * 确认数据库表中的不能为空的列是否存在于$post数组中
     */
    private function validation_db_is_not_nullable_rules_by_update($post)
    {
        if(!isset($post['apply_id']) || empty($post['apply_id'])) return false;
        if(!isset($post['apply_brand_name']) || empty($post['apply_brand_name'])) return false;
        if(!isset($post['apply_brand_ename']) || empty($post['apply_brand_ename'])) return false;
        if(!isset($post['apply_brand_img']) || empty($post['apply_brand_img'])) return false;
        if(!isset($post['apply_license_file']) || empty($post['apply_license_file'])) return false;
        if(!isset($post['apply_license_begin']) || empty($post['apply_license_begin'])) return false;
        if(!isset($post['apply_license_end']) || empty($post['apply_license_end'])) return false;
        if(!isset($post['apply_status']) || empty($post['apply_status'])) return false;

        return true;
    }

    /**
     * 根据主键删除单条记录
     *
     * @PRIMARY KEY apply_id
     */
    public function delete($apply_id)
    {
        return $this->db->delete('t_service_brands_apply',array('apply_id' => $apply_id));
    }

    /**
     * 根据主键获取单条记录
     *
     * @PRIMARY KEY s_class_id
     *
     * @return 对象
     */
    public function get_tag($field='apply_id',$where)
    {
        return $this->db->select($field)->get_where('t_service_brands_apply',$where)->result_array();
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
        return $this->db->update('t_service_brands_apply',$data,$where)?true:false;
    }

    /**
     * 根据分类id，标签id和款式名 搜索款式条数
     * @param Int $s_tag_id
     * @param Int $s_class_id
     * @param String $pattern_type
     */
    public function admin_search_count($service_id,$brand_name,$apply_status){
        $where= "1=1";
        if($service_id){
            $where.=" AND service_id=".$service_id;
        }
        if($apply_status){
            $where.=" AND apply_status=".$apply_status;
        }

        return $this->db->query("SELECT * FROM t_service_brands_apply WHERE ".$where." AND (apply_brand_name LIKE '%{$brand_name}%' OR apply_brand_ename LIKE '%{$brand_name}%')")->result();
    }

    /**
     * 根据分类id，标签id和款式名 搜索款式
     * @param Int $s_tag_id
     * @param Int $s_class_id
     * @param String $pattern_type
     * @param Int $offset
     * @param Int $limit
     */
    public function admin_search($service_id,$brand_name,$apply_status,$offset,$limit){
        $where= "1=1";
        if($service_id){
            $where.=" AND service_id=".$service_id;
        }
        if($apply_status){
            $where.=" AND apply_status=".$apply_status;
        }

        return $this->db->query("SELECT * FROM t_service_brands_apply WHERE ".$where." AND (apply_brand_name LIKE '%{$brand_name}%' OR apply_brand_ename LIKE '%{$brand_name}%') ORDER BY apply_id DESC LIMIT {$offset},{$limit}")->result();

    }

    //某个服务商下品牌与门店未关联
    public function getBrandsBySericeId($service_id,$apply_status,$shop_id){

        return $this->db->query("SELECT * FROM t_service_brands_apply WHERE apply_status NOT IN ( {$apply_status} ) AND service_id={$service_id} AND brand_id NOT IN (SELECT brand_id FROM t_service_shop_brands WHERE shop_id={$shop_id})")->result();
    }

    //某个服务商下品牌与门店未	关联
    public function getBrandsPageBySericeId($service_id,$apply_status,$shop_id,$offset,$limit){
        return $this->db->query("SELECT * FROM t_service_brands_apply WHERE apply_status NOT IN ( {$apply_status} ) AND service_id={$service_id} AND brand_id NOT IN (SELECT brand_id FROM t_service_shop_brands WHERE shop_id={$shop_id}) ORDER BY apply_id DESC LIMIT {$offset},{$limit}")->result();
    }

    /**
     *description:获取经销商经营品牌
     *author:yanyalong
     *date:2014/03/26
     */
    public function getBrandsListByUid($service_id){
        return $this->db->query("SELECT * FROM t_service_brands_apply where service_id=$service_id and apply_status<20 and apply_status<>3")->result();
    }

    /**
     * 根据服务商标识和品牌名得到经销商没有关联的品牌
     * @param Int $service_id
     * @param Int $s_class_id
     * @param String $pattern_type
     */
    public function systemSeB_search_count($service_id,$key_word){
        $where= "1=1";
        if($service_id){
            $where.=" AND service_id=".$service_id;
        }

        return $this->db->query("SELECT * FROM t_product_brands WHERE brand_id NOT IN (SELECT p.brand_id FROM t_product_brands as p JOIN t_service_brands_apply as s ON p.brand_id=s.brand_id WHERE ".$where.") AND brand_name LIKE '%{$key_word}%'")->result();
    }

    /**
     * 根据分类id，标签id和款式名 搜索款式
     * @param Int $s_tag_id
     * @param Int $s_class_id
     * @param String $pattern_type
     * @param Int $offset
     * @param Int $limit
     */
    public function systemSeB_search($service_id,$key_word,$offset,$limit){
        $where= "1=1";
        if($service_id){
            $where.=" AND service_id=".$service_id;
        }
        return $this->db->query("SELECT * FROM t_product_brands WHERE brand_id NOT IN (SELECT p.brand_id FROM t_product_brands as p JOIN t_service_brands_apply as s ON p.brand_id=s.brand_id WHERE ".$where.") AND brand_name LIKE '%{$key_word}%' ORDER BY brand_id DESC LIMIT {$offset},{$limit}")->result();

    }
    /**
     *description:获取经销商下所有品牌
     *author:yanyalong
     *date:2014/04/03
     */
    public function getApplyBrandsByServiceId($service_id,$apply_status,$p="",$row=""){
        $limit = "";
        if($p!=""&&$row!=""){
            $limit = ' limit '.($p-1)*$row.','.$row;
        }
        $where = "";
        if($apply_status!="")
            $where = " and  apply_status in ($apply_status) ";
        $this->db->query("update t_service_brands_apply set apply_status=12 where service_id=$service_id and apply_status=1 and (unix_timestamp(apply_license_end)+24*3600-1)<unix_timestamp()");
        return $this->db->query("select * from t_service_brands_apply where service_id=$service_id $where order by apply_id desc $limit")->result();
    }
    /**
     *description:获取经销商加盟品牌申请信息
     *author:yanyalong
     *date:2014/05/05
     */
    public function getApplyByServiceJoin($service_id,$apply_status=""){
        $where_apply_status = "";
        if($apply_status!="") $where_apply_status = " and apply_status=$apply_status ";
        $res =  $this->db->query("select * from t_service_brands_apply where service_id=$service_id $where_apply_status limit 1")->row();
        if($res==false) return false;
        else  return $this->db->query("select * from t_service_brands_apply sba left join t_product_brands pb on sba.brand_id=pb.brand_id where service_id=$service_id $where_apply_status limit 1")->row();
    }

    /**
     * 根据条件得到单条记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getOne($field='apply_id',$where)
    {
         return $this->db->select($field)->get_where('t_service_brands_apply',$where)->row();
    }   

    /**
     * 根据service_id 和 wid 来查找主键
     *
     * @PRIMARY KEY sw_id
    */
    public function getArray($field='apply_id',$where){
        return $this->db->select($field)->get_where('t_service_brands_apply',$where)->result();
    }
    /**
     *description:获取经销商品牌信息
     *author:yanyalong
     *date:2014/03/26
     */
    public function getServiceBrandInfo(){
        return $this->db->query("select * from t_service_brands_apply where apply_brand_name='$this->apply_brand_name' and service_id='$this->service_id'")->row();
    }
}
