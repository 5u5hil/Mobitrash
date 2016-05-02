<?php

$adminConstants = [

    'adminView' => 'admin.pages',
    'adminSystemUsersView' => 'admin.pages.acl.system_users',
    'adminUsersView' => 'admin.pages.acl.users',
    'adminRoleView' => 'admin.pages.acl.roles',
    'adminCityView' => 'admin.pages.masters.cities',
    'adminFrequencyView' => 'admin.pages.masters.frequency',
    'adminTimeslotView' => 'admin.pages.masters.timeslot',
    'adminServicetypeView' => 'admin.pages.masters.servicetype',
    'adminWastetypeView' => 'admin.pages.masters.wastetype',
    'adminFueltypeView' => 'admin.pages.masters.fueltype',
    'adminAdditiveView' => 'admin.pages.masters.additive',
    'adminRecordtypeView' => 'admin.pages.masters.recordtype',
    'adminSubscriptionView' => 'admin.pages.subscription',
    'adminRenewalView' => 'admin.pages.subscription',
    'adminScheduleView' => 'admin.pages.schedule',
    'adminAssetView' => 'admin.pages.assets',
    'adminRecordView' => 'admin.pages.record',
    'adminServiceHistoryView' => 'admin.pages.servicehistory',
    'adminPackageView' => 'admin.pages.masters.package',
    'adminOccupancyView' => 'admin.pages.masters.occupancy',
    'paginateNo' => 20,
    'uploadRecord'=>'/public/uploads/records/',
    'uploadAttendance'=>'/public/uploads/attendance/',
    'uploadProfile'=>'/public/uploads/profile/',
    'pipedriveApiToken'=>'0fbf69c98241b4dcc270bba263269c2fd6950f25'
];


$frontendConstants = [
    'frontendView' => 'frontend.pages',
    'frontendEmail' => 'frontend.emails',
];


return array_merge($frontendConstants, $adminConstants);
?>