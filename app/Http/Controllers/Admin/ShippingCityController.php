<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShippingCityRequest;
use App\Http\Requests\UpdateShippingCityRequest;
use App\Models\ShippingCity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ShippingCityController extends Controller
{
    public function index(): View
    {
        $shippingCities = ShippingCity::query()
            ->withCount('users')
            ->latest()
            ->get();

        return view('admin.shipping-cities.index', compact('shippingCities'));
    }

    public function create(): View
    {
        return view('admin.shipping-cities.create');
    }

    public function store(StoreShippingCityRequest $request): RedirectResponse
    {
        $data = $request->validated();

        ShippingCity::query()->create([
            'name' => $data['name'],
            'slug' => $this->generateUniqueSlug($data['name']),
            'shipping_cost' => $data['shipping_cost'],
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.shipping-cities.index')
            ->with('success', 'Kota tujuan berhasil ditambahkan.');
    }

    public function edit(ShippingCity $shippingCity): View
    {
        return view('admin.shipping-cities.edit', compact('shippingCity'));
    }

    public function update(UpdateShippingCityRequest $request, ShippingCity $shippingCity): RedirectResponse
    {
        $data = $request->validated();

        $shippingCity->update([
            'name' => $data['name'],
            'slug' => $this->generateUniqueSlug($data['name'], $shippingCity->id),
            'shipping_cost' => $data['shipping_cost'],
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.shipping-cities.index')
            ->with('success', 'Kota tujuan berhasil diperbarui.');
    }

    public function destroy(ShippingCity $shippingCity): RedirectResponse
    {
        if ($shippingCity->users()->exists()) {
            return back()->with('error', 'Kota masih digunakan oleh data pengguna, tidak dapat dihapus.');
        }

        $shippingCity->delete();

        return redirect()
            ->route('admin.shipping-cities.index')
            ->with('success', 'Kota tujuan berhasil dihapus.');
    }

    private function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 1;

        while (
            ShippingCity::query()
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}
