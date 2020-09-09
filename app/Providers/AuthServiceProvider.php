<?php

namespace App\Providers;

use App\Entity\User\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Entity\Clinic\Clinic;
use App\Entity\Clinic\DoctorClinic;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerPostPolicies();

        //
    }

    public function registerPostPolicies()
    {
        //--------------------ADMIN---------------
        Gate::define('manage-users', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-regions', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-specializations', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-clinics', function (User $user) {
            return $user->isAdmin();
        });
        
        Gate::define('manage-clinic-services', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-call-center', function (User $user) {
            return $user->isAdmin() || $user->isCallCenter();
        });

        Gate::define('manage-bookings-list', function (User $user) {
            return $user->isAdmin() || $user->isCallCenter();
        });

        Gate::define('manage-celebrations', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-partners', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-news', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-callback', function (User $user) {
            return $user->isAdmin();
        });
        
        Gate::define('manage-pages', function (User $user) {
            return $user->isAdmin();
        });

        //--------------------END-OF-ADMIN--------


        //--------------------ADMIN-PANELS---------------
        Gate::define('dashboard-panel', function (User $user) {
            return $user->isAdmin() || $user->isClinic() || $user->isCallCenter();
        });

        Gate::define('admin-panel', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('admin-clinic-panel', function (User $user) {
            return $user->isClinic();
        });

        Gate::define('admin-call-center-panel', function (User $user) {
            return $user->isCallCenter();
        });

        Gate::define('doctor-panel', function (User $user) {
            return $user->isDoctor();
        });

        Gate::define('patient-panel', function (User $user) {
            return $user->isPatient();
        });

        //--------------------END-OF-ADMIN-PANEL-------


        Gate::define('manage-own-clinics', function (User $auth_user, Clinic $clinic) {
            $isAdminClinic = $auth_user->adminClinics()->where('clinic_id', $clinic->id)->exists();

            return $auth_user->isAdmin() || ($auth_user->isClinic() && $isAdminClinic) || $auth_user->isCallCenter();
        });

        Gate::define('manage-own-doctors-clinics', function (User $auth_user, User $user, Clinic $clinic) {
            $adminClinics = $auth_user->adminClinics()->pluck('clinic_id')->toArray();
            $adminClinicsDoctors = DoctorClinic::whereIn('clinic_id', $adminClinics)->pluck('doctor_id')->toArray();
            return $auth_user->isAdmin() || ($auth_user->isClinic() && in_array($user->id, $adminClinicsDoctors) && in_array($clinic->id, $adminClinics));
        });

        Gate::define('manage-doctors', function (User $auth_user, User $user) {
            $adminClinics = $auth_user->adminClinics()->pluck('clinic_id')->toArray();
            $adminClinicsDoctors = DoctorClinic::whereIn('clinic_id', $adminClinics)->pluck('doctor_id')->toArray();

            return $auth_user->isAdmin() || ($auth_user->isClinic() && in_array($user->id, $adminClinicsDoctors)) || ($auth_user->isCallCenter() && ($user->isDoctor() || $user->isPatient() ));
        });

        Gate::define('manage-admin-clinics', function (User $auth_user, User $user) {

            return $auth_user->isAdmin() && $user->isClinic();
        });

        Gate::define('manage-doctor-timetable', function (User $auth_user, User $user) {
            $adminClinics = $auth_user->adminClinics()->pluck('clinic_id')->toArray();
            $adminClinicsDoctors = DoctorClinic::whereIn('clinic_id', $adminClinics)->pluck('doctor_id')->toArray();

            return ($auth_user->isAdmin() && $user->isDoctor()) || ($auth_user->isClinic() && in_array($user->id, $adminClinicsDoctors)) ;
        });

        Gate::define('manage-services', function (User $user) {
            return $user->isAdmin() || $user->isClinic();   // TODO clear which roles to place
        });


    }
}
