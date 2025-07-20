<?php

namespace App\Services;
use App\Interfaces\TabDataInterface;

class TabDataService implements TabDataInterface {

    private $activeTab;
    private $data;

    public function __construct($activeTab, $data = [])
    {
        $this->activeTab = $activeTab;
        return $this->data = $data;
    }

    public function getActiveTab()
    {
        return $this->activeTab;
    }

    public function getCreateRoleData(){
        return $this->data['createRole'] ?? []; 
    }

     public function getCreatePermissionData(){
        return $this->data['createPermission'] ?? [];
    }

    public function getRoleListData(){
        return $this->data['rolesList'] ?? [];
    }   

    public function getAssignRoleData(){
        return $this->data['assignRole'] ?? [];
    }

    public function getUserRolesData(){
        return $this->data['userRoles'] ?? [];
    }

    public function getAssignPermissionData(){
        return $this->data['assignPermission'] ?? [];
    }

   


   
    

}