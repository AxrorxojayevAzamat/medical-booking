<?php

use App\Entity\Celebration;
use App\Entity\Clinic\Clinic;
use App\Entity\User\User;
use App\Entity\Region;
use App\Entity\Clinic\Specialization;
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
Breadcrumbs::register('admin.region.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Регионы', route('admin.region.index'));
});

Breadcrumbs::register('admin.region.edit', function (Crumbs $crumbs, Region $region) {
    $crumbs->parent('admin.region.index');
    $crumbs->push($region->name_ru, route('admin.region.edit', $region));
});
Breadcrumbs::register('admin.region.editCity', function (Crumbs $crumbs, Region $region) {
    $crumbs->parent('admin.region.index');
    $crumbs->push($region->name_ru, route('admin.region.editCity', $region));
});
Breadcrumbs::register('admin.region.editDistrict', function (Crumbs $crumbs, Region $region) {
    $crumbs->parent('admin.region.index');
    $crumbs->push($region->name_ru, route('admin.region.editDistrict', $region));
});

Breadcrumbs::register('admin.region.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.region.index');
    $crumbs->push('Создать регион', route('admin.region.create'));
});

Breadcrumbs::register('admin.region.createCity', function (Crumbs $crumbs) {
    $crumbs->parent('admin.region.index');
    $crumbs->push('Создать город', route('admin.region.createCity'));
});

Breadcrumbs::register('admin.region.createDistrict', function (Crumbs $crumbs) {
    $crumbs->parent('admin.region.index');
    $crumbs->push('Создать район', route('admin.region.createDistrict'));
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

//timetables
Breadcrumbs::register('admin.timetables.create', function (Crumbs $crumbs) {
    //$crumbs->parent('admin.users.edit', $user);
    $crumbs->push('Создать расписание врача', route('admin.timetables.create'));
});

//booking
Breadcrumbs::register('admin.call-center.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Поиск врача', route('admin.call-center.index'));
});

Breadcrumbs::register('admin.call-center.booking-time', function (Crumbs $crumbs, User $user, Clinic $clinic) {
    $crumbs->parent('admin.call-center.index');
    $crumbs->push('Бронирование врача', route('admin.call-center.booking-time', [$user, $clinic]));
});

Breadcrumbs::register('admin.call-center.booking', function (Crumbs $crumbs, User $user, Clinic $clinic) {
    $crumbs->parent('admin.call-center.index');
    $crumbs->push('Зарегистрировать нового пользователя', route('admin.call-center.booking', [$user, $clinic]));
});



Breadcrumbs::register('admin.books.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Бронирование', route('admin.books.index'));
});
