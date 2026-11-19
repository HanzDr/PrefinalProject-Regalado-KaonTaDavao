# Kaon Ta! Davao – Regalado's Food Guide

**Student:** Derren Hanz Regalado

Laravel 12 full-stack guide for Davao City carinderias and eateries.

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate:fresh --seed
npm install
npm run build
php artisan serve
```

## Personalized Data

| Item | Value |
|---|---|
| Site title | Kaon Ta! Davao – Regalado's Food Guide |
| Districts | Poblacion, Talomo, Agdao, Buhangin, Toril, Bunawan |
| Features | Suki ni Regalado, Budget Meal, Halal, Open 24 Hours, Aircon, Parking |
| Primary user | Derren Hanz Regalado / derrenhanz@kaonta.test |
| Tita user | Tita Regalado / tita.regalado@kaonta.test |
| Both passwords | `kaonta2026` |
| Hand-made eatery | Carinderia ni Regalado |
| Eatery slug | `carinderia-ni-regalado` |
| Eatery feature | Suki ni Regalado |
| Permit | DVO-2026-1203 |
| Permit expiry | December 3, 2027 |

## Relationships

| Relationship | Type | Why this type fits |
|---|---|---|
| District → Eatery | `hasMany` / `belongsTo` | One district contains many eateries, while each eatery belongs to one district. |
| Eatery → Dish | `hasMany` / `belongsTo` | An eatery can offer many dishes, and each dish belongs to exactly one eatery. |
| Eatery → Review | `hasMany` / `belongsTo` | One eatery may receive many reviews, and every review belongs to one eatery. |
| User → Review | `hasMany` / `belongsTo` | A reviewer may write many reviews, while each review has one reviewer. |
| Eatery → Permit | `hasOne` / `belongsTo` | Each eatery has one permit record, and that permit belongs to its eatery. |
| Eatery ↔ Feature | `belongsToMany` / `belongsToMany` | An eatery can have several features, and a feature can belong to several eateries through `eatery_feature`. |
| District → Review | `hasManyThrough` | Reviews are reached from districts by passing through eateries. |

## Route List

```text
GET|HEAD  /                              home                       App\Http\Controllers\HomeController
GET|HEAD  districts                      districts.index            App\Http\Controllers\DistrictController@index
GET|HEAD  districts/{district}           districts.show             App\Http\Controllers\DistrictController@show
GET|HEAD  eateries                       eateries.index             App\Http\Controllers\EateryController@index
POST      eateries                       eateries.store             App\Http\Controllers\EateryController@store
GET|HEAD  eateries/create                eateries.create            App\Http\Controllers\EateryController@create
GET|HEAD  eateries/{eatery}              eateries.show              App\Http\Controllers\EateryController@show
PUT|PATCH eateries/{eatery}              eateries.update            App\Http\Controllers\EateryController@update
DELETE    eateries/{eatery}              eateries.destroy           App\Http\Controllers\EateryController@destroy
GET|HEAD  eateries/{eatery}/edit         eateries.edit              App\Http\Controllers\EateryController@edit
POST      eateries/{eatery}/reviews      eateries.reviews.store     App\Http\Controllers\ReviewController@store
GET|HEAD  reviewers/{user}               reviewers.show             App\Http\Controllers\ReviewerController@show
DELETE    reviews/{review}               reviews.destroy            App\Http\Controllers\ReviewController@destroy
```

## Screenshots

- [Eatery list](screenshots/eatery-list.png)
- [Eatery page with reviews](screenshots/eatery-page.png)
- [Create form showing validation errors](screenshots/create-validation-errors.png)
