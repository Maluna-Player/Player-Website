<?php

include_once('class/User.class.php');
include_once('class/Contribution.class.php');

function formatContributionContent($content)
{
    $content = nl2br(htmlspecialchars($content));

    // Lien sur les adresses mail
    $content = preg_replace('#[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}#', '<a href="mailto:$0">$0</a>', $content);

    // Lien sur les urls
    $content = preg_replace('#https?://[a-z0-9._/\?=&;-]+#i', '<a href="$0" target="_blank">$0</a>', $content);

    return $content;
}


if (!isset($_SESSION['id']))
{
    include("views/connection_V.php");
}
else
{
    $user = new User($_SESSION['id']);

    $contributionNb = Contribution::count();

    if ($contributionNb % 10 == 0)
        $pageNb = $contributionNb / 10;
    else
        $pageNb = $contributionNb / 10 + 1;

    if ($contributionNb > 0)
    {
        $page = (isset($_GET['pageNum'])) ? $_GET['pageNum'] : 1;

        $contributions = Contribution::getContributions($page, 10);

        foreach ($contributions as $key => $contribution)
        {
            $contributions[$key]['title'] = htmlspecialchars($contribution['title']);
            $contributions[$key]['author'] = htmlspecialchars($contribution['author']);
            $contributions[$key]['content'] = formatContributionContent($contribution['content']);
        }
    }

    include('views/contributions_V.php');
}
