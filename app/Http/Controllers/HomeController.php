<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class HomeController extends Controller {

	protected $admins = [
		'melinda.lesueur@jordandistrict.org',
		'john.lesueur@gmail.com',
		'jlesueur@bamboohr.com',
		'melinda.lesueur@gmail.com',
	];

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {

	}

	/**
	 * Show the application dashboard.
	 *
	 * @return Response
	 */
	public function index() {
		if (!Auth::check()) {
			return redirect()->intended('login');
		}
		$admin = false;
		if (in_array(Auth::User()->email, $this->admins)) {
			$admin = true;
		}

		return view('home', ['chosenGroup' => Auth::user()->group, 'groups' => Group::all(), 'admin' => $admin]);
	}

	/**
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function join(Request $request) {
		if (!Auth::check()) {
			return redirect()->intended('login');
		}
		$groupId = $request->get('groupId');
		if (Auth::User()->group) {
			$bag = new MessageBag(['Sorry, looks like you were already in a group.']);
			$request->session()->flash('errors', $bag);
			return;
		}
		$group = Group::find($groupId);
		if (!$group) {
			$bag = new MessageBag(['Sorry, that group does not exist.']);
			$request->session()->flash('errors', $bag);
			return;
		}
		if (count($group->user) >= 8) {
			$bag = new MessageBag(['Sorry, that group is now full.']);
			$request->session()->flash('errors', $bag);
			return;
		}
		$user = Auth::User();
		$user->group_id = $groupId;
		$user->save();
	}
}
