<?php

namespace App\Services;

use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Http\Resources\Account_User\AccountResource;
use App\Http\Resources\Account_User\PersonalInfoResource;
use App\Http\Resources\FormResource;
use App\Models\Account_User\Account;
use App\Models\Account_User\Employee;
use App\Models\Account_User\PersonalInfo;
use App\Models\Account_User\User;
use App\Models\Form;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Hash;

class AccountService
{

    private $allowedIncludes = [
        'form',
        'user',
        'roles',
        'permissions',
        'roles.permissions',
        'employee',
        'user.posts',
        'employee.posts',
        'user.personalInfo',
        'employee.personalInfo',
        'comments',
        'favorites.post',
        'rechargeBills',
        'payBills',
        'notifications'
    ];

    private $allColFilter = [
        'username',
        'role'
    ];

    public function createAccount($data)
    {
        return DB::transaction(function() use ($data){
        
            // Create Account
            $account = Account::create([
                'username' => $data['username'],
                'password' => bcrypt($data['password']),
                'role' => $data['role'],
            ]);

            // Create PersonalInfo
            $personalInfo = PersonalInfo::create([
                'id' => $account->id,
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
            ]);

            //assign rolePermission
            $roles = $data['roles'];
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

        // Nếu key 'roles' tồn tại trong request (ngay cả khi nó là []), syncRoles sẽ xóa hết role cũ
        if (array_key_exists('roles', $data)) {
            $account->syncRoles($data['roles']);
        }

        return [
            'message' => 'Account updated successfully',
            'post' => new AccountResource($account)
        ];
    }

    public function deleteAccount($account)
    {
        return DB::transaction(function () use ($account) {
            // Delete User or Employee
            if ($account->user) {
                $account->form->delete();
                $account->user->personalInfo->delete();
                $account->user->posts()->delete();
                $account->user->delete();
                $account->comments()->delete();
                $account->favorites()->delete();
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
                $user->restore();

                if ($user->posts()->withTrashed()){
                    $user->posts()->withTrashed()->restore();
                }

                $user->personalInfo()->withTrashed()->restore();

                if ($account->comments()->withTrashed()){
                    $account->comments()->withTrashed()->restore();
                }

                if ($account->favorites()->withTrashed()){
                    $account->favorites()->withTrashed()->restore();
                }
                
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

    public function getAccount($account){
        $account = QueryBuilder::for(Account::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($account->id);

        return $account;
    }

    public function buildGetAllQuery(){
        $query = QueryBuilder::for(Account::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            //generic search
            AllowedFilter::custom('search', new AllColumnFilter($this->allColFilter)),

            //specific filter
            AllowedFilter::partial('username'),
            AllowedFilter::exact('id'),

            AllowedFilter::exact('role'),
            AllowedFilter::custom('createdAt', new DateFilter(), 'created_at'),
            // Tuấn thêm
            AllowedFilter::trashed(),
        ])
        ->allowedSorts([
            'id',
            AllowedSort::field('createdAt', 'created_at'),
        ]);

        return $query;
    }

    public function changePassword($account, $currentPassword, $newPassword)
    {
        // Check if current password is correct
        if (!Hash::check($currentPassword, $account->password)) {
            return [
                'success' => false,
                'message' => 'Mật khẩu hiện tại không đúng.'
            ];
        }

        // Check if new password is different from current password
        if (Hash::check($newPassword, $account->password)) {
            return [
                'success' => false,
                'message' => 'Mật khẩu mới không được giống mật khẩu cũ.'
            ];
        }

        // Update to new password
        $account->password = Hash::make($newPassword);
        $account->save();

        return [
            'success' => true,
            'message' => 'Mật khẩu đã được thay đổi thành công.'
        ];
    }
}
?>