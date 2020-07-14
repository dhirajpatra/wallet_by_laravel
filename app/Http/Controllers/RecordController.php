<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wallet;
use App\Record;

class RecordController extends Controller
{
    public function index()
    {
        $wallets = auth()->user()->wallets;
        $allRecords = [];
        foreach ($wallets as $wallet) {
            $allRecords[] = $wallet->records->toArray();
        }

        return response()->json([
            'success' => true,
            'data' => $allRecords,
        ], 200);
    }

    public function show($id)
    {
        $records = Record::find($id);

        if (!$records) {
            return response()->json([
                'success' => false,
                'message' => 'Record with id ' . $id . ' not found',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $records->toArray(),
        ], 200);
    }

    /**
     * save new record into wallet
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'wallet_id' => 'required',
            'amount' => 'required',
            'type' => 'required|string',
        ]);

        $record = new Record();
        $record->wallet_id = $request->wallet_id;
        $record->amount = $request->amount;
        $record->type = $request->type == 'debit' ? 0 : 1;

        // verify
        $wallet = auth()->user()->wallets()->find($request->wallet_id);

        if (!$wallet) {
            return response()->json([
                'success' => false,
                'message' => 'Record could not be added',
            ], 500);
        }

        if ($record->save()) {
            return response()->json([
                'success' => true,
                'data' => $record->toArray(),
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Record could not be added',
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $record = Record::findOrFail($id);

        if (!$record) {
            return response()->json([
                'success' => false,
                'message' => 'Wallet with id ' . $id . ' not found',
            ], 400);
        }

        $updated = $record->update($request->all());

        if ($updated) {
            return response()->json([
                'success' => true,
            ], 204);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Record could not be updated',
            ], 500);
        }
    }

    public function remove($id)
    {
        $record = Record::findOrFail($id);

        if (!$record) {
            return response()->json([
                'success' => false,
                'message' => 'Record with id ' . $id . ' not found',
            ], 400);
        }

        if ($record->delete()) {
            return response()->json([
                'success' => true,
            ], 204);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Record could not be deleted',
            ], 500);
        }
    }
}