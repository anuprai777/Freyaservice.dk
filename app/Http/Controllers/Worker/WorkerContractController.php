<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WorkerContractController extends Controller
{
    public function index(Request $request): View
    {
        $worker = $request->user()->workerProfile;
        $contracts = $worker->contracts()->with('client')->latest()->get();

        return view('worker.contracts.index', compact('worker', 'contracts'));
    }

    public function show(Contract $contract, Request $request): View
    {
        $worker = $request->user()->workerProfile;
        if ($contract->worker_id !== $worker->id) {
            abort(403);
        }

        return view('worker.contracts.show', compact('contract'));
    }
}
