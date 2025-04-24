<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'street' => 'required|string|max:255',
            'city' => 'required|string',
            'barangay' => 'required|string',
            'label' => 'required|in:home,work',
            'is_default' => 'nullable|boolean',
        ]);

        // If set as default, remove default flag from others
        if ($request->has('is_default') && $request->is_default) {
            Address::where('user_id', Auth::id())->update(['is_default' => false]);
        }

        Address::create([
            'user_id' => Auth::id(),
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
            'street' => $request->street,
            'city' => $request->city,
            'barangay' => $request->barangay,
            'label' => $request->label,
            'is_default' => $request->has('is_default'),
        ]);

        return response()->json(['success' => true]);
    }
}
