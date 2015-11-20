<?php
/**
 * Created by Tim.
 * User: Tim
 * Date: 2015/9/18
 * Time: 10:23
 */

abstract class Model_basemodel extends MY_Model{
    protected $_time;
    protected $_tableName;
    protected $_region;
    protected abstract function setTableName();
    function __construct() {
//        $this->load->driver('cache',array('adapter'=>'redis'));
        $this->load->database();
        $this->setTableName();
        $this->_time = time();
    }

    //select one
    /*
     *
     */
    public function getOne($condition=array(), $item='*'){
        if($this->config->item('my_redis')){
            if($this->cache->redis->is_supported()){
                $Rkey  = md5('getone'.__FILE__.$this->_tableName.serialize(func_get_args()));
                $Rdata = $this->cache->redis->get($Rkey);
                if($Rdata){
                    return $Rdata?$Rdata[0]:$Rdata;
                }else{
                    $data = $this->db->select($item)->where($condition)->limit(1)->get($this->_tableName)->result_array();
                    $this->cache->redis->save($Rkey,$data,null);
                    return $data?$data[0]:$data;
                }
            }
        }
        $data = $this->db->select($item)->where($condition)->limit(1)->get($this->_tableName)->result_array();
        return $data?$data[0]:$data;
    }

    //select list
    public function getList($condition, $item='*',$orderby='', $limit=0,$page=1){
        $page = $page<1 ? 1 : $page;
        if($this->config->item('my_redis')){
            if($this->cache->redis->is_supported()){
                $Rkey  = md5('getList'.__FILE__.$this->_tableName.serialize(func_get_args()));
                $Rdata = $this->cache->redis->get($Rkey);
                if($Rdata){
                    return $Rdata;
                }else{
                    $query = $this->db->select($item)->where($condition)->order_by($orderby)->limit($limit,($page-1)*$limit)->get($this->_tableName);
                    $data['data'] = $query->result_array();
                    $data['result_nums'] = $query->num_rows();
                    $this->cache->redis->save($Rkey,$data,null);
                    return $data;
                }
            }
        }
        $query = $this->db->select($item)->where($condition)->order_by($orderby)->limit($limit,($page-1)*$limit)->get($this->_tableName);
        $data['data'] = $query->result_array();
        $data['result_nums'] = $query->num_rows();
        return $data;
    }

    //get count
    public function getCount($condition='') {
        if($condition){
            $this->db->where($condition);
        }
        $this->db->from($this->_tableName);
        return $this->db->count_all_results(); // Produces an integer, like 17
    }

    //insert
    public  function insert($data){
        $this->db->insert($this->_tableName, $data);
        return $this->db->insert_id();
    }

    public function update($data,$where,$bool=true) {
        if($bool){
            return $this->db->update($this->_tableName, $data, $where);
        }
        $this->db->where($where);
        foreach($data as $key=>$val){
            $this->db->set($key,$val,false);
        }
        return $this->db->update($this->_tableName);
    }

    private function test() {
        echo "<p>This is abstract baseModel</p>";
    }
}