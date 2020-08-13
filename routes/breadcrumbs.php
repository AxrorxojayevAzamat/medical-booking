<?php

use App\Entity\News;
use App\Entity\Region;
use App\Entity\Partner;
use App\Entity\Contacts;
use App\Entity\Book\Book;
use App\Entity\User\User;
use App\Entity\Celebration;
use App\Entity\Clinic\Clinic;
use App\Entity\Clinic\Contact;
use App\Entity\Clinic\Service;
use App\Entity\Pages;
use App\Entity\Clinic\Specialization;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Crumbs;

Breadcrumbs::register('home', function (Crumbs $crumbs) {
    $crumbs->push(trans('breadcrumb_fe.main'), route('home'));
});

// Clinics
Breadcrumbs::register('clinics.index', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push(trans('menu.clinics'), route('clinics.index'));
});

Breadcrumbs::register('clinics.show', function (Crumbs $crumbs, Clinic $clinic) {
    $crumbs->parent('clinics.index');
    $crumbs->push($clinic->name, route('clinics.show', $clinic));
});

Breadcrumbs::register('slug', function (Crumbs $crumbs, $slug) {
    $crumbs->parent('home');
    $crumbs->push($slug, route('slug'));
});

// Doctors
Breadcrumbs::register('doctors.index', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push(trans('menu.doctors'), route('doctors.index'));
});

Breadcrumbs::register('doctors.show', function (Crumbs $crumbs, User $doctor) {
    $crumbs->parent('doctors.index');
    $crumbs->push($doctor->profile->fullName, route('doctors.show', $doctor));
});

Breadcrumbs::register('doctors.book', function (Crumbs $crumbs, User $doctor, Clinic $clinic) {
    $crumbs->parent('doctors.show', $doctor);
    $crumbs->push(trans('doctors.booking'), route('doctors.book', ['doctor' => $doctor, 'clinic' => $clinic]));
});


//contacts
Breadcrumbs::register('contacts.contacts', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push(trans('breadcrumb_fe.recall'), route('contacts.contacts'));
});

//specialization
Breadcrumbs::register('specializations', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push(trans('menu.specialization'), route('specializations'));
});


//user profile
// Breadcrumbs::register('patient.mybookings', function (Crumbs $crumbs) {
//     $crumbs->parent('home');
//     $crumbs->push('Bookings', route('patient.mybookings',Auth::id()));
// });

// News
Breadcrumbs::register('news.index', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push(trans('breadcrumb_fe.news'), route('news.index'));
});

Breadcrumbs::register('news.show', function (Crumbs $crumbs, News $news) {
    $crumbs->parent('news.index');
    $crumbs->push($news->title, route('news.show', $news));
});

///////////////////////////////// Admin

Breadcrumbs::register('admin.home', function (Crumbs $crumbs) {
    $crumbs->push(trans('breadcrumbs.main'), route('admin.home'));
});

//users
Breadcrumbs::register('admin.users.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(trans('breadcrumbs.users'), route('admin.users.index'));
});

Breadcrumbs::register('admin.users.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.users.index');
    $crumbs->push(trans('breadcrumbs.create_user'), route('admin.users.create'));
});

Breadcrumbs::register('admin.users.show', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.users.index');
    $crumbs->push($user->email, route('admin.users.show', $user));
});

Breadcrumbs::register('admin.users.edit', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.users.show', $user);
    $crumbs->push(trans('breadcrumbs.edit'), route('admin.users.edit', $user));
});

Breadcrumbs::register('admin.users.specializations', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.users.show', $user);
    $crumbs->push(trans('Cпециализация'), route('admin.users.specializations', $user)); 
});

Breadcrumbs::register('admin.users.user-clinics', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.users.show', $user);
    $crumbs->push(trans('breadcrumbs.doctors_clinic'), route('admin.users.user-clinics', $user));
});
Breadcrumbs::register('admin.users.main-photo', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.users.show', $user);
    $crumbs->push(trans('breadcrumbs.main_photo'), route('admin.users.main-photo', $user));
});
Breadcrumbs::register('admin.users.photos', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.users.show', $user);
    $crumbs->push(trans('breadcrumbs.photos'), route('admin.users.photos', $user));
});

