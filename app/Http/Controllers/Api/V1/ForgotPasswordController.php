<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Get the response for a successful password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        if($response == 'passwords.sent') {

            $response = ':) لینک بازیابی پسورد به جیمیل شما ارسال شد ';
        }
        return response([
            'data' => $response,
            'status' => 'succes'
        ]);;
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        if( $response == 'passwords.throttled' ) {

            $response = '!لینک بازیابی پسورد به جیمیل شما ارسال شده لطفا جیمیل خود راچک کنید';
        } else {

            $response = ':( اطلاعات وارد شده صحیح نمی باشد ';
        }

        return response([
            'data' => $response,
            'status' => 'error'
        ], 422);
    }
}
