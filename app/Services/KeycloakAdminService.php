<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KeycloakAdminService
{
    protected string $serverUrl;
    protected string $realm;
    protected string $clientId;
    protected string $clientSecret;

    public function __construct()
    {
        $this->serverUrl = rtrim(config('services.keycloak_admin.server_url'), '/');
        $this->realm = config('services.keycloak_admin.realm');
        $this->clientId = config('services.keycloak_admin.client_id');
        $this->clientSecret = config('services.keycloak_admin.client_secret');
    }

    /**
     * Récupère un access token admin via client_credentials grant.
     * Retourne null en cas d'échec (ne lève pas d'exception).
     */
    protected function getAdminToken(): ?string
    {
        try {
            $response = Http::asForm()->post(
                "{$this->serverUrl}/realms/{$this->realm}/protocol/openid-connect/token",
                [
                    'grant_type' => 'client_credentials',
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                ]
            );

            if ($response->failed()) {
                Log::error('Keycloak Admin: échec récupération token', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return null;
            }

            return $response->json('access_token');
        } catch (\Throwable $e) {
            Log::error('Keycloak Admin: exception récupération token', ['message' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Crée un utilisateur dans Keycloak.
     * Retourne l'ID Keycloak (string) en cas de succès, ou null en cas d'échec.
     */
    public function createUser(array $utilisateur): ?string
    {
        \Illuminate\Support\Facades\Log::info('createUser() appelée', ['email' => $utilisateur['email'] ?? 'N/A']);
        $token = $this->getAdminToken();

        if (! $token) {
            return null;
        }

        try {
            $response = Http::withToken($token)->post(
                "{$this->serverUrl}/admin/realms/{$this->realm}/users",
                [
                    'username' => $utilisateur['email'],
                    'email' => $utilisateur['email'],
                    'firstName' => $utilisateur['prenom'],
                    'lastName' => $utilisateur['nom'],
                    'enabled' => true,
                    'emailVerified' => true,
                    'credentials' => [
                        [
                            'type' => 'password',
                            'value' => $utilisateur['password'],
                            'temporary' => false,
                        ],
                    ],
                ]
            );

            if ($response->status() !== 201) {
                Log::error('Keycloak Admin: échec création utilisateur', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'email' => $utilisateur['email'],
                ]);
                return null;
            }

            // Keycloak retourne l'ID dans le header Location, pas dans le body
            $location = $response->header('Location');
            if (! $location) {
                return null;
            }

            // Location: http://.../admin/realms/{realm}/users/{id}
            return basename(parse_url($location, PHP_URL_PATH));
        } catch (\Throwable $e) {
            Log::error('Keycloak Admin: exception création utilisateur', [
                'message' => $e->getMessage(),
                'email' => $utilisateur['email'],
            ]);
            return null;
        }
    }
}