<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\ApprovalHelper;
use App\Helpers\AttachmentHelper;
use App\Helpers\AuxHelper;
use App\Helpers\UserHelper;
use App\Helpers\MailHelper;
use App\Models\Company;
use App\Models\CompanyContact;
use App\Models\CompanyTax;
use App\Models\Attachment;
use App\Models\CompanyDeed;
use App\Models\CompanyPermit;
use App\Models\CompanyCapital;
use App\Models\CompanyProject;
use App\Models\CompanyEmployee;
use App\Models\CompanyPersonnel;
use App\Models\CompanyExperience;
use App\Models\CompanyCertificate;
use App\Models\CompanyStackholder;
use App\Models\CompanyRegistration;

class VerificationController extends Controller
{
    public function vendor_accept(Request $request)
    {
        $password       = AuxHelper::generate_password();

        $user_id        = intval($request->verification['user']);
        $actor_id       = intval($request->verification['actor']);
        $date           = $request->verification['date'];
        $company_id     = $request->company_id;

        $data           = array(
                            'user_id' => $user_id,
                            'actor_id' => $actor_id,
                            'date' => $date,
                            'password' => $password
                          );

        $user           = UserHelper::set_verified($data);

        if($user != null) {
            $email_data = [
                'email'     => $user->email,
                'name'      => $user->name,
                'data'      => [
                                'username'  => $user->email,
                                'name'      => $user->name,
                                'password'  => $password,
                                ],
                'type'      => 'user',
                'action'    => 'verification',
            ];

            MailHelper::sendEmail($email_data);
        }

        return redirect('/vendor/detail/' . $company_id);
    }

    public function vendor_redo(Request $request)
    {
        $approval_id    = ApprovalHelper::save_data($request->approval);
        $user           = UserHelper::set_revalidated($request->user_id);
        $company_id     = $request->company_id;

        if($user != null) {
            $email_data   = [
                'email'             => $user->email,
                'name'              => $user->name,
                'data'              => [
                                          'name'  => $user->name,
                                          'notes' => $request->approval['notes'],
                                          'paramsend'   => base64_encode($user->email.'~'.$user->telp.'~'.'paramsend'),
                                        ],
                'type'              => 'user',
                'action'            => 'redo_verification',
            ];
            // MailHelper::queue($email_data);
            MailHelper::sendEmail($email_data);
        }

        return redirect('/vendor/detail/' . $company_id);
    }

    public function vendor_reject(Request $request)
    {
        $approval_id    = ApprovalHelper::save_data($request->approval);
        $user           = UserHelper::set_revalidated($request->user_id);
        $company_id     = $request->company_id;

        if($user != null) {
            $email_data   = [
                'email'             => $user->email,
                'name'              => $user->name,
                'data'              => [
                                          'name'  => $user->name,
                                          'notes' => $request->approval['notes'],
                                        ],
                'type'              => 'user',
                'action'            => 'rejection',
            ];
            // MailHelper::queue($email_data);
            MailHelper::sendEmail($email_data);

            $company    = Company::find($company_id);
            if($company != null) {
                CompanyContact::where('company_id', $company_id)->delete();
                CompanyCapital::where('company_id', $company_id)->delete();
                CompanyCertificate::where('company_id', $company_id)->delete();
                CompanyDeed::where('company_id', $company_id)->delete();
                CompanyEmployee::where('company_id', $company_id)->delete();
                CompanyExperience::where('company_id', $company_id)->delete();
                CompanyPermit::where('company_id', $company_id)->delete();
                CompanyPersonnel::where('company_id', $company_id)->delete();
                CompanyProject::where('company_id', $company_id)->delete();
                CompanyRegistration::where('company_id', $company_id)->delete();
                CompanyStackholder::where('company_id', $company_id)->delete();
                CompanyTax::where('company_id', $company_id)->delete();
                AttachmentHelper::company_remove($company_id);

                $company->delete();
            }

            $user->delete();
        }

        return 'OK';
        // return redirect('/vendor/detail/' . $company_id);
    }
}
