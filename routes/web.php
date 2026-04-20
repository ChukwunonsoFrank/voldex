<?php

// use App\Http\Controllers\PrivateFileController;
use App\Http\Controllers\StorageFileController;
use App\Livewire\Admin\AdminDeposit;
use App\Livewire\Admin\AdminDepositDetails;
use App\Livewire\Admin\AdminDepositIntent;
use App\Livewire\Admin\AdminEventDetails;
use App\Livewire\Admin\AdminEvents;
use App\Livewire\Admin\AdminKyc;
use App\Livewire\Admin\AdminKycDetails;
use App\Livewire\Admin\AdminStrategy;
use App\Livewire\Admin\AdminStrategyDetails;
use App\Livewire\Admin\AdminTaskDetails;
use App\Livewire\Admin\AdminTasks;
use App\Livewire\Admin\AdminWithdrawals;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\EmailBroadcast;
use App\Livewire\Admin\PaymentMethodDetails;
use App\Livewire\Admin\PaymentMethods;
use App\Livewire\Admin\Users;
use App\Livewire\Admin\UsersDetails;
use App\Livewire\Dashboard\AboutUs;
use App\Livewire\Dashboard\Account;
// use App\Livewire\Dashboard\AccountInformation;
use App\Livewire\Dashboard\Alert;
use App\Livewire\Dashboard\BindWallet;
use App\Livewire\Dashboard\Certificate;
use App\Livewire\Dashboard\ChangePassword as DashboardChangePassword;
// use App\Livewire\Dashboard\ConfirmDeposit;
// use App\Livewire\Dashboard\ConfirmWithdraw;
// use App\Livewire\Dashboard\ConnectedExchanges;
use App\Livewire\Dashboard\Contact;
// use App\Livewire\Dashboard\Deposit;
// use App\Livewire\Dashboard\DepositHistory;
use App\Livewire\Dashboard\Event;
use App\Livewire\Dashboard\Faqs;
// use App\Livewire\Dashboard\History;
// use App\Livewire\Dashboard\HistoryDetails;
// use App\Livewire\Dashboard\IdentityVerification;
use App\Livewire\Dashboard\Index;
use App\Livewire\Dashboard\Invite;
// use App\Livewire\Dashboard\Kyc;
// use App\Livewire\Dashboard\Lockout;
use App\Livewire\Dashboard\Optimize;
use App\Livewire\Dashboard\Record;
// use App\Livewire\Dashboard\Robot;
// use App\Livewire\Dashboard\Security\ChangeEmail;
// use App\Livewire\Dashboard\Security\ChangePassword;
// use App\Livewire\Dashboard\Security\Setup;
// use App\Livewire\Dashboard\Security\Twofa\DisableTwofa;
// use App\Livewire\Dashboard\Security\Twofa\Secret;
// use App\Livewire\Dashboard\Security\Twofa\VerifyTwofa;
// use App\Livewire\Dashboard\Security\VerifyChangePasswordOtp;
// use App\Livewire\Dashboard\Security\VerifyChangePasswordTwofa;
// use App\Livewire\Dashboard\ShowReferrals;
use App\Livewire\Dashboard\Start;
// use App\Livewire\Dashboard\Support;
use App\Livewire\Dashboard\TermsAndConditions;
// use App\Livewire\Dashboard\Traderoom;
// use App\Livewire\Dashboard\Transaction;
// use App\Livewire\Dashboard\VerifyOtp;
// use App\Livewire\Dashboard\VerifyWithdrawTwofa;
use App\Livewire\Dashboard\Withdraw;
// use App\Livewire\Dashboard\WithdrawAddressStep;
// use App\Livewire\Dashboard\WithdrawHistory;
use App\Livewire\Dashboard\WithdrawPasswordStep;
// use App\Livewire\FindUs;
// use App\Livewire\Privacy;
// use App\Livewire\Settings\Appearance;
// use App\Livewire\Settings\Password;
// use App\Livewire\Settings\Profile;
// use App\Livewire\Terms;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/storage-file/{path}', [StorageFileController::class, 'show'])
    ->where('path', '.*')
    ->name('storage.file');

