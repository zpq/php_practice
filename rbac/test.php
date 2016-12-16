<?php
require "../vendor/autoload.php";

use rbac\src\CRbac;
use rbac\src\CItem;
use rbac\src\CRole;
use rbac\src\CUser;

// $cuser = new CUser;
// $user1 = $cuser->addUser(
//     array(
//         'username' => "jack",
//         'password' => '123456',
//     )
// );
// $user2 = $cuser->addUser(
//     array(
//         'username' => "mary",
//         'password' => '123456'
//     )
// );


// $crole = new CRole;
// $role1 = $crole->addRole(
//     array(
//         'name' => 'bm',
//         'type' => '1',
//         'description' => 'bussiness manager',
//         'freeze' => 0
//     )
// );
// $role2 = $crole->addRole(
//     array(
//         'name' => 'test',
//         'type' => '2',
//         'description' => 'test user',
//         'freeze' => 0
//     )
// );
// $crole->attachRoleForUser(9, 9);
// $crole->attachRoleForUser(10, 10);


// $citem = new CItem;
// $item_id = $citem->addItem(
//     array(
//         'name' => 'view_user_list',
//         'description' => 'allow role to view user lists'
//     )
// );
// $citem->attachItemForRole(4, 9); 

$crbac = new CRbac;
var_dump($crbac->checkAccess(9, 4));
var_dump($crbac->checkAccess(10, 4));
