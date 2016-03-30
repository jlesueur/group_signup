<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class GroupsController extends Controller {

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
		if (!Auth::check() || !Auth::User()->isAdmin()) {
			return redirect()->intended('login');
		}
		$admin = false;
		if (Auth::User()->isAdmin()) {
			$admin = true;
		}

		return view('groups', ['groups' => Group::all(), 'admin' => $admin]);
	}

	/**
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function create(Request $request) {
		if (!Auth::check() || !Auth::User()->isAdmin()) {
			return redirect()->intended('login');
		}
		Group::create([
			'name' => $request->get('name'),
		]);
	}

	/**
	 *
	 * @param Request $request
	 * @return void
	 */
	public function kick(Request $request) {
		if (!Auth::check() || !Auth::User()->isAdmin()) {
			return redirect()->intended('login');
		}
		$userId = $request->get('userId');
		$user = User::find($userId);
		$user->group_id = null;
		$user->save();
	}

	/**
	 *
	 * @param Request $request
	 * @return void
	 */
	public function delete(Request $request) {
		if (!Auth::check() || !Auth::User()->isAdmin()) {
			return redirect()->intended('login');
		}
		$groupId = $request->get('groupId');
		$group = Group::find($groupId);
		$group->delete();
	}
}
