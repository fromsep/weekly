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