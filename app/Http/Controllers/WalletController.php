<?php

namespace App\Http\Controllers;

use App\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller {
	public function index() {
		$wallets = auth()->user()->wallets;

		return response()->json([
			'success' => true,
			'data' => $wallets,
		], 200);
	}

	public function show($id) {
		$wallet = auth()->user()->wallets()->find($id);

		if (!$wallet) {
			return response()->json([
				'success' => false,
				'message' => 'Wallet with id ' . $id . ' not found',
			], 400);
		}

		return response()->json([
			'success' => true,
			'data' => $wallet->toArray(),
		], 200);
	}

	/**
	 * save new record into wallet
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function store(Request $request) {

		$this->validate($request, [
			'name' => 'required',
			'type' => 'required|string',
		]);

		$wallet = new Wallet();
		$wallet->name = $request->name;
		$wallet->type = $request->type;

		if (auth()->user()->wallets()->save($wallet)) {
			return response()->json([
				'success' => true,
				'data' => $wallet->toArray(),
			], 201);
		} else {
			return response()->json([
				'success' => false,
				'message' => 'Wallet could not be added',
			], 500);
		}

	}

	public function update(Request $request, $id) {
		$wallet = auth()->user()->wallets()->findOrFail($id);

		if (!$wallet) {
			return response()->json([
				'success' => false,
				'message' => 'Wallet with id ' . $id . ' not found',
			], 400);
		}

		$updated = $wallet->update($request->all());

		if ($updated) {
			return response()->json([
				'success' => true,
			], 204);
		} else {
			return response()->json([
				'success' => false,
				'message' => 'Wallet could not be updated',
			], 500);
		}

	}

	public function remove($id) {
		$wallet = auth()->user()->wallets()->findOrFail($id);

		if (!$wallet) {
			return response()->json([
				'success' => false,
				'message' => 'Wallet with id ' . $id . ' not found',
			], 400);
		}

		if ($wallet->delete()) {
			return response()->json([
				'success' => true,
			], 204);
		} else {
			return response()->json([
				'success' => false,
				'message' => 'Wallet could not be deleted',
			], 500);
		}
	}
}