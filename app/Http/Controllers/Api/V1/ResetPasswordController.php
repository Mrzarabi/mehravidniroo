<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Get the response for a successful password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetResponse(Request $request,  $response)
    {
        if($response == 'passwords.reset') {
            
            $response = ':) پسورد شما با موفقیت به روز رسانی شد ';
        }

        return response([
            'data' => $response,
            'status' => 'succes'
        ]);
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        if( $response == 'passwords.token' ) {

            $response = ':( درخواست شما منقضی شده لطفا دوباره اقدام به بازیابی پسورد کنید';
        } else {

            $response = ':( اطلاعات وارد شده صحیح نمی باشد ';
        }

        return response([
            'data' => $response,
            'status' => 'error'
        ], 422);
    }
}
