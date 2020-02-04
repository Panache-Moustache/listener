?php

// Include Github API client library here:
require_once __DIR__ . '/vendor/autoload.php';

// Initialize the client
$client = new \Github\Client();
$client2 = new \Github\Client();


// Login to the Github API'
$client->authenticate('', '', Github\Client::AUTH_HTTP_PASSWORD);
$client2->authenticate('', '', Github\Client::AUTH_HTTP_PASSWORD);
// Let's store the incoming webhook data into $data
$data = file_get_contents('php://input');

// Let's decode the json-encoded input
$json_data = json_decode($data, true);
#$repo_name = $json_data['repository']['name'];
$repo_name = "test1234";


// Here we need to protect the full_name branch that we have been notified about
// Post something to github API here
$params = [
    'required_status_checks' => true,
    'required_pull_request_reviews' => [
        'include_admins' => true,
    ],
    'enforce_admins' => true,
    'restrictions' => true,
];

$client->api('repo')->protection()->configure();
$client->api('repo')->protection()->update('Panache-Moustache', $repo_name, 'master', $params);


// Here we need to create an issue in the branch we have been notified about, and add tag ourselves!

$client2->api('issue')->create('Panache-Moustache', 'test1234', array('title' => 'New Security Protections added to branch', 'body' => '@gregnetau the following protections have been added to '.$repo_name.' - Required Status Checks, Required Pull Request Reviews (including admins), Enforcing Admins and Restrictions.'));

?>

