# Laravel task list

This project user

- laravel
- Laravel-data
- Laravel-openapi
- Laravel-ide-helper
- php-cs-fixer

To prepare project to startup execute

```shell
git clone https://github.com/hanterrian/laravel_todo_list.git
cd laravel_todo_list
cp .env.docker .env
```

Installing composer dependencies

```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

Startup sail

```shell
./vendor/bin/sail up -d
```

# Project structure

```
.
├── app
|   ├── Console
|   |   └── Kernel.php
|   ├── Data
|   |   ├── LoginData.php
|   |   ├── TaskData.php
|   |   └── TaskFilterData.php
|   ├── Enums
|   |   └── TaskStatusEnum.php
|   ├── Exceptions
|   |   └── Handler.php
|   ├── Filters
|   |   ├── QueryFilter.php
|   |   └── TaskQueryFilter.php
|   ├── Http
|   |   ├── Controllers
|   |   ├── Middleware
|   |   ├── Requests
|   |   └── Kernel.php
|   ├── Interfaces
|   |   ├── Repository
|   |   |   └── TaskListRepositoryInterface.php
|   |   └── Service
|   |       ├── AuthServiceInterface.php
|   |       └── TaskListServiceInterface.php
|   ├── Models
|   |   ├── Scopes
|   |   |   └── OwnerScope.php
|   |   ├── Task.php
|   |   └── User.php
|   ├── Observers
|   |   └── TaskObserver.php
|   ├── OpenApi
|   |   ├── Parameters
|   |   |   ├── TaskIdParameters.php
|   |   |   └── TaskListFilterParameters.php
|   |   ├── RequestBodies
|   |   |   ├── LoginDataRequestBody.php
|   |   |   └── TaskDataRequestBody.php
|   |   ├── Responses
|   |   |   ├── Error
|   |   |   |   ├── ErrorForbiddenResponse.php
|   |   |   |   ├── ErrorNotFoundResponse.php
|   |   |   |   ├── ErrorUnauthenticatedResponse.php
|   |   |   |   └── ErrorValidationResponse.php
|   |   |   ├── DummyResponse.php
|   |   |   ├── FormTaskResponse.php
|   |   |   ├── ListTaskResponse.php
|   |   |   ├── LoginResponse.php
|   |   |   └── TaskResponse.php
|   |   ├── Schemas
|   |   |   ├── EmptySchema.php
|   |   |   ├── LoginSchema.php
|   |   |   ├── LoginUserSchema.php
|   |   |   ├── TaskFormSchema.php
|   |   |   ├── TaskListSchema.php
|   |   |   └── TaskSchema.php
|   |   └── SecuritySchemes
|   |       └── BearerToken.php
|   ├── Providers
|   |   ├── AppServiceProvider.php
|   |   ├── AuthServiceProvider.php
|   |   ├── BroadcastServiceProvider.php
|   |   ├── EventServiceProvider.php
|   |   ├── RepositoryServiceProvider.php
|   |   └── RouteServiceProvider.php
|   ├── Repositories
|   |   └── TaskListRepository.php
|   └── Services
|       ├── AuthService.php
|       └── TaskListService.php
.
```