Breadcrumbs::register('admin.users.admin-clinics', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.users.show', $user);
    $crumbs->push(trans('Клиники админа'), route('admin.users.admin-clinics', $user));
});


// regions
Breadcrumbs::register('admin.regions.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(trans('breadcrumbs.regions'), route('admin.regions.index'));
});

Breadcrumbs::register('admin.regions.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.regions.index');
    $crumbs->push(trans('breadcrumbs.create_regions'), route('admin.regions.create'));
});

Breadcrumbs::register('admin.regions.show', function (Crumbs $crumbs, Region $region) {
    $crumbs->parent('admin.regions.index');
    $crumbs->push($region->name_ru, route('admin.regions.show', $region));
});

Breadcrumbs::register('admin.regions.edit', function (Crumbs $crumbs, Region $region) {
    $crumbs->parent('admin.regions.show', $region);
    $crumbs->push(trans('breadcrumbs.edit'), route('admin.regions.edit', $region));
});

// clinics
Breadcrumbs::register('admin.clinics.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(trans('Клиники'), route('admin.clinics.index')); 
});

Breadcrumbs::register('admin.clinics.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.clinics.index');
    $crumbs->push(trans('breadcrumbs.create_clinic'), route('admin.clinics.create'));
});

Breadcrumbs::register('admin.clinics.show', function (Crumbs $crumbs, Clinic $clinic) {
    $crumbs->parent('admin.clinics.index');
    $crumbs->push($clinic->name_ru, route('admin.clinics.show', $clinic));
});
Breadcrumbs::register('admin.clinics.edit', function (Crumbs $crumbs, Clinic $clinic) {
    $crumbs->parent('admin.clinics.show', $clinic);
    $crumbs->push('Редактировать', route('admin.clinics.edit', $clinic));
});

Breadcrumbs::register('admin.clinics.main-photo', function (Crumbs $crumbs, Clinic $clinic) {
    $crumbs->parent('admin.clinics.show', $clinic);
    $crumbs->push(trans('breadcrumbs.main_photo'), route('admin.clinics.main-photo', $clinic));
});

Breadcrumbs::register('admin.clinics.photos', function (Crumbs $crumbs, Clinic $clinic) {
    $crumbs->parent('admin.clinics.show', $clinic);
    $crumbs->push(trans('breadcrumbs.add_photo'), route('admin.clinics.photos', $clinic));
});

// Clinic services
Breadcrumbs::register('admin.services.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Сервисы', route('admin.services.index'));
});

Breadcrumbs::register('admin.services.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.services.index');
    $crumbs->push('Добавить', route('admin.services.create'));
});

Breadcrumbs::register('admin.services.show', function (Crumbs $crumbs, Service $service) {
    $crumbs->parent('admin.services.index');
    $crumbs->push($service->name_ru, route('admin.services.show', $service));
});
Breadcrumbs::register('admin.services.edit', function (Crumbs $crumbs, Service $service) {
    $crumbs->parent('admin.services.show', $service);
    $crumbs->push('Редактировать', route('admin.services.edit', $service));
});

// Clinic contacts
Breadcrumbs::register('admin.clinics.contacts.create', function (Crumbs $crumbs, Clinic $clinic) {
    $crumbs->parent('admin.clinics.show', $clinic);
    $crumbs->push('Добавить контакт', route('admin.clinics.contacts.create', $clinic));
});

Breadcrumbs::register('admin.clinics.contacts.show', function (Crumbs $crumbs, Clinic $clinic, Contact $contact) {
    $crumbs->parent('admin.clinics.show', $clinic);
    $crumbs->push($contact->value, route('admin.clinics.contacts.show', ['clinic' => $clinic, 'contact' => $contact]));
});
Breadcrumbs::register('admin.clinics.contacts.edit', function (Crumbs $crumbs, Clinic $clinic, Contact $contact) {
    $crumbs->parent('admin.clinics.show', $clinic);
    $crumbs->push($contact->value, route('admin.clinics.contacts.edit', ['clinic' => $clinic, 'contact' => $contact]));
});

