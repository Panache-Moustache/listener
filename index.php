?php

// Include Github API client library here:
require_once __DIR__ . '/vendor/autoload.php';

// Initialize the client
$client = new \Github\Client();

// Login to the Github API. We need to specify our Username & API key here.
$client->authenticate('', '', Github\Client::AUTH_HTTP_PASSWORD);

// Let's store the incoming webhook data into $data
$data = file_get_contents('php://input');

// Let's decode the json-encoded input
$json_data = json_decode($data, true);
$repo_name = $json_data['repository']['name'];

// Here we need to protect the master branch of the repository that we have been notified about
// Post something to github API here

// Connect to the Test API
$client->api('repo')->protection()->configure();

// Set the protection variables
$params = [
    'required_status_checks' => [
        'strict' => true,
        'contexts' => [
        'continuous-integration/jenkins',
        ],
],
    'required_pull_request_reviews' => [
        'include_admins' => true,
    ],
    'enforce_admins' => true,
    'restrictions' => null,
];

// Apply the protections
$protection = $client->api('repo')->protection()->update('Panache-Moustache', $repo_name, 'master', $params);

// Here we need to create an issue in the branch we have been notified about, and add tag ourselves!

$client->api('issue')->create('Panache-Moustache', $repo_name, array('title' => 'New Security Protections added to branch', 'body' => '@gregnetau the following protections have been added to '.$repo_name.'.<br/>- Require Pull request reviews by admins.<br/>- Require jenkins CI status checks to pass before merging.<br/>- Including Admins on these restrictions.'));

?>
