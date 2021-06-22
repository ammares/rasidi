<?php

namespace Database\Seeders;

use App\Models\EmailTemplate;
use App\Models\EmailTemplateTranslation;
use Illuminate\Database\Seeder;

class EmailTemplateSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        EmailTemplate::truncate();
        EmailTemplateTranslation::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();
        $data = [ //1
            [
                'category' => 'client',
                'name' => 'email_verified',
                'rule' => 'After the user has verified their email',
                'active' => '1',
                'en' => [
                    'subject' => 'Email Verified',
                    'message' => '<h4>Your email has been verified successfully</h4>
                <p>Thank you for using our app.</p>
                <p>All the best,</p>',
                ],
                'es' => [
                    'subject' => 'Email Verified',
                    'message' => '<h4>Your email has been verified successfully</h4>
                <p>Thank you for using our app.</p>
                <p>All the best,</p>',
                ],
            ], //2
            [
                'category' => 'client',
                'name' => 'password_has_been_reset',
                'rule' => 'After the user has reset their password',
                'active' => '1',
                'en' => [
                    'subject' => 'Password Has Been Reset',
                    'message' => '<h4>Your password has been reset successfully</h4>
                    <p>Please login to your account to continue using our app.</p>
                    <p>All the best,</p>',
                ],
                'es' => [
                    'subject' => 'Password Has Been Reset',
                    'message' => '<h4>Your password has been reset successfully</h4>
                    <p>Please login to your account to continue using our app.</p>
                    <p>All the best,</p>',
                ],
            ], //3
            [
                'category' => 'client',
                'name' => 'password_reset_code',
                'rule' => 'When a user requests to reset their password',
                'active' => '1',
                'en' => [
                    'subject' => '{reset_code} is your password reset code',
                    'message' => '<h2>You&#39;re almost there</h2>
                    <p>This is your password reset code {reset_code}.</p>
                    <p>Please use this code to reset your password.</p>
                    <p>This code will expire on {code_expires_at}</p>
                    <p><span style="background-color:#ffffff">If you didn&#39;t request this, you can safely ignore this email.</span></p>
                    <p><span style="background-color:#ffffff">Thanks,</span></p>',
                ],
                'es' => [
                    'subject' => '{reset_code} is your password reset code',
                    'message' => '<h2>You&#39;re almost there</h2>
                    <p>This is your password reset code {reset_code}.</p>
                    <p>Please use this code to reset your password.</p>
                    <p>This code will expire on {code_expires_at}</p>
                    <p><span style="background-color:#ffffff">If you didn&#39;t request this, you can safely ignore this email.</span></p>
                    <p><span style="background-color:#ffffff">Thanks,</span></p>',
                ],
            ], //4
            [
                'category' => 'client',
                'name' => 'send_email_verification_code',
                'rule' => 'When the user register or request to resend the email verification code',
                'active' => '1',
                'en' => [
                    'subject' => '{verification_code} is your email verification code',
                    'message' => '<p>Hello {user_name},</p>
                    <p>Your verification code is {verification_code}.&nbsp;</p>
                    <p>This code will expire on {expired_at}</p>
                    <p>If you didn’t request this please ignore this email.</p>
                    <p>All the best,</p>',
                ],
                'es' => [
                    'subject' => '{verification_code} is your email verification code',
                    'message' => '<p>Hello {user_name},</p>
                    <p>Your verification code is {verification_code}.&nbsp;</p>
                    <p>This code will expire on {expired_at}</p>
                    <p>If you didn’t request this please ignore this email.</p>
                    <p>All the best,</p>',
                ],
            ], //5
            [
                'category' => 'client',
                'name' => 'welcome',
                'rule' => 'When the user finishes the registration process',
                'active' => '1',
                'en' => [
                    'subject' => 'Welcome to our store',
                    'message' => '<p>Hello {name},</p>
                    <p>Thank you for joining us, it\'s a pleasure for us, we wish you a great experience</p>
                    <p>All the best,</p>',
                ],
                'es' => [
                    'subject' => 'Welcome to our store',
                    'message' => '<p>Hello {name},</p>
                    <p>Thank you for joining us, it\'s a pleasure for us, we wish you a great experience</p>
                    <p>All the best,</p>',
                ],
            ], //6
            [
                'category' => 'staff',
                'name' => 'contact_us_message',
                'rule' => 'Sent to the admin when new contact us message arrives',
                'active' => '1',
                'en' => [
                    'subject' => 'New Contact Us Message',
                    'message' => '<p>Hello,</p>
                    <p>{message}</p>
                    <p>All the best,</p>',
                ],
                'es' => [
                    'subject' => 'New Contact Us Message',
                    'message' => '<p>Hello,</p>
                    <p>{message}</p>
                    <p>All the best,</p>',
                ],
            ], //7
            [
                'category' => 'staff',
                'name' => 'user_login_credentials',
                'rule' => 'On create a new user, system will send a welcome letter with login credentials',
                'active' => '1',
                'en' => [
                    'subject' => 'User Login Credentials for {business_name}',
                    'message' => '<p>Dear {username}</p>,
                    <p>{business_name} provided you access to the Management Platform. 
                    Please find below your credentials for Login</p>
                    <p>Login Link: <a href="{url}">{url}</a></p>
                    <p>Email: {email}</p>
                    <p>Password: {password}</p>
                    <p>Regards,</p>',
                ],
                'es' => [
                    'subject' => 'User Login Credentials for {business_name}',
                    'message' => '<p>Dear {username}</p>,
                    <p>{business_name} provided you access to the Management Platform. 
                    Please find below your credentials for Login</p>
                    <p>Login Link: <a href="{url}">{url}</a></p>
                    <p>Email: {email}</p>
                    <p>Password: {password}</p>
                    <p>Regards,</p>',
                ],
            ],
        ];
        foreach ($data as $one) {
            EmailTemplate::create($one);
        }
    }
}
