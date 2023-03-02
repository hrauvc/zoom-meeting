<?php

namespace LaravelersAcademy\ZoomMeeting\Zoom;

use Illuminate\Support\Facades\Http;
use LaravelersAcademy\ZoomMeeting\Exceptions\ZoomAuthorizationException;

class Authorization
{

	protected $baseUrl = 'https://api.zoom.us/v2/';

	public string $account;

	public string $client;

	private string $secret;

	private string $clientSecret;

	private array $authResponse;

	protected ?string $accessToken;

	protected bool $envSet = false;

	public function set(array $params)
	{

		// Nota: Puedes implementar una validación para $params

		$this->account = $params['account'];

		$this->client = $params['client'];

		$this->secret = $params['secret'];

		$this->clientSecret = $this->getClientSecret();

		$this->authResponse = $this->getAuthResponse();

		$this->accessToken = $this->getAccessToken();

		$this->envSet = $this->accessToken != null;

		return $this;

	}

	private function getClientSecret()
	{

		return base64_encode($this->client . ':' . $this->secret);

	}

	private function getAuthResponse()
	{

		$url = "https://zoom.us/oauth/token?grant_type=account_credentials&account_id=$this->account";

		$response = Http::withHeaders([
			'Authorization' => 'Basic ' . $this->clientSecret,
		])->post($url);

		return $response->json();

	}

	private function getAccessToken()
	{

		if(!array_key_exists('error', $this->authResponse) && array_key_exists('access_token', $this->authResponse)) 
			return $this->authResponse['access_token'];

		throw new ZoomAuthorizationException('Error al generar el token de acceso');

	}

	protected function checkEnv()
	{

		if(!$this->envSet) $this->setDefaultEnv();

		if(!$this->envSet) throw new ZoomAuthorizationException('Error al configurar el entorno');

	}

	private function setDefaultEnv()
	{

		if(config('zoom.use_default_env')) {

			$env = [

				'account' => config('zoom.account'),

				'client' => config('zoom.client'),

				'secret' => config('zoom.secret'),

			];

			$this->set($env);

		}

	}

}