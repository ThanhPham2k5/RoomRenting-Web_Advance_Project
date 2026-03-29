<?php

namespace App\Services;

use App\Http\Resources\Account_User\AccountResource;
use App\Http\Resources\Account_User\PersonalInfoResource;
use App\Http\Resources\FormResource;
use App\Models\Account_User\Account;
use App\Models\Account_User\Employee;
use App\Models\Account_User\PersonalInfo;
use App\Models\Account_User\User;
use App\Models\Form;
use Illuminate\Support\Facades\DB;

class AccountService
{
    public function createAccount($data)
    {
        return DB::transaction(function() use ($data){
            // Create PersonalInfo
            $personalInfo = PersonalInfo::create([
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
            ]);

            // Create Account
            $account = Account::create([
                'username' => $data['username'],
                'password' => bcrypt($data['password']),
                'role' => $data['role'],
            ]);

            //assign rolePermission
            $roles = $data['rolePermission'];
            foreach($roles as $role){
                $account->assignRole($role);
            }

            $profile = null;

            if($data['role'] === 'user'){
                // Create User
                $profile = User::create([
                    'points' => 0,
                    'account_id' => $account->id,
                    'personal_info_id' => $personalInfo->id,
                ]);

                $form = Form::create([
                    'account_id' =>$account->id,
                ]);

                return [
                    'account' => new AccountResource($account),
                    'profile' => $profile,
                    'personalInfo' => new PersonalInfoResource($personalInfo),
                    'form' => new FormResource($form)
                ];
            }else{
                // Create Employee
                $profile = Employee::create([
                    'account_id' => $account->id,
                    'personal_info_id' => $personalInfo->id,
                ]);
                return [
                    'account' => new AccountResource($account),
                    'profile' => $profile,
                    'personalInfo' => new PersonalInfoResource($personalInfo),
                ];
            }            
        });
    }

    public function updateAccount($account, $data){
        // Update Account
        $account->update([
            'username' => $data['username'] ?? $account->username,
            'password' => isset($data['password']) 
                ? bcrypt($data['password']) 
                : $account->password,
            'role' => $data['role'] ?? $account->role,
        ]);

        return response()->json([
            'message' => 'Account updated successfully',
            'post' => new AccountResource($account)
        ]);
    }

    public function deleteAccount($account)
    {
        return DB::transaction(function () use ($account) {
            // Delete User or Employee
            if ($account->user) {
                $account->form->delete();
                $account->user->personalInfo->delete();
                $account->user->delete();
            }

            if ($account->employee) {
                $account->employee->personalInfo->delete();
                $account->employee->delete();
            }

            // Delete Account
            $account->delete();

            return [
                'message' => 'Account deleted successfully'
            ];
        });
    }

    public function restoreAccount($account)
    {
        return DB::transaction(function () use ($account) {
            // Restore User
            if ($account->user()->withTrashed()->exists()) {
                $user = $account->user()->withTrashed()->first();
                
                $user->personalInfo()->withTrashed()->restore();
                $user->restore();
                $account->form()->withTrashed()->restore();
            }

            // Restore Employee
            if ($account->employee()->withTrashed()->exists()) {
                $employee = $account->employee()->withTrashed()->first();
                
                $employee->personalInfo()->withTrashed()->restore();
                $employee->restore();
            }

            // Restore Account
            $account->restore();

            return [
                'message' => 'Account restored successfully'
            ];
        });
    }
}
?>