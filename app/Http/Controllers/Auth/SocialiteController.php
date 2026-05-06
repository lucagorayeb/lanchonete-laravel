<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

/**
 * Controller de autenticacao social.
 *
 * Integracao temporariamente pausada.
 */
class SocialiteController extends Controller
{
    /**
     * Endpoint mantido apenas por compatibilidade temporaria.
     */
    public function redirectToProvider(string $provider)
    {
        /*
         * Fluxo original de login social (Google/Facebook) temporariamente comentado.
         *
         * $this->validateProvider($provider);
         *
         * // stateless() evita o InvalidStateException causado por
         * // incompatibilidade de sessao entre redirect e callback
         * return Socialite::driver($provider)->stateless()->redirect();
         */
        abort(404);
    }

    /**
     * Endpoint mantido apenas por compatibilidade temporaria.
     */
    public function handleProviderCallback(string $provider)
    {
        /*
         * Fluxo original de callback social (Google/Facebook) temporariamente comentado.
         *
         * $this->validateProvider($provider);
         *
         * try {
         *     // setHttpClient(['verify' => false]) bypassa erro de SSL local do cURL no Windows
         *     $socialUser = Socialite::driver($provider)
         *         ->stateless()
         *         ->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))
         *         ->user();
         * } catch (\Exception $e) {
         *     \Log::error('OAuth callback error: ' . $e->getMessage());
         *     return redirect()->route('autorizacao.login')
         *         ->with('mensagem', 'Nao foi possivel autenticar com ' . ucfirst($provider) . '. Tente novamente.');
         * }
         *
         * $user = User::where('provider', $provider)
         *             ->where('provider_id', $socialUser->getId())
         *             ->first();
         *
         * if (! $user) {
         *     $user = User::where('email', $socialUser->getEmail())->first();
         *
         *     if ($user) {
         *         $user->update([
         *             'provider'    => $provider,
         *             'provider_id' => $socialUser->getId(),
         *             'avatar'      => $socialUser->getAvatar(),
         *         ]);
         *     } else {
         *         $user = User::create([
         *             'name'        => $socialUser->getName() ?? $socialUser->getNickname() ?? 'Usuario',
         *             'email'       => $socialUser->getEmail(),
         *             'provider'    => $provider,
         *             'provider_id' => $socialUser->getId(),
         *             'avatar'      => $socialUser->getAvatar(),
         *             'password'    => Str::random(32),
         *         ]);
         *     }
         * } else {
         *     $user->update(['avatar' => $socialUser->getAvatar()]);
         * }
         *
         * Auth::login($user, remember: true);
         *
         * return redirect()->intended(route('cardapio.index'))
         *     ->with('mensagem', 'Bem-vindo, ' . $user->name . '!');
         */
        abort(404);
    }
}