// specializations

Breadcrumbs::register('admin.specializations.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(trans('Специализации'), route('admin.specializations.index'));
});

Breadcrumbs::register('admin.specializations.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.specializations.index');
    $crumbs->push(trans('breadcrumbs.create_specialization'), route('admin.specializations.create'));
});

Breadcrumbs::register('admin.specializations.show', function (Crumbs $crumbs, Specialization $specialization) {
    $crumbs->parent('admin.specializations.index');
    $crumbs->push($specialization->name_ru, route('admin.specializations.show', $specialization));
});
Breadcrumbs::register('admin.specializations.edit', function (Crumbs $crumbs, Specialization $specialization) {
    $crumbs->parent('admin.specializations.index');
    $crumbs->push($specialization->name_ru, route('admin.specializations.index', $specialization));
});

// celebration
Breadcrumbs::register('admin.celebration.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(trans('breadcrumbs.holidays'), route('admin.celebration.index'));
});

Breadcrumbs::register('admin.celebration.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.celebration.index');
    $crumbs->push(trans('breadcrumbs.create_holidays'), route('admin.celebration.create'));
});
Breadcrumbs::register('admin.celebration.edit', function (Crumbs $crumbs, Celebration $celebration) {
    $crumbs->parent('admin.celebration.index');
    $crumbs->push(trans('breadcrumbs.edit_holidays'), route('admin.celebration.edit', $celebration));
});

// partners
Breadcrumbs::register('admin.partners.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(trans('breadcrumbs.partners'), route('admin.partners.index'));
});
Breadcrumbs::register('admin.partners.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.partners.index');
    $crumbs->push(trans('breadcrumbs.add_new_partner'), route('admin.partners.create'));
});
Breadcrumbs::register('admin.partners.show', function (Crumbs $crumbs, Partner $partner) {
    $crumbs->parent('admin.partners.index');
    $crumbs->push($partner->name, route('admin.partners.show', $partner));
});
Breadcrumbs::register('admin.partners.edit', function (Crumbs $crumbs, Partner $partner) {
    $crumbs->parent('admin.partners.index');
    $crumbs->push($partner->name, route('admin.partners.edit', $partner));
});
// timetables
Breadcrumbs::register('admin.timetables.create', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.users.edit', $user);
    $crumbs->push(trans('breadcrumbs.create_timetable_doctor'), route('admin.timetables.create'));
});
Breadcrumbs::register('admin.timetables.edit', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.users.edit', $user);
    $crumbs->push(trans('breadcrumbs.edit_timetable_doctor'), route('admin.timetables.edit'));
});


// booking
Breadcrumbs::register('admin.call-center.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(trans('breadcrumbs.patients'), route('admin.call-center.index'));
});

Breadcrumbs::register('admin.call-center.create-patient', function (Crumbs $crumbs) {
    $crumbs->parent('admin.call-center.index');
    $crumbs->push(trans('breadcrumbs.create_new_patient'), route('admin.call-center.create-patient'));
});

Breadcrumbs::register('admin.call-center.patient-doctor', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.call-center.index');
    $crumbs->push(trans('breadcrumbs.select_doctor'), route('admin.call-center.patient-doctor', $user));
});

Breadcrumbs::register('admin.call-center.show-doctor', function (Crumbs $crumbs, User $user, User $doctor) {
    $crumbs->parent('admin.call-center.patient-doctor', $user);
    $crumbs->push(trans('breadcrumbs.book_doctor'), route('admin.call-center.show-doctor', [$user,$doctor]));
});

//BookList
Breadcrumbs::register('admin.books.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(trans('Ваше бронирование'), route('admin.books.index')); 
});
Breadcrumbs::register('admin.books.show', function (Crumbs $crumbs, Book $book) {
    $crumbs->parent('admin.books.index');
    $crumbs->push('Заказ № '.$book->id, route('admin.books.show', [$book]));
});


