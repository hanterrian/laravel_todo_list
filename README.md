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

Setup database & seed

```shell
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed
```

Seed create 10 random user and one main (main@localhost.loc | password), and 30 root task,
then 300 sub-tasks with random parent

# Project structure

```
.
├── app
|   ├── Console
|   |   └── Kernel.php
|   ├── Data
|   |   ├── LoginData.php                               # Login DTO
|   |   ├── TaskData.php                                # Task DTO
|   |   └── TaskFilterData.php                          # Task filter DTO
|   ├── Enums
|   |   └── TaskStatusEnum.php                          # Task statuses enum
|   ├── Exceptions
|   |   └── Handler.php
|   ├── Filters
|   |   ├── QueryFilter.php                             # Main query filter to model
|   |   └── TaskQueryFilter.php                         # Task list filter
|   ├── Http
|   |   ├── Controllers
|   |   |   ├── Api
|   |   |   |   └── Auth
|   |   |   |   |   ├── LoginController.php             # Login single controller
|   |   |   |   |   └── LogoutController.php            # Logout single controller
|   |   |   |   └── TasksController.php                 # Tasks CRUD controller
|   |   |   └── Controller.php                          # Main app controller
|   |   ├── Middleware
|   |   |   ├── Authenticate.php
|   |   |   ├── EncryptCookies.php
|   |   |   ├── EnsureEmailIsVerified.php
|   |   |   ├── ForceJsonResponse.php
|   |   |   ├── PreventRequestsDuringMaintenance.php
|   |   |   ├── RedirectIfAuthenticated.php
|   |   |   ├── TrimStrings.php
|   |   |   ├── TrustHosts.php
|   |   |   ├── TrustProxies.php
|   |   |   ├── ValidateSignature.php
|   |   |   └── VerifyCsrfToken.php
|   |   └── Kernel.php
|   ├── Interfaces
|   |   ├── Repository
|   |   |   └── TaskListRepositoryInterface.php         # Interface to tasks repository
|   |   └── Service
|   |       ├── AuthServiceInterface.php                # Interface to authenticate service
|   |       └── TaskListServiceInterface.php            # Interface to tasks service
|   ├── Models
|   |   ├── Scopes
|   |   |   └── OwnerScope.php                          # Scope to select only owners tasks
|   |   ├── Task.php                                    # Task model
|   |   └── User.php                                    # User model
|   ├── Observers
|   |   └── TaskObserver.php                            # Observer to add owner id from Auth::id() by created task
|   ├── OpenApi                                         # Classes to generate OpenApi documentation
|   |   ├── Parameters
|   |   |   ├── TaskIdParameters.php                    # OpenApi task "id" parameter
|   |   |   └── TaskListFilterParameters.php            # OpenApi tasks list filter parameter
|   |   ├── RequestBodies
|   |   |   ├── LoginDataRequestBody.php                # OpenApi login request
|   |   |   └── TaskDataRequestBody.php                 # OpenApi create/update request
|   |   ├── Responses
|   |   |   ├── Error
|   |   |   |   ├── ErrorForbiddenResponse.php          # OpenApi 401 error response
|   |   |   |   ├── ErrorNotFoundResponse.php           # OpenApi 404 error response
|   |   |   |   ├── ErrorUnauthenticatedResponse.php    # OpenApi 401 error response
|   |   |   |   └── ErrorValidationResponse.php         # OpenApi 422 error response
|   |   |   ├── DummyResponse.php                       # OpenApi dummy/empty response
|   |   |   ├── FormTaskResponse.php                    # OpenApi create/update action response
|   |   |   ├── ListTaskResponse.php                    # OpenApi task list action rasponse
|   |   |   ├── LoginResponse.php                       # OpenApi login action response
|   |   |   └── TaskResponse.php                        # OpenApi task action response
|   |   ├── Schemas
|   |   |   ├── EmptySchema.php                         # OpenApi empty response schema
|   |   |   ├── LoginSchema.php                         # OpenApi access token response schema
|   |   |   ├── LoginUserSchema.php                     # OpenApi user credential schema
|   |   |   ├── TaskFormSchema.php                      # OpenApi create/update task body schema
|   |   |   ├── TaskListSchema.php                      # OpenApi task list schema
|   |   |   └── TaskSchema.php                          # OpenApi single task schema
|   |   └── SecuritySchemes
|   |       └── BearerToken.php                         # OpenApi secure schema
|   ├── Providers
|   |   ├── AppServiceProvider.php
|   |   ├── AuthServiceProvider.php
|   |   ├── BroadcastServiceProvider.php
|   |   ├── EventServiceProvider.php
|   |   ├── RepositoryServiceProvider.php
|   |   └── RouteServiceProvider.php
|   ├── Repositories
|   |   └── TaskListRepository.php                      # Repository to operate tasks
|   └── Services
|       ├── AuthService.php                             # Service to operate authentication/logout process
|       └── TaskListService.php                         # Service to operate tasks actions
.
```
