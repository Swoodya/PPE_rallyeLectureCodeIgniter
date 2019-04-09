<?php

class RallyeModel extends CI_Model {
    public $ValidationRules=array(
        array('field'=>'dateDebut','label'=>'Date de début','rules'=>'required'),
        array('field'=>'duree','label'=>'Durée','rules'=>'required|integer'),
        array('field'=>'theme','label'=>'Thème','rules'=>'required|max_length[45]')
    );

    function __construct() {
        parent::__construct();
    }
    function get_all_livre($idRallye){
        $this->db->where('idRallye',$idRallye);
        $this->db->where_in('idlivre', ($this->db->get('comporter')->result_array()));
        return $this->db->get('livre')->result_array();
    }

    function get_rallye($id) {
        return $this->db->get_where('rallye',array('id'=>$id))->row_array();
    }

    function get_all_rallyes($idEleve=null) {
        if(isset($idEleve)){
            $this->db->where('idEleve',$idEleve);
            $this->db->where_in('idRallye', ($this->db->get('Participer')->result_array()));
        }
        return $this->db->get('rallye')->result_array();
    }

    function add_rallye($params) {
        $this->db->insert('rallye',$params);
        return $this->db->insert_id();
    }

    function update_rallye($id,$params) {
        $this->db->where('id',$id);
        $this->db->update('rallye',$params);
    }

    function delete_rallye($id) {
        $this->db->delete('rallye',array('id'=>$id));
    }

}