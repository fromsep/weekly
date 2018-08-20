## weekly

### 1. 路由

```
+--------+---------------+------------------------+-------------------+------------------------------------------------------------------------+---------------------+
| Domain | Method        | URI                    | Name              | Action                                                                 | Middleware          |
+--------+---------------+------------------------+-------------------+------------------------------------------------------------------------+---------------------+
|        | GET|HEAD      | /                      |                   | App\Http\Controllers\AssignmentController@recent                       | web,auth,checkGroup |
|        | GET|HEAD      | api/hello              |                   | Closure                                                                | api                 |
|        | GET|HEAD      | api/user               |                   | Closure                                                                | api,auth:api        |
|        | GET|HEAD      | assignment             |                   | App\Http\Controllers\AssignmentController@index                        | web,auth,checkGroup |
|        | POST|GET|HEAD | assignment/add         | assignment.add    | App\Http\Controllers\AssignmentController@add                          | web,auth,checkGroup |
|        | GET|HEAD      | assignment/delete/{id} |                   | App\Http\Controllers\AssignmentController@delete                       | web,auth,checkGroup |
|        | GET|HEAD      | assignment/detail/{id} |                   | App\Http\Controllers\AssignmentController@detail                       | web,auth,checkGroup |
|        | GET|HEAD      | assignment/edit/{id}   |                   | App\Http\Controllers\AssignmentController@edit                         | web,auth,checkGroup |
|        | GET|HEAD      | assignment/recent      | assignment.recent | App\Http\Controllers\AssignmentController@recent                       | web,auth,checkGroup |
|        | POST          | assignment/update      | assignment.update | App\Http\Controllers\AssignmentController@update                       | web,auth,checkGroup |
|        | GET|HEAD      | group                  | group.select      | App\Http\Controllers\Auth\GroupController@select                       | web,auth            |
|        | POST          | group/update           | group.update      | App\Http\Controllers\Auth\GroupController@update                       | web,auth            |
|        | GET|HEAD      | home                   | home              | App\Http\Controllers\HomeController@index                              | web,auth            |
|        | GET|HEAD      | login                  | login             | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest           |
|        | POST          | login                  |                   | App\Http\Controllers\Auth\LoginController@login                        | web,guest           |
|        | POST          | logout                 | logout            | App\Http\Controllers\Auth\LoginController@logout                       | web                 |
|        | POST          | password/email         | password.email    | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web,guest           |
|        | POST          | password/reset         |                   | App\Http\Controllers\Auth\ResetPasswordController@reset                | web,guest           |
|        | GET|HEAD      | password/reset         | password.request  | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web,guest           |
|        | GET|HEAD      | password/reset/{token} | password.reset    | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web,guest           |
|        | GET|HEAD      | register               | register          | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest           |
|        | POST          | register               |                   | App\Http\Controllers\Auth\RegisterController@register                  | web,guest           |
|        | GET|HEAD      | test                   |                   | App\Http\Controllers\HomeController@test                               | web,auth            |
+--------+---------------+------------------------+-------------------+------------------------------------------------------------------------+---------------------+
```

### 2. 每周一自动发送邮件任务

```
php artisan weekly:post          每周一发送邮件
```

### 3. 表

```
-- 用户表
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '群组id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 用户重置密码表

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- 用户群组表
CREATE TABLE `UserGroup` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(16) CHARACTER SET gbk NOT NULL COMMENT '组名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户群组表';

-- 用户工作任务表
CREATE TABLE `Assignment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL COMMENT '用户id',
  `title` varchar(128) NOT NULL COMMENT '任务',
  `schedule` enum('planning','reviewing','developing','launched','end') DEFAULT 'planning' COMMENT '进度',
  `completion_rate` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '完成百分比',
  `review_date` datetime NOT NULL COMMENT '评审日期',
  `development_date` datetime NOT NULL COMMENT '开发日期',
  `testing_date` datetime NOT NULL COMMENT '提测日期',
  `launch_date` datetime NOT NULL COMMENT '上线日期',
  `collaborators` varchar(256) DEFAULT '' COMMENT '合作人员',
  `remarks` varchar(256) DEFAULT NULL COMMENT '备注',
  `delete` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除',
  `status` enum('posted','none') NOT NULL DEFAULT 'none' COMMENT '状态',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`) USING BTREE,
  KEY `idx_create_time` (`create_time`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='任务表';

```
