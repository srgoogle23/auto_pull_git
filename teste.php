<?php
$url = 'http://localhost/git/Handler.php';
$ch = curl_init( $url );
$payload = array (
    'ref' => 'refs/heads/main',
    'before' => '31a69d85e883ef9e8234c896d521127ca74355c2',
    'after' => 'eb3afefff6d6afce4f2e952668876c31a617ba13',
    'repository' => 
    array (
      'id' => 351428855,
      'node_id' => 'MDEwOlJlcG9zaXRvcnkzNTE0Mjg4NTU=',
      'name' => 'srgoogle23',
      'full_name' => 'srgoogle23/srgoogle23',
      'private' => false,
      'owner' => 
      array (
        'name' => 'srgoogle23',
        'email' => '62403037+srgoogle23@users.noreply.github.com',
        'login' => 'srgoogle23',
        'id' => 62403037,
        'node_id' => 'MDQ6VXNlcjYyNDAzMDM3',
        'avatar_url' => 'https://avatars.githubusercontent.com/u/62403037?v=4',
        'gravatar_id' => '',
        'url' => 'https://api.github.com/users/srgoogle23',
        'html_url' => 'https://github.com/srgoogle23',
        'followers_url' => 'https://api.github.com/users/srgoogle23/followers',
        'following_url' => 'https://api.github.com/users/srgoogle23/following{/other_user}',
        'gists_url' => 'https://api.github.com/users/srgoogle23/gists{/gist_id}',
        'starred_url' => 'https://api.github.com/users/srgoogle23/starred{/owner}{/repo}',
        'subscriptions_url' => 'https://api.github.com/users/srgoogle23/subscriptions',
        'organizations_url' => 'https://api.github.com/users/srgoogle23/orgs',
        'repos_url' => 'https://api.github.com/users/srgoogle23/repos',
        'events_url' => 'https://api.github.com/users/srgoogle23/events{/privacy}',
        'received_events_url' => 'https://api.github.com/users/srgoogle23/received_events',
        'type' => 'User',
        'site_admin' => false,
      ),
      'html_url' => 'https://github.com/srgoogle23/srgoogle23',
      'description' => NULL,
      'fork' => false,
      'url' => 'https://github.com/srgoogle23/srgoogle23',
      'forks_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/forks',
      'keys_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/keys{/key_id}',
      'collaborators_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/collaborators{/collaborator}',
      'teams_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/teams',
      'hooks_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/hooks',
      'issue_events_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/issues/events{/number}',
      'events_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/events',
      'assignees_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/assignees{/user}',
      'branches_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/branches{/branch}',
      'tags_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/tags',
      'blobs_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/git/blobs{/sha}',
      'git_tags_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/git/tags{/sha}',
      'git_refs_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/git/refs{/sha}',
      'trees_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/git/trees{/sha}',
      'statuses_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/statuses/{sha}',
      'languages_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/languages',
      'stargazers_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/stargazers',
      'contributors_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/contributors',
      'subscribers_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/subscribers',
      'subscription_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/subscription',
      'commits_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/commits{/sha}',
      'git_commits_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/git/commits{/sha}',
      'comments_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/comments{/number}',
      'issue_comment_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/issues/comments{/number}',
      'contents_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/contents/{+path}',
      'compare_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/compare/{base}...{head}',
      'merges_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/merges',
      'archive_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/{archive_format}{/ref}',
      'downloads_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/downloads',
      'issues_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/issues{/number}',
      'pulls_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/pulls{/number}',
      'milestones_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/milestones{/number}',
      'notifications_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/notifications{?since,all,participating}',
      'labels_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/labels{/name}',
      'releases_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/releases{/id}',
      'deployments_url' => 'https://api.github.com/repos/srgoogle23/srgoogle23/deployments',
      'created_at' => 1616675439,
      'updated_at' => '2021-03-27T23:50:50Z',
      'pushed_at' => 1616889321,
      'git_url' => 'git://github.com/srgoogle23/srgoogle23.git',
      'ssh_url' => 'git@github.com:srgoogle23/srgoogle23.git',
      'clone_url' => 'https://github.com/srgoogle23/srgoogle23.git',
      'svn_url' => 'https://github.com/srgoogle23/srgoogle23',
      'homepage' => NULL,
      'size' => 24,
      'stargazers_count' => 0,
      'watchers_count' => 0,
      'language' => NULL,
      'has_issues' => true,
      'has_projects' => true,
      'has_downloads' => true,
      'has_wiki' => true,
      'has_pages' => false,
      'forks_count' => 0,
      'mirror_url' => NULL,
      'archived' => false,
      'disabled' => false,
      'open_issues_count' => 0,
      'license' => NULL,
      'forks' => 0,
      'open_issues' => 0,
      'watchers' => 0,
      'default_branch' => 'main',
      'stargazers' => 0,
      'master_branch' => 'main',
    ),
    'pusher' => 
    array (
      'name' => 'srgoogle23',
      'email' => '62403037+srgoogle23@users.noreply.github.com',
    ),
    'sender' => 
    array (
      'login' => 'srgoogle23',
      'id' => 62403037,
      'node_id' => 'MDQ6VXNlcjYyNDAzMDM3',
      'avatar_url' => 'https://avatars.githubusercontent.com/u/62403037?v=4',
      'gravatar_id' => '',
      'url' => 'https://api.github.com/users/srgoogle23',
      'html_url' => 'https://github.com/srgoogle23',
      'followers_url' => 'https://api.github.com/users/srgoogle23/followers',
      'following_url' => 'https://api.github.com/users/srgoogle23/following{/other_user}',
      'gists_url' => 'https://api.github.com/users/srgoogle23/gists{/gist_id}',
      'starred_url' => 'https://api.github.com/users/srgoogle23/starred{/owner}{/repo}',
      'subscriptions_url' => 'https://api.github.com/users/srgoogle23/subscriptions',
      'organizations_url' => 'https://api.github.com/users/srgoogle23/orgs',
      'repos_url' => 'https://api.github.com/users/srgoogle23/repos',
      'events_url' => 'https://api.github.com/users/srgoogle23/events{/privacy}',
      'received_events_url' => 'https://api.github.com/users/srgoogle23/received_events',
      'type' => 'User',
      'site_admin' => false,
    ),
    'created' => false,
    'deleted' => false,
    'forced' => false,
    'base_ref' => NULL,
    'compare' => 'https://github.com/srgoogle23/srgoogle23/compare/31a69d85e883...eb3afefff6d6',
    'commits' => 
    array (
      0 => 
      array (
        'id' => 'eb3afefff6d6afce4f2e952668876c31a617ba13',
        'tree_id' => 'c9e4c1c0288e572d2538c95aaba6681bceae1672',
        'distinct' => true,
        'message' => 'Update README.md',
        'timestamp' => '2021-03-27T20:55:21-03:00',
        'url' => 'https://github.com/srgoogle23/srgoogle23/commit/eb3afefff6d6afce4f2e952668876c31a617ba13',
        'author' => 
        array (
          'name' => 'Leonardo Oliveira',
          'email' => '62403037+srgoogle23@users.noreply.github.com',
          'username' => 'srgoogle23',
        ),
        'committer' => 
        array (
          'name' => 'GitHub',
          'email' => 'noreply@github.com',
          'username' => 'web-flow',
        ),
        'added' => 
        array (
        ),
        'removed' => 
        array (
        ),
        'modified' => 
        array (
          0 => 'README.md',
        ),
      ),
    ),
    'head_commit' => 
    array (
      'id' => 'eb3afefff6d6afce4f2e952668876c31a617ba13',
      'tree_id' => 'c9e4c1c0288e572d2538c95aaba6681bceae1672',
      'distinct' => true,
      'message' => 'Update README.md',
      'timestamp' => '2021-03-27T20:55:21-03:00',
      'url' => 'https://github.com/srgoogle23/srgoogle23/commit/eb3afefff6d6afce4f2e952668876c31a617ba13',
      'author' => 
      array (
        'name' => 'Leonardo Oliveira',
        'email' => '62403037+srgoogle23@users.noreply.github.com',
        'username' => 'srgoogle23',
      ),
      'committer' => 
      array (
        'name' => 'GitHub',
        'email' => 'noreply@github.com',
        'username' => 'web-flow',
      ),
      'added' => 
      array (
      ),
      'removed' => 
      array (
      ),
      'modified' => 
      array (
        0 => 'README.md',
      ),
    ),
);
$payload = json_encode($payload);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
$header = 'Accept: */*
Accept-Encoding: gzip
Cdn-Loop: cloudflare
Cf-Connecting-Ip: 140.82.115.155
Cf-Ipcountry: US
Cf-Ray: 636c8c96085c5ebf-IAD
Cf-Request-Id: 0917b631c300005ebf062ed000000001
Cf-Visitor: {"scheme":"https"}
Connection: upgrade
Content-Length: 7386
Content-Type: application/json
User-Agent: GitHub-Hookshot/8dde19c
X-Forwarded-For: 140.82.115.155, 172.70.45.164
X-Forwarded-Proto: http
X-Github-Delivery: e4077124-8f57-11eb-9576-81495a02032a
X-Github-Event: push
X-Github-Hook-Id: 288884478
X-Github-Hook-Installation-Target-Id: 351428855
X-Github-Hook-Installation-Target-Type: repository
X-Hub-Signature: sha1=a7a64e65a2381bb013be6b75789a9549d8fd5c64
X-Hub-Signature-256: sha256=091f86fdfaa579b4e33f924e025d3fce9a5ab8b73ca4a55c8e4a37a661c1d7cc
X-Real-Ip: 172.70.45.164';
$header_arr= explode(PHP_EOL, $header);
foreach($header_arr as $arr){
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array($arr));
}
# Return response instead of printing.
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
# Send request.
$result = curl_exec($ch);
curl_close($ch);
# Print response.
echo "<pre>$result</pre>";