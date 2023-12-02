# Laravel Markdown Service

## Purpose

1. Laravel 공식 문서를 내려받아 마크다운 뷰어의 데이터로 이용
    - `git clone https://github.com/laravel/docs.git`
2. FileSystem을 사용한다.

## Cheatsheet

- `composer create-project laravel/laravel {project-name} --prefer-dist`

### Filesystem Facade

> File::

- `put(string $path, string $contents)` : 파일 쓰기
- `files(string $directory)`: 디렉터리 하위 파일 목록 조회
- `exists(string $path)`: 파일, 디렉터리 존재 확인
- `glob(string $pattern)`: 패턴에 맞는 파일 조회
- `isDirectory(string $directory)`: 디렉터리인지 확인
- `makeDirectory(string $path, int $mode)`: 디렉터리 생성

### Model

- `php artisan make:model {model-name}`: Model 생성

### Markdown component

- `composer require "erusev/parsedown-extra"`

### Documentation

- `app({class})`: 의존성이 모두 주입된 객체를 반환한다.
- `ServiceProvider`: 부트스트래핑시 실행할 스크립트를 작성한다. Singleton, macro 등의 작업을 정의할 수 있다.
    - `boot`에 booting 후 실행할 Tasks를 작성한다.
    - `register`에 등록 시 실행할 Tasks를 작성한다.
    - `php artisan make:provider {provider-name}`
    - Provider 등록은 전역(`config/app.php`)에 하거나 `app/Providers/AppServiceProvider.php`의 `register` 단계에서 선택적으로 하는 등을 선택할 수
      있다.
- `Exception`
    - [문서 참고](https://laravel.com/docs/10.x/errors#rendering-exceptions)
    - `renderable`/`reportable`에 등록한 함수가 아무 값을 반환하지 않는다면 기본 함수까지 올라간다.
    - `abort(status_code, "message")` 로 간단하게 HTTPException 을 보낼 수 있다.
- `auto_load`
  - 함수를 사용하기 위해서는 함수 정의 후 `auto_load`로 찾을 수 있도록 구성해야 한다.
  ```
  <config.json>
  "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        },
        "files": ["app/Helpers/markdown.php"]
    },
  ```
  -  `composer dump-autoload --optimize`로 reload
  - `tinker`에서도 사용 가능하다.
- controller 생성: `php artisan make:controller {controller-name}`
### Cache
- `.env`의 `CACHE_DRIVER`를 확인
- `config/cache.php`에서 읽는다.
- `php artisan cache:clear`: 캐시 초기화
- Client Cache
  - 이미지의 경우 변경될 여지가 더 적다.
  - 따라서 이미지 전송은 Client Cache를 이용한다(`E-tag` 및 304 Not Modified 이용)
