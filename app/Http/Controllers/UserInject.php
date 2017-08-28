<?php 

namespace App\Http\Controllers;

use Auth;

trait UserInject {

    /**
     * Inject $user in view
     *
     * @return void
     */
	public function setUser() 
	{
		view()->composer(['layouts.back', 'layouts.front'], function($view) {
			$user = Auth::user();
			$view->with('user', $user);
		});
	}
}