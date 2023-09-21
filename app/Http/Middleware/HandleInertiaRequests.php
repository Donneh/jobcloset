<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $sharedData = [
            'auth' => [
                'user' => [
                    'data' => $request->user(),
                    'can' => null,
                ],
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'flash' => [
                'message' => fn() => $request->session()->get('message')
            ],
            'cart' => fn() => $request->session()->get('cart'),
        ];

        if ($request->user()) {
            $sharedData['auth']['user']['can'] = fn() => $request->user()->getAllPermissions()->pluck('name');
        }

        return array_merge(parent::share($request), $sharedData);
    }

}
