<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateBuyerAddressRequest;
use App\Models\ShippingCity;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user()->load('shippingCity');
        $orders = $user->orders()
            ->with(['items.product'])
            ->latest()
            ->take(3)
            ->get();

        $shippingCities = ShippingCity::query()
            ->active()
            ->orderBy('name')
            ->get();

        $initials = collect(preg_split('/\s+/', trim((string) ($user?->name ?? 'U'))))
            ->filter()
            ->take(2)
            ->map(fn (string $part) => mb_substr($part, 0, 1))
            ->implode('');

        return view('profile.edit', [
            'user' => $user,
            'initials' => $initials,
            'orders' => $orders,
            'totalOrdersCount' => $user->orders()->count(),
            'shippingCities' => $shippingCities,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['username'] = $validated['username'] ?? null;
        $validated['phone'] = $validated['phone'] ?? null;

        $request->user()->fill($validated);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's shipping address information.
     */
    public function updateAddress(UpdateBuyerAddressRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['postal_code'] = $validated['postal_code'] ?? null;
        $validated['phone'] = $validated['phone'] ?? null;

        $request->user()->fill($validated);
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'address-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
