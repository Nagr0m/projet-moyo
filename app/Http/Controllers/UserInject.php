<?php 

namespace App\Http\Controllers;

use Auth;

trait UserInject {

    /**
     * Injecte la variable $user dans la vue
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