<?php

namespace App\Interfaces;


interface TabDataInterface{
    public function getCreateRoleData();
    public function getRoleListData();
    public function getAssignRoleData();
    public function getUserRolesData();
    public function getActiveTab();
    // public function getMessage();
    // public function getErrors();
    // public function getUsers();
    // public function getRoles();
    // public function getTemplate();
    // public function getContentFile();
    // public function getPageTitle();
    // public function getData();
    // public function render();
    // public function isActiveTab($tabName);
    // public function isActiveTabPanel($tabName);         
}