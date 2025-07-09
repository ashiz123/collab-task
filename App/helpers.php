<?php

function isActiveTab(string $tabName): string {
    $currentTab = $_GET['tab'] ?? 'create-role';
    return $currentTab === $tabName ? 'active show' : '';
}


function isActiveTabPanel(string $tabName) : string {
    $currentTab = $_GET['tab'] ?? 'create-role';
    return $currentTab === $tabName ? 'active show' : '';
}