Route::get('/link-storage', function () {
    Artisan::call('storage:link');
    dd('storage linked');
});

Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    dd('cleared cache');
});

Route::get('/cache', function () {
    Artisan::call('optimize');
    dd('cached');
});

// Route::get('/private-file/{path}', [PrivateFileController::class, 'show'])
//     ->where('path', '.*')
//     ->name('private.file');

Route::redirect('/', '/dashboard')->name('home');

Route::middleware(['auth', 'user', 'banned'])->group(function () {
    Route::get('/dashboard', Index::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard');
    Route::get('/dashboard/start', Start::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard.start');
    Route::get('/dashboard/optimize', Optimize::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard.optimize');
    Route::get('/dashboard/records', Record::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard.record');
    Route::get('/dashboard/alerts', Alert::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard.alert');
    Route::get('/dashboard/latest-event', Event::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard.event');
    Route::get('/dashboard/contact-us', Contact::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard.contact');
    Route::get('/dashboard/invite', Invite::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard.invite');
    Route::get('/dashboard/about-us', AboutUs::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard.about-us');
    Route::get('/dashboard/terms-and-conditions', TermsAndConditions::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard.terms-and-conditions');
    Route::get('/dashboard/faqs', Faqs::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard.faqs');
    Route::get('/dashboard/certificate', Certificate::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard.certificate');
    Route::get('/dashboard/bind-wallet', BindWallet::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard.bind-wallet');
    Route::get('/dashboard/change-password', DashboardChangePassword::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard.change-password');
    Route::get('/dashboard/withdraw-password-step', WithdrawPasswordStep::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard.withdraw-password-step');
    Route::get('/dashboard/withdraw', Withdraw::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard.withdraw');
    Route::get('/dashboard/account', Account::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard.account');

    // Route::get('/dashboard/history', History::class)
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.history');
    // Route::get('/dashboard/history/details', HistoryDetails::class)
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.history.details');
    // Route::get('/dashboard/robot', Robot::class)
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.robot');
    // Route::get('/dashboard/robot/lockout', Lockout::class)
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.robot.lockout');
    // Route::get('/dashboard/support', Support::class)
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.support');
    // Route::get('/dashboard/deposit', Deposit::class)
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.deposit');
    // Route::get('/dashboard/deposit/confirm', ConfirmDeposit::class)
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.deposit.confirm');
    // Route::get('/dashboard/withdraw/addressstep', WithdrawAddressStep::class)
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.withdraw.addressstep');
    // Route::get('/dashboard/withdraw/confirm', ConfirmWithdraw::class)
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.withdraw.confirm');
    // Route::get('/dashboard/withdraw/verifyotp', VerifyOtp::class)
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.withdraw.verifyotp');
    // Route::get(
    //     '/dashboard/withdraw/verifywithdrawtwofa',
    //     VerifyWithdrawTwofa::class,
    // )
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.withdraw.verifywithdrawtwofa');
    // Route::get('/dashboard/robot/traderoom', Traderoom::class)
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.robot.traderoom');
    // Route::get('/dashboard/accountinformation', AccountInformation::class)
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.accountinformation');
    // Route::get('/dashboard/transactions', Transaction::class)
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.transactions');
    // Route::get('/dashboard/connectedexchanges', ConnectedExchanges::class)
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.connectedexchanges');
    // Route::get('/dashboard/security/changeemail', ChangeEmail::class)
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.security.changeemail');
    // Route::get('/dashboard/security/changepassword', ChangePassword::class)
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.security.changepassword');
    // Route::get(
    //     '/dashboard/security/changepassword/verifyotp',
    //     VerifyChangePasswordOtp::class,
    // )
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.security.changepassword.verifyotp');
    // Route::get(
    //     '/dashboard/security/changepassword/verifytwofa',
    //     VerifyChangePasswordTwofa::class,
    // )
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.security.changepassword.verifytwofa');
    // Route::get('/dashboard/security/setup', Setup::class)
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.security.setup');
    // Route::get('/dashboard/security/2fa/secret', Secret::class)
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.security.2fa.secret');
    // Route::get('/dashboard/security/2fa/verifytwofa', VerifyTwofa::class)
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.security.2fa.verifytwofa');
    // Route::get('/dashboard/security/2fa/disabletwofa', DisableTwofa::class)
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.security.2fa.disabletwofa');
    // Route::get('/dashboard/identityverification', IdentityVerification::class)
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.identityverification');
    // Route::get('/dashboard/deposithistory', DepositHistory::class)
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.deposithistory');
    // Route::get('/dashboard/withdrawhistory', WithdrawHistory::class)
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.withdrawhistory');
    // Route::get('/dashboard/referrals', ShowReferrals::class)
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.referrals');
    // Route::get('/dashboard/kyc', Kyc::class)
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard.kyc');

    // Route::redirect('settings', 'settings/profile');
    // Route::get('settings/profile', Profile::class)->name('settings.profile');
    // Route::get('settings/password', Password::class)->name('settings.password');
    // Route::get('settings/appearance', Appearance::class)->name(
    //     'settings.appearance',
    // );
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', Dashboard::class)
            ->middleware(['auth', 'verified'])
            ->name('dashboard');
        Route::get('/dashboard/users', Users::class)
            ->middleware(['auth', 'verified'])
            ->name('dashboard.users');
        Route::get('/dashboard/events', AdminEvents::class)
            ->middleware(['auth', 'verified'])
            ->name('dashboard.events');
        Route::get('/dashboard/events/details', AdminEventDetails::class)
            ->middleware(['auth', 'verified'])
            ->name('dashboard.events.details');
        Route::get('/dashboard/tasks', AdminTasks::class)
            ->middleware(['auth', 'verified'])
            ->name('dashboard.tasks');
        Route::get('/dashboard/tasks/details', AdminTaskDetails::class)
            ->middleware(['auth', 'verified'])
            ->name('dashboard.tasks.details');
        Route::get('/dashboard/users/details', UsersDetails::class)
            ->middleware(['auth', 'verified'])
            ->name('dashboard.users.details');
        Route::get('/dashboard/broadcast', EmailBroadcast::class)
            ->middleware(['auth', 'verified'])
            ->name('dashboard.broadcast');
        Route::get('/dashboard/strategy', AdminStrategy::class)
            ->middleware(['auth', 'verified'])
            ->name('dashboard.strategy');
        Route::get('/dashboard/strategy/details', AdminStrategyDetails::class)
            ->middleware(['auth', 'verified'])
            ->name('dashboard.strategy.details');
        Route::get('/dashboard/deposits', AdminDeposit::class)
            ->middleware(['auth', 'verified'])
            ->name('dashboard.deposits');

        Route::get('/dashboard/deposit/details', AdminDepositDetails::class)
            ->middleware(['auth', 'verified'])
            ->name('dashboard.deposit.details');

        Route::get('/dashboard/depositintents', AdminDepositIntent::class)
            ->middleware(['auth', 'verified'])
            ->name('dashboard.depositintents');
        Route::get('/dashboard/withdrawals', AdminWithdrawals::class)
            ->middleware(['auth', 'verified'])
            ->name('dashboard.withdrawals');
        Route::get('/dashboard/paymentmethods', PaymentMethods::class)
            ->middleware(['auth', 'verified'])
            ->name('dashboard.paymentmethods');
        Route::get(
            '/dashboard/paymentmethods/details',
            PaymentMethodDetails::class,
        )
            ->middleware(['auth', 'verified'])
            ->name('dashboard.paymentmethods.details');
        Route::get('/dashboard/kyc', AdminKyc::class)
            ->middleware(['auth', 'verified'])
            ->name('dashboard.kyc');
        Route::get('/dashboard/kyc/details', AdminKycDetails::class)
            ->middleware(['auth', 'verified'])
            ->name('dashboard.kyc.details');
    });

require __DIR__.'/auth.php';
