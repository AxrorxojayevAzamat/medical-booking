<?php

use App\Clinic;
use App\User;
use App\Region;
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
    $crumbs->push($user->name, route('admin.users.show', $user));
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
    $crumbs->push('Редакирование', route('admin.region.edit', $region));
});
Breadcrumbs::register('admin.region.editCity', function (Crumbs $crumbs, Region $region) {
    $crumbs->parent('admin.region.index');
    $crumbs->push('Редакирование', route('admin.region.editCity', $region));
});
Breadcrumbs::register('admin.region.editDistrict', function (Crumbs $crumbs, Region $region) {
    $crumbs->parent('admin.region.index');
    $crumbs->push('Редакирование', route('admin.region.editDistrict', $region));
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
    $crumbs->push($clinic->id, route('admin.clinic.show', $clinic));
});
