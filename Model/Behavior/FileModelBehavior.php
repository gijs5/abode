<?php  
/* 
 * Developed by The-Di-Lab 
 * www.the-di-lab.com 
 * www.startutorial.com 
 * contact at thedilab@gmail.com 
 * FileMode v2.0 support multiple fields 
 * http://www.startutorial.com/articles/view/12
 */ 
App::uses('Folder', 'Utility');
class FileModelBehavior extends ModelBehavior { 
    /** 
     * Model-specific settings 
     * @var array 
     */ 
    public $settings = array();     
    /** 
     * Setup 
     * @param unknown_type $model 
     * @param unknown_type $settings 
     */ 
    public function setup(Model $model, $config = array()) { 
        //Folder for setting up permission 
        if (!isset($this->Folder)) { 
            $this->Folder = new Folder(); 
        }
        //default settings 
        if (!isset($this->settings[$model->alias])) { 
            $this->settings[$model->alias] = array( 
                'file_db_file'=>array('filename'), 
                'file_field'=>array('file'), 
                'dir' => array('uploads'), 
                'overwrite'=>1, 
                'file_type_field'=>'filetype'
            ); 
        }
        $this->settings[$model->alias] = array_merge( 
            $this->settings[$model->alias], (array)$config 
        );
        //hold settings 
        $this->dir=$this->settings[$model->alias]['dir']; 
        $this->file_db_file=$this->settings[$model->alias]['file_db_file']; 
        $this->file_field=$this->settings[$model->alias]['file_field']; 
        $this->file_type_field=$this->settings[$model->alias]['file_type_field']; 
        $this->uploads=array(); 
        $this->overwrite=$this->settings[$model->alias]['overwrite']; 
    }     

    //call back 
    public function afterSave(Model $Model,$created){ 
        //callback only if there is a file attached 
        if($this->_hasUploads($Model)){                 
                //save 
                if($created){ 
                    $id=$Model->getLastInsertId();     
                //update 
                }else{
                    //overwrite 
                    if($this->overwrite){         
                        $oldFile=$Model->find('first',array('contain'=>false, 'conditions'=>array($Model->alias.".".$Model->primaryKey=>$Model->data[$Model->alias][$Model->primaryKey])));
                        //delete all of the old files 
                        for($i=0;$i<sizeof($this->uploads);$i++){ 
                            $this->_delete($oldFile[$Model->alias][$this->file_db_file[$this->uploads[$i]]],$oldFile[$Model->alias][$Model->primaryKey],$this->uploads[$i]);
                        }
                    }
                    $id=$Model->data[$Model->alias][$Model->primaryKey];
                }
                
                //upload files         
                $uploadOk=true; 
                for($i=0;$i<sizeof($this->uploads);$i++){ 
                    $thisUploadOk = $this->_upload($Model->data[$Model->alias][$this->file_field[$this->uploads[$i]]],$id,$this->uploads[$i]); 
                    $uploadOk=$uploadOk*$thisUploadOk; 
                    //get file name first
                    $filename = $Model->data[$Model->alias][$this->file_field[$this->uploads[$i]]]['name'];
                    $filetype = pathinfo($filename, PATHINFO_EXTENSION);
                    //assign file name to updateModel 
                    $updateM[$Model->alias][$Model->primaryKey]=$id; 
                    $updateM[$Model->alias][$this->file_type_field[$this->uploads[$i]]] = $filetype;
                    $updateM[$Model->alias][$this->file_db_file[$this->uploads[$i]]]=$id.'_'.$this->_formatFilename($filename);
                } 
                 
                if($uploadOk){ 
                        return $this->_customizedSave($Model,$updateM); 
                }else{ 
                        echo 'Upload failed,please try again.'; 
                        return false; 
                } 
                 
        }else{ 
                return true; 
        } 
    }     
    //call back 
    public function beforeDelete(Model $Model, $cascade = true){ 
        $data = $Model->read(null,$Model->id); 
        if (!empty($data[$Model->alias]['id'])) { 
                for($i=0;$i<sizeof($this->file_db_file);$i++){ 
                    $this->_delete($data[$Model->alias][$this->file_db_file[$i]],$data[$Model->alias][$Model->primaryKey],$i); 
                }
        }
        return true;
    } 
    //check if there is any uploads 
    private function _hasUploads($Model){ 
        //clear first 
        unset($this->uploads); 
        $this->uploads=array(); 
        for($i=0;$i<sizeof($this->file_field);$i++){ 
            //print_r($Model->data[$Model->alias]); 
            if(isset($Model->data[$Model->alias][$this->file_field[$i]]['size'])&& 
                    $Model->data[$Model->alias][$this->file_field[$i]]['size']!=0){ 
                        array_push($this->uploads,$i); 
            } 
        } 
        if(sizeof($this->uploads)==0){ 
            return false; 
        } 
        return true; 
    } 
    private function _noUploads($Model){ 
        for($i=0;$i<sizeof($this->file_field);$i++){ 
            $Model->data[$Model->alias][$this->file_field[$i]]['size']=0; 
        } 
    } 
    private function _delete($filename,$id,$dirIndex){ 
        $path=WWW_ROOT.$this->dir[$dirIndex].DS.$filename; 
        if (null!=$filename&&file_exists($path)) { 
            clearstatcache(); 
            return unlink($path); 
        }else{ 
            return false; 
        } 
    }     
    private function _customizedSave(&$Model,$modelDate){         
        //this will prevent it from calling the callback     
        $this->_noUploads($Model); 
        return $Model->save($modelDate); 
    }     
    private function _upload($file,$id,$dirIndex){         
        if($this->_validate($file)){
            $des=WWW_ROOT.$this->dir[$dirIndex].DS.$id.'_'.$this->_formatFilename($file['name']);
            if (move_uploaded_file($file['tmp_name'], $des)) {  
                return true; 
            }else if (copy($file['tmp_name'],$des)) {  
                return true; 
            }else{ 
                return false; 
            } 
        }else{ 
                return false; 
        } 
         
    }
    //give your own validation logic here 
    private function _validate($file){ 
        return true; 
    } 
    
    private function _formatFilename($filename) {
    	$filetype = pathinfo($filename, PATHINFO_EXTENSION);
    	$filename = str_replace('.'.$filetype, '', $filename);
    	return Inflector::underscore(Inflector::slug($filename)).'.'.$filetype;
    }

         
} 
?>