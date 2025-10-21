<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sso extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('model_login');
    $this->load->model('ModelAdminBagian');
  }


  public function index()
  {
    $this->session->set_userdata('state', bin2hex(random_bytes(32)));

    $params = [
      'response_type' => 'code',
      'client_id' => SSO_CLIENT_ID,
      'redirect_uri' => SSO_REDIRECT_URL,
      'scope' => 'openid profile email',
      'state' => $_SESSION['state'],
      'remember_me' => 'on',
    ];

    redirect(SSO_AUTH_URL . '?' . http_build_query($params));
  }

  public function callback()
  {
    // Check state to prevent CSRF
    if (
      empty($this->input->get('state'))
      || ($this->input->get('state') !== $this->session->userdata('state'))
    ) {
      die('Invalid state, possible CSRF attack');
    }

    // Get the authorization code
    $code = $this->input->get('code') ?? null;
    if (!$code) {
      die('No authorization code received');
    }

    // Exchange code for token using POST
    $data = [
      'grant_type' => 'authorization_code',
      'code' => $code,
      'redirect_uri' => SSO_REDIRECT_URL,
      'client_id' => SSO_CLIENT_ID,
      'client_secret' => SSO_CLIENT_SECRET
    ];

    $ch = curl_init(SSO_TOKEN_URL);
    curl_setopt_array($ch, [
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => http_build_query($data)
    ]);
    $response = curl_exec($ch);
    if (curl_errno($ch)) die('Curl error: ' . curl_error($ch));
    curl_close($ch);

    $tokenData = json_decode($response, true);

    if (!isset($tokenData['access_token'])) {
      die('Token exchange failed: ' . $response);
    }

    // Retrieve user info
    $ch = curl_init(SSO_USER_INFO_URL);
    curl_setopt_array($ch, [
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $tokenData['access_token']]
    ]);
    $userinfo = curl_exec($ch);
    curl_close($ch);

    $userData = json_decode($userinfo, true);
    // [name] => 
    // [preferred_username] => NIP
    // [given_name] => 
    // [email] => 
    $dbUser = $this->model_login->cek_username($userData['preferred_username']);
    if ($dbUser) {
      $kode_user = $dbUser->kode_user;
      $username = $dbUser->username;
      $nama_user = $dbUser->nama_user;
      $level_user = $dbUser->level_user;
      $status_user = $dbUser->status_user;
    } else {
      // Kedepan ambil data user dari master API
      $data = array(
        'username' => $userData['preferred_username'],
        'nama_user' => $userData['name'],
        'jabatan_user' => '',
        'id_unit_kerjanya' => 1,
        'password' => sha1(''),
        'status_user' => 'Aktif',
        'level_user' => 'Admin Bagian',
      );
      $kode_user = $this->ModelAdminBagian->save($data);
      $username = $userData['preferred_username'];
      $nama_user = $userData['name'];
      $level_user = 'Admin Bagian';
      $status_user = 'Aktif';
    }
    if ($level_user == 'Admin Utama') {
      $this->session->set_userdata(array(
        'adminLogin'      => TRUE,
        'kode_user'       => $kode_user,
        'username'         => $username,
        'nama_user'       => $nama_user,
        'level_user'       => $level_user,
        'status_user'       => $status_user
      ));
      redirect('adminBagian');
    } else {
      $this->session->set_userdata(array(
        'bagianLogin'      => TRUE,
        'kode_user'       => $kode_user,
        'username'         => $username,
        'nama_user'       => $nama_user,
        'level_user'       => $level_user,
        'status_user'       => $status_user
      ));
      redirect('bagian');
    }
  }
}
