<?php

use App\Entity\Celebration;
use App\Entity\Clinic\Clinic;
use App\Entity\News;
use App\Entity\User\User;
use App\Entity\Region;
use App\Entity\Clinic\Specialization;
use App\Entity\Partner;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Crumbs;

Breadcrumbs::register('admin.home', function (Crumbs $crumbs) {
    $crumbs->push(trans('Главная'), route('admin.home'));
});

//users
Breadcrumbs::register('admin.users.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Пользователи', route('admin.users.index'));
});
Breadcrumbs::register('admin.users.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.users.index');
    $crumbs->push(trans('Создать пользователя'), route('admin.users.create'));
});

Breadcrumbs::register('admin.users.show', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.users.index');
    $crumbs->push($user->email, route('admin.users.show', $user));
});

Breadcrumbs::register('admin.users.edit', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.users.show', $user);
    $crumbs->push(trans('Редактировать'), route('admin.users.edit', $user));
});

Breadcrumbs::register('admin.users.specializations', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.users.show', $user);
    $crumbs->push(trans('Специализации'), route('admin.users.specializations', $user));
});

Breadcrumbs::register('admin.users.user-clinics', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.users.show', $user);
    $crumbs->push(trans('Клиники врача'), route('admin.users.user-clinics', $user));
});


//regions
Breadcrumbs::register('admin.regions.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Регионы', route('admin.regions.index'));
});

Breadcrumbs::register('admin.regions.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.regions.index');
    $crumbs->push('Создать регион', route('admin.regions.create'));
});

Breadcrumbs::register('admin.regions.show', function (Crumbs $crumbs, Region $region) {
    $crumbs->parent('admin.regions.index');
    $crumbs->push($region->name_ru, route('admin.regions.show', $region));
});

Breadcrumbs::register('admin.regions.edit', function (Crumbs $crumbs, Region $region) {
    $crumbs->parent('admin.regions.show', $region);
    $crumbs->push('Редактировать', route('admin.regions.edit', $region));
});

//clinics
Breadcrumbs::register('admin.clinic.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Клиники', route('admin.clinic.index'));
});

Breadcrumbs::register('admin.clinic.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.clinic.index');
    $crumbs->push('Клиники', route('admin.clinic.create'));
});

Breadcrumbs::register('admin.clinic.show', function (Crumbs $crumbs, Clinic $clinic) {
    $crumbs->parent('admin.clinic.index');
    $crumbs->push($clinic->name_ru, route('admin.clinic.show', $clinic));
});
Breadcrumbs::register('admin.clinic.edit', function (Crumbs $crumbs, Clinic $clinic) {
    $crumbs->parent('admin.clinic.index');
    $crumbs->push($clinic->name_ru, route('admin.clinic.edit', $clinic));
});

Breadcrumbs::register('admin.clinic.main-photo', function (Crumbs $crumbs, Clinic $clinic) {
    $crumbs->parent('admin.clinic.show', $clinic);
    $crumbs->push('Главное фото', route('admin.clinic.main-photo', $clinic));
});
Breadcrumbs::register('admin.clinic.photos', function (Crumbs $crumbs, Clinic $clinic) {
    $crumbs->parent('admin.clinic.show', $clinic);
    $crumbs->push('Добавление фотографий', route('admin.clinic.photos', $clinic));
});

//specializations

Breadcrumbs::register('admin.specializations.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Специализации', route('admin.specializations.index'));
});

Breadcrumbs::register('admin.specializations.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.specializations.index');
    $crumbs->push('Создать специализацию', route('admin.specializations.create'));
});

Breadcrumbs::register('admin.specializations.show', function (Crumbs $crumbs, Specialization $specialization) {
    $crumbs->parent('admin.specializations.index');
    $crumbs->push($specialization->name_ru, route('admin.specializations.show', $specialization));
});
Breadcrumbs::register('admin.specializations.edit', function (Crumbs $crumbs, Specialization $specialization) {
    $crumbs->parent('admin.specializations.index');
    $crumbs->push($specialization->name_ru, route('admin.specializations.index', $specialization));
});

//celebration
Breadcrumbs::register('admin.celebration.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Праздничные дни', route('admin.celebration.index'));
});

Breadcrumbs::register('admin.celebration.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.celebration.index');
    $crumbs->push('Создать праздничный день', route('admin.celebration.create'));
});
Breadcrumbs::register('admin.celebration.edit', function (Crumbs $crumbs, Celebration $celebration) {
    $crumbs->parent('admin.celebration.index');
    $crumbs->push('Создать праздничный день', route('admin.celebration.edit', $celebration));
});

//partners
Breadcrumbs::register('admin.partners.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Партнеры', route('admin.partners.index'));
});
Breadcrumbs::register('admin.partners.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.partners.index');
    $crumbs->push('Добавление нового партнера', route('admin.partners.create'));
});
Breadcrumbs::register('admin.partners.show', function (Crumbs $crumbs, Partner $partner) {
    $crumbs->parent('admin.partners.index');
    $crumbs->push($partner->name, route('admin.partners.show', $partner));
});
Breadcrumbs::register('admin.partners.edit', function (Crumbs $crumbs, Partner $partner) {
    $crumbs->parent('admin.partners.index');
    $crumbs->push($partner->name, route('admin.partners.edit', $partner));
});
//timetables
Breadcrumbs::register('admin.timetables.create', function (Crumbs $crumbs) {
    //$crumbs->parent('admin.users.edit', $user);
    $crumbs->push('Создать расписание врача', route('admin.timetables.create'));
});
Breadcrumbs::register('admin.timetables.edit', function (Crumbs $crumbs) {
    //$crumbs->parent('admin.users.edit', $user);
    $crumbs->push('Редактирование расписания врача', route('admin.timetables.edit'));
});

//booking
Breadcrumbs::register('admin.call-center.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Пациенты', route('admin.call-center.index'));
});

Breadcrumbs::register('admin.call-center.create-patient', function (Crumbs $crumbs) {
    $crumbs->parent('admin.call-center.index');
    $crumbs->push('Создание нового пациента', route('admin.call-center.create-patient'));
});

Breadcrumbs::register('admin.call-center.patient-doctor', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.call-center.index');
    $crumbs->push('Выбрать врача', route('admin.call-center.patient-doctor', $user));
});

Breadcrumbs::register('admin.call-center.show-doctor', function (Crumbs $crumbs, User $user, User $doctor) {
    $crumbs->parent('admin.call-center.patient-doctor', $user);
    $crumbs->push('Бронирование врача', route('admin.call-center.show-doctor', [$user,$doctor]));
});

Breadcrumbs::register('admin.books.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Бронирование', route('admin.books.index'));
});


// News
Breadcrumbs::register('admin.news.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Новости', route('admin.news.index'));
});

Breadcrumbs::register('admin.news.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.news.index');
    $crumbs->push('Добавить новость', route('admin.news.create'));
});

Breadcrumbs::register('admin.news.show', function (Crumbs $crumbs, News $news) {
    $crumbs->parent('admin.news.index');
    $crumbs->push($news->title_ru, route('admin.news.show', $news));
});

Breadcrumbs::register('admin.news.edit', function (Crumbs $crumbs, News $news) {
    $crumbs->parent('admin.news.index');
    $crumbs->push('Редактировать новость', route('admin.news.edit', $news));
});
