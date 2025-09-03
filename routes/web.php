<?php

use App\View\Components\Search;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\WebEventController;
use App\Http\Controllers\WebRequestController;
use App\Http\Controllers\User\FavoriteController;

Route::get('/clear', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    return back();
});

// User Support Ticket
Route::controller(SupportController::class)->prefix('support')->name('support.')->group(function () {
    Route::get('/all', 'supportTicket')->name('index');
    Route::get('new', 'openSupport')->name('open');
    Route::post('create', 'storeSupport')->name('store');
    Route::get('view/{number}', 'viewSupport')->name('view');
    Route::post('reply/{number}', 'replySupport')->name('reply');
    Route::post('close/{number}', 'closeSupport')->name('close');
    Route::get('download/{number}', 'supportDownload')->name('download');
});


// seach for global and services

Route::get('search', [SearchController::class, 'search'])->name('search');


Route::prefix('services')->group(function () {
    Route::post('register', [\App\Http\Controllers\Admin\ServiceRequestController::class, 'store'])->name('services.form.submit');
});



Route::controller(WebRequestController::class)->group(function () {
    // our service request

    Route::get('our-service-request', 'ourServiceRequest')->name('our-service-request.index');
    Route::post('our-service-request', 'store')->name('our-service-request.store');

    // private sector request
    Route::get('private-sector-request', 'privateSectorRequest')->name('private-sector-request.index');
    
    // financial investment request
    Route::get('financial-investment-request', 'financialInvestmentRequest')->name('financial-investment-request.index');

    // open banking request
    Route::get('open-banking-request', 'openBankingRequest')->name('open-banking-request.index');

    // settlement request
    Route::get('settlement-request', 'settlementRequest')->name('settlement-request.index');
    
});



Route::controller(WebEventController::class)->group(function () {
     // event route
     Route::get('events', 'events')->name('events');
     Route::get('event-filter', 'eventFilter')->name('eventFilter');
     Route::get('events-details/{slug}', 'eventDetails')->name('event.details');
     Route::get('event-news', 'eventNews')->name('eventNews');
     Route::get('events-news-details/{slug}', 'eventNewsDetails')->name('event.news.details');
     Route::post('event-ask-form-submit', 'eventAskFormSubmit')->name('event.ask.form_submit');
});



Route::controller(WebController::class)->group(function () {

    // blog routes
    Route::get('/blogs', 'blogs')->name('blogs');
    Route::get('/blog/{slug}', 'blogDetails')->name('blog.details');


    // auction routes
    Route::get('auctions', 'auctions')->name('auctions');
    Route::get('auction/details/{slug}', 'auctionDetails')->name('auction.details');
    Route::get('auctions-maps/{id?}', 'auctionMap')->name('auctions.maps');

    // authenticate route

    Route::middleware(['check.status'])->group(function () {
        Route::post('fav-store', 'fvtStore')->name('fvtStore');
        Route::get('bidding-offer-request-page/{auction}/{property}', 'biddingOfferRequest')->name('bidding.request.page');
        Route::post('bidding-offer-request', 'biddingOfferSend')->name('bidding.request.send');
    });

    // request
    Route::group(['prefix' => 'request', 'as' => 'request.'], function(){
        Route::get('auction-form-request/{id}', 'getAuctionRequestForm')->name('get.auction_request');
        Route::post('auction-request-form-store/{id}', 'requestAuctionRequestStore')->name('store.auction_request');
    });

    //pages routes
    Route::as('web.pages.')->group(function () {

        Route::get('sectors', 'sectors')->name('sectors');
      
        Route::get('embedded-finance', 'embeddedFinance')->name('embedded-finance');
        Route::get('smart-collection', 'smartCollection')->name('smart-collection');
        Route::get('open-banking', 'openBanking')->name('open-banking');
        Route::get('marketing', 'marketing')->name('marketing');
        Route::get('jobs', 'jobs')->name('jobs');
        Route::get('training', 'training')->name('training');
        Route::get('about-us', 'aboutus')->name('about-us');
        Route::get('investment-opportunities', 'investmentOpportunities')->name('investment-opportunities');
        Route::get('investment-opportunities-details', 'investmentOpportunityView')->name('investment-opportunity.view');
    

       
        Route::view('contact-us', 'web.pages.contact-us')->name('contact-us');
        Route::post('contact-us', 'contact_us');
        Route::get('investor-account', 'InvestorAccount')->name('investor-account');
    });

    // pages

    Route::get('/services/{slug?}', 'services')->name('services');
    Route::get('category/services/{slug}', 'categorywiseservices')->name('categorywiseservices');


    //web
    Route::get('/change/{lang?}', 'changeLanguage')->name('lang');
    Route::get('cookie-policy', 'cookiePolicy')->name('cookie.policy');
    Route::get('/cookie/accept', 'cookieAccept')->name('cookie.accept');
    Route::post('subscribe', 'subscribe')->name('subscribe');
    Route::get('policy/{slug}/{id}', 'policyPages')->name('policy.pages');
    Route::get('/{slug}', 'pages')->name('pages');
    Route::get('/', 'index')->name('home');
});


// Favorite

Route::post('add-favorite', [FavoriteController::class, 'store'])->name('favorite.store');

Route::get('get-property-type-info/{val}', [WebController::class, 'getPropertyTypeInfo'])->name('get-property-type-info');

require __DIR__ . '/auth.php';
