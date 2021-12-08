<?php 

namespace App\Services;

class UserService
{
    public static function getDashboardRouteBasedOnUserInstitutionType($institutionType)
    {
        if($institutionType === 'SCHOOL') {
            return route('school.food_record.index');
        }

        if($institutionType === 'SECRETARY') {
            return route('secretary.institution.index');
        }
    }
}