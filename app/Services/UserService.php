<?php 

namespace App\Services;

class UserService
{
    public static function getDashboardRouteBasedOnUserInstitutionType($institutionType)
    {
        if($institutionType === 'SCHOOL') {
            return route('school.dashboard.index');
        }

        if($institutionType === 'SECRETARY') {
            return route('secretary.dashboard.index');
        }
    }
}