// news
Breadcrumbs::register('admin.news.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(trans('breadcrumbs.news'), route('admin.news.index'));
});

Breadcrumbs::register('admin.news.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.news.index');
    $crumbs->push(trans('breadcrumbs.add_news'), route('admin.news.create'));
});

Breadcrumbs::register('admin.news.show', function (Crumbs $crumbs, News $news) {
    $crumbs->parent('admin.news.index');
    $crumbs->push($news->title_ru, route('admin.news.show', $news));
});

Breadcrumbs::register('admin.news.edit', function (Crumbs $crumbs, News $news) {
    $crumbs->parent('admin.news.index');
    $crumbs->push(trans('breadcrumbs.edit_news'), route('admin.news.edit', $news));
});

// contact us
Breadcrumbs::register('admin.contactlist', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(trans('breadcrumbs.recall'), route('admin.contactlist'));
});

// pages
Breadcrumbs::register('admin.pages.pages', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Pages', route('admin.pages.pages'));
});
Breadcrumbs::register('admin.pages.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.pages.pages');
    $crumbs->push('Create', route('admin.pages.create'));
});
Breadcrumbs::register('admin.pages.view', function (Crumbs $crumbs) {
    $crumbs->parent('admin.pages.pages');
    $crumbs->push('View', route('admin.pages.view'));
});
Breadcrumbs::register('admin.pages.edit', function (Crumbs $crumbs) {
    $crumbs->parent('admin.pages.pages');
    $crumbs->push('Edit', route('admin.pages.edit'));
});


// cabinet-doctor

Breadcrumbs::register('doctor.profile', function (Crumbs $crumbs) {
    $crumbs->push(trans('panel.doctor.doctor'), route('doctor.profile'));
});

Breadcrumbs::register('doctor.timetable', function (Crumbs $crumbs) {
    $crumbs->parent('doctor.profile');
    $crumbs->push(trans('panel.doctor.timetable'), route('doctor.timetable'));
});

Breadcrumbs::register('doctor.profileEdit', function (Crumbs $crumbs) {
    $crumbs->parent('doctor.profile');
    $crumbs->push(trans('panel.doctor.edit'), route('doctor.profileEdit'));
});

Breadcrumbs::register('doctor.editSpecialization', function (Crumbs $crumbs) {
    $crumbs->parent('doctor.profile');
    $crumbs->push(trans('panel.doctor.specialization'), route('doctor.editSpecialization'));
});

Breadcrumbs::register('doctor.doctorbookings', function (Crumbs $crumbs, $user) {
    $crumbs->parent('doctor.profile');
    $crumbs->push(trans('panel.doctor.timetable'), route('doctor.doctorbookings', $user));
});

Breadcrumbs::register('doctor.main-photo', function (Crumbs $crumbs) {
    $crumbs->parent('doctor.profile');
    $crumbs->push(trans('panel.doctor.mainphoto'), route('doctor.main-photo'));
});

Breadcrumbs::register('doctor.photos', function (Crumbs $crumbs) {
    $crumbs->parent('doctor.profile');
    $crumbs->push(trans('panel.doctor.photos'), route('doctor.photos'));
});

Breadcrumbs::register('doctor.edit', function (Crumbs $crumbs) {
    $crumbs->parent('doctor.profile');
    $crumbs->push(trans('panel.doctor.timetable'), route('doctor.edit'));
});

//cabinet-patient

Breadcrumbs::register('patient.profile', function (Crumbs $crumbs) {
    $crumbs->push(trans('panel.user.user'), route('patient.profile'));
});

Breadcrumbs::register('patient.mybookings', function (Crumbs $crumbs, $user) {
    $crumbs->parent('patient.profile');
    $crumbs->push(trans('panel.doctor.timetable'), route('patient.mybookings', $user));
});

Breadcrumbs::register('patient.profileEdit', function (Crumbs $crumbs) {
    $crumbs->parent('patient.profile');
    $crumbs->push(trans('panel.doctor.edit'), route('patient.profileEdit'));
});
