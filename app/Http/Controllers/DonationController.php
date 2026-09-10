<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Project;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function show(Request $request)
    {
        $projects = Project::published()->orderBy('title')->get(['id','title']);
        return view('pages.donate', [
            'projects' => $projects,
            'preselected' => $request->query('project'),
        ]);
    }

    public function store(Request $request, PaymentService $payments)
    {
        $data = $request->validate([
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'required|email',
            'amount' => 'required|numeric|min:1|max:1000000',
            'currency' => 'nullable|string|size:3',
            'type' => 'required|in:individual,company',
            'recurring' => 'sometimes|boolean',
            'project_id' => 'nullable|exists:projects,id',
        ]);

        $donation = Donation::create([
            ...$data,
            'currency' => $data['currency'] ?? 'RON',
            'recurring' => (bool) ($data['recurring'] ?? false),
            'status' => 'pending',
            'donated_at' => now(),
        ]);

        $result = $payments->initiate($donation);

        if (!empty($result['redirect_url'])) {
            return redirect()->away($result['redirect_url']);
        }

        return redirect()->route('donate.thanks', $donation);
    }

    public function thanks(Donation $donation)
    {
        return view('pages.donate-thanks', compact('donation'));
    }
}
